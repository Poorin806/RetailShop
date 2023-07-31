<?php

    // Connection
    include_once('../import/connect.php');

    //If come to this page without ID parameter
    if (!isset($_GET['ID'])) {
        echo "<script>window.location='product.php'</script>";
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการข้อมูลสินค้า</title>
    <!-- Essentials Css Icons -->
    <?php include_once "../import/css.php"; ?>

</head>

<body>
    <!-- Navbar -->
    <?php include_once "../import/navbar.php" ?>

    <?php
        // If edited
        if (isset($_POST['submit'])) {
            $ID = $_POST['Pro_id'];
            $Name = $_POST['Pro_name'];
            $Cost = $_POST['Pro_cost'];
            $SalePrice = $_POST['Pro_salePrice'];
            $MemberPrice = $_POST['Pro_memberPrice'];
            $Amount = $_POST['Pro_amount'];
            $Cate = $_POST['Cate_id'];
            $Shelf = $_POST['Shelf_id'];
            $Sup = $_POST['Sup_id'];
            $PointOfSale = $_POST['Point_ofSale'];

            $sql = "UPDATE product 
                    SET Pro_name = '$Name', Pro_cost = '$Cost', Pro_salePrice = '$SalePrice', 
                        Pro_memberPrice = '$MemberPrice', Pro_amount = '$Amount', Cate_id = '$Cate', 
                        Shelf_no = '$Shelf', Sup_id = '$Sup', Point_ofSale = '$PointOfSale'
                    WHERE Pro_id = '$ID'
            ";
            $con->query($sql);

            echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'แก้ไขข้อมูลสำเร็จ',
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
                <h1>แก้ไขข้อมูล<h class="text-primary">สินค้า</h></h1>
                <h6>Edit Product Data</h6>
            </div>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF'] . "?ID=" . $_GET['ID'] ?>" method="post">
            <?php
                $sql = "SELECT 
                            product.*, product_category.Cate_name, shelf.Shelf_name, supplier.Sup_name
                        FROM
                            product, product_category, shelf, supplier
                        WHERE
                            (product.Cate_id = product_category.Cate_id) AND
                            (product.Shelf_no = shelf.Shelf_no) AND
                            (product.Sup_id = supplier.Sup_id) AND
                            (product.Pro_id = '" . $_GET['ID'] . "')
                ";
                $result = $con->query($sql);
                $data = mysqli_fetch_array($result);
            ?>
            <div class="row">
                <div class="col-sm-2 mb-3">
                    <label for="" class="form-label">รหัสสินค้า</label>
                    <input type="text" name="Pro_id" class="form-control bg-body-secondary" value="<?php echo $data['Pro_id'] ?>" readonly>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="" class="form-label">ชื่อสินค้า</label>
                    <input type="text" name="Pro_name" class="form-control" placeholder="ชื่อสินค้า" value="<?php echo $data['Pro_name'] ?>" required>
                </div>
                <div class="col-sm-4">
                    
                </div>
                <div class="col-sm-3">
                    <label for="" class="form-label">ราคา (ต้นทุน)</label>
                    <input type="number" name="Pro_cost" class="form-control" placeholder="ราคาต้นทุน" value="<?php echo $data['Pro_cost'] ?>" required>
                </div>
                <div class="col-sm-3">
                    <label for="" class="form-label">ราคา (ขาย)</label>
                    <input type="number" name="Pro_salePrice" class="form-control" placeholder="ราคาขาย" value="<?php echo $data['Pro_salePrice'] ?>" required>
                </div>
                <div class="col-sm-3">
                    <label for="" class="form-label">ราคา (สมาชิก)</label>
                    <input type="number" name="Pro_memberPrice" class="form-control" placeholder="ราคาขาย (สมาชิก)" value="<?php echo $data['Pro_memberPrice'] ?>" required>
                </div>
                <div class="col-sm-3 mb-3">
                    <label for="" class="form-label">จำนวน</label>
                    <input type="number" name="Pro_amount" class="form-control" placeholder="จำนวนสินค้า" value="<?php echo $data['Pro_amount'] ?>" required>
                </div>
                <div class="col-sm-3">
                    <label for="" class="form-label">ประเภทสินค้า</label>
                    <select name="Cate_id" class="form-select" required>
                        <option value="">เลือกประเภทสินค้า...</option>
                        <?php
                            $sql = "SELECT * FROM product_category";
                            $result = $con->query($sql);
                            while ($temp_data = mysqli_fetch_array($result)) {
                                if ($data['Cate_id'] == $temp_data['Cate_id']) {
                                    ?>
                                    <option selected value="<?php echo $temp_data['Cate_id'] ?>"><?php echo $temp_data['Cate_name'] ?></option>
                                    <?php
                                }
                                else {
                                    ?>
                                    <option value="<?php echo $temp_data['Cate_id'] ?>"><?php echo $temp_data['Cate_name'] ?></option>
                                    <?php
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="col-sm-3">
                    <label for="" class="form-label">ชั้นวาง</label>
                    <select name="Shelf_id" class="form-select" required>
                        <option value="">เลือกชั้นวาง...</option>
                        <?php
                            $sql = "SELECT * FROM shelf";
                            $result = $con->query($sql);
                            while ($temp_data = mysqli_fetch_array($result)) {
                                if ($data['shelf_id'] == $temp_data['shelf_id']) {
                                    ?>
                                    <option selected value="<?php echo $temp_data['Shelf_no'] ?>"><?php echo $temp_data['Shelf_name'] ?></option>
                                    <?php
                                }
                                else {
                                    ?>
                                    <option value="<?php echo $temp_data['Shelf_no'] ?>"><?php echo $temp_data['Shelf_name'] ?></option>
                                    <?php
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="col-sm-3">
                    <label for="" class="form-label">ตัวแทนจำหน่าย</label>
                    <select name="Sup_id" class="form-select" required>
                        <option value="">เลือกตัวแทนจำหน่าย...</option>
                        <?php
                            $sql = "SELECT * FROM supplier";
                            $result = $con->query($sql);
                            while ($temp_data = mysqli_fetch_array($result)) {
                                if ($data['Sup_id'] == $temp_data['Sup_id']) {
                                    ?>
                                    <option selected value="<?php echo $temp_data['Sup_id'] ?>"><?php echo $temp_data['Sup_name'] ?></option>
                                    <?php
                                }
                                else {
                                    ?>
                                    <option value="<?php echo $temp_data['Sup_id'] ?>"><?php echo $temp_data['Sup_name'] ?></option>
                                    <?php
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="col-sm-3 mb-3">
                    <label for="" class="form-label">จุดที่ขาย</label>
                    <select name="Point_ofSale" class="form-select" required>
                        <option value="">เลือกจุดที่ขาย...</option>
                        <?php
                            for ($i = 1; $i <= 10 ; $i++) {
                                if ($i == $data['Point_ofSale']) {
                                    ?>
                                    <option selected value="<?php echo $i ?>"><?php echo $i ?></option>
                                    <?php
                                }
                                else {
                                    ?>
                                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                    <?php
                                }
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