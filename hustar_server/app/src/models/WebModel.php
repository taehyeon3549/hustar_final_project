<?php
namespace App\Model;

final class WebModel extends BaseModel
{
	//Get email in certification table in db
	public function getEmail($code){
		$sql = "SELECT * FROM CERTIFICATION WHERE CERTIFICATION_CODE = ?";
		$sth = $this->db->prepare($sql);
		
		$sth->execute(array($code));
		$result = $sth->fetchAll();
		
		return $result[0];
	}
}
