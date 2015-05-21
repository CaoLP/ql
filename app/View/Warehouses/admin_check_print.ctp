<?php
$headers = array();
//start of printing column names as names of MySQL fields
$tbhead = array('Stt','Note','Mã hàng','Tên hàng','Giá bán lẻ','Giá bán sỉ','Cửa hàng','Số lượng','Số lượng thực');
$excelCol = array('A','B','C','D','E','F','G','H','I');
$rows = array();
$rows[] = $tbhead;
$store_name = 'Kho';
$date = date('d-m-Y',$date_filter);
foreach($warehouse_check_detail as $key=>$warehouse){
    $class = '';
    $message = '';
    if ($warehouse['WarehouseCheckDetail']['warehouse_id'] == 0) {
        $class = 'td-error';
        $message = 'Kho không có';
    } else {
        if ($warehouse['WarehouseCheckDetail']['qty'] < $warehouse['WarehouseCheckDetail']['real_qty']) {
            $class = 'td-warning';
            $message = 'Dư hàng';
        }
        if ($warehouse['WarehouseCheckDetail']['real_qty'] < $warehouse['WarehouseCheckDetail']['qty']) {
            $class = 'td-warning-1';
            $message = 'Thiếu hàng';
            if($warehouse['WarehouseCheckDetail']['real_qty'] == 0){
                $class = 'td-warning-2';
                $message = 'Sai số liệu';
            }
        }

    }

    $rows[] = array(
        'Stt' => $key+1,
        'message'=> $message,
        'code'=> $warehouse['WarehouseCheckDetail']['code'],
        'product'=> $warehouse['Product']['name'],
        'price'=> number_format( $warehouse['WarehouseCheckDetail']['price'], 0, '.', ','),
        'retail_price'=> number_format($warehouse['WarehouseCheckDetail']['retail_price'], 0, '.', ','),
        'store'=> $warehouse['Store']['name'],
        'qty'=> $warehouse['WarehouseCheckDetail']['qty'],
        'real_qty'=> $warehouse['WarehouseCheckDetail']['real_qty'],
    );
    $store_name = $warehouse['Store']['name'];
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
    ->setCellValue('B1', "message")
    ->setCellValue('C1', "code")
    ->setCellValue('D1', "product")
    ->setCellValue('E1', "price")
    ->setCellValue('F1', "retail_price")
    ->setCellValue('G1', "store")
    ->setCellValue('H1', "qty")
    ->setCellValue('I1', "real_qty");

foreach($rows as $key=>$row){
    $i=0;
    foreach($row as $keysub=>$subrow){
        $objPHPExcel->getActiveSheet()->setCellValue($excelCol[$i] . ($key+1), $subrow);
        $i++;
    }
}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Kiểm hàng '. $date );


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Kiểm hàng kho '.$store_name . ' ngày '. $date .'.xlsx"');
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