<?php

    $Username = "root";
    $Password = "";
    $db = "tatcshop";

    //MySQL Connection
    $con = mysqli_connect("localhost", $Username, $Password, $db);
    mysqli_set_charset($con, 'UTF8');
    date_default_timezone_set('Asia/Bangkok');

    //Database Connection Check
    if (mysqli_connect_errno()) {   //If Failed to connect
        echo "Failed to connect Database" . mysqli_connect_errno();
    }

    //Time zone Settings
    date_default_timezone_set('Asia/Bangkok');

    session_start();

    function formatDateThai($date) {
        // แปลงวันที่สากลเป็น timestamp
        $timestamp = strtotime($date);

        // สร้างรูปแบบวันที่ใหม่สำหรับแสดงผล (ใช้ d, M, Y และแทนที่เดือนแบบอังกฤษเป็นไทย)
        $formatThai = 'd M Y'; // รูปแบบวันที่แบบไทย (เช่น "25 ก.ค. 2566")

        // ใช้ฟังก์ชัน date() เพื่อแปลง timestamp เป็นวันที่แบบไทย
        $formattedDate = date($formatThai, $timestamp);

        // แปลงปีให้เป็น พ.ศ.
        $yearThai = date('Y', $timestamp) + 543;
        $formattedDate = str_replace(date('Y', $timestamp), $yearThai, $formattedDate);

        // แทนที่ชื่อเดือนแบบอังกฤษเป็นชื่อเดือนแบบไทย
        $formattedDate = str_replace(
            array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'),
            array('ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'),
            $formattedDate
        );

        return $formattedDate;
    }

    function formatDateTimeThai($date) {
        // แปลงวันที่สากลเป็น timestamp
        $timestamp = strtotime($date);

        // สร้างรูปแบบวันที่ใหม่สำหรับแสดงผล (ใช้ d, M, Y และแทนที่เดือนแบบอังกฤษเป็นไทย)
        $formatThai = 'd M Y (HⓂ️s น.)'; // รูปแบบวันที่แบบไทย (เช่น "25 ก.ค. 2566")

        // ใช้ฟังก์ชัน date() เพื่อแปลง timestamp เป็นวันที่แบบไทย
        $formattedDate = date($formatThai, $timestamp);

        // แปลงปีให้เป็น พ.ศ.
        $yearThai = date('Y', $timestamp) + 543;
        $formattedDate = str_replace(date('Y', $timestamp), $yearThai, $formattedDate);

        // แทนที่ชื่อเดือนแบบอังกฤษเป็นชื่อเดือนแบบไทย
        $formattedDate = str_replace(
            array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'),
            array('ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'),
            $formattedDate
        );

        return $formattedDate;
    }

?>