<?php
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use PhpOffice\PhpSpreadsheet\Shared\File;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;



final class AdminController extends BaseController
{
    protected $logger;
	protected $AdminModel;
    protected $view;
    
    public function __construct($logger, $AdminModel, $view)
	{
		$this->logger = $logger;
		$this->AdminModel = $AdminModel;
		$this->view = $view;
    }
    
    public function temp(Request $request, Response $response, $args)
    {
        $userinfo = $this->AdminModel->userList();
        
        $excel = new Spreadsheet();
        
        // 셀 열 설정
        $excel->setActiveSheetIndex(0)
                        ->setCellValue('C8', 'No.')
                        ->setCellValue('D8', 'Hustar 부서명')
                        ->setCellValue('E8', '교육 장소')
                        ->setCellValue('F8', '이름')
                        ->setCellValue('G8', '이메일')
                        ->setCellValue('H8', '학교')
                        ->setCellValue('I8', '전공')
                        ->setCellValue('J8', '부전공')
                        ->setCellValue('K8', '석/박사')
                        ->setCellValue('L8', '휴대전화')
                        ->setCellValue('M8', '생년월일')
                        ->setCellValue('N8', '성별')
                        ->setCellValue('O8', '분반 이름')
                        ->setCellValue('P8', '멘토 교수');

        //반복문을 돌며 각 row의 cell에 데이터 추가
        for($i=9; $i<count($userinfo)+9; $i++) {            
            $excel->setActiveSheetIndex(0)
                        // ->setCellValue("A$i", $userinfo[i-3]['HUSTAR_NAME'])
                        ->setCellValue("C$i", ($i - 9))
                        ->setCellValue("D$i", $userinfo[$i-8]['HUSTAR_NAME'])
                        ->setCellValue("E$i", $userinfo[$i-8]['HUSTAR_ADDRESS'])
                        ->setCellValue("F$i", $userinfo[$i-8]['USER_NAME'])
                        ->setCellValue("G$i", $userinfo[$i-8]['USER_EMAIL'])
                        ->setCellValue("H$i", $userinfo[$i-8]['USER_UNIV'])
                        ->setCellValue("I$i", $userinfo[$i-8]['USER_MAJOR'])
                        ->setCellValue("J$i", $userinfo[$i-8]['USER_SUBMAJOR'])
                        ->setCellValue("K$i", $userinfo[$i-8]['USER_DEGREE'])
                        ->setCellValue("L$i", $userinfo[$i-8]['USER_PHONE'])
                        ->setCellValue("M$i", $userinfo[$i-8]['USER_BIRTH'])                        
                        ->setCellValue("O$i", $userinfo[$i-8]['SUB_CLASS_NAME'])
                        ->setCellValue("P$i", $userinfo[$i-8]['SUB_CLASS_CHARGER']);
            if($userinfo[$i-8]['USER_GENDER'] == 0){
                $excel->setActiveSheetIndex(0)
                    ->setCellValue("N$i", "남");
            }else{
                $excel->setActiveSheetIndex(0)
                    ->setCellValue("N$i", "여");
            }
        }

        // 워크시트 이름 붙이기
        $excel->getActiveSheet()->setTitle('Hustar 인원 정보');

        $excel->getActiveSheet()
                    ->getColumnDimension('C')
                    ->setWidth(5);

        $excel->getActiveSheet()
                    ->getColumnDimension('D')
                    ->setWidth(20);
        $excel->getActiveSheet()
                    ->getColumnDimension('E')
                    ->setWidth(25);
        $excel->getActiveSheet()
                    ->getColumnDimension('F')
                    ->setWidth(10);
        $excel->getActiveSheet()
                    ->getColumnDimension('G')
                    ->setWidth(25);
        $excel->getActiveSheet()
                    ->getColumnDimension('H')
                    ->setWidth(25);
        $excel->getActiveSheet()
                    ->getColumnDimension('I')
                    ->setWidth(25);
        $excel->getActiveSheet()
                    ->getColumnDimension('J')
                    ->setWidth(25);
        $excel->getActiveSheet()
                    ->getColumnDimension('K')
                    ->setWidth(25);
        $excel->getActiveSheet()
                    ->getColumnDimension('L')
                    ->setWidth(25);
        $excel->getActiveSheet()
                    ->getColumnDimension('M')
                    ->setWidth(25);
        $excel->getActiveSheet()
                    ->getColumnDimension('N')
                    ->setWidth(25);
        $excel->getActiveSheet()
                    ->getColumnDimension('O')
                    ->setWidth(25);
        $excel->getActiveSheet()
                    ->getColumnDimension('P')
                    ->setWidth(25);       
        
        $excel->setActiveSheetIndex(0);
        ob_end_clean();
    
        $excelWriter = new Xlsx($excel);

        // We have to create a real temp file here because the
        // save() method doesn't support in-memory streams.
        $tempFile = tempnam(File::sysGetTempDir(), 'phpxltmp');
        $tempFile = $tempFile ?: __DIR__ . '/temp.xlsx';
        $excelWriter->save($tempFile);

        // For Excel2007 and above .xlsx files   
        $response = $response->withHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response = $response->withHeader('Content-Disposition', 'attachment; filename="Hustar_교육생_명단.xlsx"');

        $stream = fopen($tempFile, 'r+');

        return $response->withBody(new \Slim\Http\Stream($stream));        
    }

    /*************************************************
     * Hustar user 테이블 전체 기록 Excel 파일로 출력
     *************************************************/
    public function printUserList(Request $request, Response $response, $args)
    {
        //$helper->log('Load from Xls template');
        $reader = IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load(__DIR__.'/Hustar_student_list_template.xlsx');
        
        // User 정보 가져옴
        $userinfo = $this->AdminModel->userList();

        //반복문을 돌며 각 row의 cell에 데이터 추가
        for($i=9; $i<count($userinfo)+9; $i++) {            
            $spreadsheet->getActiveSheet()
                        // ->setCellValue("A$i", $userinfo[i-3]['HUSTAR_NAME'])
                        ->setCellValue("C$i", ($i - 8))
                        ->setCellValue("D$i", $userinfo[$i-9]['HUSTAR_NAME'])
                        ->setCellValue("E$i", $userinfo[$i-9]['HUSTAR_ADDRESS'])
                        ->setCellValue("F$i", $userinfo[$i-9]['USER_NAME'])
                        ->setCellValue("G$i", $userinfo[$i-9]['USER_EMAIL'])
                        ->setCellValue("H$i", $userinfo[$i-9]['USER_UNIV'])
                        ->setCellValue("I$i", $userinfo[$i-9]['USER_MAJOR'])
                        ->setCellValue("J$i", $userinfo[$i-9]['USER_SUBMAJOR'])
                        ->setCellValue("K$i", $userinfo[$i-9]['USER_DEGREE'])
                        ->setCellValue("L$i", $userinfo[$i-9]['USER_PHONE'])
                        ->setCellValue("M$i", $userinfo[$i-9]['USER_BIRTH'])                        
                        ->setCellValue("O$i", $userinfo[$i-9]['SUB_CLASS_NAME'])
                        ->setCellValue("P$i", $userinfo[$i-9]['SUB_CLASS_CHARGER']);

            if($userinfo[$i-9]['USER_GENDER'] == 0){
                $spreadsheet->setActiveSheetIndex(0)
                      ->setCellValue("N$i", "남");
            }else{
                $spreadsheet->setActiveSheetIndex(0)
                      ->setCellValue("N$i", "여");
            }            
        }

        $excelWriter = new Xlsx($spreadsheet);
        $tempFile = tempnam(File::sysGetTempDir(), 'phpxltmp');
        $tempFile = $tempFile ?: __DIR__ . '/temp.xlsx';
        $excelWriter->save($tempFile);

        $response = $response->withHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response = $response->withHeader('Content-Disposition', 'attachment; filename="Hustar_교육생명단.xlsx"');

        $stream = fopen($tempFile, 'r+');

        return $response->withBody(new \Slim\Http\Stream($stream));  

        // // Save
        // $helper->write($spreadsheet, __FILE__);
    }

    /***************************************
     * 공지사항 입력
     * TITLE, BODY, USN
     * return 
     * 0 DB 입력 성공
     * 1 DB 입력 실패
     * 2 관리자 계정이 아님
     ***************************************/
    public function noticeAdd(Request $request, Response $response, $args)
    {
        $notice['TITLE'] = $request->getParsedBody()['TITLE'];
        $notice['BODY'] = $request->getParsedBody()['BODY'];
        $notice['USN'] = $request->getParsedBody()['USN'];
        $notice['DATE'] = date("yy-m-d H:i:s");

        $userinfo = $this->AdminModel->getUserByUSN($notice['USN']);

        if($userinfo['USER_ADMIN'] == 1){       //입력한 사용자가 관리자라면
            if($this->AdminModel->noticeAdd($notice) == 0){
                $result['header'] = "Add the Notice is success";
                $result['message'] = "0";
            }else{
                $result['header'] = "Add the Notice is fail";
                $result['message'] = "1";
            }
        }else{
            $result['header'] = "Not admin";
            $result['message'] = "2";
        }
        

        return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
    }

    /***************************************
     * 공지사항 수정
     * NO, TITLE, BODY, USN
     * return 
     * 0 DB 수정 성공
     * 1 DB 수정 실패
     * 2 관리자 계정이 아님
     ***************************************/
    public function noticeUpdate(Request $request, Response $response, $args)
    {
        $notice['NO'] = $request->getParsedBody()['NO'];
        $notice['TITLE'] = $request->getParsedBody()['TITLE'];
        $notice['BODY'] = $request->getParsedBody()['BODY'];
        $notice['USN'] = $request->getParsedBody()['USN'];
        $notice['DATE'] = date("yy-m-d H:i:s");

        $userinfo = $this->AdminModel->getUserByUSN($notice['USN']);

        if($userinfo['USER_ADMIN'] == 1){       //입력한 사용자가 관리자라면
            if($this->AdminModel->noticeUpdate($notice) == 0){
                $result['header'] = "Update the Notice is success";
                $result['message'] = "0";
            }else{
                $result['header'] = "Update the Notice is fail";
                $result['message'] = "1";
            }
        }else{
            $result['header'] = "Not admin";
            $result['message'] = "2";
        }

        return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
    }

    /***************************************
     * 공지사항 삭제
     * NO, USN
     * return 
     * 0 DB 삭제 성공
     * 1 DB 삭제 실패
     * 2 관리자 계정이 아님
     ***************************************/
    public function noticeDelete(Request $request, Response $response, $args)
    {
        $notice['NO'] = $request->getParsedBody()['NO'];        
        $notice['USN'] = $request->getParsedBody()['USN'];

        $userinfo = $this->AdminModel->getUserByUSN($notice['USN']);

        if($userinfo['USER_ADMIN'] == 1){       //입력한 사용자가 관리자라면
            if($this->AdminModel->noticeDelete($notice) == 0){
                $result['header'] = "Delete the Notice is success";
                $result['message'] = "0";
            }else{
                $result['header'] = "Delete the Notice is fail";
                $result['message'] = "1";
            }
        }else{
            $result['header'] = "Not admin";
            $result['message'] = "2";
        }

        return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
    }
}
