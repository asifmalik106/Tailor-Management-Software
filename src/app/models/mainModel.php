<?php
include 'system/Model.php';
class mainModel extends Model
{
	public function tt(){
		echo "Hello";
	}
	
	public function executeSQL($sql){
		return $this->db->execute($sql);
	}
	public function loginVerify($login, $password)
    {
        $sql = "SELECT * FROM administration WHERE ( userName = '$login' OR userPhone = '$login') AND userPass = '$password'";
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
