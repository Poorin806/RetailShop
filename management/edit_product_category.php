<?php

    // Connection
    include_once('../import/connect.php');

    //If come to this page without ID parameter
    if (!isset($_GET['ID'])) {
        echo "<script>window.location='product_category.php'</script>";
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการข้อมูลประเภทสินค้า</title>
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
            $Name_old = $_POST['Cate_name_old'];
        
            $sql = "UPDATE product_category SET Cate_name = '$Name' WHERE Cate_id = $ID";
            $con->query($sql);

            echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'แก้ไขข้อมูลสำเร็จ',
                            text: 'จาก $Name_old เป็น $Name',
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
                <h1>แก้ไขข้อมูล<h class="text-primary">ประเภทสินค้า</h></h1>
                <h6>Edit Product Category Data</h6>
            </div>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF'] . "?ID=" . $_GET['ID'] ?>" method="post">
            <?php
                $sql = "SELECT * FROM product_category WHERE Cate_id = " . $_GET['ID'];
                $result = $con->query($sql);
                $data = mysqli_fetch_array($result);
            ?>
            <div class="row">
                <div class="col-sm mb-3">
                    <label for="" class="form-label">รหัสประเภทสินค้า</label>
                    <input type="text" name="Cate_id" class="form-control bg-body-secondary" value="<?php echo $data['Cate_id'] ?>" readonly>
                </div>
                <div class="col-sm mb-3">
                    <label for="" class="form-label">ชื่อประเภทสินค้า</label>
                    <input type="text" name="Cate_name" class="form-control" placeholder="ชื่อประเภทสินค้า" value="<?php echo $data['Cate_name'] ?>" required>
                    <input type="text" name="Cate_name_old" class="form-control" value="<?php echo $data['Cate_name'] ?>" hidden>
                </div>
            </div>
            <input type="submit" value="บันทึก" class="btn btn-primary" name="submit">
            <a href="product_category.php" class="btn btn-secondary">ยกเลิก</a>
        </form>
    </div>

    <?php include_once "../import/js.php"; ?>
</body>

</html>