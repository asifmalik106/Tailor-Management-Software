<?php
class SMS{
  
    public static function onSale($invoiceID, $invoiceTotal, $invoiceDue, $scID){
      $loadSMS = new Load();
      $loadSMS->model('adminModel');
  		$smsModel = new adminModel();
      $smsBalance = $smsModel->getSMSBalance()->fetch_assoc()['balance'];
      if($smsBalance > 0){
        $invT = $smsModel->getTotalInvoiceSC($scID)->fetch_assoc()['invoiceTotal'];
				$paidT = $smsModel->getTotalPaidSC($scID)->fetch_assoc()['paidTotal'];
				$b = $paidT - $invT;
        $smsText = "Jui Mono Filament Ind, Sales Memo: ".$invoiceID.", Total Amount: ".$invoiceTotal.", Due Balance: ".$invoiceDue.", Total Balance: ".$b.", Thank You.";
        $receipent = $smsModel->getSCInfo($scID)->fetch_assoc()['scContactNo'];
        if(strlen($receipent)==11){
            $result = (int)self::sendSMS($receipent, $smsText);
        $qty = 0;
        if($result==1900){
          $qty = (int)(strlen($smsText)/160)+1;
          $result = "success";
        }else if($result==1903){
					$qty = 0;
          $result = "contact";
        }else if($result==1905){
					$qty = 0;
          $result = "invalid";
        }else{
					$qty = 0;
				}
        
        $log = $smsModel->addSMSLog($scID,$receipent, $smsText, $qty, strlen($smsText));
        $smsModel->updateSMSMainServer($qty);
        echo $result;
        }else{
            echo "Invalid Phone Number! Edit Phone Number & Try Again...";
        }
      }
    }
    
        public static function dueReminder($scID){
      $loadSMS = new Load();
      $loadSMS->model('adminModel');
  		$smsModel = new adminModel();
      $smsBalance = $smsModel->getSMSBalance()->fetch_assoc()['balance'];
      if($smsBalance > 0){
        $invT = $smsModel->getTotalInvoiceSC($scID)->fetch_assoc()['invoiceTotal'];
		$paidT = $smsModel->getTotalPaidSC($scID)->fetch_assoc()['paidTotal'];
		$b = $paidT - $invT;
		date_default_timezone_set($_SESSION['data']['businessTimeZone']);
    	$date = date('Y-m-d');
    	$time = date('H:i:s');
		$date = date("d/m/Y", strtotime($date));
        $time  = date("g:iA", strtotime($time));
        $smsText = "";
        if($b<0){
            $smsText = "Jui Mono Filament Ind, Your Total Due is ".$b." on ".$time.", ".$date.". Pay your Due amount as soon as possible. Thank You.";
        }else{
            $smsText = "Jui Mono Filament Ind, Your Current Balance is ".$b." on ".$time.", ".$date.". Pay your Due amount as soon as possible. Thank You.";
        }
        
        $receipent = $smsModel->getSCInfo($scID)->fetch_assoc()['scContactNo'];
        if(strlen($receipent)==11){
            $result = (int)self::sendSMS($receipent, $smsText);
        $qty = 0;
        if($result==1900){
          $qty = (int)(strlen($smsText)/160)+1;
          $result = "success";
        }else if($result==1903){
					$qty = 0;
          $result = "contact";
        }else if($result==1905){
					$qty = 0;
          $result = "invalid";
        }else{
					$qty = 0;
				}
        
        $log = $smsModel->addSMSLog($scID,$receipent, $smsText, $qty, strlen($smsText));
        $smsModel->updateSMSMainServer($qty);
        echo $result;
        }else{
            echo "Invalid Phone Number! Edit Phone Number & Try Again...";
        }
      }
    }
    
    public static function depositReceive($deposit, $scID){
      $loadSMS = new Load();
      $loadSMS->model('adminModel');
  		$smsModel = new adminModel();
      $smsBalance = $smsModel->getSMSBalance()->fetch_assoc()['balance'];
      if($smsBalance > 0){
        $invT = $smsModel->getTotalInvoiceSC($scID)->fetch_assoc()['invoiceTotal'];
		$paidT = $smsModel->getTotalPaidSC($scID)->fetch_assoc()['paidTotal'];
		$b = $paidT - $invT;
		date_default_timezone_set($_SESSION['data']['businessTimeZone']);
    	$date = date('Y-m-d');
    	$time = date('H:i:s');
		$date = date("d/m/Y", strtotime($date));
        $time  = date("g:iA", strtotime($time));
        $receipent = $smsModel->getSCInfo($scID)->fetch_assoc()['scContactNo'];
        $smsText = "Jui Mono Filament Ind, Deposit Received ".$deposit." on ".$time.", ".$date.". Your current balance ".$b." Thank You.";
        if(strlen($receipent)==11){
            $result = (int)self::sendSMS($receipent, $smsText);
        $qty = 0;
        if($result==1900){
          $qty = (int)(strlen($smsText)/160)+1;
          $result = "success";
        }else if($result==1903){
					$qty = 0;
          $result = "contact";
        }else if($result==1905){
					$qty = 0;
          $result = "invalid";
        }else{
					$qty = 0;
				}
        
        $log = $smsModel->addSMSLog($scID,$receipent, $smsText, $qty, strlen($smsText));
        $smsModel->updateSMSMainServer($qty);
        //echo $result;
        }else{
            //echo "Invalid Phone Number! Edit Phone Number & Try Again...";
        }
      }
    }
    
        public static function attandanceUpdate($smsID, $data){
      $loadSMS = new Load();
      $loadSMS->model('adminModel');
  		$smsModel = new adminModel();
      $smsBalance = $smsModel->getSMSBalance()->fetch_assoc()['balance'];
      if($smsBalance > 0){
        
        
        $result = (int)self::sendSMS($receipent, $smsText);
        $qty = 0;
        if($result==1900){
          $qty = (int)(strlen($smsText)/160)+1;
          $result = "success";
        }else if($result==1903){
          $result = "contact";
        }else if($result==1905){
          $result = "invalid";
        }
        
        $log = $smsModel->addSMSLog($scID,$receipent, $smsText, $qty, strlen($smsText));
        $smsModel->updateSMSMainServer($qty);
      }
    }
    
        public static function addOvertime($smsID, $data){
      $loadSMS = new Load();
      $loadSMS->model('adminModel');
  		$smsModel = new adminModel();
      $smsBalance = $smsModel->getSMSBalance()->fetch_assoc()['balance'];
      if($smsBalance > 0){
        
        
        $result = (int)self::sendSMS($receipent, $smsText);
        $qty = 0;
        if($result==1900){
          $qty = (int)(strlen($smsText)/160)+1;
          $result = "success";
        }else if($result==1903){
          $result = "contact";
        }else if($result==1905){
          $result = "invalid";
        }
        
        $log = $smsModel->addSMSLog($scID,$receipent, $smsText, $qty, strlen($smsText));
        $smsModel->updateSMSMainServer($qty);
      }
    }
    
        public static function salaryWithdraw($smsID, $data){
      $loadSMS = new Load();
      $loadSMS->model('adminModel');
  		$smsModel = new adminModel();
      $smsBalance = $smsModel->getSMSBalance()->fetch_assoc()['balance'];
      if($smsBalance > 0){
        
        
        $result = (int)self::sendSMS($receipent, $smsText);
        $qty = 0;
        if($result==1900){
          $qty = (int)(strlen($smsText)/160)+1;
          $result = "success";
        }else if($result==1903){
          $result = "contact";
        }else if($result==1905){
          $result = "invalid";
        }
        
        $log = $smsModel->addSMSLog($scID,$receipent, $smsText, $qty, strlen($smsText));
        $smsModel->updateSMSMainServer($qty);
      }
    }
    
 
  public static function verifySMS($smsID, $data){
    $loadSMS = new Load();
    $loadSMS->model('adminModel');
		$smsModel = new adminModel();
    $smsBalance = $smsModel->getSMSBalance()->fetch_assoc()['balance'];
    if($smsBalance > 0){
      if($smsID == 1){
        $shopName = $_SESSION['data']['businessNameSMS'];
        $invoiceInfo = $smsModel->getInvoiceInfo($data)->fetch_assoc();
        $scID = $invoiceInfo['scID'];
        $date = date("d/m/Y", strtotime($invoiceInfo['invoiceDate']));
        $time  = date("g:iA", strtotime($invoiceInfo['invoiceTime']));
        $total  = $invoiceInfo['invoiceAmount'] - $invoiceInfo['invoiceDiscount'];
        $paid = $smsModel->getInvoicePaidAmount($data)->fetch_assoc()['paid'];
        $due = $total - $paid;
        $smsText = $smsModel->getSMSText($smsID)->fetch_assoc()['smsTemplate'];
        $smsText = str_replace("#SHOPNAME#", $shopName, $smsText);
        $smsText = str_replace("#INV_NO#", $data , $smsText);
        $smsText = str_replace("#TIME#", $time , $smsText);
        $smsText = str_replace("#DATE#", $date , $smsText);
        $smsText = str_replace("#TOTAL#", $total , $smsText);
        $smsText = str_replace("#PAID#", $paid , $smsText);
        $smsText = str_replace("#DUE#", $due , $smsText);
        echo $smsText;
        
        $receipent = $smsModel->getSCInfo($scID)->fetch_assoc()['scContactNo'];
        
        $result = (int)self::sendSMS($receipent, $smsText);
        $qty = 0;
        if($result==1900){
          $qty = (int)(strlen($smsText)/160)+1;
          $result = "success";
        }else if($result==1903){
          $result = "contact";
        }else if($result==1905){
          $result = "invalid";
        }
        
        $log = $smsModel->addSMSLog($scID,$receipent, $smsText, $qty, strlen($smsText));
        $smsModel->updateSMSMainServer($qty);
        echo $result;
      }else if($smsID == 2){
        
      }else if($smsID == 3){
        $shopName = $_SESSION['data']['businessNameSMS'];
        $invoiceInfo = $smsModel->getInvoiceInfo($data)->fetch_assoc();
        $scID = $invoiceInfo['scID'];
        $date = date("d/m/Y", strtotime($invoiceInfo['invoiceDate']));
        $time  = date("g:iA", strtotime($invoiceInfo['invoiceTime']));
        $total  = $invoiceInfo['invoiceAmount'] - $invoiceInfo['invoiceDiscount'];
        $paid = $smsModel->getInvoicePaidAmount($data)->fetch_assoc()['paid'];
        $due = $total - $paid;
        $smsText = $smsModel->getSMSText($smsID)->fetch_assoc()['smsTemplate'];
        $smsText = str_replace("#SHOPNAME#", $shopName, $smsText);
        $smsText = str_replace("#INV_NO#", $data , $smsText);
        $smsText = str_replace("#TIME#", $time , $smsText);
        $smsText = str_replace("#DATE#", $date , $smsText);
        $smsText = str_replace("#TOTAL#", $total , $smsText);
        $smsText = str_replace("#PAID#", $paid , $smsText);
        $smsText = str_replace("#DUE#", $due , $smsText);
        echo $smsText;
        
        $receipent = $smsModel->getSCInfo($scID)->fetch_assoc()['scContactNo'];
        if(strlen($receipent)==11){
            $result = (int)self::sendSMS($receipent, $smsText);
        $qty = 0;
        if($result==1900){
          $qty = (int)(strlen($smsText)/160)+1;
          $result = "success";
        }else if($result==1903){
					$qty = 0;
          $result = "contact";
        }else if($result==1905){
					$qty = 0;
          $result = "invalid";
        }else{
					$qty = 0;
				}
        
        $log = $smsModel->addSMSLog($scID,$receipent, $smsText, $qty, strlen($smsText));
        
        echo $result;
        }else{
            echo "Invalid Phone Number! Edit Phone Number & Try Again...";
        }
        
      }
    }
    return 0;
    //print_r($dashModel->getSMSTemplate()->fetch_assoc());
  }
  
  
  public static function sendSMS($phone, $text){
    try
    {
      $soapClient = new SoapClient("https://api2.onnorokomSMS.com/sendSMS.asmx?wsdl"); 
      $paramArray = array(
        'userName'=>"123456789",
        'userPassword'=>"000000", 
        'mobileNumber'=> $phone, 
        'smsText'=>$text,
        'type'=>"TEXT",
        'maskName'=> "", 
        'campaignName'=>'',
      );
      $value = $soapClient->__call("OneToOne", array($paramArray));
      
      $result = str_split($value->OneToOneResult, 4);
      return $result[0];

    }
    catch (Exception $e) {
    echo $e;
    }
  }
}