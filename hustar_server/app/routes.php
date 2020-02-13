<?php

/****************************************/
/*              web page                */
/****************************************/

// TEST
$app->get('/index', 'App\Controller\WebController:index')
    ->setName('index');

// 로그인 페이지 
$app->get('/', 'App\Controller\WebController:dispatch')
    ->setName('sign_in');

// 메인 페이지
$app->get('/main', 'App\Controller\WebController:main')
    ->setName('main');

// 패스워드 변경 페이지
$app->get('/signup/forgotpassword', 'App\Controller\WebController:forgotten_password')
    ->setName('forgot-password');

// 회원가입 1단계 회원가입 페이지
$app->get('/signup/email', 'App\Controller\WebController:register_email')
    ->setName('register_email');

// 회원가입 2단계 인증 메일 전송 완료 페이지
$app->get('/signup/message', 'App\Controller\WebController:register_email_message')
    ->setName('register_email_message'); 

// 회원가입 3단계 정보 입력 페이지
$app->get('/verify/sign_up/{code}', 'App\Controller\WebController:sign_up')
    ->setName('sign_up');  

// myaccount
$app->get('/myaccount', 'App\Controller\WebController:myaccount')
    ->setName('myaccount');

// change_password
$app->get('/change_password', 'App\Controller\WebController:change_password')
    ->setName('change_password');

// change_idcancellation
$app->get('/change_idcancellation', 'App\Controller\WebController:change_idcancellation')
    ->setName('change_idcancellation');

// charts
$app->get('/charts', 'App\Controller\WebController:charts')
    ->setName('charts');

// maps
$app->get('/admin/notice', 'App\Controller\WebController:memo')
    ->setName('notice');

// maps
$app->get('/maps', 'App\Controller\WebController:maps')
    ->setName('maps');

// 출결 정보 표시2
$app->get('/admin/user/attendance/page2', 'App\Controller\WebController:userAttendance')
    ->setName('userAttendance');

// 출결 정보 표시
$app->get('/admin/user/attendance/page/', 'App\Controller\WebController:userAttendance2')
    ->setName('userAttendance2');

// 휴스타 학생 표시


// 내 신상 기록 카드
$app->get('/admin/user/', 'App\Controller\WebController:userList')
    ->setName('userList');

    
// 내 신상 기록 카드 글 목록 가져오기
$app->post('/admin/user/getList', 'App\Controller\WebController:getuserList')
->setName('getuserList');


// 내 신상 기록 카드 출력
$app->get('/admin/user/view/{index}', 'App\Controller\WebController:userView')
    ->setName('userView');


// 회원 기기 등록 표시
$app->get('/admin/device/', 'App\Controller\WebController:deviceList')
    ->setName('deviceList');

// 공지사항 게시판
$app->get('/notification/', 'App\Controller\WebController:notiList')
    ->setName('notification');

// 공지사항 게시판 글 목록 가져오기
$app->post('/notification/getList', 'App\Controller\WebController:getNotiList')
->setName('getNotiList');

// 게시글 출력
$app->get('/notification/view/{index}', 'App\Controller\WebController:notiView')
    ->setName('notificationView');







    
// 게시글 입력
$app->get('/notification/wirte/', 'App\Controller\WebController:notiWrite')
    ->setName('notificationWrite');

/****************************************/
/*          User Management             */
/****************************************/

    //TEST
    $app->get('/test/{data}', 'App\Controller\UserManagementController:test')
    ->setName('test');

    //회원 가입
    $app->post('/signup', 'App\Controller\UserManagementController:signUP')
    ->setName('signup');

    //eamil check
    $app->post('/check_user', 'App\Controller\UserManagementController:check_user')
    ->setName('check_user');

    // 이메일 인증 메일 전송
    $app->post('/verify/{where}', 'App\Controller\UserManagementController:EmailVerify')
    ->setName('verify');

    // EMAIL로 인증 유무 확인 (APP)    
    $app->post('/verify/check/certification', 'App\Controller\UserManagementController:checkCertification')
    ->setName('check_certification');

    // CERTIFICATION_STATE 변경 (WEB)    
    $app->get('/verify/web/{code}', 'App\Controller\UserManagementController:change_certification')
    ->setName('change_certification');

    // CERTIFICATION_STATE 변경 (APP)    
    $app->get('/verify/app/{code}', 'App\Controller\UserManagementController:change_certification_app')
    ->setName('change_certification');

    // 로그인
    $app->post('/signin', 'App\Controller\UserManagementController:signIn')
    ->setName('signIn');

    // 로그아웃
    $app->post('/signout', 'App\Controller\UserManagementController:signOut')
    ->setName('signOut');

    // 임시비밀번호 발급
    $app->post('/newpassword', 'App\Controller\UserManagementController:makeNewPassword')
    ->setName('makeNewPassword');

    //forgot_password
    $app->post('/forgot_password', 'App\Controller\UserManagementController:forgot_password')
    ->setName('forgot_password');

    // 패스워드 변경
    $app->post('/newpassword/change', 'App\Controller\UserManagementController:change_password')
    ->setName('change_password');

    //user cancellation check page
    $app->post('/delete_account_check', 'App\Controller\UserManagementController:delete_account_check')
    ->setName('delete_account_check');

    //user cancellation
    $app->post('/delete_account', 'App\Controller\UserManagementController:delete_account')
    ->setName('delete_account');

    // 내정보 보기
    $app->post('/userinfo', 'App\Controller\UserManagementController:userInfo')
    ->setName('userinfo');

    //logo_img
    $app->get('/mailicon', 'App\Controller\UserManagementController:mailIcon')
    ->setName('mailicon');

    // 패스워드 변경 - 사용자 확인
    $app->get('/newpassword/{code}', 'App\Controller\UserManagementController:changePassword_checkUser')
    ->setName('CheckUser');

    /****************************************/
    /*          certification page          */
    /****************************************/

    //certification_success page
    $app->get('/certification/success', 'App\Controller\CertificateController:certification_success')
        ->setName('success');

    $app->get('/post/{id}', 'App\Controller\HomeController:viewPost')
        ->setName('view_post');

    // sign_up
    $app->get('/ucsd/sign_up', 'App\Controller\UserController:sign_up')
        ->setName('sign_up');

    // sign_in
    $app->get('/ucsd/sign_in', 'App\Controller\UserController:sign_in')
        ->setName('sign_in');

    /****************************************/
    /*               출결                   */
    /****************************************/

    // 출석 체크 - test
    $app->get('/check/{what}', 'App\Controller\UserManagementController:attendCheck')
        ->setName('attendCheck');

    // 외출 체크
    $app->post('/outing', 'App\Controller\UserManagementController:outingCheck')
        ->setName('outingCheck');

    // 시간 동기화
    $app->get('/gettime', 'App\Controller\DeviceManagementController:gettime')
        ->setName('getTime');

    // 지문 출석 체크
    $app->get('/check/fingerprint/{code}', 'App\Controller\UserManagementController:checkFinger')
        ->setName('CheckFinger');

    // 지문 등록
    $app->get('/register/fingerprint/', 'App\Controller\UserManagementController:registerFinger')
        ->setName('registerFinger');


    /****************************************/
    /*               기기 관리               */
    /****************************************/
        
    // 기기 등록
    $app->post('/device/register', 'App\Controller\DeviceManagementController:deviceRegistration')
        ->setName('register');

    // 기기 삭제
    $app->post('/device/deregistration', 'App\Controller\DeviceManagementController:deviceDeregistration')
        ->setName('deviceDeregistration');

    // 기기 수정
    $app->post('/device/update', 'App\Controller\DeviceManagementController:deviceUpdate')
        ->setName('deviceUpdate');

    // 기기 리스트
    $app->post('/device/list/', 'App\Controller\DeviceManagementController:deviceList')
        ->setName('deviceList');

    /****************************************/
    /*             관리자 기능               */
    /****************************************/

    // 회원 목록 출력 - 엑셀
    $app->get('/admin/user/list', 'App\Controller\AdminController:printUserList')
        ->setName('userList');    

    // 공지사항 입력
    $app->post('/admin/notice/add', 'App\Controller\AdminController:noticeAdd')
        ->setName('noticeAdd');    
    
    // 공지사항 수정
    $app->post('/admin/notice/update', 'App\Controller\AdminController:noticeUpdate')
        ->setName('noticeUpdate');    

    // 공지사항 삭제
    $app->post('/admin/notice/delete', 'App\Controller\AdminController:noticeDelete')
        ->setName('noticeDelete'); 

    // 공지사항 출력
    $app->post('/admin/notice/list', 'App\Controller\AdminController:noticeList')
        ->setName('noticeList'); 
       
    // Hustar 출결 출력
    $app->get('/admin/user/attendance/excel', 'App\Controller\AdminController:printUserAttendance')
        ->setName('attendance'); 

    // Hustar 출결 papge 출력 하기 위한 json
    $app->post('/admin/user/attendance/page/getdata', 'App\Controller\AdminController:getAttendanceDate')
        ->setName('getAttendanceDate'); 

    // Hustar 출결 papge 출력 하기 위한 일별 출결 인원 json
    $app->post('/admin/user/attendance/page/count/', 'App\Controller\AdminController:getAttendanceCount')
        ->setName('getAttendanceDate'); 
        
    
    
    // test
    $app->get('/admin/user/temp', 'App\Controller\AdminController:temp')
        ->setName('temp');    


    /****************************************/
    /*             지훈이 형 WEB 테스트               */
    /****************************************/
    $app->get('/test1', 'App\Controller\WebController:test1')
        ->setName('test1'); 

    // calendar
    $app->get('/calendar', 'App\Controller\WebController:calendar')
        ->setName('calendar');

     // memo
     $app->get('/memo', 'App\Controller\WebController:memo')
        ->setName('calendar');

     // PI
     $app->get('/PI', 'App\Controller\WebController:PI')
        ->setName('PI');

    // USER name 출력
    $app->get('/user/name', 'App\Controller\UserManagementController:getUserName')
    ->setName('getUserName');


    // WEB TEST 페이지
    $app->get('/hustar/test/', 'App\Controller\WebController:TESTPAGE')
        ->setName('userList');

