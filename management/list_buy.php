<?php include './connect.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการซื้อสินค้าเข้า</title>
    <!-- Essentials Css Icons -->
    <?php include_once "../import/css.php"; ?>

    <?php include_once "../import/js.php"; ?>
</head>

<body>
    <!-- Navbar -->
    <?php include_once "../import/navbar.php" ?>
    <div class="container my-5">
        <div class="title">
            <h1>รายการสั่งซื้อสินค้าเข้าร้าน</h1>
        </div>
        <table class="table table-hover table-bordered text-center">
            <thead>
                <tr>
                    <th class="text-primary">รหัสใบเสร็จ</th>
                    <th class="text-primary">พนักงาน</th>
                    <th class="text-primary">วันที่ซื้อ</th>
                    <th class="text-primary">วันที่รับ</th>
                    <th class="text-primary">วันที่จ่าย</th>
                    <th class="text-primary">ราคาสุทธิ</th>
                    <th class="text-primary">รายละเอียด</th>
                    <th class="text-primary">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM buy INNER JOIN employee ON buy.Emp_id = employee.Emp_id";
                if ($result = $con->query($sql)) {
                    while ($row = mysqli_fetch_array($result)) {
                        $buy_id = $row['Buy_id'];
                ?>
                        <tr>
                            <td><?php echo $row['Buy_id'] ?></td>
                            <td><?php echo $row['Emp_name'] ?></td>
                            <td><?php echo formatDateThai($row['Buy_date']) ?></td>
                            <td><?php echo formatDateThai($row['Receive_date']) ?></td>
                            <td><?php echo formatDateThai($row['Paid_date']) ?></td>
                            <td><?php echo number_format($row['Net_price'], 2) ?></td>
                            <td class="text-start">
                                <ol>
                                    <?php
                                    $sql_detail = "SELECT * FROM buy_detail LEFT JOIN product ON product.Pro_id = buy_detail.pro_id WHERE Buy_id = '$buy_id' ";
                                    if ($result_detail = $con->query($sql_detail)) {
                                        while ($row_detail = mysqli_fetch_array($result_detail)) {
                                    ?>
                                            <li><?php echo $row_detail['Pro_name'] . ' x' . $row_detail['Amount'] ?></li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ol>
                            </td>
                            <td>
                                <?php
                                if ($row['Receive_date'] <> null) {
                                } else {
                                ?>
                                    <a href="receiveBuy.php?buy_id=<?php echo $buy_id ?>" class="btn btn-outline-primary">รับสินค้า</a>
                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>

    </div>

</body>

</html>