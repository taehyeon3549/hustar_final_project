<?php
namespace App\Model;

final class SensorManagementModel extends BaseModel
{
	//Check Duplicate of email
	public function duplicateEmail($email){
		$sql = "SELECT * FROM User WHERE email = ?";
		$sth = $this->db->prepare($sql);
		$sth->execute(array($email));
		$result = $sth->fetchAll();
		$num = count($result);

		if($num == 0){
			//if user not exsit
			$val = "0";
			return $val;
		}else{
			//if user exsit
			$val = "1";
			return $val;
		}
	}

}
