<?php

    // Connection
    include_once('../import/connect.php');

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
  <?php include_once "../import/css.php"; ?>
  
</head>
<body>
  <!-- Navbar -->
  <?php include_once "../import/navbar.php" ?>

  <!-- Sidebar -->
  <div class="sidebar">
        <ul class="side-menu">
            <li class="active"><a href="#" class="text-decoration-none"><i class='bx bxs-dashboard'></i>ผลรวมทั้งหมด</a></li>
            <li><a href="#" class="text-decoration-none"><i class='bx bx-store-alt'></i>ผลรวม</a></li>
            <li><a href="#" class="text-decoration-none"><i class='bx bx-analyse'></i>ผลรวม  </a></li>
            <li><a href="#" class="text-decoration-none"><i class='bx bx-message-square-dots'></i>ผลรวม</a></li>
            <li><a href="#" class="text-decoration-none"><i class='bx bx-group'></i>ผลรวม</a></li>
            <li><a href="#" class="text-decoration-none"><i class='bx bx-cog'></i>ผลรวม</a></li>
        </ul>
    </div>
    <!-- End of Sidebar -->

    <!-- Main Content -->
    <div class="content">
        <main>
            <div class="header">
                <div class="left">
                    <h1>ผลรวมทั้งหมด</h1>
                </div>
            </div>

            <!-- Insights -->
            <ul class="insights">
                <li>
                    <i class='bx bx-calendar-check'></i>
                    <span class="info">
                        <h3>
                            0000
                        </h3>
                        <p>สินค้าทั้งหมด</p>
                    </span>
                </li>
                <li><i class='bx bx-cart-add' ></i>
                    <span class="info">
                        <h3>
                          0000
                        </h3>
                        <p>ยอดการขาย</p>
                    </span>
                </li>
                <li><i class='bx bx-line-chart'></i>
                    <span class="info">
                        <h3>
                          0000
                        </h3>
                        <p>ยอดการสั่งซื้อ</p>
                    </span>
                </li>
                <li><i class='bx bx-dollar-circle'></i>
                    <span class="info">
                        <h3>
                          0000
                        </h3>
                        <p>รายได้เข้าร้านทั้งหมด</p>
                    </span>
                </li>
            </ul>
            <!-- End of Insights -->

            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>รายการสั่งซื้อล่าสุด</h3>
                        <i class='bx bx-filter'></i>
                        <i class='bx bx-search'></i>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th style="font-size: 16px;">พนักงาน</th>
                                <th style="font-size: 16px;">วันที่รับสินค้า</th>
                                <th style="font-size: 16px;">สถานะการสั่งซื้อ</th>
                                <th style="font-size: 16px;">เพิ่มเติม</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <p>ณัฏฐากร</p>
                                </td>
                                <td>14-08-2023</td>
                                <td ><span class="status completed" style="font-size: 14px;">รับสินค้าแล้ว</span></td>
                                <td>
                                  <button type="button" class="btn btn-primary">รายละเอียด</button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>พัลลภ</p>
                                </td>
                                <td>14-08-2023</td>
                                <td><span class="status notComplete" style="font-size: 14px;">สินค้าไม่ครบ</span></td>
                                <td>
                                  <button type="button" class="btn btn-primary">รายละเอียด</button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>ภูรินทร์</p>
                                </td>
                                <td>14-08-2023</td>
                                <td><span class="status cancle" style="font-size: 14px;">ยกเลิกการซื้อ</span></td>
                                <td>
                                  <button type="button" class="btn btn-primary">รายละเอียด</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Reminders -->
                <div class="reminders">
                    <div class="header">
                        <i class='bx bx-note'></i>
                        <h3>คืนสินค้า</h3>
                        <i class='bx bx-filter'></i>
                        <i class='bx bx-plus'></i>
                    </div>
                    <ul class="task-list">
                        <li class="completed">
                            <div class="task-title">
                                <i class='bx bx-check-circle'></i>
                                <p style="font-size: 18px;">ใบเสร็จที่ 1: AK-47 จำนวน 2 กระบอก</p>
                            </div>
                            <i class='bx bx-dots-vertical-rounded'></i>
                        </li>
                        <li class="completed">
                            <div class="task-title">
                                <i class='bx bx-check-circle'></i>
                                <p style="font-size: 18px;">ใบเสร็จที่ 1: AK-47 จำนวน 2 กระบอก</p>
                            </div>
                            <i class='bx bx-dots-vertical-rounded'></i>
                        </li>
                        <li class="completed">
                            <div class="task-title">
                                <i class='bx bx-check-circle'></i>
                                <p style="font-size: 18px;">ใบเสร็จที่ 1: AK-47 จำนวน 2 กระบอก</p>
                            </div>
                            <i class='bx bx-dots-vertical-rounded'></i>
                        </li>
                    </ul>
                </div>

                <!-- End of Reminders-->

            </div>

        </main>

    </div>

    <script src="index.js"></script>
  <?php include_once "../import/js.php"; ?>
</body>
</html>