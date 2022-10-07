<?php
// 4. Referral sales

//INIT
require "app/config.php";
require PATH_LIB . "lib.php";
$libDB = new DB();
session_start();

// Capturing Referral sales detail after checkout
$oID = 890;
$rID = $_SESSION['ref'];
$order_date = date("Y-m-d H:i:s");
$saleAmount = 999;
$commission = (10*$saleAmount)/100;
$sale = $libDB->exec(
    "INSERT INTO `referral_sales` (`referral_id`, `order_id`, `amount`, `commission`, `order_date`) VALUES (?,?,?,?,?)", [$rID, $oID, $saleAmount, $commission, $order_date]
);

echo $sale ? "Ok" : $libDB->error;

// Unset session
unset($_SESSION['ref']);