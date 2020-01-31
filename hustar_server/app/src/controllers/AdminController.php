<?php
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use PhpOffice\PhpSpreadsheet\Shared\File;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


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
    
    public function printUserList(Request $request, Response $response, $args)
    {
        $userinfo = $this->AdminModel->userList();
        
        $excel = new Spreadsheet();
        
        // 셀 열 설정
        $excel->setActiveSheetIndex(0)
                        ->setCellValue('A2', 'Hustar 부서명')
                        ->setCellValue('B2', '교육 장소')
                        ->setCellValue('C2', '이름')
                        ->setCellValue('D2', '이메일')
                        ->setCellValue('E2', '휴대전화')
                        ->setCellValue('F2', '생년월일')
                        ->setCellValue('G2', '성별')
                        ->setCellValue('H2', '분반 이름')
                        ->setCellValue('I2', '멘토 교수');

        //반복문을 돌며 각 row의 cell에 데이터 추가
        for($i=3; $i<count($userinfo)+3; $i++) {            
            $excel->setActiveSheetIndex(0)
                        // ->setCellValue("A$i", $userinfo[i-3]['HUSTAR_NAME'])
                        ->setCellValue("A$i", $userinfo[$i-3]['HUSTAR_NAME'])
                        ->setCellValue("B$i", $userinfo[$i-3]['HUSTAR_ADDRESS'])
                        ->setCellValue("C$i", $userinfo[$i-3]['USER_NAME'])
                        ->setCellValue("D$i", $userinfo[$i-3]['USER_EMAIL'])
                        ->setCellValue("E$i", $userinfo[$i-3]['USER_PHONE'])
                        ->setCellValue("F$i", $userinfo[$i-3]['USER_BIRTH'])
                        ->setCellValue("G$i", $userinfo[$i-3]['USER_GENDER'])
                        ->setCellValue("H$i", $userinfo[$i-3]['SUB_CLASS_NAME'])
                        ->setCellValue("I$i", $userinfo[$i-3]['SUB_CLASS_CHARGER']);
        }

        // 워크시트 이름 붙이기
        $excel->getActiveSheet()->setTitle('Hustar 인원 정보');

        $excel->getActiveSheet()
                    ->getColumnDimension('A')
                    ->setWidth(15);
                    //->setAutoSize(true); // 셀 사이즈 자동조절

        $excel->getActiveSheet()
                    ->getColumnDimension('B')
                    ->setWidth(25);

        $excel->getActiveSheet()
                    ->getColumnDimension('C')
                    ->setWidth(15);
        $excel->getActiveSheet()
                    ->getColumnDimension('D')
                    ->setWidth(30);

        $excel->getActiveSheet()
                    ->getColumnDimension('E')
                    ->setWidth(15);

        $excel->getActiveSheet()
                    ->getColumnDimension('F')
                    ->setWidth(15);

        $excel->getActiveSheet()
                    ->getColumnDimension('G')
                    ->setWidth(15);

        $excel->getActiveSheet()
                    ->getColumnDimension('H')
                    ->setWidth(15);

        $excel->getActiveSheet()
                    ->getColumnDimension('I')
                    ->setWidth(15);



        
        
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
}
