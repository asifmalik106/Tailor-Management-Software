<?php
include 'system/Middleware.php';


/* File: Main Controler
 * Handle all primary requests. It handles Login Requests and authenticate users.
 * Asif Salman Malik
 * Incresome Inc.
 *
 */
class testMiddleware extends Middleware
{
	function __construct()
	{
		parent::__construct();
	}

  public function sumF($x,$y){
    $z = $x + $y;
    echo $x." + ".$y." = ".$z;
		$this->load->model('mainModel');
		$dbModel = new mainModel();
		$dbModel->tt();
  }
}