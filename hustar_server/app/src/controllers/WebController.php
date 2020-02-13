<?php
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class WebController extends BaseController
{
    protected $logger;
	protected $WebModel;
	protected $view;

	public function __construct($logger, $WebModel, $view)
	{
		$this->logger = $logger;
		$this->WebModel = $WebModel;
		$this->view = $view;
    }
    
    //TEST
    public function index(Request $request, Response $response, $args)
    {
        $this->logger->info("Home page action dispatched");

        //$this->flash->addMessage('info', 'Sample flash message');

        $this->view->render($response, '404.html');
        //$this->view->render($response, 'register_email.html');
        
        return $response;
    }

    public function dispatch(Request $request, Response $response, $args)
    {
        $this->logger->info("Home page action dispatched");

        //$this->flash->addMessage('info', 'Sample flash message');

        $this->view->render($response, 'login.html');
        //$this->view->render($response, 'register_email.html');
        
        return $response;
    }

    public function viewPost(Request $request, Response $response, $args)
    {
        $this->logger->info("View post using Doctrine with Slim 3");

        $messages = $this->flash->getMessage('info');

        try {
            $post = $this->em->find('App\Model\Post', intval($args['id']));
        } catch (\Exception $e) {
            echo $e->getMessage();
            die;
        }

        $this->view->render($response, 'post.html', ['post' => $post, 'flash' => $messages]);
        return $response;
    }

    
/****************************
    * 회원 가입 페이지
****************************/
	public function sign_up(Request $request, Response $response, $args)
    {        
        $this->logger->info("sign_up page action dispatched");

        $code = $args['code'];      //Get the code value             
        //Get email using by certi_code
        $val = $this->WebModel->getEmail($code);
        $email = $val['CERTIFICATION_EMAIL'];
        
        $this->view->render($response, 'register.twig', ['email' => $email]);
        return $response;
    }

/*************************
 * 메인 페이지
 *************************/
	public function main(Request $request, Response $response, $args)
    {
        $this->logger->info("main page action dispatched");

        //$this->flash->addMessage('info', 'main page load');

        $this->view->render($response, 'index.html');
        return $response;
    }

/************************************
 * 회원가입 1단계 계정 확인
**************************************/
	public function register_email(Request $request, Response $response, $args)
    {
        $this->logger->info("register_email page action dispatched");

        //$this->flash->addMessage('info', 'register_email page load');

        $this->view->render($response, 'register_email.html');
        return $response;
    }

/************************************
 * 패스워드 변경
**************************************/
	public function forgotten_password(Request $request, Response $response, $args)
    {
        $this->logger->info("forgotten_password page action dispatched");

        //$this->flash->addMessage('info', 'forgotten_password page load');

        $this->view->render($response, 'forgot-password.html');
        return $response;
    }

/************************************
 * 회원가입 2단계 인증 메일 전송 완료
**************************************/
	public function register_email_message(Request $request, Response $response, $args)
    {
        $this->logger->info("register_email_message page action dispatched");

        //$this->flash->addMessage('info', 'register_email_message page load');

        $this->view->render($response, 'register_email_message.html');
        return $response;
    }

    //myaccount
	public function myaccount(Request $request, Response $response, $args)
    {
        $this->logger->info("myaccount page action dispatched");

        //$this->flash->addMessage('info', 'myaccount page load');

        $this->view->render($response, 'myaccount.html');
        return $response;
    }

    //change-password
	public function change_password(Request $request, Response $response, $args)
    {
        $this->logger->info("change-password page action dispatched");

        //$this->flash->addMessage('info', 'change-password page load');

        $this->view->render($response, 'change-password.html');
        return $response;
    }

    //change_idcancellation
	public function change_idcancellation(Request $request, Response $response, $args)
    {
        $this->logger->info("change_idcancellation page action dispatched");

        //$this->flash->addMessage('info', 'change_idcancellation page load');

        $this->view->render($response, 'change-idcancellation.html');
        return $response;
    }

    //charts
	public function charts(Request $request, Response $response, $args)
    {
        $this->logger->info("charts page action dispatched");

       // $this->flash->addMessage('info', 'charts page load');

        $this->view->render($response, 'charts.html');
        return $response;
    }

    //maps
	public function maps(Request $request, Response $response, $args)
    {
        $this->logger->info("maps page action dispatched");

        //$this->flash->addMessage('info', 'maps page load');

        $this->view->render($response, 'google_geolocation.html');
        return $response;
    }


    //calendar
    public function calendar(Request $request, Response $response, $args)
    {
        $this->logger->info("calendar page action dispatched");

        //$this->flash->addMessage('info', 'calendar page load');

        $this->view->render($response, 'calendar.html');
        return $response;

    }    
    
    //memo
    public function memo(Request $request, Response $response, $args)
    {
        $this->logger->info("memo page action dispatched");

        //$this->flash->addMessage('info', 'memo page load');

        $this->view->render($response, 'memo.html');
        return $response;

    }    

    //PI
    public function PI(Request $request, Response $response, $args)
    {
        $this->logger->info("PI page action dispatched");

        //$this->flash->addMessage('info', 'PI page load');

        $this->view->render($response, 'PI.html');
        return $response;

    }

    //test1
    public function test1(Request $request, Response $response, $args)
    {
        $this->view->render($response, '404.html');
        return $response;
    }

     /**************************
      * 출결 상황 출력
      ************************/
     public function userAttendance(Request $request, Response $response, $args)
     {
         $this->view->render($response, 'hustar_attendance.html');
         return $response;
     }

     public function userAttendance2(Request $request, Response $response, $args)
     {
         $this->view->render($response, 'AttendanceCalendar.html');
         //$this->view->render($response, '404.html');

         return $response;
     }

     /**************************
      * 내 개인 신상카드
      ************************/
      public function userList(Request $request, Response $response, $args)
      {
          $this->view->render($response, 'hustar_user.html');
          return $response;
      }

      /**************************
      * 내 개인 신상카드 글 가져오기
      ************************/
      public function getuserList(Request $request, Response $response, $args)
      {
          $result = $this->WebModel->getuserList();
  
          return $response->withStatus(200)
          ->withHeader('Content-Type', 'application/json')
          ->write(json_encode($result, JSON_NUMERIC_CHECK));	
      }

      /**************************
      * 내 개인 신상카드 글 보기
      *****************************/
      public function userView(Request $request, Response $response, $args)
    {
        // 호출 index 받고
        $index = $args['index'];
       
        // index에 해당하는 공지사항 가져오기
        $TITLE = $this->WebModel->getuserView($index)[0]['NOTICE_TITLE'];
        $BODY = $this->WebModel->getuserView($index)[0]['NOTICE_BODY'];
        $NAME = $this->WebModel->getuserView($index)[0]['USER_NAME'];
        $DATE = $this->WebModel->getuserView($index)[0]['NOTICE_DATE'];

        $this->view->render($response, 'notificationView.twig', 
                            ['index' => $index , 'title' => $TITLE, 
                            'body' => $BODY , 'name' => $NAME , 'date' => $DATE]);
        
        return $response;
    }


    /************************************
    * 공지사항 게시판
    **************************************/
	public function notiList(Request $request, Response $response, $args)
    {
        $this->view->render($response, 'notificationBoard.html');
        return $response;
    }

    /************************************
    * 공지사항 게시판 글 가져오기
    **************************************/
	public function getNotiList(Request $request, Response $response, $args)
    {
        $result = $this->WebModel->getNotiList();

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));	
    }

    /************************************
    * 공지사항 게시판 글 보기
    **************************************/
	public function notiView(Request $request, Response $response, $args)
    {
        // 호출 index 받고
        $index = $args['index'];
       
        // index에 해당하는 공지사항 가져오기
        $TITLE = $this->WebModel->getNotiView($index)[0]['NOTICE_TITLE'];
        $BODY = $this->WebModel->getNotiView($index)[0]['NOTICE_BODY'];
        $NAME = $this->WebModel->getNotiView($index)[0]['USER_NAME'];
        $DATE = $this->WebModel->getNotiView($index)[0]['NOTICE_DATE'];

        $this->view->render($response, 'notificationView.twig', 
                            ['index' => $index , 'title' => $TITLE, 
                            'body' => $BODY , 'name' => $NAME , 'date' => $DATE]);
        
        return $response;
    }

    /************************************
    * 공지사항 게시판 글 작성 페이지
    **************************************/
	public function notiWrite(Request $request, Response $response, $args)
    {
        $this->view->render($response, 'notificationWrite.html');
        return $response;
    }

     /**************************
      * 테스트 페이지
      ************************/
      public function TESTPAGE(Request $request, Response $response, $args)
      {
          $this->view->render($response, 'Root.html');
          return $response;
      }
     /************************************
    * 회원 등록 기기 출력 페이지
    **************************************/
	public function deviceList(Request $request, Response $response, $args)
    {
        $this->view->render($response, 'hustar_device.html');
        return $response;
    }
      
}
