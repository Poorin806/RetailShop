<?php

    // Connection
    include_once('import/connect.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="/RetailShop/dashboard.css">
  <title>Retailshop Dashboard</title>
  <!-- Essentials Css Icons -->
  <?php include_once "import/css.php"; ?>
  
</head>
<body>
  <!-- Navbar -->
  <?php include_once "import/navbar.php" ?>

  <!-- Sidebar -->
  <div class="sidebar">
        <ul class="side-menu">
            <li class="active"><a href="#" class="text-decoration-none"><i class='bx bxs-dashboard'></i>ผลรวมทั้งหมด</a></li>
            <li><a href="/RetailShop/management/product.php" class="text-decoration-none"><i class='bx bx-store-alt'></i>ข้อมูลสินค้า</a></li>
            <li><a href="/RetailShop/management/employee.php" class="text-decoration-none"><i class='bx bx-group'></i>ข้อมูลพนักงาน</a></li>
            <li><a href="/RetailShop/management/supplier.php" class="text-decoration-none"><i class='bx bx-home-alt'></i>ข้อมูลตัวแทนจำหน่าย</a></li>
            <li><a href="/RetailShop/management/customer.php" class="text-decoration-none"><i class='bx bx-analyse'></i>ข้อมูลลูกค้า</a></li>
            <li><a href="/RetailShop/management/product_category.php" class="text-decoration-none"><i class='bx bx-category-alt' ></i>ข้อมูลประเภทสินค้า</a></li>
            <li><a href="/RetailShop/management/shelf.php" class="text-decoration-none"><i class='bx bx-spreadsheet'></i>ข้อมูลชั้นวางสินค้า</a></li>
            <li><a href="/RetailShop/management/province.php" class="text-decoration-none"><i class='bx bxl-product-hunt' ></i>ข้อมูลจังหวัด</a></li>
        </ul>
    </div>
    <!-- End of Sidebar -->

    <!-- Main Content -->
    <div class="content">
        <main>
            <div class="header mt-5">
                <div class="left">
                    <h1>ผลรวมทั้งหมด</h1>
                </div>
            </div>

            <!-- Insights -->
            <ul class="insights">
                <a class="text-decoration-none" href="/RetailShop/management/employee.php">
                    <li><i class='bx bxs-user'></i>
                        <span class="info">
                            <h3>
                                <?php 
                                    $query = "SELECT * FROM employee";
                                    $result = mysqli_query($con, $query);
                                    $num_rows = mysqli_num_rows($result);
                                    echo $num_rows;
                                ?>
                            </h3>
                            <p>พนักงานทั้งหมด</p>
                        </span>
                    </li>
                </a>
                <a class="text-decoration-none" href="/RetailShop/management/product.php">
                    <li><i class='bx bx-calendar-check'></i>
                        <span class="info">
                            <h3>
                                <?php 
                                    $query = "SELECT * FROM product";
                                    $result = mysqli_query($con, $query);
                                    $num_rows = mysqli_num_rows($result);
                                    echo $num_rows;
                                ?>
                            </h3>
                            <p>รายการสินค้าทั้งหมด</p>
                        </span>
                    </li>
                </a>
                <a class="text-decoration-none" href="/RetailShop/management/supplier.php">
                    <li><i class='bx bx-home-alt'></i>
                        <span class="info">
                            <h3>
                                <?php 
                                    $query = "SELECT * FROM product_return";
                                    $result = mysqli_query($con, $query);
                                    $num_rows = mysqli_num_rows($result);
                                    echo $num_rows;
                                ?>
                            </h3>
                            <p>ยอดคืนสินค้าทั้งหมด</p>
                        </span>
                    </li>
                </a>
                <a class="text-decoration-none">
                    <li><i class='bx bx-dollar-circle'></i>
                        <span class="info">
                            <h3>
                            <?php
                                $query = "SELECT SUM(Net_price) - SUM(Net_discount) AS Total FROM sale";
                                $result = mysqli_query($con, $query);
                                $row = mysqli_fetch_assoc($result);
                                $total = $row['Total'];
                                echo number_format($total, 2);
                            ?>
                            </h3>
                            <p>รายได้เข้าร้านทั้งหมด</p>
                        </span>
                    </li>
                </a>
            </ul>
            <!-- End of Insights -->

            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>รายการซื้อสินค้าเข้าร้าน</h3>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th style="font-size: 17px;">พนักงาน</th>
                                <th style="font-size: 17px;">วันที่รับสินค้า</th>
                                <th style="font-size: 17px;">ราคาสุทธิ</th>
                                <th style="font-size: 17px;">สถานะการสั่งซื้อ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT Buy.*, Employee.Emp_name FROM Buy INNER JOIN Employee ON Buy.Emp_id = Employee.Emp_id ORDER BY Receive_date DESC Limit 8";
                                $result = $con->query($sql);
                                while ($data = mysqli_fetch_array($result)) {
                                    ?>
                                    <tr>
                                        <th><?php echo $data['Emp_name'] ?></th>
                                        <td><?php echo formatDateThai($data['Receive_date'])?></td>
                                        <td ><?php echo number_format($data['Net_price'], 2)?> บาท</td>
                                        <td>
                                            <span class="
                                                <?php
                                                        if ($data['Buy_status'] == 1){
                                                            echo 'status cancle';   
                                                        }
                                                        elseif($data['Buy_status'] == 2){
                                                            echo 'status notComplete';
                                                        }
                                                        else{
                                                            echo 'status completed';
                                                        }
                                                    ?>" style="font-size: 14px;">
                                                    <?php
                                                        if ($data['Buy_status'] == 1){
                                                            echo 'ยกเลิกสินค้า';
                                                        }
                                                        elseif($data['Buy_status'] == 2){
                                                            echo 'สินค้าไม่ครบ';
                                                        }
                                                        else{
                                                            echo 'รับสินค้าครบ';
                                                        }
                                                    ?>
                                                </span>
                                        </td>
                                    </tr>
                                <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Reminders -->
                <div class="reminders">
                    <div class="header">
                        <i class='bx bx-note'></i>
                        <h3>ใบเสร็จคืนสินค้า</h3>
                    </div>
                    <ul class="task-list">
                                <?php
                                    $sql = "SELECT Product_Return.*, Product.Pro_name FROM Product_Return INNER JOIN Product ON Product_Return.pro_id = Product.Pro_id Limit 6";
                                    $result = $con->query($sql);
                                    while ($data = mysqli_fetch_array($result)) {
                                    ?>
                                        <li class="completed">
                                            <div class="task-title">
                                                <p class="m-0 p-0" style="font-size: 18px;">
                                                    ใบเสร็จ <?php echo $data['Sale_id']?>: คืน <!--รหัสใบเสร็จที่ที่คืนสินค้า -->
                                                    <?php echo $data['Pro_name']?> จำนวน <?php echo $data['Amount']?> กระบอก
                                                </p>
                                            
                                            </div>
                                            <i class='bx bx-dots-vertical-rounded'></i>
                                        </li>
                                    <?php   
                                    }
                                ?>
                    </ul>
                </div>
                <!-- End of Reminders-->

            </div>

        </main>

    </div>

    <script src="index.js"></script>
  <?php include_once "import/js.php"; ?>
</body>
</html>