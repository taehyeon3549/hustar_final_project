<?php
namespace App\Model;

final class UserManagementModel extends BaseModel
{
	/**********************
	 * TEST
	 * ********************/	
	public function test_insert($data){
		$sql = "INSERT INTO HUSTAR (`HUSTAR_NAME`, `HUSTAR_ADDRESS`, `HUSTAR_TELL`, `HUSTAR_CHARGE`, `HUSTAR_SUB_CLASS_NO`) 
				VALUES ('testerrrrrr', 'testttttt', '00000', ?, '1')";

		$val = 0;

		$sth = $this->db->prepare($sql);
		if($sth->execute(array($data))){
			$val = 1;	
		}else{
			$val = 0;
		}

		return $val;
	}
	
	/**********************
	 * 이메일 중복 체크
	 **********************/
	public function duplicateEmail($email){
		$sql = "SELECT * FROM USER WHERE USER_EMAIL = ?";
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

	/*********************
	 *  DB 삽입
	 *********************/
	//Insert User 여기
    public function addUser($user) {        
		$sql = "INSERT into USER (USER_USN, USER_PASSWORD, USER_EMAIL, USER_PHONE, USER_NAME, USER_GENDER, USER_BIRTH ,USER_ADMIN, USER_CLASS) 
				values (?, ?, ?, ?, ? , ?, ?, ?, ? )";
		$sth = $this->db->prepare($sql);

		if($sth->execute(array($user['USER_USN'], $user['USER_PASSWORD'], 
								$user['USER_EMAIL'], $user['USER_PHONE'], 
								$user['USER_NAME'], $user['USER_GENDER'], 
								$user['USER_BIRTH'], $user['USER_ADMIN'], 
								$user['USER_CLASS']))){
			$val = "0";
			return $val;
		}else{
			$val = "1";
			return $val;
		}
    }

	//Check the user already exist
	public function getByEmail($email) {  
		$sql = "SELECT * FROM User WHERE email = ?";
		$sth = $this->db->prepare($sql);

		$sth->execute(array($email));

		$result = $sth->fetchAll();

		$num = count($result);

		return $num;
	}

	//Check user login
	public function login($email) {  
		$sql = "SELECT hashed FROM User WHERE email = ?";
		$sth = $this->db->prepare($sql);

		$sth->execute(array($email));
		$result = $sth->fetchAll();

		return $result[0];		
	}

	//Get Certification table info
	public function checkCertifi($email) {  
		$sql = "SELECT * FROM Certification WHERE certi_email = ?";
		$sth = $this->db->prepare($sql);

		$sth->execute(array($email));
		$result = $sth->fetchAll();

		return $result[0];
	}	

	//Get User's info in User table by email
	public function getUserInfo_email($email) {  
		$sql = "SELECT * FROM User WHERE email = ?";
		$sth = $this->db->prepare($sql);

		$sth->execute(array($email));
		$result = $sth->fetchAll();

		return $result[0];
	}

	//Get User's info in User table by usn
	public function getUserInfo_usn($usn) {  
		$sql = "SELECT * FROM User WHERE USN = ?";
		$sth = $this->db->prepare($sql);
		
		$sth->execute(array($usn));
		$result = $sth->fetchAll();

		return $result[0];
	}

	//Change the signin_state in User table to 0
	public function changeSignin($email) {  
		$sql = "UPDATE User SET sign_state = '0' WHERE email = ?";
		$sth = $this->db->prepare($sql);

		if($sth->execute(array($email))){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	//Change the signin_state in User table to 1
	public function changeSignout($usn) {  
		$sql = "UPDATE User SET sign_state = '1' WHERE USN = ?";
		$sth = $this->db->prepare($sql);

		if($sth->execute(array($usn))){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	//Check User is exsit
	public function checkUserinfo($user) {  
		$sql = "SELECT * FROM User WHERE email = ? AND birth = ?";
		$sth = $this->db->prepare($sql);

		$sth->execute(array($user['email'], $user['birth']));
		$result = $sth->fetchAll();
		$num = count($result);

		if($num > 0){
			//user exist
			return true;
		}else{
			//user not exist
			return false;
		}
	}

	// USER 테이블 USER_USN 빈 USN 체크
	public function checkEmptyUSN() {   
		$sql = "SELECT min(USER_USN + 1) AS EmptyUSN FROM USER WHERE (USER_USN + 1) NOT IN (SELECT USER_USN FROM USER)";
		$sth = $this->db->prepare($sql);
		$sth->execute();
		
		$result = $sth->fetchAll();
		
		return $result[0];
	}
	
	
/*************************
 * CERTIFICATION 코드 갱신  
 *************************/
	public function updateCertifi($info, $num) {  
		$sql = "UPDATE CERTIFICATION SET CERTIFICATION_CODE = ? , CERTIFICATION_STATE = ? WHERE CERTIFICATION_EMAIL = ?";
		$sth = $this->db->prepare($sql);
		
		if($sth->execute(array($info['code'], $num, $info['email']))){
			//success
			return TRUE;
		}else{
			//fail
			return FALSE;
		}
	}

	//Get certification value using by certi_code
	public function getCertifi($code) {  
		$sql = "SELECT * FROM Certification WHERE certi_code = ?";
		$sth = $this->db->prepare($sql);

		$sth->execute(array($code));
		$result = $sth->fetchAll();

		return $result[0];
	}

	//Update user's password
	public function changePassByemail($certi) {  
		$sql = "UPDATE User SET hashed = ? WHERE email = ?";
		$sth = $this->db->prepare($sql);
		
		if($sth->execute(array($certi['password'], $certi['email']))){

			//success
			return TRUE;
		}else{
			//fail
			return FALSE;
		}
	}

	//Update user's password
	public function changePassByusn($certi) {  
		$sql = "UPDATE User SET hashed = ? WHERE usn = ?";
		$sth = $this->db->prepare($sql);
		
		if($sth->execute(array($certi['password'], $certi['usn']))){
			//success
			return TRUE;
		}else{
			//fail
			return FALSE;
		}
	}

	// 인증 받은 회원인지 체크
	public function alreadyCertifi($email) {  
		$sql = "SELECT * FROM CERTIFICATION WHERE CERTIFICATION_EMAIL = ?";
		$sth = $this->db->prepare($sql);

		$sth->execute(array($email));
		$result = $sth->fetchAll();
		$num = count($result);

		if($num > 0){
			//already try certificated
			return 0;
		}else{
			//Didn't try certificated
			return 1;
		}
	}

	/*
	//Update the certification data
	public function updateCertifi($certi) {  
		$sql = "UPDATE Certification SET certi_code = ?, certi_state = ? WHERE certi_email = ?";
		$sth = $this->db->prepare($sql);

		if($sth->execute(array($certi['code'], $certi['state'], $certi['email']))){
			//success
			return 0;
		}else{
			//fail
			return 1;
		}
	}
	*/

/****************************
 * CERTIFICATION 테이블 입력
 *****************************/
	public function addCertifi($certi) {  
		$sql = "INSERT INTO CERTIFICATION (`CERTIFICATION_EMAIL`, `CERTIFICATION_CODE`, `CERTIFICATION_STATE`) VALUES (?, ?, ?)";
		$sth = $this->db->prepare($sql);

		if($sth->execute(array($certi['email'], $certi['code'], $certi['state']))){
			//success
			return 0;
		}else{
			//fail
			return 1;
		}
	}

/*******************************************
 * CERTIFICATION 테이블 STATE 변경 0 to 1
 ******************************************/
	public function changeCertifi($certi) {   
		$sql = "UPDATE `CERTIFICATION` SET `CERTIFICATION_STATE` = '0' WHERE (`CERTIFICATION_CODE` = ?)";
		$sth = $this->db->prepare($sql);
		
		if($sth->execute(array($certi))){
			//success
			return TRUE;
		}else{
			//fail
			return FALSE;
		}
	}

	//Get sensor data
	public function getSensorByusn($sensor) {   
		$sql = "SELECT * FROM Sensor WHERE s_user = ?";
		$sth = $this->db->prepare($sql);
		$sth->execute(array($sensor));
		
		$result = $sth->fetchAll();

		return $result[0];
	}

	//Get sensor data
	public function getSensorByssn($sensor) {   
		$sql = "SELECT * FROM Sensor WHERE SSN = ?";
		$sth = $this->db->prepare($sql);
		$sth->execute(array($sensor['ssn']));
		
		$result = $sth->fetchAll();

		return $result[0];
	}

	//Make null the sensor value
	public function deleteAir($usn) {  
		$sql = "DELETE FROM Air_Sensor_value WHERE a_usn = ?";
		$sth = $this->db->prepare($sql);
		
		if($sth->execute(array($usn))){
			return TRUE;
		}else{
			return FALSE;
		}		
	}

	//Delete the sensor value
	public function deletePolar($usn) {   
		$sql = "DELETE FROM Polar_Sensor_value WHERE p_usn = ?";
		$sth = $this->db->prepare($sql);
		
		if($sth->execute(array($usn))){
			return TRUE;
		}else{
			return FALSE;
		}		
	}

	//Delete the sensor
	public function deleteSensor($usn) {   
		$sql = "DELETE FROM Sensor WHERE s_user = ?";
		$sth = $this->db->prepare($sql);
		
		if($sth->execute(array($usn))){
			return TRUE;
		}else{
			return FALSE;
		}		
	}

	//Delete the user
	public function deleteUser($usn) {   
		$sql = "DELETE FROM User WHERE USN = ?";
		$sth = $this->db->prepare($sql);
		
		if($sth->execute(array($usn))){
			return TRUE;
		}else{
			return FALSE;
		}		
	}

	//Get certificaton table info used by certi_code
	public function getCertiinfo($code) {   
		$sql = "SELECT * FROM Certification WHERE certi_code = ?";
		$sth = $this->db->prepare($sql);
		$sth->execute(array($code));

		$result = $sth->fetchAll();
		
		return $result[0];
	}

	//check the certification code is valible
	public function checkCertificode($code) {   
		$sql = "SELECT * FROM Certification WHERE certi_code = ?";
		$sth = $this->db->prepare($sql);
		$sth->execute(array($code));

		$result = $sth->fetchAll();
		$num = count($result);
		
		if($num > 0){
			return TRUE;
		}else{
			return FALSE;
		}		
	}
}
