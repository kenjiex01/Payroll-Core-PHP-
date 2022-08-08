<?php 
date_default_timezone_set('Asia/Manila');
$dateToTest = "2021-03-02";
$lastday = date('t',strtotime($dateToTest));
echo $lastday;
?>