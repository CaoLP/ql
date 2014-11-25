<?php
$headers = array();
//start of printing column names as names of MySQL fields
$tbhead = array('Stt','Ten','Thuoctinh','ma','gia','soluong');
$excelCol = array('A','B','C','D','E','F','G');
$rows = array();
$rows[] = $tbhead;
foreach($data['InoutWarehouseDetail'] as $key=>$detail){
    $rows[] = array(
        'Stt' => $key+1,
        'Ten' =>$detail['name'],
        'Thuoctinh' =>$detail['option_names'],
        'ma' =>$detail['sku'],
        'gia' =>number_format($detail['price'], 0, '.', ','),
        'soluong' =>$detail['qty']
    );
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


$objPHPExcel->getActiveSheet()->setCellValue('A1', "Stt")
    ->setCellValue('B1', "Ten")
    ->setCellValue('C1', "Thuoctinh")
    ->setCellValue('D1', "ma")
    ->setCellValue('E1', "gia")
    ->setCellValue('F1', "soluong");

foreach($rows as $key=>$row){
    $i=0;
    foreach($row as $keysub=>$subrow){
        $objPHPExcel->getActiveSheet()->setCellValue($excelCol[$i] . ($key+1), $subrow);
        $i++;
    }
}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle($data['InoutWarehouse']['code']);


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$data['InoutWarehouse']['code'].'.xlsx"');
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