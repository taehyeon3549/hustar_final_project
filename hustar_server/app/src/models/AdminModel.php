<?php
namespace App\Model;

final class AdminModel extends BaseModel
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

	//회원 목록 조회
	public function userList(){
		$sql = "SELECT HUSTAR_NAME, HUSTAR_ADDRESS, USER_NAME, USER_EMAIL, 
						USER_UNIV, USER_MAJOR, USER_SUBMAJOR, USER_DEGREE, 
						USER_PHONE, USER_BIRTH, USER_GENDER , SUB_CLASS_NAME, 
						SUB_CLASS_CHARGER
                FROM hustar_final.USER 
                LEFT OUTER JOIN 
                    (	SELECT *
                        FROM hustar_final.HUSTAR
                        LEFT OUTER JOIN hustar_final.SUB_CLASS
                        ON HUSTAR.HUSTAR_SUB_CLASS_NO = SUB_CLASS.SUB_CLASS_NO
                    ) AS a1
                ON USER.USER_CLASS = a1.HUSTAR_NO";
        // printf($sql);
		$sth = $this->db->prepare($sql);
		$sth->execute();
		$result = $sth->fetchAll();

		return $result;
	}

/*****************************
 * 공지 사항 추가
 *****************************/
	public function noticeAdd($notice){
		$sql = "INSERT INTO `hustar_final`.`NOTICE` 
				(`NOTICE_TITLE`, `NOTICE_BODY`, `NOTICE_USN`, `NOTICE_DATE`, 
				`NOTICE_STATE`) VALUES (?, ?, ?, ?, '1');";
        
		$sth = $this->db->prepare($sql);
		if($sth->execute(array($notice['TITLE'], $notice['BODY'], $notice['USN'], $notice['DATE']))){
			$val = 0;
		}else{
			$val = 1;
		}		

		return $val;
	}

/*****************************
 * 공지 사항 수정
 *****************************/
	public function noticeUpdate($notice){
		$sql = "UPDATE `hustar_final`.`NOTICE` SET `NOTICE_TITLE` = ?, `NOTICE_BODY` = ?, `NOTICE_DATE` = ? 
				WHERE (`NOTICE_NO` = ?) and (`NOTICE_USN` = ?);";

		$sth = $this->db->prepare($sql);
		if($sth->execute(array($notice['TITLE'],$notice['BODY'], 
			$notice['DATE'], $notice['NO'], $notice['USN']))){
				$val = 0;
		}else{
				$val = 1;
		}

		return $val;
	}

/*****************************
 * 공지 사항 삭제
 *****************************/
public function noticeDelete($notice){
	$sql = "DELETE FROM `hustar_final`.`NOTICE` 
			WHERE (`NOTICE_NO` = ?) and (`NOTICE_USN` = ?);";

	$sth = $this->db->prepare($sql);
	if($sth->execute(array($notice['NO'],$notice['USN']))){
			$val = 0;
	}else{
			$val = 1;
	}

	return $val;
}

/*****************************
 * 공지 사항 출력
 *****************************/
public function noticeList(){
	$sql = "SELECT NOTICE_NO, NOTICE_TITLE, NOTICE_BODY, USER_NAME, NOTICE_DATE, NOTICE_STATE
			FROM hustar_final.NOTICE
			LEFT OUTER JOIN hustar_final.USER
			ON NOTICE_USN = USER_USN";

	$sth = $this->db->prepare($sql);
	$sth->execute();	
	$result = $sth->fetchAll();

	//print_r($result);

	return $result;
}

	/*****************************
	 * USN 회원 정보 가져오기
	 *****************************/
	public function getUserByUSN($USN) {  
		$sql = "SELECT * FROM USER WHERE USER_USN = ?";
		$sth = $this->db->prepare($sql);
		
		$sth->execute(array($USN));
		$result = $sth->fetchAll();

		return $result[0];
	}

}
