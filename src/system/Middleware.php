<?php
//include 'system/Load.php';


class Middleware
{
	protected $load;
	function __construct(){
		$this->load = new Load();
	}
	
}