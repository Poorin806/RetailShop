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
        // If edited
        if (isset($_POST['submit'])) {
            $ID = $_POST['Cate_id'];
            $Name = $_POST['Cate_name'];
        
            $sql = "INSERT INTO product_category VALUES ($ID, '$Name')";
            $con->query($sql);

            echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'เพิ่มข้อมูลสำเร็จ',
                            confirmButtonText: 'ตกลง'
                        }).then((result) => {
                            window.location='product_category.php'
                        });
                    </script>";
        }        
    ?>
    <div class="container my-5">
        <div class="title mb-3">
            <div class="text">
                <h1>เพิ่มข้อมูล<h class="text-primary">ประเภทสินค้า</h></h1>
                <h6>Add New Product Category Data</h6>
            </div>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <?php
                $sql = "SELECT * FROM product_category";
                $result = $con->query($sql);
                $NewID = mysqli_num_rows($result) + 1;
            ?>
            <div class="row">
                <div class="col-sm mb-3">
                    <label for="" class="form-label">รหัสประเภทสินค้า</label>
                    <input type="text" name="Cate_id" class="form-control bg-body-secondary" value="<?php echo $NewID ?>" readonly>
                </div>
                <div class="col-sm mb-3">
                    <label for="" class="form-label">ชื่อประเภทสินค้า</label>
                    <input type="text" name="Cate_name" class="form-control" placeholder="ชื่อประเภทสินค้า" required>
                </div>
            </div>
            <input type="submit" value="บันทึก" class="btn btn-primary" name="submit">
            <a href="product_category.php" class="btn btn-secondary">ยกเลิก</a>
        </form>
    </div>

    <?php include_once "../import/js.php"; ?>
</body>

</html>