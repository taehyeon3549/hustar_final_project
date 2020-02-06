<?php
namespace App\Model;

final class UserManagementModel extends BaseModel
{
	/**********************
	 * TEST
	 * ********************/	
	public function test_insert($data){
		$dd = date("yy-m-d H:i:s");

		$sql = "INSERT INTO HUSTAR (`HUSTAR_NAME`, `HUSTAR_ADDRESS`, `HUSTAR_TELL`, `HUSTAR_CHARGE`, `HUSTAR_SUB_CLASS_NO`) 
				VALUES ('testerrrrrr', ?, '00000', ?, '1')";

		$val = 0;

		$sth = $this->db->prepare($sql);
		if($sth->execute(array($dd, $data))){
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

/************************
 * Email로 USER 검색
 *************************/
	public function getUserByEmail($email) {  
		$sql = "SELECT * FROM USER WHERE USER_EMAIL = ?";
		$sth = $this->db->prepare($sql);

		$sth->execute(array($email));
		$result = $sth->fetchAll();

		return $result[0];		
	}

/*********************************
 * CERTIFICATION 의 정보 가져오기(Email)
 *********************************/
	public function getCertifiByEmail($email) {  
		$sql = "SELECT * FROM CERTIFICATION WHERE CERTIFICATION_EMAIL = ?";
		$sth = $this->db->prepare($sql);

		$sth->execute(array($email));
		$result = $sth->fetchAll();

		return $result[0];
	}

/*****************************
 * 내 정보 가져오기
 *****************************/
	public function getUserByUSN($USN) {  
		$sql = "SELECT * FROM USER WHERE USER_USN = ?";
		$sth = $this->db->prepare($sql);
		
		$sth->execute(array($USN));
		$result = $sth->fetchAll();

		return $result[0];
	}

/*******************************
 * HUSTAR Class 정보 가져오기 
 ******************************/
	public function getClass($CLASS) {  
		$sql = "SELECT * FROM HUSTAR WHERE HUSTAR_NO = ?";
		$sth = $this->db->prepare($sql);
		
		$sth->execute(array($CLASS));
		$result = $sth->fetchAll();

		return $result[0];
	}

/*******************************
 * HUSTAR SubClass 정보 가져오기 
 ******************************/
	public function getSubClass($CLASS) {  
		$sql = "SELECT * FROM SUB_CLASS WHERE SUB_CLASS_NO = ?";
		$sth = $this->db->prepare($sql);
		
		$sth->execute(array($CLASS));
		$result = $sth->fetchAll();

		return $result[0];
	}

/*************************************
 *  USER 검색( birth 와 email) 개수
 ************************************/
	public function checkUserinfo($user) {  
		$sql = "SELECT * FROM USER WHERE USER_EMAIL = ? AND USER_BIRTH = ?";
		$sth = $this->db->prepare($sql);

		$sth->execute(array($user['EMAIL'], $user['BIRTH']));
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

	/**************************************
	 * USER 테이블 USER_USN 빈 USN 체크
	 * ************************************/
	public function checkEmptyUSN() {   
		$sql = "SELECT min(USER_USN + 1) AS EmptyUSN 
				FROM USER WHERE (USER_USN + 1) NOT IN (SELECT USER_USN FROM USER)";
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
		
		if($sth->execute(array($info['code'], $num, $info['EMAIL']))){
			//success
			return TRUE;
		}else{
			//fail
			return FALSE;
		}
	}

/**************************************
 * CERTIFICATION 의 정보 가져오기(Code)
 **************************************/
	public function getCertifiByCode($code) {  
		$sql = "SELECT * FROM CERTIFICATION WHERE CERTIFICATION_CODE = ?";
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

/***************************************
 * 사용자 패스워드 변경
 **************************************/
	public function changePass($certi) {  
		$sql = "UPDATE USER SET USER_PASSWORD = ? WHERE USER_USN = ?";
		$sth = $this->db->prepare($sql);
		
		if($sth->execute(array($certi['PASSWORD'], $certi['USN']))){
			//success
			return TRUE;
		}else{
			//fail
			return FALSE;
		}
	}

/****************************
 * 인증 받은 회원인지 체크
 *****************************/
	public function checkCertifiByEmail($email) {  
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

		if($sth->execute(array($certi['EMAIL'], $certi['code'], $certi['state']))){
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

/***************************************
 * CERTIFICATION 을 CERTI_CODE로 확인
 ***************************************/
	public function checkCertifiByCode($code) {   
		$sql = "SELECT * FROM CERTIFICATION WHERE CERTIFICATION_CODE = ?";
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


/***************************************
 * 출근 - ATTENDANCE 테이블 삽입
 * return 0 성공
 * return 1 실패
 ***************************************/
	public function AttendanceGTW($attenInfo) {  
		$sql = "INSERT INTO `hustar_final`.`ATTENDANCE` 
				(`ATTENDANCE_USN`, `ATTENDANCE_GTW`) VALUES (?, ?)";

		$sth = $this->db->prepare($sql);
		if($sth->execute(array($attenInfo['USN'], $attenInfo['GTW']))){
			return 0;
		}else{
			return 1;
		}
	}

/***************************************
 * 퇴근 - ATTENDANCE 테이블 수정
 * return 0 성공
 * return 1 실패
 ***************************************/
	public function AttendanceGTH($attenInfo) {  
		$sql = "UPDATE `hustar_final`.`ATTENDANCE` 
				SET `ATTENDANCE_GTH` = ? 
				WHERE (`ATTENDANCE_USN` = ?)";

		$sth = $this->db->prepare($sql);
		if($sth->execute(array($attenInfo['GTH'], $attenInfo['USN']))){
			return 0;
		}else{
			return 1;
		}
	}

/***************************************
 * 외출 - OUTTING 테이블 삽입
 * return 0 성공
 * return 1 실패
 ***************************************/
	public function OuttingOut($outingInfo) {  
		$sql = "INSERT INTO OUTING (OUTING_USN, OUTING_OUT) VALUES (?, ?)";

		$sth = $this->db->prepare($sql);
		if($sth->execute(array($outingInfo['USN'], $outingInfo['TIME']))){
			return 0;
		}else{
			return 1;
		}
	}

/***************************************
 * 외출 - OUTTING 테이블 수정
 * return 0 성공
 * return 1 실패
 ***************************************/
	public function OuttingBack($outingInfo) {  
		$sql = "UPDATE OUTING 
				SET OUTING_BACK = ? 
				WHERE (OUTING_USN = ? and OUTING_NO = ?)";

		$sth = $this->db->prepare($sql);
		if($sth->execute(array($outingInfo['TIME'], $outingInfo['USN'], $outingInfo['last']))){
			return 0;
		}else{
			return 1;
		}
	}

/***************************************
 * OUTTING 테이블 검색 - USN
 * return 0 성공
 * return 1 실패
 ***************************************/
public function getOutingByUSN($userInfo) {  
	$sql = "SELECT * FROM OUTING 			
			WHERE (OUTING_USN = ?)";
	
	$sth = $this->db->prepare($sql);
	$sth->execute(array($userInfo));
	$result = $sth->fetchAll();

	return $result;
}

/**********************
 * 회원 이름 가져오기
 **********************/
public function getUserName(){
	$sql = "SELECT USER_NAME FROM USER";
	$sth = $this->db->prepare($sql);
	$sth->execute(array($email));
	$result = $sth->fetchAll();
	//print_r($result);
	return $result;
}

}
