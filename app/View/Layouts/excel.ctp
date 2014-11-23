<?php
//header info for browser
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename='.$data['InoutWarehouse']['code'].'.csv');
header('Pragma: no-cache');
header('Expires: 0');

//define separator (defines columns in excel & tabs in word)
$sep = '\t'; //tabbed character
echo $this->fetch('content');