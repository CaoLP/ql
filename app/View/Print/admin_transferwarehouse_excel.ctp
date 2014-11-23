<?php
$headers = array();
//start of printing column names as names of MySQL fields
$tbhead = array('Stt','Tên sản phẩm','Thuộc tính','Mã','Giá','Số lượng');
foreach($tbhead as $th){
    $headers[] = $th;
}
$fp = fopen('php://output', 'w');
$rows = array();
foreach($data['InoutWarehouseDetail'] as $key=>$detail){
    $rows[] = array(
        $key+1,$detail['name'],$detail['option_names'],$detail['sku'],number_format($detail['price'], 0, '.', ','),$detail['qty']
    );
}
fputcsv($fp, $headers);
$row_tally = 0;
// Write mysql rows to csv
foreach($rows as $row){
    fputcsv($fp, $row);
}