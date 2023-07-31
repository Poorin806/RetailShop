<?php

    // Connection
    include_once('../import/connect.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retail Shop - Management</title>
    <!-- Essentials Css Icons -->
    <?php include_once "../import/css.php"; ?>

</head>

<body>
    <!-- Navbar -->
    <?php include_once "../import/navbar.php" ?>

    <?php
        // If Add New
        if (isset($_POST['submit'])) {
            $ID = $_POST['Pro_id'];
            $Name = $_POST['Pro_name'];
            $Cost = $_POST['Pro_cost'];
            $SalePrice = $_POST['Pro_salePrice'];
            $MemberPrice = $_POST['Pro_memberPrice'];
            $Amount = $_POST['Pro_amount'];
            $Cate = $_POST['Cate_id'];
            $Shelf = $_POST['Shelf_no'];
            $Sup = $_POST['Sup_id'];
            $PointOfSale = $_POST['Point_ofSale'];
        
            $sql = "INSERT INTO product VALUES ('$ID', '$Name', $Cost, $SalePrice, $MemberPrice, $Amount, $Cate, '$Shelf', '$Sup', $PointOfSale, 1)";
            $con->query($sql);

            echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'เพิ่มข้อมูลสำเร็จ',
                            confirmButtonText: 'ตกลง'
                        }).then((result) => {
                            window.location='product.php'
                        });
                    </script>";
        }        
    ?>
    <div class="container my-5">
        <div class="title mb-3">
            <div class="text">
                <h1>เพิ่มข้อมูล<h class="text-primary">สินค้า</h></h1>
                <h6>Add New Product Data</h6>
            </div>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <?php
                $sql = "SELECT * FROM product ORDER BY Pro_id DESC LIMIT 1";
                $result = $con->query($sql);
                $NewID = mysqli_fetch_array($result);
                $NewID = "PRO" . preg_replace('/\D/', '', $NewID['Sup_id']) + 1;
            ?>
            <div class="row">
                <div class="col-sm-6 mb-3">
                    <label for="" class="form-label">รหัสสินค้า</label>
                    <input type="text" name="Pro_id" class="form-control bg-body-secondary" value="<?php echo $NewID ?>" readonly>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="" class="form-label">ชื่อสินค้า</label>
                    <input type="text" name="Pro_name" class="form-control" placeholder="ชื่อสินค้า" required>
                </div>

                <div class="col-sm-3 mb-3">
                    <label for="" class="form-label">ราคา (ต้นทุน)</label>
                    <input type="number" name="Pro_cost" class="form-control" placeholder="ราคาต้นทุน" required>
                </div>
                <div class="col-sm-3 mb-3">
                    <label for="" class="form-label">ราคาขาย</label>
                    <input type="number" name="Pro_salePrice" class="form-control" placeholder="ราคาขาย" required>
                </div>
                <div class="col-sm-3 mb-3">
                    <label for="" class="form-label">ราคาขาย (สมาชิก)</label>
                    <input type="number" name="Pro_memberPrice" class="form-control" placeholder="ราคาขาย (สมาชิก)" required>
                </div>
                <div class="col-sm-3 mb-3">
                    <label for="" class="form-label">จำนวน</label>
                    <input type="number" name="Pro_amount" class="form-control" placeholder="จำนวนสินค้า" required>
                </div>

                <div class="col-sm-3 mb-3">
                    <label for="" class="form-label">ประเภทสินค้า</label>
                    <select name="Cate_id" class="form-select" required>
                        <option value="">เลือกประเภทสินค้า...</option>
                        <?php
                            $sql = "SELECT * FROM product_category";
                            $result = $con->query($sql);
                            while ($temp_data = mysqli_fetch_array($result)) {
                                ?>
                                <option value="<?php echo $temp_data['Cate_id']; ?>"><?php echo $temp_data['Cate_id']; ?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-sm-3 mb-3">
                    <label for="" class="form-label">ชั้นวางสินค้า</label>
                    <select name="Shelf_no" class="form-select" required>
                        <option value="">เลือกชั้นวางสินค้า...</option>
                        <?php
                            $sql = "SELECT * FROM shelf";
                            $result = $con->query($sql);
                            while ($temp_data = mysqli_fetch_array($result)) {
                                ?>
                                <option value="<?php echo $temp_data['Shelf_no']; ?>"><?php echo $temp_data['Shelf_name']; ?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-sm-3 mb-3">
                    <label for="" class="form-label">ตัวแทนจำหน่าย</label>
                    <select name="Sup_id" class="form-select" required>
                        <option value="">เลือกตัวแทนจำหน่าย...</option>
                        <?php
                            $sql = "SELECT * FROM supplier";
                            $result = $con->query($sql);
                            while ($temp_data = mysqli_fetch_array($result)) {
                                ?>
                                <option value="<?php echo $temp_data['Sup_id']; ?>"><?php echo $temp_data['Sup_name']; ?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-sm-3 mb-3">
                    <label for="" class="form-label">จุดที่ขาย</label>
                    <select name="Point_ofSale" class="form-select" required>
                        <option value="">เลือกจุดที่ขาย...</option>
                        <?php
                            for ($i = 1; $i <= 10; $i++) {
                                ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
            </div>
            <input type="submit" value="บันทึก" class="btn btn-primary" name="submit">
            <a href="product.php" class="btn btn-secondary">ยกเลิก</a>
        </form>
    </div>

    <?php include_once "../import/js.php"; ?>
</body>

</html>