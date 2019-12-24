<?php
include 'system/Controller.php';
class admin extends Controller
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function sessionVerify($data){
		if($data=='verify'){
			if (!(array_key_exists('data', $_SESSION) && $_SESSION['data']['userRank'] == 'admin')){
				$this->load->redirectIn();
			}
		}
	}
	
	public function index(){
		$this->sessionVerify('verify');
		$data = array(
			'title'=> 'Dashboard | Retail Manager'
		);
		$this->load->view('admin/home',$data);
	}
	
	public function order(){
		$this->sessionVerify('verify');
		if(func_get_arg(0)==null)
		{
			$data = array(
				'title'=> 'Orders | A-1 Marin Tailors'
			);
				
			$data['css'] = array('global/plugins/datatables/datatables.min.css',
													 'global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css'
			);
			$data['js'] = array('global/plugins/datatables/datatables.min.js',
													'global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js',
						'js/orderList.js'
			);
			$this->load->model("adminModel");
			$adminModel = new adminModel();
			$data['order'] = $adminModel->getOrder();
			/*echo "<pre>";
              var_dump($data['order']);
              echo "</pre>";*/
			$this->load->view('admin/orderList', $data);
		}else{
				$reqData = func_get_arg(0);
				if($reqData[0]=='new' && sizeof($reqData)==1){
					
					$data = array(
							'title'=> 'Add New Order | A-1 Marin Tailors'
							);
					$data['css'] = array('global/plugins/select2/css/select2.min.css');
					$data['js'] = array('global/plugins/select2/js/select2.min.js','js/order.js');
					$this->load->model('adminModel');
					$adminModel = new adminModel();
					$data['customer'] = $adminModel->getCustomer();
					$data['dress'] = $adminModel->getDress();
					$this->load->view('admin/orderStart', $data);
				}
				if($reqData[0]=='next'){
					$dressID = Validation::verify($_POST['dress']);
					$customerID = Validation::verify($_POST['customer']);
					$this->load->redirectIn("admin/order/new/".$dressID."/".$customerID);
				}
				if($reqData[0]=='new' && sizeof($reqData)==3){
					$data = array(
						'title'=> 'Add New Order | A-1 Marin Tailors'
					);
					$data['css'] = array(	'global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css');
					$data['js'] = array('global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
															'js/order.js'
					);
					$this->load->middleware('DressMiddleware');
					$dressMiddleware = new DressMiddleware();
					$data['dress'] = $dressMiddleware->getDressInfo($reqData[1]);
					
					$this->load->model('adminModel');
					$adminModel = new adminModel();
					$data['customer'] = $adminModel->getCustomerInfo($reqData[2])->fetch_assoc();
					$data['employeeCutting'] = $adminModel->getEmployee();
					$data['employeeStitching'] = $adminModel->getEmployee();
					$data['feature'] = $adminModel->getFeatures($data['dress']['featureID']);
					$this->load->view('admin/orderFinish', $data);
				}
				if($reqData[0]=='confirm'){
					$orderArray = $_POST;
					$this->load->middleware('OrderMiddleware');
					$orderMiddleware = new OrderMiddleware();
					$result = $orderMiddleware->addOrder($orderArray);
					echo "<pre>";
					print_r($orderArray);
					//var_dump($result);
					echo "</pre>";
				}
				if($reqData[0]=='view'){
					$data = array(
						'title'=> 'Add New Order | A-1 Marin Tailors'
					);
					$data['css'] = array('css/orderView.css');
					$data['js'] = array('js/orderView.js');
					$this->load->middleware('OrderMiddleware');
					$orderMiddleware = new OrderMiddleware();
					$data['order'] = $orderMiddleware->getOrder($reqData[1]);
					$data['dress'] = $orderMiddleware->getDressInfo($data['order']['orderInfo']['dressID']);
					$data['employee'] = $orderMiddleware->getAssignment($reqData[1]);
					$this->load->model("adminModel");
					$adminModel = new adminModel();
					$data['feature'] = $adminModel->getFeatureSL($data['order']['orderInfo']['featureSL'])->fetch_assoc();
					/*echo "<pre>";
					print_r($data['feature']);
					echo "</pre>";
					echo "<pre>";
					print_r($data['dress']);
					echo "</pre>";*/
					$this->load->view("admin/order", $data);
				}
				if($reqData[0]=='edit'&& sizeof($reqData)==2){
					$data = array(
						'title'=> 'Edit Order | A-1 Marin Tailors'
					);
					$data['css'] = array(	'global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css');
					$data['js'] = array('global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
															'js/order.js'
					);
					$this->load->middleware('OrderMiddleware');
					$orderMiddleware = new OrderMiddleware();
					$res = $orderMiddleware->getOrder($reqData[1]);
					/*echo "<pre>";
					print_r($res);
					echo "</pre>";*/
					$data['order'] = $res;
					$data['dress'] = $orderMiddleware->getDressInfo($res['orderInfo']['dressID']);
					
					$this->load->model('adminModel');
					$adminModel = new adminModel();
					$data['customer'] = $adminModel->getCustomerInfo($res['orderInfo']['customerID'])->fetch_assoc();
					$data['employeeCutting'] = $adminModel->getEmployee();
					$data['employeeStitching'] = $adminModel->getEmployee();
					$data['selectedEmployee'] = $orderMiddleware->getAssignment($reqData[1]);
					$data['features'] = $adminModel->getFeatureSL($res['orderInfo']['featureSL'])->fetch_assoc();
					$data['feature'] = $adminModel->getFeatures($data['dress']['featureID']);
					$this->load->view('admin/orderEdit', $data);
				}
				if($reqData[0]=='copy'&& sizeof($reqData)==2){
					$data = array(
						'title'=> 'Copy Order | A-1 Marin Tailors'
					);
					$data['css'] = array(	'global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css');
					$data['js'] = array('global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
															'js/order.js'
					);
					$this->load->middleware('OrderMiddleware');
					$orderMiddleware = new OrderMiddleware();
					$res = $orderMiddleware->getOrder($reqData[1]);
					/*echo "<pre>";
					print_r($res);
					echo "</pre>";*/
					$data['order'] = $res;
					$data['dress'] = $orderMiddleware->getDressInfo($res['orderInfo']['dressID']);
					
					$this->load->model('adminModel');
					$adminModel = new adminModel();
					$data['customer'] = $adminModel->getCustomerInfo($res['orderInfo']['customerID'])->fetch_assoc();
					$data['employeeCutting'] = $adminModel->getEmployee();
					$data['employeeStitching'] = $adminModel->getEmployee();
					$data['selectedEmployee'] = $orderMiddleware->getAssignment($reqData[1]);
					$data['features'] = $adminModel->getFeatureSL($res['orderInfo']['featureSL'])->fetch_assoc();
					$data['feature'] = $adminModel->getFeatures($data['dress']['featureID']);
					$this->load->view('admin/orderCopy', $data);
				}
				if($reqData[0]=='change'){
					$orderArray = $_POST;
					$this->load->middleware('OrderMiddleware');
					$orderMiddleware = new OrderMiddleware();
					$result = $orderMiddleware->updateOrder($orderArray);

				}
			}
		}
	
	public function customer(){
		$this->sessionVerify('verify');
		if(func_get_arg(0)==null)
		{
			$data = array(
				'title'=> 'Customers | A-1 Marin Tailors'
			);
				
			$data['css'] = array('global/plugins/datatables/datatables.min.css',
													 'global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css'
			);
			$data['js'] = array('global/plugins/datatables/datatables.min.js',
													'global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js',
						'js/customerList.js'
			);
			$this->load->model("adminModel");
			$adminModel = new adminModel();
			$data['customer'] = $adminModel->getCustomer();
			$this->load->view('admin/customerList', $data);
		}else{
			$reqData = func_get_arg(0);
			if($reqData[0]=='new'){
				$data = array(
						'title'=> 'Add New Customer | A-1 Marin Tailors'
						);
				$data['css'] = array();
				$data['js'] = array('js/newCustomer.js');
				$this->load->view('admin/newCustomer', $data);
			}
			if($reqData[0]=='add'){
				/*echo "<pre>";
				print_r($_POST);
				echo "</pre>";*/
				$name = Validation::verify($_POST['name']);
				$mobile = Validation::verify($_POST['mobile']);
				$address = Validation::verify($_POST['address']);
				$this->load->middleware("CustomerMiddleware");
				$customerMiddleware = new CustomerMiddleware();
				$customerMiddleware->addCustomer($name, $mobile, $address);
			}
		}
	}
	
	public function invoice(){
		$this->sessionVerify('verify');
		if(func_get_arg(0)==null)
		{
			$data = array(
				'title'=> 'Invoice | A-1 Marin Tailors'
			);
				
			$data['css'] = array('global/plugins/datatables/datatables.min.css',
													 'global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css'
			);
			$data['js'] = array('global/plugins/datatables/datatables.min.js',
													'global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js',
						'js/invoiceList.js'
			);
			/*$this->load->model("adminModel");
			$adminModel = new adminModel();
			$data['invoice'] = $adminModel->getInvoice();
			$this->load->view('admin/invoiceList', $data);*/
			$this->load->middleware("InvoiceMiddleware");
			$invoiceMiddleware = new InvoiceMiddleware();
			$data['invoice'] = $invoiceMiddleware->getAllInvoice();
			/*echo "<pre>";
			print_r($data['invoice']);
			echo "</pre>";*/
			$this->load->view('admin/invoiceList',$data);
		}else{
			$reqData = func_get_arg(0);
			if($reqData[0]=='new'){
					$data = array(
							'title'=> 'Create New Invoice | A-1 Marin Tailors'
							);
					$data['css'] = array('global/plugins/select2/css/select2.min.css');
					$data['js'] = array('global/plugins/select2/js/select2.min.js','js/newInvoice.js');
					$this->load->model('adminModel');
					$adminModel = new adminModel();
					$data['customer'] = $adminModel->getCustomer();
					$this->load->view('admin/invoiceStart', $data);
			}
			if($reqData[0]=='create'){
				$customerID = $_POST['customerID'];
				/*echo "<pre>";
				print_r($_POST);
				echo "</pre>";*/
				$this->load->middleware("InvoiceMiddleware");
				$invoiceMiddleware = new InvoiceMiddleware();
				$invoiceMiddleware->createInvoice($customerID);
			}
			if($reqData[0]=='payment'){
				$data = array(
					'title'=> 'Invoice | A-1 Marin Tailors'
				);
				$data['js'] = array('js/invoice.js');
				$this->load->middleware("InvoiceMiddleware");
				$invoiceMiddleware = new InvoiceMiddleware();
				$result = $invoiceMiddleware->getInvoice($reqData[1]);
				$data['info'] = $result;
				$data['id'] = $reqData[1];
				$this->load->view('admin/invoiceWork',$data);
			}
			if($reqData[0]=='view'){
				$data = array(
					'title'=> 'Invoice | A-1 Marin Tailors'
				);
				$data['js'] = array('js/invoice.js');
				$this->load->middleware("InvoiceMiddleware");
				$invoiceMiddleware = new InvoiceMiddleware();
				$result = $invoiceMiddleware->getInvoice($reqData[1]);
				$data['info'] = $result;
				$data['id'] = $reqData[1];
				$this->load->view('admin/invoiceView',$data);
			}
			if($reqData[0]=='process'){
				echo "<pre>";
				print_r($_POST);
				echo "</pre>";
				$invID = Validation::verify($_POST['invID']);
				$discount = Validation::verify($_POST['discount']);
				$nagori = Validation::verify($_POST['nagori']);
				$payment = Validation::verify($_POST['payment']);
				$accountID = Validation::verify($_POST['account']);
				$total = Validation::verify($_POST['total']);
				$paid = Validation::verify($_POST['paid']);
				$this->load->middleware("InvoiceMiddleware");
				$invoiceMiddleware = new InvoiceMiddleware();
				$invoiceMiddleware->makePayment($invID, $accountID, $nagori, $discount, $payment, $total, $paid);
				$redirect = "admin/invoice/view/".$invID;
				$this->load->redirectIn($redirect);
			}
		}
	}
	
}