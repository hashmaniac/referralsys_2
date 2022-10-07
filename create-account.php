<?php
//1. Create account

//INIT
require 'app/config.php';
require PATH_LIB . 'lib.php';
$libDB = new DB();

$pass = $libDb->exec(
    "INSERT INTO `referral` (`username`, `email`, `password`) VALUES (?, ?, ?)", [`johndoe`,`john@example.com`,`12345678`]
);

echo $pass ? "Ok" : $libDB->error;