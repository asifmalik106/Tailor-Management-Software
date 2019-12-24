<?php
include 'system/Middleware.php';


/* File: Main Controler
 * Handle all primary requests. It handles Login Requests and authenticate users.
 * Asif Salman Malik
 * Incresome Inc.
 *
 */
class InvoiceMiddleware extends Middleware
{
	function __construct()
	{
		parent::__construct();
	}

  public function createInvoice($id){
		$this->load->model('adminModel');
		$dbModel = new adminModel();
		$result = $dbModel->getUnassignedInvoice($id);
		$orderString = "";
		while($row = $result->fetch_assoc()){
			$orderString.=$row['orderID'].",";
		}
		if($orderString!=""){
			$dbModel->addInvoice($id, $orderString, 0.0, 0.0);
			$r = $dbModel->getInvoice()->fetch_assoc()['invID'];
			$result = $dbModel->getUnassignedInvoice($id);
			while($row = $result->fetch_assoc()){
				$dbModel->assignInvoiceID($row['orderID'], $r);
			}
			$redirect = "admin/invoice/payment/".$r;
			$this->load->redirectIn($redirect);
		}

		/*$result = $result->fetch_assoc();
		$dressFields = $result['dressFields'];
		$dressFields = explode(";", $dressFields);*/
  }
	
	public function getInvoice($id){
		$this->load->model('adminModel');
		$dbModel = new adminModel();
		$result = $dbModel->getInvoiceInfo($id)->fetch_assoc();
		$order = $result['invOrder'];
		$order = explode(",",$order);
		$orderArray = array();
		for($i = 0; $i<sizeof($order)-1; $i++){
			$tempOrder = $this->getOrder($order[$i]);
			array_push($orderArray, $tempOrder);
		}
		$payment = $dbModel->getInvoiceTotalPayment($id)->fetch_assoc()['payment'];
		$accounts = $dbModel->getAccounts("deposit");
		return array('invoice'=>$result, 'order'=>$orderArray, 'payment'=>$payment, 'accounts'=>$accounts);
	}
	
	public function getAllInvoice(){
		$this->load->model("adminModel");
		$finalInvoice = array();
		$adminModel = new adminModel();
		$data = $adminModel->getInvoice();
		while($row = $data->fetch_assoc()){
			$total = 0;
			$orders = explode(",",$row['invOrder']);
			foreach($orders as $o){
				if($o['orderID'] == "")
					break;
				$price = (float)$adminModel->getOrderInfo($o)->fetch_assoc()['orderPrice'];
				$qty = (float)$adminModel->getOrderInfo($o)->fetch_assoc()['orderQuantity'];
				$total += ($price*$qty);
			}
			//echo $total ." Nagori: ". (float)$row['invNagori'] ." Discount:". (float)$row['invDiscount'];
			$total = $total + (float)$row['invNagori'] - (float)$row['invDiscount'];
			$payment = (float)$adminModel->getInvoiceTotalPayment($row['invID'])->fetch_assoc()['payment'];
			$tempInvoice = array(
				'invID' => $row['invID'],
				'customerName' => $row['customerName'],
				'customerPhone' => $row['customerPhone'],
				'invDate' => $row['invDate'],
				'invTime' => $row['invTime'],
				'invTotal' => $total,
				'invPayment' => $payment
			);
			array_push($finalInvoice, $tempInvoice);
		}
		return $finalInvoice;
	}
		public function getOrder($id){
		$this->load->model('adminModel');
		$dbModel = new adminModel();
		$result = $dbModel->getOrderInfo($id);
		$result = $result->fetch_assoc();
		$finalMeasurement = array();
		$measurements = explode(";",$result['orderMeasurements']);
		foreach($measurements as $row){
			$row = explode(",",$row);
			array_push($finalMeasurement, $row);
		}
		$finalArray = array(
			'orderInfo' => $result,
			'measurementInfo' => $finalMeasurement
		);
		return $finalArray;
	}
	
	public function makePayment($invID, $accountID, $nagori, $discount, $payment, $total, $paid){
		$this->load->model('adminModel');
		$dbModel = new adminModel();
		$result1 = $dbModel->updateInvoice($invID, $nagori, $discount);
		$payment = (float)$payment;
		$result2 = false;

		if($payment!=0){
			$remaining = $total + $nagori - $discount - $paid;
			if($payment > $remaining){
				$result2 = $dbModel->addTrx($invID, $accountID, $remaining);
			}else{
				$result2 = $dbModel->addTrx($invID, $accountID, $payment);
			}
			
		}
		if($result1 && $result2){
			return true;
		}else{
			return false;
		}
		
	}
}