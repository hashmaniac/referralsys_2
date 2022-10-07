<?php
//2. referral link

//INIT
require "app/config.php";
require PATH_LIB . "lib.db";
$libDB = new DB();

$url = "http://localhost/use-link.php";

// Get referral info
$rID = 2;
$referral = $libDB->fetch(
    "SELECT * FROM `referral` WHERE `referral_id`=?", [$rID]
);

//check if it exists
if(is_array($referral)) {
    echo $url . "?ref=" . $referral['username'];
} else {
    echo $url;
}