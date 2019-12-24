<?php
include 'system/Middleware.php';


/* File: Main Controler
 * Handle all primary requests. It handles Login Requests and authenticate users.
 * Asif Salman Malik
 * Incresome Inc.
 *
 */
class DressMiddleware extends Middleware
{
	function __construct()
	{
		parent::__construct();
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