<?php
//3. use link

//INIT
require "app/config.php";
require PATH_LIB . "lib.php";
$libDB = new DB();
session_start();

//Redirect link
$redirect = "https://localhost/use-link.php"

// Verify referral link
if($_GET['ref']) {
    $referral = $libDb->fetch(
        "SELECT * FROM `referral` WHERE `username`=?", [$_GET['ref']]
    );
    if(is_array($referral)) {
        $_SESSION['ref'] = $referral['referral_id'];
    }

    //Redirect to another page to avoid user messing with link
    header("Location: " . $redirect);
    die();
}