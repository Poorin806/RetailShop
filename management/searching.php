<?php
    // Connection
    include_once('../import/connect.php');

    if (isset($_GET['province_search'])) {
        $searchText = $_GET['province_search'];

        // Query ข้อมูลจังหวัดที่ตรงตามคำค้นหา
        $sql = "SELECT * FROM Province WHERE Province_name LIKE '%$searchText%'";
        $result = $con->query($sql);

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        // ส่งข้อมูลกลับในรูปแบบ JSON
        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        // ถ้าไม่มีคำค้นหาส่งกลับข้อมูลทั้งหมด
        $sql = "SELECT * FROM Province";
        $result = $con->query($sql);

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        // ส่งข้อมูลกลับในรูปแบบ JSON
        header('Content-Type: application/json');
        echo json_encode($data);
    }
?>
