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

	/*************************************
	 * // 공지사항 글 리스트 가져오기
	 *************************************/	
	public function getNotiList(){
		$sql = "SELECT NOTICE_NO, NOTICE_TITLE, USER_NAME, NOTICE_DATE
				FROM NOTICE
				LEFT OUTER JOIN USER
				ON NOTICE.NOTICE_USN = USER.USER_USN
				WHERE NOTICE.NOTICE_STATE = 1;";
		$sth = $this->db->prepare($sql);
		
		$sth->execute();
		$result = $sth->fetchAll();
		
		return $result;
	}
	
	/*************************************
	 * // 공지사항 글 출력
	 *************************************/	
	public function getNotiView($index){
		$sql = "SELECT NOTICE.*, USER.USER_NAME FROM hustar_final.NOTICE
				LEFT OUTER JOIN USER
				ON NOTICE.NOTICE_USN = USER.USER_USN
				WHERE NOTICE.NOTICE_NO=?";
				
		$sth = $this->db->prepare($sql);

		$sth->execute(array($index));
		$result = $sth->fetchAll();			
		
		return $result;
	}

	/*************************************
	 * // 공지사항 글 수정
	 *************************************/	
	public function notiUpdate($noti){
		$sql = "UPDATE `hustar_final`.`NOTICE` 
				SET `NOTICE_TITLE` = ?, `NOTICE_BODY` = ? 
				WHERE (`NOTICE_NO` = ?);";
				
		$sth = $this->db->prepare($sql);

		if($sth->execute(array($noti['title'],$noti['body'], $noti['no']))){
			$val = 0;
		}else{						
			$val = 1;			
		}		
		return $val;
	}

	/*************************************
	 * // 관리자 유무 체크
	 *************************************/	
	public function getAdmin($usn){
		$sql = "SELECT *
				FROM USER
				WHERE USER_USN = ? AND USER_ADMIN = 1";
				
		$sth = $this->db->prepare($sql);

		$sth->execute($usn);
		$result = $sth->fetchAll();			
		
		return $result;
	}



	
}
