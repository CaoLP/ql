<?php
$headers = array();
//start of printing column names as names of MySQL fields
$tbhead = array('Stt'=>'Stt','name'=>'Tên','code'=>'Mã thẻ','gender'=>'Giới tính','phone'=>'Điện thoại');
$excelCol = array('A','B','C','D');
$rows = array();
$rows[] = $tbhead;
$array_phones = array();
$abc = 1;
$pos = 0;
foreach($data as $key=>$customer){
    $rows[] = array(
        'Stt' => $key+1,
        'name' =>$customer['Customer']['name'],
        'code' =>$customer['Customer']['code'],
        'gender' =>$customer['Customer']['gender']== 0 ? 'Nam' : ($customer['Customer']['gender'] == 1 ? 'Nữ' : 'Không xác định'),
        'phone' =>$customer['Customer']['phone']
    );
    if($customer['Customer']['phone'] && strlen($customer['Customer']['phone']) >= 10){
        if($abc == $total) {
            $pos++;
            $abc = 1;
        }
        $array_phones[$pos][] = str_replace('.','',$customer['Customer']['phone']);
        $abc++;
    }
}

foreach($array_phones as $arr_phone){
    $rows[] = array('Stt'=>implode(',',$arr_phone),'name'=>'','code'=>'','gender'=>'','phone'=>'');
}

App::import('Vendor', 'PHPExcel/PHPExcel');

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("ThoiTrangDN")
    ->setLastModifiedBy("ThoiTrangDN")
    ->setTitle("Office 2007 XLSX Test Document")
    ->setSubject("Office 2007 XLSX Test Document")
    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
    ->setKeywords("office 2007 openxml php")
    ->setCategory("Test result file");

$objPHPExcel->getActiveSheet()->fromArray($rows, null, 'A1');

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Danh sách khách hàng');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="danh_sach_khach_hang.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;