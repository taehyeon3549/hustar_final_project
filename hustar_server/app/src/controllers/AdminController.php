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
    
    public function printUserList(Request $request, Response $response, $args)
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
                        ->setCellValue("N$i", $userinfo[$i-8]['USER_GENDER'])
                        ->setCellValue("O$i", $userinfo[$i-8]['SUB_CLASS_NAME'])
                        ->setCellValue("P$i", $userinfo[$i-8]['SUB_CLASS_CHARGER']);
        }

        // 워크시트 이름 붙이기
        $excel->getActiveSheet()->setTitle('Hustar 인원 정보');

        $excel->getActiveSheet()
                    ->getColumnDimension('C')
                    ->setWidth(5)
                    ->getColumnDimension('D')
                    ->setWidth(20)
                    ->getColumnDimension('E')
                    ->setWidth(25)
                    ->getColumnDimension('F')
                    ->setWidth(10)
                    ->getColumnDimension('G')
                    ->setWidth(25)
                    ->getColumnDimension('H')
                    ->setWidth(25)
                    ->getColumnDimension('I')
                    ->setWidth(25)
                    ->getColumnDimension('J')
                    ->setWidth(25)
                    ->getColumnDimension('K')
                    ->setWidth(25)
                    ->getColumnDimension('L')
                    ->setWidth(25)
                    ->getColumnDimension('M')
                    ->setWidth(25)
                    ->getColumnDimension('N')
                    ->setWidth(25)
                    ->getColumnDimension('O')
                    ->setWidth(25)
                    ->getColumnDimension('P')
                    ->setWidth(25);

        // $excel->getActiveSheet()
        //             ->getColumnDimension('B')
        //             ->setWidth(25);

        // $excel->getActiveSheet()
        //             ->getColumnDimension('C')
        //             ->setWidth(15);
        // $excel->getActiveSheet()
        //             ->getColumnDimension('D')
        //             ->setWidth(30);

        // $excel->getActiveSheet()
        //             ->getColumnDimension('E')
        //             ->setWidth(15);

        // $excel->getActiveSheet()
        //             ->getColumnDimension('F')
        //             ->setWidth(15);

        // $excel->getActiveSheet()
        //             ->getColumnDimension('G')
        //             ->setWidth(15);

        // $excel->getActiveSheet()
        //             ->getColumnDimension('H')
        //             ->setWidth(15);

        // $excel->getActiveSheet()
        //             ->getColumnDimension('I')
        //             ->setWidth(15);



        
        
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

    public function temp(Request $request, Response $response, $args)
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
                        ->setCellValue("N$i", $userinfo[$i-9]['USER_GENDER'])
                        ->setCellValue("O$i", $userinfo[$i-9]['SUB_CLASS_NAME'])
                        ->setCellValue("P$i", $userinfo[$i-9]['SUB_CLASS_CHARGER']);
        }


        // //$helper->log('Add new data to the template');
        // $data = [['title' => 'Excel for dummies',
        //         'price' => 17.99,
        //         'quantity' => 2,
        //     ],
        //     ['title' => 'PHP for dummies',
        //         'price' => 15.99,
        //         'quantity' => 1,
        //     ],
        //     ['title' => 'Inside OOP',
        //         'price' => 12.95,
        //         'quantity' => 1,
        //     ],
        // ];

        // $spreadsheet->getActiveSheet()->setCellValue('D1', date("m-d"));

        // $baseRow = 5;
        // foreach ($data as $r => $dataRow) {
        //     $row = $baseRow + $r;
        //     $spreadsheet->getActiveSheet()->insertNewRowBefore($row, 1);

        //     $spreadsheet->getActiveSheet()->setCellValue('A' . $row, $r + 1)
        //         ->setCellValue('B' . $row, $dataRow['title'])
        //         ->setCellValue('C' . $row, $dataRow['price'])
        //         ->setCellValue('D' . $row, $dataRow['quantity'])
        //         ->setCellValue('E' . $row, '=C' . $row . '*D' . $row);
        // }
        // $spreadsheet->getActiveSheet()->removeRow($baseRow - 1, 1);

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
}
