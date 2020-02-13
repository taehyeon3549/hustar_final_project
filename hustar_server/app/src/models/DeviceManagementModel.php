<?php
namespace App\Model;

final class DeviceManagementModel extends BaseModel
{
	protected $db;

	public function __construct($db){
		$this->db = $db;		
	}

	/*************************
	 * 기기 검색 : MAC
	 *************************/
	public function getDeviceByMAC($mac){
		$sql = "SELECT * FROM DEVICE
				WHERE DEVICE_MAC = ?";
		$sth = $this->db->prepare($sql);

		$sth->execute(array($mac['MAC']));
		$result = $sth->fetchAll();
		return $result;
	}

	/*************************
	 * 기기 검색 : USN
	 *************************/
	public function getDeviceByUSN($USN){
		$sql = "SELECT * FROM DEVICE
				WHERE DEVICE_USN = ?";
		$sth = $this->db->prepare($sql);

		$sth->execute(array($USN['USN']));
		$result = $sth->fetchAll();
		return $result;
	}

	/******************************
	 * 비어있는 SSN 확인
	 ******************************/	
	public function checkEmptyssn(){   
		$sql = "SELECT min(DEVICE_SSN + 1) AS val FROM hustar_final.DEVICE 
				WHERE (DEVICE_SSN + 1) 
				NOT IN (SELECT DEVICE_SSN FROM hustar_final.DEVICE)";
				
		$sth = $this->db->prepare($sql);
		$sth->execute();
		
		$result = $sth->fetchAll();
		
		return $result[0];
	}

	/**************************
	 * 휴대폰 등록
	 ***************************/
	public function regitDevice($deviceinfo){
		$sql = "INSERT INTO DEVICE (`DEVICE_SSN`, `DEVICE_USN`, 
									`DEVICE_MAC`, `DEVICE_REGISTER_DAY`) 
				VALUES (?, ?, ?, ?);";
		$sth = $this->db->prepare($sql);
		
		if($sth->execute(array($deviceinfo['SSN'], $deviceinfo['USN'], 
							$deviceinfo['MAC'], $deviceinfo['DAY']))){			
			$val = 0;	
		}else{
			$val = 1;
		}		
		return $val;
	}

	/***********************
	 * 휴대폰 삭제
	 ***********************/
	public function deleteDevice($deviceinfo){
		$sql = "DELETE FROM DEVICE WHERE DEVICE_USN = ? AND DEVICE_MAC = ?";
		$sth = $this->db->prepare($sql);
		
		if($sth->execute(array($deviceinfo['USN'], $deviceinfo['MAC']))){			
			$val = 0;			
		}else{
			$val = 1;
		}		
		return $val;
	}

	/***********************
	 * 휴대폰 수정
	 ***********************/
	public function updateDevice($deviceinfo){
		$sql = "UPDATE DEVICE
				SET DEVICE_MAC = ? WHERE (DEVICE_USN = ?)";
		$sth = $this->db->prepare($sql);
		
		if($sth->execute(array($deviceinfo['MAC'], $deviceinfo['USN']))){			
			$val = 0;			
		}else{
			$val = 1;
		}		
		return $val;
	}

	/***********************
	 * 기기 리스트
	 ***********************/
	public function showDevice(){
		$sql = "SELECT USER.USER_NAME, USER.USER_USN, DEVICE.*
				FROM USER
				LEFT OUTER JOIN DEVICE
				ON USER_USN = DEVICE_USN;";

		$sth = $this->db->prepare($sql);
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}
	
	//Get sensor list by ssn
	public function getSensorByssn($sensor){   
		$sql = "SELECT s_name FROM Sensor WHERE SSN = ? ";
		$sth = $this->db->prepare($sql);
		$sth->execute(array($sensor));		
		$result = $sth->fetchAll();		
		return $result[0];
	}

	//Insert polardata
	public function insertPolardata($sensor){   
		$sql = "INSERT INTO Polar_Sensor_value (p_ssn, p_heartrate, p_RR_interval, p_latitude, p_longitude, p_time, p_usn) VALUES (?, ?, ?, ?, ?, ?, ?);";
		
		$sth = $this->db->prepare($sql);
		
		if($sth->execute(array($sensor['ssn'], $sensor['heartrate'], $sensor['RR_interval'], $sensor['latitude'], $sensor['longitude'], $sensor['time'], $sensor['usn']))){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	//show realdata
	public function showRealdata($sensor){
		$str = explode('_', $sensor['sensor_name']);

		if($str[0] == "Air"){
			$sql = "SELECT * FROM Air_Sensor_value WHERE a_ssn = ? ORDER BY a_no DESC LIMIT 1";
		}else{
			$sql = "SELECT * FROM Polar_Sensor_value WHERE p_ssn = ? ORDER BY p_no DESC LIMIT 1";
		}
		$sth = $this->db->prepare($sql);

		$sth->execute(array($sensor['ssn']));

		$result = $sth->fetchAll();
		
		return $result[0];
	}

	//show histodata
	public function showHistodata($sensor){
		$str = explode('_', $sensor['sensor_name']);

		if($str[0] == "Air"){
			$sql = "SELECT * FROM Air_Sensor_value WHERE a_ssn = ? and a_time >= ? and a_time < ? ORDER BY a_no DESC";
		}else{
			$sql = "SELECT * FROM Polar_Sensor_value WHERE p_ssn = ? and p_time >= ? and p_time < ? ORDER BY p_no DESC";
		}
		$sth = $this->db->prepare($sql);

		$sth->execute(array($sensor['ssn'], $sensor['yesterday'], $sensor['today']));

		$result = $sth->fetchAll();
		
		return $result;
	}

	//Get getGPS
	public function getGPS(){
		
		$sql = "SELECT p_ssn, p_latitude, p_longitude FROM Polar_Sensor_value GROUP BY p_latitude, p_longitude;";
		
		$sth = $this->db->prepare($sql);

		$sth->execute();

		$result = $sth->fetchAll();
		
		return $result;
	}


	////////시작///////////////

	public function location($ssn){	

		$sql = "SELECT a_latitude, a_longitude, a_time, a_ssn
				FROM Air_Sensor_value
				WHERE a_ssn = ?
				GROUP BY a_latitude, a_longitude
				ORDER BY a_time DESC
				LIMIT 1;
				";
		
		$sth = $this->db->prepare($sql);

		$sth->execute(array($ssn));

		$result = $sth->fetchAll();
		
		return $result[0];
	}

	//Get AQI
	public function getAQI($val){	

		// 들어가는 값 오늘 날짜 , 어제 날짜, 위도, 경도

		// $sql = "SELECT *, max(AQ_PM2_5) as AQ_PM2_5, MAX(AQ_O3) as AQ_O3, MAX(AQ_CO) as AQ_CO, MAX(AQ_NO2) as AQ_NO2, MAX(AQ_SO2) as AQ_SO2
		// 		FROM Air_Sensor_value
		// 		where a_time >= ? and a_time < ? and a_latitude like ? and a_longitude like ?
		// 		group by a_latitude, a_longitude;
		// 		";
		
		$sql = "SELECT *, max(AQ_PM2_5) as AQ_PM2_5, MAX(AQ_O3) as AQ_O3, MAX(AQ_CO) as AQ_CO, MAX(AQ_NO2) as AQ_NO2, MAX(AQ_SO2) as AQ_SO2
		FROM Air_Sensor_value where a_time >= ? and a_time < ? and a_latitude like ? and a_longitude like ? group by a_latitude, a_longitude;";
		
		$sth = $this->db->prepare($sql);

		$sth->execute(array($val['date'], $val['tomorrow'], $val['lati'], $val['longi']));

		$result = $sth->fetchAll();

		//print_r(array($val['date'], $val['tomorrow'], $val['lati'], $val['longi']));

		//print_r($result);
		
		return $result;
	}


	//Get AQI
	public function test($val){	

		// 들어가는 값 오늘 날짜 , 어제 날짜, 위도, 경도

		// $sql = "SELECT *, max(AQ_PM2_5) as AQ_PM2_5, MAX(AQ_O3) as AQ_O3, MAX(AQ_CO) as AQ_CO, MAX(AQ_NO2) as AQ_NO2, MAX(AQ_SO2) as AQ_SO2
		// 		FROM Air_Sensor_value
		// 		where a_time >= ? and a_time < ? and a_latitude like ? and a_longitude like ?
		// 		group by a_latitude, a_longitude;
		// 		";
		
		$sql = " SELECT *, max(AQ_PM2_5) as AQ_PM2_5, MAX(AQ_O3) as AQ_O3, MAX(AQ_CO) as AQ_CO, MAX(AQ_NO2) as AQ_NO2, MAX(AQ_SO2) as AQ_SO2
        from Air_Sensor_value";
		
		$sth = $this->db->prepare($sql);

		$sth->execute();

		$result = $sth->fetchAll();

		//print_r(array($val['date'], $val['tomorrow'], $val['lati'], $val['longi']));


		
		return $result;
	}

	



}
