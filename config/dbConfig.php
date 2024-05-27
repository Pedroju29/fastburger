<?php
$hn = 'localhost';
$un = 'fastburger_admin';
$pw = 'R8ee_2l1_Sj9i-eh';
$db = 'fast_burger';

$conn = mysqli_connect($hn, $un, $pw, $db);
if (!$conn){
    die('Connection Failed: ' . mysqli_connect_error());
}


else{
    echo('connection is successful');
}