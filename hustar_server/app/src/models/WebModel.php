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

	// 공지사항 글 리스트 가져오기
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
}
