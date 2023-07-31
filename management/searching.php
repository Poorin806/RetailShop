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
    else if (isset($_GET['product_category_search'])) {
        $searchText = $_GET['product_category_search'];

        // Query ข้อมูลจังหวัดที่ตรงตามคำค้นหา
        $sql = "SELECT * FROM product_category WHERE Cate_name LIKE '%$searchText%'";
        $result = $con->query($sql);

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        // ส่งข้อมูลกลับในรูปแบบ JSON
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    else if (isset($_GET['employee_search'])) {
        $searchText = $_GET['employee_search'];

        // Query ข้อมูลจังหวัดที่ตรงตามคำค้นหา
        $sql = "SELECT * FROM employee WHERE Emp_id LIKE '%$searchText%'";
        $result = $con->query($sql);

        $data = [];

        if (mysqli_num_rows($result) != 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        else {
            $sql = "SELECT * FROM employee WHERE Emp_name LIKE '%$searchText%'";
            $result = $con->query($sql);
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        // ส่งข้อมูลกลับในรูปแบบ JSON
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    else if (isset($_GET['supplier_search'])) {
        $searchText = $_GET['supplier_search'];

        // Query ข้อมูลจังหวัดที่ตรงตามคำค้นหา
        $sql = "SELECT supplier.*, province.Province_name FROM supplier, province WHERE (supplier.Province_id = province.Province_id) AND (supplier.Sup_id LIKE '%$searchText%')";
        $result = $con->query($sql);

        $data = [];
        
        if (mysqli_num_rows($result) != 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        else {
            $sql = "SELECT supplier.*, province.Province_name FROM supplier, province WHERE (supplier.Province_id = province.Province_id) AND (supplier.Sup_name LIKE '%$searchText%')";
            $result = $con->query($sql);
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        // ส่งข้อมูลกลับในรูปแบบ JSON
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    else if (isset($_GET['product_search'])) {
        $searchText = $_GET['product_search'];

        // Query ข้อมูลจังหวัดที่ตรงตามคำค้นหา
        $sql = "SELECT 
                    product.*, product_category.Cate_name, shelf.Shelf_name, supplier.Sup_name
                FROM
                    product, product_category, shelf, supplier
                WHERE
                    (product.Cate_id = product_category.Cate_id) AND
                    (product.Shelf_no = shelf.Shelf_no) AND
                    (product.Sup_id = supplier.Sup_id) AND
                    (product.Pro_id LIKE '%$searchText%')
                ORDER BY product.Pro_id
        ";
        $result = $con->query($sql);

        $data = [];
        
        if (mysqli_num_rows($result) != 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        else {
            $sql = "SELECT 
                    product.*, product_category.Cate_name, shelf.Shelf_name, supplier.Sup_name
                FROM
                    product, product_category, shelf, supplier
                WHERE
                    (product.Cate_id = product_category.Cate_id) AND
                    (product.Shelf_no = shelf.Shelf_no) AND
                    (product.Sup_id = supplier.Sup_id) AND
                    (product.Pro_name LIKE '%$searchText%')
                ORDER BY product.Pro_id
            ";
            $result = $con->query($sql);
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        // ส่งข้อมูลกลับในรูปแบบ JSON
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    else if (isset($_GET['customer_search'])) {
        $searchText = $_GET['customer_search'];

        // Query ข้อมูลจังหวัดที่ตรงตามคำค้นหา
        $sql = "SELECT 
                        Customer.*, Province.Province_name 
                    FROM 
                        Customer, Province 
                    WHERE 
                        Customer.Province_id = Province.Province_id AND
                        (Customer.Cust_id LIKE '%$searchText%')
                ORDER BY Customer.Cust_id
        ";
        $result = $con->query($sql);

        $data = [];
        
        if (mysqli_num_rows($result) != 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        else {
            $sql = "SELECT 
                        Customer.*, Province.Province_name 
                    FROM 
                        Customer, Province 
                    WHERE 
                        Customer.Province_id = Province.Province_id AND
                        (Customer.Cust_name LIKE '%$searchText%')
                ORDER BY Customer.Cust_id
            ";
            $result = $con->query($sql);
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        // ส่งข้อมูลกลับในรูปแบบ JSON
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    else {
        echo "<script>window.location='../index.php'</script>";
    }
?>
