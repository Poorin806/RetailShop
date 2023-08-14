<?php
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $dbname = 'tatcshop';

    $con = mysqli_connect($host, $user, $pass, $dbname) or die ('Connection Error');
    mysqli_set_charset($con, 'UTF8');
    date_default_timezone_set('Asia/Bangkok');
    session_start();
?>