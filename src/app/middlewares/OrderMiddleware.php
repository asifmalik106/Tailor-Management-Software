<?php
include 'system/Middleware.php';


/* File: Main Controler
 * Handle all primary requests. It handles Login Requests and authenticate users.
 * Asif Salman Malik
 * Incresome Inc.
 *
 */
class OrderMiddleware extends Middleware
{
	function __construct()
	{
		parent::__construct();
	}
	/*$order Array Structure
	Array
(
    [dressID] => 3
    [customerID] => 1
    [dress1] => Array
        (
            [0] => 1
            [1] => 2
            [2] => 3
            [3] => 4
            [4] => 5
            [5] => 6
        )

    [dress2] => Array
        (
            [0] => 7
            [1] => 8
            [2] => 9
            [3] => 1
            [4] => 2
        )

    [quantity] => 1
    [price] => 600.00
    [issue] => 05/11/2017
    [delivery] => 22/11/2017
    [remarks] => asdasdasd
    [length] => 12
    [cutting] => 1
    [status] => Ready
)
	*/
  public function addOrder($order){
		$count = 1;
		$fieldIndex = "dress".$count;
		$str = "";
		while(array_key_exists($fieldIndex,$order)){
			if($count>1){
				$str = $str.";";
			}
			foreach($order[$fieldIndex] as $row){
				$str = $str.$row.",";
			}
			$count++;
			$fieldIndex = "dress".$count;
		}
		echo $str;
		$date = DateTime::createFromFormat('d/m/Y', $order['delivery']);
		$order['delivery'] = $date->format('Y-m-d');
		$date = DateTime::createFromFormat('d/m/Y', $order['issue']);
		$order['issue'] = $date->format('Y-m-d');
		echo "Delivery: ".$order['delivery']." Issue: ".$order['issue'];
		$this->load->model('adminModel');
		$dbModel = new adminModel();
		$result = $dbModel->addOrder($order['dressID'],$order['featureSL'], $order['customerID'], $str, $order['quantity'], $order['issue'], $order['delivery'], $order['cutting'], $order['stitching'], $order['remarks'], $order['status'], $order['price'], $order['length'], -1);
		$lastOrder = $dbModel->getOrder()->fetch_assoc()['orderID'];
		if($result){
			$this->load->redirectIn('admin/order/view/'.$lastOrder);
		}
  }
	
	  public function updateOrder($order){
		$count = 1;
		$fieldIndex = "dress".$count;
		$str = "";
		while(array_key_exists($fieldIndex,$order)){
			if($count>1){
				$str = $str.";";
			}
			foreach($order[$fieldIndex] as $row){
				$str = $str.$row.",";
			}
			$count++;
			$fieldIndex = "dress".$count;
		}
		echo $str;
		$date = DateTime::createFromFormat('d/m/Y', $order['delivery']);
		$order['delivery'] = $date->format('Y-m-d');
		$date = DateTime::createFromFormat('d/m/Y', $order['issue']);
		$order['issue'] = $date->format('Y-m-d');
		$this->load->model('adminModel');
		$dbModel = new adminModel();
		if($order['status'] == "Ready"){
			$text = "Dear Customer, Your Order#".$order['orderID']." (".$order['dressName'].") is ready to deliver! A-1 Marin Tailors.";
			SMS::sendSMS($order['mobile'], $text);
		}
		$result = $dbModel->updateOrder($order['orderID'], $order['dressID'], $order['featureSL'], $order['customerID'], $str, $order['quantity'], $order['issue'], $order['delivery'], $order['cutting'], $order['stitching'], $order['remarks'], $order['status'], $order['price'], $order['length'], $order['invID']);
		if($result){
			$this->load->redirectIn('admin/order/view/'.$order['orderID']);
		}
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
	
	public function getAssignment($id){
		$this->load->model('adminModel');
		$dbModel = new adminModel();
		$result = $dbModel->getOrderInfo($id);
		$result = $result->fetch_assoc();
		$stitching = $dbModel->getEmployeeInfo($result['orderStitching'])->fetch_assoc();
		$cut = $dbModel->getEmployeeInfo($result['orderCutting'])->fetch_assoc();
		return array($cut, $stitching);
	}
	
	  public function getDressInfo($id){
		$this->load->model('adminModel');
		$dbModel = new adminModel();
		$result = $dbModel->getDressInfo($id);
		$result = $result->fetch_assoc();
		$dressFields = $result['dressFields'];
		$dressFields = explode(";", $dressFields);
		$finalDressFields = array();
		foreach($dressFields as $rawFields){
			array_push($finalDressFields, $this->dressFieldsProcessor($rawFields));
		}
		$finalArray = array(
				"dressID" => $result['dressID'],
				"dressName" => $result['dressName'],
				"dressFields" => $finalDressFields,
				"dressPrice" => $result['price'],
				"featureID" => $result['featureID']
 			);
 			return $finalArray;
  }
  
  private function dressFieldsProcessor($rawFields){
  		//Get Raw Dress Field Data
		$fields = $rawFields;
		
		//Get Colon Position
		$colonCount = stripos($fields,":");
		
		//Count String Length: After ":" to Before "}"
		$len = strlen($fields);
		$fieldLabel = substr($fields, 1,($colonCount-1));
		
		//Get Only Fields in Single String
		$fields = substr($fields, $colonCount+1,($len-$colonCount-2));
		
		//Explode Fields in Array
		$fields = explode(",", $fields);
		$finalFields = array(
			'name' => $fieldLabel,
			'fields'=>$fields
		);
		return $finalFields;
  }
}