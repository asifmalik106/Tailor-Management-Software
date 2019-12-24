<?php
include 'system/Middleware.php';


/* File: Main Controler
 * Handle all primary requests. It handles Login Requests and authenticate users.
 * Asif Salman Malik
 * Incresome Inc.
 *
 */
class CustomerMiddleware extends Middleware
{
	function __construct()
	{
		parent::__construct();
	}
	
  public function addCustomer($name,$phone,$address){
		$this->load->model('adminModel');
		if($name!="" && $phone!=""){
			$dbModel = new adminModel();
			$result = $dbModel->isUniqueCustomer($phone);
			if($result->num_rows==0){
				$result = $dbModel->addCustomer($name, $phone, $address);
				if($result){
					echo "success";
				}else{
					echo "failed";
				}
			}else{
				echo "duplicate";
			}
		}else{
			echo "empty";
		}

  }
}