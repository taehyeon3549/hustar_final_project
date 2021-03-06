<?php
namespace App\Model;

final class SensorManagementModel extends BaseModel
{
	//Check the duplicate of sensor
	public function checkSensor($sensor){
		$sql = "SELECT * FROM Sensor WHERE s_MAC = ?";
		$sth = $this->db->prepare($sql);
		$sth->execute(array($sensor['mac']));

		$result = $sth->fetchAll();
		$num = count($result);

		if($num == 0){
			//sensor not exsit			
			$val = 0;
		}else{
			//sensor exsit
			$val = 1;	
		}
		return $val;		
	}

	//Registratioin sensor info
	public function regitSensor($sensor){
		$sql = "INSERT INTO Sensor (SSN, s_user, s_MAC, s_name, s_state) VALUES (?, ?, ?, ?, ?)";
		$sth = $this->db->prepare($sql);
		
		if($sth->execute(array($sensor['ssn'], $sensor['usn'], $sensor['mac'], $sensor['sensor_name'], $sensor['state']))){
			//insert success
			return TRUE;
		}else{
			return FALSE;
		}		
	}

	
	//Get sensor info
	public function getSensorBymac($sensor){
		$sql = "SELECT * FROM Sensor WHERE s_MAC = ?";
		$sth = $this->db->prepare($sql);
		$sth->execute(array($sensor));
		$result = $sth->fetchAll();

		return $result[0];
	}

	//Delete air sensor value
	public function deleteAir($sensor){
		$sql = "DELETE FROM Air_Sensor_value WHERE a_ssn = ? AND a_usn = ?";
		$sth = $this->db->prepare($sql);
		
		if($sth->execute(array($sensor['ssn'], $sensor['usn']))){
			//insert success
			return TRUE;
		}else{
			return FALSE;
		}		
	}

	//Delete Polar sensor value
	public function deletePolar($sensor){
		$sql = "DELETE FROM Polar_Sensor_value WHERE p_ssn = ? AND p_usn = ?";
		$sth = $this->db->prepare($sql);
		
		if($sth->execute(array($sensor['ssn'], $sensor['usn']))){
			//insert success
			return TRUE;
		}else{
			return FALSE;
		}		
	}

	//Deregistratioin sensor info
	public function deregitSensor($sensor){
		$sql = "DELETE FROM Sensor WHERE SSN = ? AND s_user = ?";
		
		$sth = $this->db->prepare($sql);
		
		if($sth->execute(array($sensor['ssn'], $sensor['usn']))){
			//insert success
			return TRUE;
		}else{
			return FALSE;
		}		
	}

	//Get sensor list by usn
	public function getSensorByusn($usn){   
		$sql = "SELECT * FROM Sensor WHERE s_user = ? ";
		$sth = $this->db->prepare($sql);
		$sth->execute(array($usn));		
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


	//Check the empty ssn in sensor table
	public function checkEmptyssn(){   
		$sql = "SELECT min(SSN + 1) AS val FROM Sensor WHERE (SSN + 1) NOT IN (SELECT SSN FROM Sensor)";
		$sth = $this->db->prepare($sql);
		$sth->execute();
		
		$result = $sth->fetchAll();
		
		return $result[0];
	}

	//Insert airdata
	public function insertAirdata($sensor){   
		$sql = "INSERT INTO Air_Sensor_value (a_ssn, a_PM2_5, a_O3, a_CO, a_NO2, a_SO2, a_Temperture, a_latitude, a_longitude, a_time, a_usn, AQ_PM2_5, AQ_O3, AQ_CO, AQ_NO2, AQ_SO2) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$sth = $this->db->prepare($sql);
		
		if($sth->execute(array($sensor['ssn'], $sensor['pm2_5'], $sensor['o3'], $sensor['co'], $sensor['no2'], $sensor['so2'], $sensor['temperture'], $sensor['latitude'], $sensor['longitude'], $sensor['time'], $sensor['usn'], $sensor['aq_pm2_5'], $sensor['aq_o3'], $sensor['aq_co'], $sensor['aq_no2'],$sensor['aq_so2']))){
			return TRUE;
		}else{
			return FALSE;
		}
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


	////////??????///////////////

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

		// ???????????? ??? ?????? ?????? , ?????? ??????, ??????, ??????

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

		// ???????????? ??? ?????? ?????? , ?????? ??????, ??????, ??????

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
