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
    }
    else if (isset($_GET['shelf_search'])) {
        $searchText = $_GET['shelf_search'];

        // Query ข้อมูลจังหวัดที่ตรงตามคำค้นหา
        $sql = "SELECT * FROM Shelf WHERE Shelf_name LIKE '%$searchText%'";
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
