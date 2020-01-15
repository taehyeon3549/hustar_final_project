<?php

// Routes

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

// 회원가입 1단계 회원가입 페이지
$app->get('/signup/email', 'App\Controller\WebController:register_email')
    ->setName('register_email');

//forgotten_password page
$app->get('/forgot-password', 'App\Controller\WebController:forgotten_password')
    ->setName('forgot-password');

// 회원가입 3단계 정보 입력 페이지
$app->get('/verify/sign_up/{code}', 'App\Controller\WebController:sign_up')
    ->setName('sign_up');  

// 회원가입 2단계 인증 메일 전송 완료 페이지
$app->get('/signup/message', 'App\Controller\WebController:register_email_message')
    ->setName('register_email_message'); 

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
$app->get('/maps', 'App\Controller\WebController:maps')
    ->setName('maps');


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
    $app->get('/verify/check', 'App\Controller\UserManagementController:checkCertification')
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

    //forgot_password check- user are exsit
    $app->post('/forgot_password_check', 'App\Controller\UserManagementController:forgot_password_check')
    ->setName('forgot_password_check');

    //forgot_password
    $app->post('/forgot_password', 'App\Controller\UserManagementController:forgot_password')
    ->setName('forgot_password');

    //change_password
    $app->post('/change_password', 'App\Controller\UserManagementController:change_password')
    ->setName('change_password');

    //user cancellation check page
    $app->post('/delete_account_check', 'App\Controller\UserManagementController:delete_account_check')
    ->setName('delete_account_check');

    //user cancellation
    $app->post('/delete_account', 'App\Controller\UserManagementController:delete_account')
    ->setName('delete_account');

    //get user info
    $app->get('/userinfo/{usn}', 'App\Controller\UserManagementController:userinfo')
    ->setName('userinfo');

    //logo_img
    $app->get('/mailicon', 'App\Controller\UserManagementController:mailIcon')
    ->setName('mailicon');

    //show up change password page
    $app->get('/pass/{code}', 'App\Controller\UserManagementController:change_password_page')
    ->setName('mailicon');

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
