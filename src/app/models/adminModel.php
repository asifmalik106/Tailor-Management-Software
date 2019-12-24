<?php
include 'system/Model.php';
class adminModel extends Model
{
	public function tt(){
		echo "Hello";
	}
	public function isUniqueCustomer($mobile){
	    $sql = "SELECT * FROM customer WHERE customerPhone = '$mobile'";
	    return $this->db->fetch($sql);
	}
	
	public function getCustomer(){
	    $sql = "SELECT * FROM customer order by customerID desc";
	    return $this->db->fetch($sql);
	}
	
	public function getCustomerInfo($id){
	    $sql = "SELECT * FROM customer where customerID = '$id'";
	    return $this->db->fetch($sql);
	}

	public function getDress(){
	    $sql = "SELECT * FROM dress";
	    return $this->db->fetch($sql);
	}
	public function getDressInfo($id){
		$sql = "SELECT * FROM dress where dressID = '$id'";
		return $this->db->fetch($sql);
	}
	public function getOrder(){
	    $sql = "SELECT * FROM `orderTable` inner join dress on dress.dressID = orderTable.dressID inner join customer on customer.customerID = orderTable.customerID order by orderID DESC";
	    return $this->db->fetch($sql);
	}
	public function getOrderInfo($id){
		$sql = "SELECT * FROM orderTable inner join dress on dress.dressID = orderTable.dressID inner join customer on customer.customerID = orderTable.customerID where orderID = '$id'";
		return $this->db->fetch($sql);
	}
	
	
		public function getEmployee(){
	    $sql = "SELECT * FROM employee";
	    return $this->db->fetch($sql);
	}
	public function getEmployeeInfo($id){
	    $sql = "SELECT * FROM employee where employeeID = '$id'";
	    return $this->db->fetch($sql);
	}
	
	public function addCustomer($name, $phone, $address){
	    $sql = "INSERT INTO customer (customerName, customerPhone, customerAddress) VALUES ('$name', '$phone', '$address')";
	    return $this->db->execute($sql);
	}
	public function addOrder($dress,$feature, $customer, $measurement, $quantity, $issue, $delivery, $cut, $stitch, $remark, $status, $price, $cloth, $invID){
	    $sql = "INSERT INTO orderTable (dressID,featureSL, customerID, orderMeasurements, orderQuantity, orderIssue, orderDelivery, orderCutting, orderStitching, orderRemarks, orderStatus, orderPrice, orderClothLength, invoiceID) VALUES ('$dress','$feature', '$customer', '$measurement', '$quantity', '$issue', '$delivery', '$cut', '$stitch', '$remark', '$status', '$price', '$cloth', '$invID')";
	    return $this->db->execute($sql);
	}
	
	public function updateOrder($orderID, $dress,$feature, $customer, $measurement, $quantity, $issue, $delivery, $cut, $stitch, $remark, $status, $price, $cloth, $invID){
		$sql = "UPDATE orderTable SET featureSL = '$feature', orderMeasurements = '$measurement', orderQuantity = '$quantity', orderIssue = '$issue', orderDelivery = '$delivery', orderCutting = '$cut', orderStitching = '$stitch', orderRemarks = '$remark', orderStatus = '$status', orderPrice = '$price', orderClothLength = '$cloth', invoiceID = '$invID' WHERE orderID = '$orderID'";
		return $this->db->execute($sql);
	}
	public function getUnassignedInvoice($id){
		$sql = "SELECT * FROM orderTable WHERE customerID = '$id' AND invoiceID = '-1'";
		return $this->db->fetch($sql);
	}
	public function addInvoice($customerID, $orderStr, $discount, $nagori){
		date_default_timezone_set('Asia/Dhaka');
		$date = date('Y-m-d');
		$time = date('H:i:s');
		$sql = "INSERT INTO invoice (customerID, invDate, invTime, invOrder, invDiscount, invNagori) VALUES ('$customerID','$date', '$time', '$orderStr', '$discount', '$nagori')";
		return $this->db->execute($sql);
	}
	public function getInvoice(){
		$sql = "SELECT * FROM invoice INNER JOIN customer ON invoice.customerID = customer.customerID order by invID desc";
		return $this->db->fetch($sql);
	}
	public function getInvoiceInfo($id){
		$sql = "SELECT * FROM invoice where invID='$id'";
		return $this->db->fetch($sql);
	}
	public function assignInvoiceID($orderID, $invID){
		$sql = "UPDATE orderTable SET invoiceID = '$invID' WHERE orderID = '$orderID'";
		return $this->db->execute($sql);
	}
	
	public function addTrx($invID, $account, $amount){
		$date = date('Y-m-d');
		$time = date('H:i:s');
		$user = $_SESSION['data']['userID'];
		$sql = "INSERT INTO transaction (invID, accountID, userID, trxAmount, trxDate, trxTime) VALUES ('$invID', '$account', '$user', '$amount', '$date', '$time')";
		return $this->db->execute($sql);
	}
	public function getAccounts($type){
		$sql = "SELECT * FROM account WHERE accountType = '$type'";
		return $this->db->fetch($sql);
	}
	
	public function getInvoiceTotalPayment($invID){
		$sql = "SELECT SUM(trxAmount) as payment FROM transaction WHERE invID = '$invID'";
		return $this->db->fetch($sql);
	}
	public function updateInvoice($invID, $nagori, $discount){
		$sql = "UPDATE invoice SET invDiscount = '$discount', invNagori = '$nagori' WHERE invID = '$invID'";
		return $this->db->execute($sql);
	}
	public function getFeatures($featureID){
		$sql = "SELECT * FROM feature INNER JOIN featureData ON feature.featureID = featureData.featureID WHERE feature.featureID = '$featureID'";
		return $this->db->fetch($sql);
	}
	public function getFeatureSL($featureSL){
		$sql = "SELECT * FROM featureData INNER JOIN feature ON feature.featureID = featureData.featureID WHERE featureSL = '$featureSL'";
		return $this->db->fetch($sql);
	}
	
	public function loginVerify($login, $password)
    {
        $sql = "SELECT userID, name, phone, email, username, rank, language, businessID FROM businessCredentials WHERE (email = '$login' OR username = '$login' OR phone = '$login') AND password = '$password'";
		return $this->db->fetch($sql);
    }
	
	public function updatePassword($userID, $password)
    {
        $sql = "UPDATE businessCredentials SET password = '$password' WHERE userID = '$userID'";
		return $this->db->execute($sql);
    }
	
    public function getDBAndTimezome($bID)
    {
        $sql = "SELECT businessName, businessNameSMS, businessAddress, businessPhone, businessDBName, businessTimeZone, businessCurrency FROM businessInfo WHERE businessID = '$bID'";
        return $this->db->fetch($sql);
    }

    public function test(){
        $sql = "SELECT * FROM businessInfo";
        return $this->db->fetch($sql);
    }
    public function setPrimaryDB(){
        return $this->db->selectDB();
    }

    public function setSecondaryDB(){
        return $this->db->selectDB($_SESSION['data']['businessDBName']);
    }
}
