<?php
// 5. Report

//INIT
require "app/config.php";
require PATH_LIB . "lib.php";
$libDB = new DB();

$rID = 2;
$start = date("Y-m-01 00:00:00");
$end = date("Y-m-t 23:59:59");
$report = $libDB->fetchAll(
    "SELECT * FROM `referral_sales` WHERE `referral_id`=? AND `order_date` BETWEEN ? AND ?", [$rID, $start, $end], "order_id"
);

print_r($report);