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
use PhpOffice\PhpSpreadsheet\Style\Color;



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

    /*************************************************
     * Hustar 회원 목록 json 변환
     *************************************************/
    public function userListJson(Request $request, Response $response, $args)
    {      
        // User 정보 가져옴
        $userinfo = $this->AdminModel->userList();

        //반복문을 돌며 각 row의 cell에 데이터 추가
        for($i=0; $i<count($userinfo); $i++) {    
            $result[$i]['NO'] = $i+1;
            $result[$i]['NAME'] = $userinfo[$i]['USER_NAME'];
            
            if($userinfo[$i]['USER_GENDER'] == 0){
                $result[$i]['GENDER'] = "남";
            }else{
                $result[$i]['GENDER'] = "여";
            }
            $result[$i]['BIRTH'] = $userinfo[$i]['USER_BIRTH'];
            $result[$i]['UNIV'] = $userinfo[$i]['USER_UNIV'];
            $result[$i]['MAJOR'] = $userinfo[$i]['USER_MAJOR'];
            $result[$i]['SUB_MAJOR'] = $userinfo[$i]['USER_SUBMAJOR'];
            $result[$i]['DEGREE'] = $userinfo[$i]['USER_DEGREE'];            
            $result[$i]['PHONE'] = $userinfo[$i]['USER_PHONE'];
            $result[$i]['EMAIL'] = $userinfo[$i]['USER_EMAIL'];
            $result[$i]['HUSTAR'] = $userinfo[$i]['HUSTAR_NAME'];
            $result[$i]['CLASS'] = $userinfo[$i]['SUB_CLASS_NAME'];    
        }

        return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));

    }


     /*************************************************
     * Hustar 출결 기록 Excel 파일로 출력
     *************************************************/
    public function printUserAttendance(Request $request, Response $response, $args)
    {
        // 년, 월, 일별 수업시간 입력 받음
        //$year = $request->getParsedBody()['YEAR'];        
        //$month = $request->getParsedBody()['MONTH'];
        $month = $args['month'];
        // $ctime = $request->getParsedBody()['CLASSTIME'];
        $ctime = "8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8";
        $daytime = explode(',',$ctime);

        $year = "2020";
        //$month = "2";

        $time = mktime(0,0,0,$month, 1, $year);

        $yoil = array("일","월","화","수","목","금","토");        
        // 셀 인덱스 배열
        $cellborder = array("D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD","AE","AF","AG","AH");
        $index = 0;

        // 날짜 배열
        $day = array();

        // 엑셀 템플릿 들고옴
        $reader = IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load(__DIR__.'/Hustar_attendance_template.xlsx');
        
        // 출력 년 월 입력
        $spreadsheet->getActiveSheet()
                    ->setCellvalue("T3",$year."년");
        $spreadsheet->getActiveSheet()
                    ->setCellvalue("U3",$month."월");

        // 날짜 부분 입력
        while($month == date('m', $time)){
            if(date('w', $time) != 6 && date('w', $time) != 0){                
                $spreadsheet->getActiveSheet()
                    ->setCellvalue($cellborder[$index]."8",date("m-d",$time));
                
                // 입력된 날짜 배열로 저장
                $day[$index] = date("m-d",$time);
                $index +=1;
            }            
            
            //하루씩 증가
            $time = strtotime("+1 days",$time);                     
        }
        // 계산 부분 입력
        $spreadsheet->getActiveSheet()
                    ->setCellvalue($cellborder[$index]."8","총 강의시간");
        $spreadsheet->getActiveSheet()
                    ->setCellvalue($cellborder[$index+1]."8","차감 시간");
        $spreadsheet->getActiveSheet()
                    ->setCellvalue($cellborder[$index+2]."8","총 이수시간");
        $spreadsheet->getActiveSheet()
                    ->setCellvalue($cellborder[$index+3]."8","출석률(%)");       
                

        // 교육생 이름만 가져오기
        $userinfo = $this->AdminModel->userNameList();
        // 교육생 이름 입력
        for($i = 9; $i<count($userinfo)+9; $i++){
            $spreadsheet->getActiveSheet()
                    ->setCellvalue("C".$i,$userinfo[$i-9]['USER_NAME']);
        }
        
        // 교육생 출결 상황 입력
        for($column = 9; $column< 9+count($userinfo); $column++){
            //USN 가져오고
            $user['USN'] = $userinfo[$column-9]['USER_USN'];       

            //총 이수시간
            $totalTime = 0;
            // 차감 시간
            $minusTime = 0;
            //총 강의시간
            $totalClassTime = 0;

            // USN 으로 출결 정보 가져오고
            for($row = 0; $row<$index; $row++){
                // 총 강의시간 합
                $totalClassTime += $daytime[$row];

                if($day[$row] != NULL){
                    $user['DAYFRONT'] = "2020-".$day[$row]." 0:0:0";
                    $user['DAYEND'] = "2020-".$day[$row]." 23:59:59";
                    
                    // USN 에 해당하는 출결 정보 가져오고
                    $userAttendace = $this->AdminModel->attendanceList($user);
                    if(count($userAttendace) != 0){
                        $GTW_time_H = date("H:i:s", strtotime( $userAttendace[0]["ATTENDANCE_GTW"] ) );
                        //$GTH_time_H = date("H:m:s", strtotime( $userAttendace[0]["ATTENDANCE_GTH"] ) );
                        $GTH_time_H = date("H:i:s", strtotime("2020-02-02 18:00:00" ));

                        $HourGab = (strtotime($GTH_time_H) - strtotime($GTW_time_H))/3600;
                        $MinGab = (strtotime($GTH_time_H) - strtotime($GTW_time_H))/60;
                        
                        // 정상 출결이라면 그날 하루 시간을 표시1
                        if($MinGab >=470.0){                       
                            //print_r("정상");
                            $spreadsheet->getActiveSheet()
                                ->setCellvalue($cellborder[$row].$column,"출석(".$daytime[$row].")");
                            // 색깔 변경
                            $spreadsheet->getActiveSheet()->getStyle($cellborder[$row].$column)->getFill()
                                ->setFillType('solid')->getStartColor()->setARGB("FF90EE90");

                            // 총 이수시간 더하기
                            $totalTime += $daytime[$row];
                        }else{                        
                            $spreadsheet->getActiveSheet()
                                ->setCellvalue($cellborder[$row].$column,"지각(".(int)$HourGab.")");
                                //->setCellvalue($cellborder[$row].$column,(int)$HourGab);
                            // 색깔 변경
                            $spreadsheet->getActiveSheet()->getStyle($cellborder[$row].$column)->getFill()
                                ->setFillType("solid")->getStartColor()->setARGB("FFFAFAD2");                            
                            

                            // 총 이수시간 더하기
                            $totalTime += (int)$HourGab;
                            // 차감 시간 더하기
                            $minusTime += ($daytime[$row] - (int)$HourGab);
                        }
                    }else{
                        $spreadsheet->getActiveSheet()
                                ->setCellvalue($cellborder[$row].$column,"결석(0)");
                        // 색깔 변경
                        $spreadsheet->getActiveSheet()->getStyle($cellborder[$row].$column)->getFill()
                            ->setFillType("solid")->getStartColor()->setARGB("FFFFB6C1");
                        // 차감 시간 더하기
                        $minusTime += $daytime[$row];
                    }
                }
            }
            // 총 강의시간 출력
            $spreadsheet->getActiveSheet()
                                ->setCellvalue($cellborder[$row].$column,$totalClassTime);
            // 차감 시간 출력
            $spreadsheet->getActiveSheet()
                                ->setCellvalue($cellborder[$row+1].$column,$minusTime);
            // 총 이수시간 출력
            $spreadsheet->getActiveSheet()
                                ->setCellvalue($cellborder[$row+2].$column,$totalTime);
            $spreadsheet->getActiveSheet()->getStyle($cellborder[$row+2].$column)->getFill()
                                ->setFillType("solid")->getStartColor()->setARGB("FFFFFF00");  
            // 출석률 출력 
            $spreadsheet->getActiveSheet()
                                ->setCellvalue($cellborder[$row+3].$column,($totalTime/$totalClassTime)*100);
            $spreadsheet->getActiveSheet()->getStyle($cellborder[$row+3].$column)->getFill()
                                ->setFillType("solid")->getStartColor()->setARGB("FFFFFF00");  

        }


        $excelWriter = new Xlsx($spreadsheet);
        $tempFile = tempnam(File::sysGetTempDir(), 'phpxltmp');
        $tempFile = $tempFile ?: __DIR__ . '/temp.xlsx';
        $excelWriter->save($tempFile);

        $response = $response->withHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response = $response->withHeader('Content-Disposition', 'attachment; filename="Hustar_출석명단.xlsx"');

        $stream = fopen($tempFile, 'r+');

        return $response->withBody(new \Slim\Http\Stream($stream)); 
    }


    public function testest(Request $request, Response $response, $args){
        $GTW_time_H = date("H:i:s", strtotime("2020-02-02 10:00:11" ));        
        $GTH_time_H = date("H:i:s", strtotime("2020-02-02 18:00:00" ));

        print_r($GTW_time_H."\n");
        print_r($GTH_time_H."\n");

        $HourGab = (strtotime($GTH_time_H) - strtotime($GTW_time_H))/3600;
        $MinGab = (strtotime($GTH_time_H) - strtotime($GTW_time_H))/60;
        
        // 정상 출결이라면 그날 하루 시간을 표시1
        if($MinGab >=470.0){                       
            //print_r("정상");
            print_r("\n정상 시간차이 (".(int)$HourGab.") :: 분 차이 (".$MinGab.")\n");            
        }else{
            print_r("\n지각 시간차이 (".(int)$HourGab.") :: 분 차이 (".$MinGab.")\n");            
        }
        

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
            $tt = $this->AdminModel->noticeUpdate($notice);
            if($tt == 0){
                $result['header'] = "Update the Notice is success";
                $result['message'] = "0";
            }else{
                // print_r($this->AdminModel->noticeUpdate($notice));
                $result['header'] = "Update the Notice is fail";
                $result['message'] = $tt;
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

    /***************************************
     * 공지사항 출력     
     * return 
     * 정보
     ***************************************/
    public function noticeList(Request $request, Response $response, $args)
    {     
        $noticeInfo = $this->AdminModel->noticeList();

        $count = count($noticeInfo);

        for($i = 0; $i < $count; $i++){
            $result[$i]['NOTICE_NO'] = $noticeInfo[$i]['NOTICE_NO'];
            $result[$i]['NOTICE_TITLE'] = $noticeInfo[$i]['NOTICE_TITLE'];
            $result[$i]['NOTICE_BODY'] = $noticeInfo[$i]['NOTICE_BODY'];
            $result[$i]['NOTICE_NAME'] = $noticeInfo[$i]['USER_NAME'];
            $result[$i]['NOTICE_DATE'] = $noticeInfo[$i]['NOTICE_DATE'];
            $result[$i]['NOTICE_STATE'] = $noticeInfo[$i]['NOTICE_STATE'];
        }
        

        return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
    }

/**
 * 출석일 출력
 */
public function getAttendanceDate(Request $request, Response $response, $args)
    {
        // 년, 월, 일별 수업시간 입력 받음
         $year = $request->getParsedBody()['YEAR'];
         $month = $request->getParsedBody()['MONTH'];
         $ctime = $request->getParsedBody()['CLASSTIME'];
        //$year = "2020";
        //$month = "2";
        //$ctime = "8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8";

        $daytime = explode(',',$ctime);       

        $time = mktime(0,0,0,$month, 1, $year);

        $yoil = array("일","월","화","수","목","금","토");        
        // 셀 인덱스 배열
        $cellborder = array("D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD","AE","AF","AG","AH");
        $index = 0;

        // 날짜 배열
        $day = array();

        // 결과
        $result = array();
        $result['TOP'] = array();
        $result['TOP'][0] = '';
        
        // 날짜 부분 입력
        while($month == date('m', $time)){
            if(date('w', $time) != 6 && date('w', $time) != 0){                
                
                // 입력된 날짜 배열로 저장
                $day[$index] = date("m-d",$time);

                // 결과 
                $result['TOP'][$index +1] = date("m-d",$time);

                $index +=1;
            }            
            
            //하루씩 증가
            $time = strtotime("+1 days",$time);                     
        }
        
        // 결과
        $result['TOP'][$index+1] = "총 강의시간";
        $result['TOP'][$index+2] = "차감 시간";
        $result['TOP'][$index+3] = "총 이수시간";
        $result['TOP'][$index+4] = "출석률(%)";       
                

        // 교육생 이름만 가져오기
        $userinfo = $this->AdminModel->userNameList();
        // 교육생 이름 입력
        for($i = 9; $i<count($userinfo)+9; $i++){

            // 결과
            $result['LEFT'][$i-9]['NAME'] = $userinfo[$i-9]['USER_NAME'];
        }
        
        // 교육생 출결 상황 입력
        for($column = 9; $column< 9+count($userinfo); $column++){
            //USN 가져오고
            $user['USN'] = $userinfo[$column-9]['USER_USN'];       

            //총 이수시간
            $totalTime = 0;
            // 차감 시간
            $minusTime = 0;
            //총 강의시간
            $totalClassTime = 0;

            // USN 으로 출결 정보 가져오고
            for($row = 0; $row<$index; $row++){
                // 총 강의시간 합
                $totalClassTime += $daytime[$row];

                if($day[$row] != NULL){
                    $user['DAYFRONT'] = "2020-".$day[$row]." 0:0:0";
                    $user['DAYEND'] = "2020-".$day[$row]." 23:59:59";
                    
                    // USN 에 해당하는 출결 정보 가져오고
                    $userAttendace = $this->AdminModel->attendanceList($user);
                    if(count($userAttendace) != 0){
                        $GTW_time_H = date("H:i:s", strtotime( $userAttendace[0]["ATTENDANCE_GTW"] ) );
                        //$GTH_time_H = date("H:m:s", strtotime( $userAttendace[0]["ATTENDANCE_GTH"] ) );
                        $GTH_time_H = date("H:i:s", strtotime("2020-02-02 18:00:00" ));

                        $HourGab = (strtotime($GTH_time_H) - strtotime($GTW_time_H))/3600;
                        $MinGab = (strtotime($GTH_time_H) - strtotime($GTW_time_H))/60;
                        
                        // 정상 출결이라면 그날 하루 시간을 표시1
                        if($MinGab >=470.0){                       
                        
                            
                            //결과
                            $result['LEFT'][$column-9]['ATTEND'][$row] = "출석(".$daytime[$row].")";


                            // 총 이수시간 더하기
                            $totalTime += $daytime[$row];
                        }else{                        
                            
                            //결과
                            $result['LEFT'][$column-9]['ATTEND'][$row] = "지각(".(int)$HourGab.")";
                                                
                            

                            // 총 이수시간 더하기
                            $totalTime += (int)$HourGab;
                            // 차감 시간 더하기
                            $minusTime += ($daytime[$row] - (int)$HourGab);
                        }
                    }else{
                        //결과
                        $result['LEFT'][$column-9]['ATTEND'][$row] = "결석(0)";
                  
                        // 차감 시간 더하기
                        $minusTime += $daytime[$row];
                    }
                }
            }
             //결과
             $result['LEFT'][$column-9]['ATTEND'][$row+1] = $totalClassTime;
             //결과
             $result['LEFT'][$column-9]['ATTEND'][$row+2] = $minusTime; 
             //결과
             $result['LEFT'][$column-9]['ATTEND'][$row+3] = $totalTime; 
             //결과
             $result['LEFT'][$column-9]['ATTEND'][$row+4] = ($totalTime/$totalClassTime)*100;  
           

        }     
        //print_r($result);

        return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
    }


    /******************************************************
     * 관리자 기능 : 각일자 별 출석, 지각, 결석 인원 가져오기
     *******************************************************/
    public function getAttendanceCount(Request $request, Response $response, $args)
    {
         // 년, 월, 일별 수업시간 입력 받음
         $year = $request->getParsedBody()['YEAR'];
         $month = $request->getParsedBody()['MONTH'];
        //  $ctime = $request->getParsedBody()['CLASSTIME'];
        // $year = "2020";
        // $month = "2";

        $time = mktime(0,0,0,$month, 1, $year);

        $yoil = array("일","월","화","수","목","금","토");        
        // 셀 인덱스 배열
        $cellborder = array("D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD","AE","AF","AG","AH");
        $index = 0;

        // 날짜 배열
        $day = array();

        // 결과
        $result = array();      
        
        // 총 교육생 카운트
        $totalStudent = $this->AdminModel->userCount()['count(*)'];

        // 날짜 부분 입력
        while($month == date('m', $time)){
            if(date('w', $time) != 6 && date('w', $time) != 0){           
                $DATE['DAYFRONT'] = "2020-".date("m-d",$time)." 0:0:0";
                $DATE['DAYEND'] = "2020-".date("m-d",$time)." 23:59:59";

                $userAttendace = $this->AdminModel->attendanceListByDATE($DATE);
                $result[$index]['start'] = date("yy-m-d",$time);
                $result[$index]['title'][0] = "출석 : ".$userAttendace['count(*)'];                
                $result[$index]['title'][1] = "결석 : ".((int)$totalStudent - (int)$userAttendace['count(*)']);
                

                $DATE['DAYFRONT'] = "2020-".date("m-d",$time)." 10:10:0";

                // 지각생
                $laterCnt = $this->AdminModel->attendanceListByDATE($DATE)['count(*)'];
                $result[$index]['title'][2] = "지각 : ".$laterCnt;
                
                

                $index +=1;
            }            
            
            //하루씩 증가
            $time = strtotime("+1 days",$time);                     
        }   

        // // 교육생 이름만 가져오기
        // $userinfo = $this->AdminModel->userNameList();
        // // 교육생 이름 입력
        // for($i = 9; $i<count($userinfo)+9; $i++){

        //     // 결과
        //     $result['LEFT'][$i-9]['NAME'] = $userinfo[$i-9]['USER_NAME'];
        // }
        
        // // 교육생 출결 상황 입력
        // for($column = 9; $column< 9+count($userinfo); $column++){
        //     //USN 가져오고
        //     $user['USN'] = $userinfo[$column-9]['USER_USN'];       

        //     //총 이수시간
        //     $totalTime = 0;
        //     // 차감 시간
        //     $minusTime = 0;
        //     //총 강의시간
        //     $totalClassTime = 0;

        //     // USN 으로 출결 정보 가져오고
        //     for($row = 0; $row<$index; $row++){              

        //         if($day[$row] != NULL){
        //             $user['DAYFRONT'] = "2020-".$day[$row]." 0:0:0";
        //             $user['DAYEND'] = "2020-".$day[$row]." 23:59:59";
                    
        //             // USN 에 해당하는 출결 정보 가져오고
        //             $userAttendace = $this->AdminModel->attendanceList($user);
        //             if(count($userAttendace) != 0){
        //                 $GTW_time_H = date("H:i:s", strtotime( $userAttendace[0]["ATTENDANCE_GTW"] ) );
        //                 //$GTH_time_H = date("H:m:s", strtotime( $userAttendace[0]["ATTENDANCE_GTH"] ) );
        //                 $GTH_time_H = date("H:i:s", strtotime("2020-02-02 18:00:00" ));

        //                 $HourGab = (strtotime($GTH_time_H) - strtotime($GTW_time_H))/3600;
        //                 $MinGab = (strtotime($GTH_time_H) - strtotime($GTW_time_H))/60;
                        
        //                 // 정상 출결이라면 그날 하루 시간을 표시1
        //                 if($MinGab >=470.0){                       
                        
                            
        //                     //결과
        //                     $result['LEFT'][$column-9]['ATTEND'][$row] = "출석(".$daytime[$row].")";

        //                 }else{                        
                            
        //                     //결과
        //                     $result['LEFT'][$column-9]['ATTEND'][$row] = "지각(".(int)$HourGab.")";
                                                
        //                 }
        //             }else{
        //                 //결과
        //                 $result['LEFT'][$column-9]['ATTEND'][$row] = "결석(0)";
                  
        //             }
        //         }
        //     }
           

        // }     
        //print_r($result);

        return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
    }

    /***************************************
     * 출석 인원 이름 가져오기
     * return 
     * 정보
     ***************************************/
    public function attendedList(Request $request, Response $response, $args)
    {     
        $month = $request->getParsedBody()['MONTH'];
        $day = $request->getParsedBody()['DAY'];

        $ok_c = 0;
        $error_c = 0;
        $late_c = 0;
        $absent_c = 0;

        /******************** 정상 ****************** */
        $date['START'] = "2020-".$month."-".$day." 06:00:00";
        $date['END'] = "2020-".$month."-".$day." 10:10:00";        

        $attendList = $this->AdminModel->getAttendList($date);
        $errorList = $this->AdminModel->errorList($date);
        
        $count = count($attendList);        

        for($i = 0; $i < $count; $i++){
            $result['OK'][$i] = $attendList[$i]['USER_NAME'];
            $ok_c+=1;
        }

        $count = count($errorList);        

        for($i = 0; $i < $count; $i++){
            $result['ERROR'][$i] = $errorList[$i]['USER_NAME'];
            $error_c+=1;
        }

        /******************** 지각 ****************** */
        $date['START'] = "2020-".$month."-".$day." 10:10:01";
        $date['END'] = "2020-".$month."-".$day." 18:00:00";

        $lateList = $this->AdminModel->getAttendList($date);
        
        $count = count($lateList);

        for($i = 0; $i < $count; $i++){
            $result['LATE'][$i] = $lateList[$i]['USER_NAME'];
            $late_c+=1;
        }

        /******************** 결석 ****************** */
        $date['START'] = "2020-".$month."-".$day." 00:00:00";
        $date['END'] = "2020-".$month."-".$day." 23:59:00";

        $absentList = $this->AdminModel->getAbsentList($date);
        
        $count = count($absentList);

        for($i = 0; $i < $count; $i++){
            $result['ABSENT'][$i] = $absentList[$i]['USER_NAME'];
            $absent_c+=1;
        }
        
        $result['MAX'] = max($ok_c,$error_c,$absent_c,$late_c);
        

        return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($result, JSON_NUMERIC_CHECK));
    }    
}
