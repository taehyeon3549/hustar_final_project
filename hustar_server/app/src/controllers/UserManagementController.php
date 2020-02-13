<?php
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

final class UserManagementController extends BaseController
{
	protected $logger;
	protected $UserManagementModel;
	protected $view;

	public function __construct($logger, $UserManagementModel, $view)
	{
		$this->logger = $logger;
		$this->UserManagementModel = $UserManagementModel;
		$this->view = $view;
	}
	
	/*************************** *
	* TEST 함수
	*******************************/	
	public function test(Request $request, Response $response, $args){
		$test_db = $args['data'];

		if($this->UserManagementModel->test_insert($test_db) == 1){
			$result['header'] = "insert success";
			$result['message'] = $test_db;
		}else{
			$result['header'] = "insert fail";
			$result['message'] = "fail";
		}

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
	}

	/*************************
	// EMAIL 전송 함수 
	// return value : true, false
	// who : send to address,  code : certicate code,  client: web or app(where clicked),  type: 0=certification, 1=resetpassword
 	***************************/
	public function send_mail($who, $code, $client, $type){
		$mail = new PHPMailer(true);			
		try{
			// SMTP 설정
			$mail->SMTPDebug = 0;		//debugging setting 
			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com';   
			$mail->SMTPAuth = true;
			$mail->Username = 'hustar.ict.daegu@gmail.com';   //SMTP username
			$mail->Password = 'hustar2019';
			$mail->SMTPSecure = 'tls';
			$mail->Port = 587;
			$mail->CharSet = "UTF-8";

			// 수신자
			$mail->setFrom('hustar.ict.daegu@gmail.com', "hustar.ict.daegu");
			$mail->addAddress($who);

			$mail->isHTML(true);

			// Email Body
			// 인증 메일인지 비번 변경 메일인지 구분
			// 0 : certification mail, 1: forgotten password			
			if($type == 0){
				//"Hustar ICT 회원 인증 메일 입니다.";
				$subject = 'SHVzdGFyIElDVCDtmozsm5Ag7J247KadIOuplOydvCDsnoXri4jri6Qu';
				$mail->Subject = '=?UTF-8?B?'.$subject.'?=';				
				$mail->Body = 
								'<body style="margin: 0; padding: 0;">
									<table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
										<tr>
											<td align="center" bgcolor="#01dea5" style="padding: 40px 0 30px 0;">
												<img src= "http://54.180.159.207/icon/hustar.png" alt="Thank you for certification!!" height="230" style="display: block;width: 100%"/>
											</td>
										</tr>
										<tr>
											<td bgcolor="#f8f9fa" style="padding: 40px 30px 40px 30px;">
												<table border="0" cellpadding="0" cellspacing="0" width="100%">
													<tr>
														<td>
															<h4>
																링크를 클릭하여, 이메일 인증을 완료해주세요!
															</h4>
														</td>
													</tr>
													<tr align="center" style="height: 200px;">
														<td>
															<h2><b><a href = http://54.180.159.207/verify/'.$client.'/'.$code.'>http://54.180.159.207/verify/'.$client.'/'.$code.'</a></b></h2>
														</td>
													</tr>
													<tr>
														<td>
														
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td align="center" bgcolor="#2e9afe" style="color:white;">
												대구 Hustar ICT &nbsp;&nbsp;	Hustar.org
											</td>
										</tr>
									</table>
								</body>';				
				$mail->AltBody = '링크를 클릭하여, 이메일 인증을 완료해주세요!';
			}else if($type == 1){
				//forgotten password
				//Hustar ICT 회원 비번 변경 메일 입니다.
				$subject = 'SHVzdGFyIElDVCDtmozsm5Ag67mE67KIIOuzgOqyvSDrqZTsnbwg7J6F64uI64ukLg==';
				$mail->Subject = '=?UTF-8?B?'.$subject.'?=';	
				$mail->Body = '<body style="margin: 0; padding: 0;">
				<table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
					<tr>
						<td align="center" bgcolor="#01dea5" style="padding: 40px 0 30px 0;">
							<img src= "http://54.180.159.207/icon/hustar.png" alt="Thank you for certification!!" height="230" style="display: block;width: 100%"/>
						</td>
					</tr>
					<tr>
						<td bgcolor="#f8f9fa" style="padding: 40px 30px 40px 30px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td>
										<h4>
											 링크를 클릭하여, 패스워드 변경 화면으로 이동하세요!
										</h4>
									</td>
								</tr>
								<tr align="center" style="height: 200px;">
									<td>
										<h2><b><a href = http://54.180.159.207/newpassword/'.$code.'>http://54.180.159.207/newpassword/'.$code.'</a></b></h2>
									</td>
								</tr>
								<tr>
									<td>
									   
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td align="center" bgcolor="#2e9afe" style="color:white;">
						대구 Hustar ICT &nbsp;&nbsp;	Hustar.org
						</td>
					</tr>
				</table>
			</body>';
				$mail->AltBody = '링크를 클릭하여, 패스워드 변경 화면으로 이동하세요!';
			}			
			

			$mail -> SMTPOptions = array(
				"ssl" => array("verify_peer" => false, "verify_peer_name" => false, "allow_self_signed" => true));
			$mail->send();			

			return true;	
		} catch (Exception $e){
			//print_r($e);
			return false;
		}
	}

	//인증 암호 생성 - 8char
	public function makeNonce(){
		//Create nonce code
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';		//nonce code

		for ($i = 0; $i < 8; $i++) {
		   	$randomString .= $characters[rand(0, $charactersLength - 1)];
		}

		return $randomString;
	}
	
	//메일 아이콘 호출 함수
	public function mailIcon(Request $request, Response $response, $args)
	{
		echo '<img src="mail_iconn.png" />';
	}

	/***************************************************
	 * // Sign_up//
	 * //0: sign_in success(send email), 1: already have account, 2: user db adding fail
	 * USER TABLE 정보
	 *	USER_USN
	 *	USER_EMAIL
	 *	USER_PASSWORD
	 *	USER_EMAIL
	 *	USER_PHONE
	 *	USER_NAME
	 *	USER_GENDER
	 *	USER_BIRTH
	 *	USER_ADMIN
	 *	USER_CLASS
	 *	
	 *	GENDER :0		//0: 남자 1: 여자
	 *	ADMIN : 0		//0: 교육생 1: 관리자
	 *	CLASS :  0		// 미정

	 *	return 
		   0 : DB 삽입 성공
		   1 : 이미 존재하는 회원
		   2 : DB 삽입 실패
	 ************************************************/
	public function signUP(Request $request, Response $response, $args)
	{
		$result = [];

		/** 회원 가입 유저 정보 **/
		$userInfo = [];
		$userInfo['USER_EMAIL'] = $request->getParsedBody()['EMAIL'];
		$userInfo['PASSWORD'] = $request->getParsedBody()['PASSWORD'];
		$userInfo['USER_NAME'] = $request->getParsedBody()['NAME'];
		$userInfo['USER_PHONE'] = $request->getParsedBody()['PHONE'];		
		$userInfo['USER_GENDER'] = $request->getParsedBody()['GENDER'];
		$userInfo['USER_BIRTH'] = $request->getParsedBody()['BIRTH'];		

		/* 이메일 중복 체크 */
		if($this->UserManagementModel->duplicateEmail($userInfo['USER_EMAIL']) == 0){
			// 0: 해당 이메일 없음, 1: 해당 이메일 있음						
			$userInfo['USER_ADMIN'] = 0;
			$userInfo['USER_CLASS'] = 1;

			//패스워드 암호화
			$HASHED_PASSWORD = password_hash($userInfo['PASSWORD'], PASSWORD_DEFAULT);
			$userInfo['USER_PASSWORD'] = $HASHED_PASSWORD;

			// 유저 USN 빈곳 찾기
			$emptyusn = $this->UserManagementModel->checkEmptyUSN();
			if(count($emptyusn) > 0){
				//빈 USN 이 있으면 USN 재사용
				$userInfo['USER_USN'] = $emptyusn['EmptyUSN'];
			}

			// 유저 정보 DB 삽입
			if($this->UserManagementModel->addUser($userInfo) == 0){		
				$result['header'] = "Add user success";
				$result['message'] = "0";
			}else{
				$result['header'] = "Add user fail";
				$result['message'] = "2";
			}		
		}else{
			//이미 존재하는 유저
			$result['header'] = "Already have account";
			$result['message'] = "1";
		}
		
		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
	}

/*****************************************
 * 로그인
 * 
 * return
 * 0 : 로그인 성공, 1: 패스워드 틀림, 
 * 2 : 회원 없음, 3: 미인증 회원
 ****************************************/
	public function signIn(Request $request, Response $response, $args)
	{
		$Loinginfo = [];
		$Loinginfo['EMAIL'] = $request->getParsedBody()['EMAIL'];
		$Loinginfo['PASSWORD'] = $request->getParsedBody()['PASSWORD'];
		
		$result = [];
		$searchedUserInfo = $this->UserManagementModel->getUserByEmail($Loinginfo['EMAIL']);

		// 찾는 유저가 없으면
		if(!$searchedUserInfo['USER_PASSWORD']){
			//Account is not exsit
			$result['header'] = "User is not exsit";
			$result['message'] = "2";
		}else{	
			// 찾는 유저가 있으면 비번 비교
			if(password_verify($Loinginfo['PASSWORD'], $searchedUserInfo['USER_PASSWORD'])){
				// 비번이 같으면 인증 회원인지 확인				
				$certificated = $this->UserManagementModel->getCertifiByEmail($Loinginfo['EMAIL']);
				
				if($certificated['CERTIFICATION_STATE'] == 1){					
					$result['header'] = "Certificate is not done";
					$result['message'] = "3";
				}else{
					// 로그인 성공
					$result['header'] = "login_success";
					$result['message'] = "0";
					$result['usn'] = $searchedUserInfo['USER_USN'];
					$result['is_admin']	 = $searchedUserInfo['USER_ADMIN'];
					$result['name'] = $searchedUserInfo['USER_NAME'];					
				}		
			}else{
				// 로그인 실패
				$result['header'] = "login_password_wrong";
				$result['message'] = "1";
			}
		}

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
	}

/******************************
 * 로그아웃
 * 
 * return
 * 0: 로그아웃 성공, 1: 로그아웃 실패
 ******************************/
	public function signOut(Request $request, Response $response, $args)
	{
		$userInfo = [];
		$userInfo['USN'] = $request->getParsedBody()['USN'];
		
		$result['header'] = "Signout_success";
		$result['message'] = "0";				

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
	}

/*****************************************************
 * 임시비밀번호 발급
 * 
 * return
 * 0: 임시비밀번호 전송 성공, 1: 없는 유저, 
 * 2: 임시비밀번호 전송 실패, 3: 인증코드 발급 실패
 *****************************************************/
	public function makeNewPassword(Request $request, Response $response, $args)
	{
		$userInfo = [];
		$userInfo['EMAIL'] = $request->getParsedBody()['EMAIL'];
		$userInfo['BIRTH'] = $request->getParsedBody()['BIRTH'];

		$result = [];
		// 유저 정보가 맞는지 확인
		if($this->UserManagementModel->checkUserinfo($userInfo)){
			// 유저가 있으면 메일 보냄			
			$userInfo['code'] = $this->makeNonce();

			//CERTIFICATION 테이블 인증 상태 변경
			if($this->UserManagementModel->updateCertifi($userInfo, 0)){
				// 임시 비밀번호 메일 전송
				if($this->send_mail($userInfo['EMAIL'], $userInfo['code'], NULL, 1)){
					//success
					$result['header'] = "Send email success";
					$result['message'] = "0";	
				}else{
					//fail
					$result['header'] = "Send email fail";
					$result['message'] = "2";
				}
			}else{
				//fail
				$result['header'] = "Update certificate code fail";
				$result['message'] = "3";
			}			
		}else{
			//user not exist
			$result['header'] = "User is not exsit";
			$result['message'] = "1";
		}	

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
	}

//forgotten password - change the password
	public function forgot_password(Request $request, Response $response, $args)
	{
		$certi = [];

		//Get email using by certi_code
		$certi['code'] = $request->getParsedBody()['code'];
		$certi['email'] = $this->UserManagementModel->getCertifi($certi['code'])['certi_email'];		//user's email

		//Change the password
		//Get the password of input
		$password = $request->getParsedBody()['password'];
		//Hashing the password
		$certi['password'] = password_hash($password, PASSWORD_DEFAULT);

		if($this->UserManagementModel->changePassByemail($certi)){
			//change success
			$result['header'] = "Password change success";
			$result['message'] = "0";
		}else{
			//change fail
			$result['header'] = "Password change fail";
			$result['message'] = "1";
		}

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
	}

/***********************************
 * 패스워드 변경
 **********************************/
	public function change_password(Request $request, Response $response, $args)
	{
		$usercerti = [];

		$usercerti['USN'] = $request->getParsedBody()['USN'];

		// 패스워드 변경
		$password = $request->getParsedBody()['PASSWORD'];
		// 패스워드 해쉬
		$usercerti['PASSWORD'] = password_hash($password, PASSWORD_DEFAULT);		

		if($this->UserManagementModel->changePass($usercerti)){
			//change success
			$result['header'] = "Password change success";
			$result['message'] = "0";
		}else{
			//change fail
			$result['header'] = "Password change fail";
			$result['message'] = "1";
		}

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
	}

/********************************************************
 * 이메일 인증 메일 전송
 * 0: send email success, 1: already have account, 
 * 2: send email fail, 3: insert certification table fail, 
 * 4: update certification table fail	 
 **********************************************************/
	public function EmailVerify(Request $request, Response $response, $args)
	{
		// WEB 인지 APP 인지 구분
		//0: web , 1: app
		if($args['where'] == 0){
			$client = "web";
		}else{
			$client = "app";
		}

		$EMAIL = $request->getParsedBody()['EMAIL'];
		//$EMAIL = 'xogusrla09@gmail.com';

		// 이미 가입 되어있는 회원인지 체크
		if($this->UserManagementModel->duplicateEmail($EMAIL) == 0){
			// 기존 회원이 아니면
			$result = [];

			// 인증 암호 생성
			$randomString = $this->makeNonce();

		    // DB CERTIFICATION 테이블에 삽입할 값
			$certi = [];		//certification data
			$certi['EMAIL'] = $EMAIL;
			$certi['code'] = $randomString;
			$certi['state'] = 1;		//default is 1

			// 인증 받은 회원인지 아닌지 체크
			if($this->UserManagementModel->checkCertifiByEmail($certi['EMAIL']) == 0){
				// 만약 인증은 안하고 코드 발급을 받았다면 코드 갱신
				if($this->UserManagementModel->updateCertifi($certi, 1)){
					// CERTIFICATION 갱신 완료
					// 인증 메일 전송
					if($this->send_mail($certi['EMAIL'], $certi['code'], $client, 0)){
						$result['header'] = "Send email success";
						$result['message'] = "0";	
					}else{
						$result['header'] = "Send email fail";
						$result['message'] = "2";
					}				
			    }else{
					// CERTIFICATON 테이블 갱신 실패
			    	$result['header'] = "Update certification table fail";
			    	$result['message'] = "4";
			    }
			}else{
				// 인증코드를 처음 발급 받는 회원
				// CERTIFICATION 테이블에 USER 정보 삽입
				if($this->UserManagementModel->addCertifi($certi) == 0){
					// 인증 메일 전송
					if($this->send_mail($certi['EMAIL'], $certi['code'], $client, 0)){
						$result['header'] = "Send email success";
						$result['message'] = "0";	
					}else{
						$result['header'] = "Send email fail";
						$result['message'] = "2";
					}						
			    }else{
			    	$result['header'] = "Fail the insert data in certification table";
			    	$result['message'] = "3";				
			    }
			}
		}else{
			// 이미 회원 가입되어 있는 유저
			$result['header'] = "Already have account";
			$result['message'] = "1";
		}

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
	}

/**************************
*	인증 확인 (APP)
****************************/
	public function checkCertification(Request $request, Response $response, $args)
	{
		$EMAIL = $request->getParsedBody()['EMAIL'];
		$CERTIFICATION_STATE = $this->UserManagementModel->getCertifiByEmail($EMAIL);

		// CERTIFICATION 테이블의 CERTIFICATION_STATE 값 확인
		if($CERTIFICATION_STATE['CERTIFICATION_STATE'] == '0'){
			//certificated
			$result['header'] = "Certificated";
			$result['message'] = "0";
		}else{
			//Not certificated
			$result['header'] = "Not certificated";
			$result['message'] = "1";
		}

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
	}

/**************************************************************
* 이메일 인증 확인, CERTIFICATON 의 CERTIFICATION_STATE를 변경 (WEB)
***************************************************************/
	public function change_certification(Request $request, Response $response, $args)
	{
		$certi_code = $args['code'];

		if($this->UserManagementModel->changeCertifi($certi_code)){			 
			echo("<script>alert('인증 성공')</script>");			
			echo("<script>location.href='/verify/sign_up/".$certi_code."';</script>");			
		}else{
			$result['header'] = "Change the state fail";
			$result['message'] = "1";

			return $response->withStatus(200)
			->withHeader('Content-Type', 'application/json')
			->write(json_encode($result, JSON_NUMERIC_CHECK));
		}		
	}

/**************************************************************
* 이메일 인증 확인, CERTIFICATON 의 CERTIFICATION_STATE를 변경 (APP)
***************************************************************/
public function change_certification_app(Request $request, Response $response, $args)
{	
	$certi_code = $args['code'];

	if($this->UserManagementModel->changeCertifi($certi_code)){
		$result['header'] = "Change the state success";
		$result['message'] = "0";

		// 이메일 인증 성공 화면 보이기
		$this->view->render($response, 'register_email_certification.html');
		//echo("<script>location.href='/register_email_certification';</script>");
		/*
		//Show up sign up page
		echo("<script>alert('Certification success')</script>");
		//Add certi_code when open the sign up page
		echo("<script>location.href='/sign_up/".$certi_code."';</script>");			
		*/
	}else{
		$result['header'] = "Change the state fail";
		$result['message'] = "1";

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
	}		
}


//Check the user are exsit
	public function check_user(Request $request, Response $response, $args)
	{
   		//Get the User's email in sign_up page
		$info = [];
		$info['email'] = $request->getParsedBody()['id'];

		//Array of put the result
		$result = [];

		//Run the SQL
		//$this->UserManagementModel->getByEmail($info['email']);

		//Insert the user's info in DB and Check, is success
		if($this->UserManagementModel->getByEmail($info['email']) > 0){
			//Already exist the email, make response 1
			$result['header'] = "Already have account";
			$result['message'] = "1";
		}else{
			//Not exist the eamil, make response 0
			$result['header'] = "None account";
			$result['message'] = "0";	
		}

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
	}

//delete account check page
	public function delete_account_check(Request $request, Response $response, $args)
	{
		$user = [];
		
		//Get user's usn and password
		$user['usn'] = $request->getParsedBody()['usn'];
		$user['password'] = $request->getParsedBody()['password'];

		//Get the user info in DB
		$user_info = $this->UserManagementModel->getUserInfo_usn($user['usn']);

		//Check the password
		if(password_verify($user['password'], $user_info['hashed'])){
			//verity
			$result['header'] = "Password correct";
			$result['message'] = "0";
		}else{
			//not correct
			$result['header'] = "Password not correct";
			$result['message'] = "1";
		}
		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
	}

//user cancellation
//0 : success, 2: Delete polar data fail, 3: Delete air data fail
//4: Delete sensor data fail, 5: Delete User data fail
	public function delete_account(Request $request, Response $response, $args)
	{
		$user = [];

		$user['usn'] = $request->getParsedBody()['usn'];
		
		//delete sensor data
		$userDB = $this->UserManagementModel->getSensorByusn($user['usn']);
			
		//Check sensor are exsit 
		if(count($userDB) > 0){
			//sensor is exist, Store the ssn
			$user['ssn'] = $userDB['SSN'];
			//Delete data in air_value and polar_value
			//delete ALL sensor data success
			//delete user data
			if($this->UserManagementModel->deleteAir($user['usn'])){
				if($this->UserManagementModel->deletePolar($user['usn'])){
					//if delete ALL data success,delete the sensor
					if($this->UserManagementModel->deleteSensor($user['usn'])){
						//if delete the sensor, delete the user						
					}else{
						//delete sensor data fail
						$result['header'] = "Delete sensor data fail";
						$result['message'] = "4";
					}						
				}else{
					//delete polar data fail
					$result['header'] = "Delete polar data fail";
					$result['message'] = "2";
				}
			}else{
				//delete air data fail
				$result['header'] = "Delete air data fail";
				$result['message'] = "3";				
			}
		}

		//Delete user data in user table
		if($this->UserManagementModel->deleteUser($user['usn'])){
			//delete the user success
			$result['header'] = "Delete User data success";
			$result['message'] = "0";
		}else{
			//delete the user fail
			$result['header'] = "Delete User data fail";
			$result['message'] = "5";
		}							

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
	}

/***********************************************
 * 패스워드 변경 - 사용자 확인
 **********************************************/	
	public function changePassword_checkUser(Request $request, Response $response, $args)
	{		
		$certicode = $args['code'];
		// 유효한 인증 코드인지 확인
		if($this->UserManagementModel->checkCertifiByCode($certicode)){
			//Add the certi_code back on the url
			//echo("<script>location.href='/pass/'".$certi_code.";</script>");
			//Then, get email from certification table used by certi_code
			$userCerti = $this->UserManagementModel->getCertifiByCode($certicode);
			
			if($userCerti['CERTIFICATION_EMAIL'] != NULL){
				// USN 가져오기
				$userInfo = $this->UserManagementModel->getUserByEmail($userCerti['CERTIFICATION_EMAIL']);
				if($userInfo['USER_USN'] != NULL){					
					$usn = $userInfo['USER_USN'];
					$this->view->render($response, 'new-password.twig', ['code' => $certicode, 'usn' => $usn]);
        			return $response;
				}else{
					echo("<script>alert('유효하지 않습니다.')</script>");
					echo("<script>location.href='/';</script>");	
				}
			}else{
				echo("<script>alert('Not runnable.')</script>");
				echo("<script>location.href='/';</script>");
			}
		}else{
			echo("<script>alert('Not runnable.')</script>");
			echo("<script>location.href='/';</script>");	
		}

		return TRUE;
	}

	/***********************
	 * 내정보 보기
	 * 
	 * USN으로 검색
	 * 
	 * return
	 * 1: 실패
	 * 정보 : 성공
	 ***********************/
	public function userInfo(Request $request, Response $response, $args)
	{
		$USN = $request->getParsedBody()['USN'];

		$userinfo = $this->UserManagementModel->getUserByUSN($USN);
		
		if(count($userinfo) != NULL){
			$result['EMAIL'] = $userinfo['USER_EMAIL'];
			$result['PHONE'] = $userinfo['USER_PHONE'];
			$result['NAME'] = $userinfo['USER_NAME'];
			
			//성별 체크
			if($userinfo['USER_GENDER'] == 0){
				$result['GENDER'] = "Male";
			}else{
				$result['GENDER'] = "Female";
			}

			$result['BIRTH'] = $userinfo['USER_BIRTH'];

			// 부서 정보 가져오기
			$userClass = $this->UserManagementModel->getClass($userinfo['USER_CLASS']);
			$result['CLASS'] = $userClass['HUSTAR_NAME'];

			// 분반 정보 가져오기
			$userSubClass = $this->UserManagementModel->getSubClass($userClass['HUSTAR_SUB_CLASS_NO']);
			$result['SUBCLASS'] = $userSubClass['SUB_CLASS_NAME'];
			$result['SUPERVISOR'] = $userSubClass['SUB_CLASS_CHARGER'];

		}else{
			$result['header'] = "Get My Info fail";
			$result['message'] = "1";
		}		
		
		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
	}
	
	/*********************************************
	 * 출결
	 * MAC이랑 CODE 보냄(what과)
	 * return 
	 * 0 : 출근 성공
	 * 1 : DB 에러
	 * 2 : 지각
	 * 3 : 퇴근 성공
	 * 4 : 아직 수업 시간
	 ***********************************************/
	public function attendCheck(Request $request, Response $response, $args)
	{
		// 출근/퇴근 0/1
		$flag = $args['what'];
				
		//이후 MAC 주소 받아서 USN을 찾고 출석 되게끔 만듬
		$code = $request->getParsedBody()['MAC'];
		
		// code = 암호
		$code = $request->getParsedBody()['CODE'];
		//$userInfo['USN'] = $request->getParsedBody()['USN'];
		$userInfo['USN'] = "1";

		$day = date("m-d");
		$time = date("H:i:s");		

		$result['Input'] = $code;
		
		// 암호 해독
		$temp = exec("/var/www/html/hustar/hustar-app/KISA/decode $code");
		$result['Decode'] = $temp;

		//문자열 자르고
		$decode = explode(' ', $temp);

		//날짜 체크
		if($decode[1] == explode('-', $day)[0]  && $decode[2] == explode('-', $day)[1]){
			if( ((int)$decode[5] - (int)date("s")) <= 10 && ((int)$decode[5] - (int)date("s")) >= 0){
				printf(((int)$decode[5] - (int)date("s")));
				if($flag == 0){				// 출근
					// DB 삽입
					$userInfo['GTW'] = date("yy-m-d H:i:s");
					$attendInfo = $this->UserManagementModel->AttendanceGTW($userInfo);
					if($attendInfo == 1){
						$result['header'] = "DB error";
						$result['message'] = "1";
					}
					
					if($decode[3] == '10' && (int)$decode[4] <= 10){		//시간 체크					
						if($attendInfo == 0){
							$result['header'] = "Go to work";
							$result['message'] = "0";
						}else{
							$result['header'] = "DB error";
							$result['message'] = "1";
						}				
					}else{
						$result['header'] = "Be late for work";
						$result['message'] = "2";
					}				
				}else if($flag == 1){	// 퇴근		
					if((int)$decode[3] >= 18){		//시간 체크
						// DB 수정
						$userInfo['GTH'] = date("yy-m-d H:i:s");

						$attendInfo = $this->UserManagementModel->AttendanceGTH($userInfo);
						if($attendInfo == 0){
							$result['header'] = "Go to Home";
							$result['message'] = "3";
						}else{
							$result['header'] = "DB error";
							$result['message'] = "1";
						}
					}else{
						$result['header'] = "It's still class time";
						$result['message'] = "4";
					}
				}
			}else{
				$result['header'] = "Are you hacked now?";
				$result['message'] = "5";
			}
		}else{
			$result['header'] = "Attendance Check";
			$result['message'] = "Absent";
		}
		
		//$result['result'] = exec("/var/www/html/hustar/hustar-app/KISA/decode $name");
		
		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
		
	}	

/**********************
 * 외출 복귀
 * return
 * 0: 복귀 성공 1: 복귀 실패 2: 외출 성공 3: 외출 실패
 *********************/
	public function outingCheck(Request $request, Response $response, $args)
	{			
		$userInfo['USN'] = $request->getParsedBody()['USN'];
		$userInfo['TIME'] = date("yy-m-d H:i:s");
		
		$userOuting = $this->UserManagementModel->getOutingByUSN($userInfo['USN']);

		if($userOuting != NULL){									// 외출이 처음이 아니라면
			$lastOuting = count($userOuting) - 1;					//맨 마지막 외출 확인
			//print_r($userOuting);
			//print_r($userOuting[$lastOuting]);
	
			if($userOuting[$lastOuting]['OUTING_BACK'] == ""){		// 복귀 안한게 있음
				$userInfo['last'] = $userOuting[$lastOuting]['OUTING_NO'];
				$check = $this->UserManagementModel->OuttingBack($userInfo);
				if($check == 0){
					$result['header'] = "Outing update success";
					$result['message'] = "0";
				}else{
					$result['header'] = "Outing update fail";
					$result['message'] = "1";
				}
			}else{													// 복귀 다 했음
				$check = $this->UserManagementModel->OuttingOut($userInfo);
				if($check == 0){
					$result['header'] = "Outing insert success";
					$result['message'] = "2";
				}else{
					$result['header'] = "Outing insert fail";
					$result['message'] = "3";
				}
			}
		}else{
			$check = $this->UserManagementModel->OuttingOut($userInfo);
			if($check == 0){
				$result['header'] = "Outing insert success";
				$result['message'] = "2";
			}else{
				$result['header'] = "Outing insert fail";
				$result['message'] = "3";
			}	
		}
		
		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));	

	}	


	 //유저 이름만 가져오기
	 public function getUserName(Request $request, Response $response, $args)
	 {
		$result = $this->UserManagementModel->getUserName();

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));	
	 }


	 /*********************************************
	 * 지문 출결 및 외출 복귀
	 * 
	 * return 
	 * 0 : 출근 성공
	 * 1 : DB 에러
	 * 2 : 지각
	 * 3 : 퇴근 성공
	 * 4 : 아직 수업 시간
	 ***********************************************/
	public function checkFinger(Request $request, Response $response, $args)
	{				
		//이후 MAC 주소 받아서 USN을 찾고 출석 되게끔 만듬
		
		// code = 암호
		$code = $args['code'];		
		
		//$code = "1$91810bf4e1d1b59d$1";
		// 코드 입력 받은 것을 $로 문자열 자름
		$slidecode = explode('$', $code);

		$day = date("m-d");
		$time = date("H:i:s");		

		// 지문 index를 이용하여 usn 가져오기		
		$userInfo['USN'] = $this->UserManagementModel->checkFingerCode($slidecode[0])[0]['AUTHENTICATION_USN'];
		print_r($this->UserManagementModel->checkFingerCode($slidecode[0])[0]['AUTHENTICATION_USN']);

		// 1번째 값이 암호화된 code
		$result['Input'] = $slidecode[1];

		$inputcode = $slidecode[1];

		// 암호 해독
		$temp = exec("/var/www/html/hustar/hustar-app/KISA/decode1 $inputcode");
		
		$result['Decode'] = $temp;

		//문자열 자르고
		$decode = explode(' ', $temp);

		//날짜 체크
		if($decode[1] == explode('-', $day)[0]  && $decode[2] == explode('-', $day)[1]){
			if((int)$decode[5] >= 50 &&  (int)date("s") < 10){
				$nowSecond = (int)date("s") + 60;
			}else{
				$nowSecond = (int)date("s");
			}

			if( ($nowSecond - (int)$decode[5]) <= 20 && ($nowSecond - (int)$decode[5]) >= 0){
				//printf(((int)$decode[5] - (int)date("s")));
				if($slidecode[2] == 1){				// 출근
					// DB 삽입
					$userInfo['GTW'] = date("yy-m-d H:i:s");
					
					//print_r("PUSH >>> USN : ".$userInfo['USN']."GTW : ".$userInfo['GTW']."\n");

					$attendInfo = $this->UserManagementModel->AttendanceGTW($userInfo);

					if($attendInfo == 1){
						$result['header'] = "DB error";
						$result['message'] = "1";
					}
					
					if($decode[3] == '10' && (int)$decode[4] <= 10){		//시간 체크					
						if($attendInfo == 0){
							$result['header'] = "Go to work";
							$result['message'] = "0";
						}else{
							$result['header'] = "DB error";
							$result['message'] = "1";
						}				
					}else{
						$result['header'] = "Be late for work";
						$result['message'] = "2";
					}				
				}else if($slidecode[2] == 2){	// 퇴근		
					if((int)$decode[3] >= 18){		//시간 체크
						// DB 수정
						$userInfo['GTH'] = date("yy-m-d H:i:s");

						$attendInfo = $this->UserManagementModel->AttendanceGTH($userInfo);
						if($attendInfo == 0){
							$result['header'] = "Go to Home";
							$result['message'] = "3";
						}else{
							$result['header'] = "DB error";
							$result['message'] = "1";
						}
					}else{
						$result['header'] = "It's still class time";
						$result['message'] = "4";
					}
				}
			}else{
				$result['header'] = "Are you hacked now?";
				$result['message'] = "5";
			}
		}else{
			$result['header'] = "Attendance Check";
			$result['message'] = "Absent";
		}
		
		//$result['result'] = exec("/var/www/html/hustar/hustar-app/KISA/decode $name");
		
		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
		
	}

	/**
	 * 지문 정보 등록
	 * 
	 * return
	 * 0 : DB 저장 성공
	 * 1 : 이미 등록되어있는 지문 index 번호
	 * 2 : 이미 지문 3개 등록 다함
	 * 3 : DB 저장 실패
	 */
	public function registerFinger(Request $request, Response $response, $args)
	{		
		$user['code'] = $request->getParsedBody()['CODE'];
		$user['usn'] = $request->getParsedBody()['USN'];

		// code 가 이미 지문 등록이 되어있는지 확인
		$codecheck = $this->UserManagementModel->checkFingerCode($user);
		if(count($codecheck) == 0 ){
			// usn 에 해당하는 지문이 이미 3개가 있는지 확인
			$usncheck = $this->UserManagementModel->checkFingerUsn($user);
			// print_r($usncheck[0]['AUTHENTICATION_FINGER_3']);

			if($usncheck[0]['AUTHENTICATION_FINGER_3'] == ""){
				//지문 등록
				// 지문 등록 위치 찾아서 등록
				$userfinger = $this->UserManagementModel->getFingerUsn($user);
				
				// print_r($userfinger);

				if($userfinger[0]['AUTHENTICATION_FINGER_1'] == NULL){
					if(($this->UserManagementModel->registerFinger_1($user)) == 0){
						$result['header'] = "DB insert success";
						$result['message'] = "0";
					}else{
						$result['header'] = "DB insert fail";
						$result['message'] = "3";
					}
				}else if($userfinger[0]['AUTHENTICATION_FINGER_2'] == NULL){
					if(($this->UserManagementModel->registerFinger_2($user)) == 0){
						$result['header'] = "DB insert success";
						$result['message'] = "0";
					}else{
						$result['header'] = "DB insert fail";
						$result['message'] = "3";
					}
				}else if($userfinger[0]['AUTHENTICATION_FINGER_3'] == NULL){
					if(($this->UserManagementModel->registerFinger_3($user)) == 0){
						$result['header'] = "DB insert success";
						$result['message'] = "0";
					}else{
						$result['header'] = "DB insert fail";
						$result['message'] = "3";
					}
				}
			}else{
				$result['header'] = "Already registed fingerprint";
				$result['message'] = "2";
			}
		}else{
			$result['header'] = "Already registed index";
			$result['message'] = "1";
		}

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));		
	}
}