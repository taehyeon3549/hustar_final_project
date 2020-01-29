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
		$sql = "SELECT HUSTAR_NAME, HUSTAR_ADDRESS, USER_NAME, USER_EMAIL, USER_PHONE, USER_BIRTH, USER_GENDER , SUB_CLASS_NAME, SUB_CLASS_CHARGER
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

}
