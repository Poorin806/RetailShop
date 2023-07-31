<?php

    // Connection
    include_once('../import/connect.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการข้อมูลจังหวัด</title>
    <!-- Essentials Css Icons -->
    <?php include_once "../import/css.php"; ?>

</head>

<body>
    <!-- Navbar -->
    <?php include_once "../import/navbar.php" ?>

    <?php
        // If edited
        if (isset($_POST['submit'])) {
            $ID = $_POST['Shelf_no'];
            $Name = $_POST['Shelf_name'];
        
            $sql = "INSERT INTO Shelf VALUES ('$ID', '$Name')";
            $con->query($sql);

            echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'เพิ่มข้อมูลสำเร็จ',
                            confirmButtonText: 'ตกลง'
                        }).then((result) => {
                            window.location='shelf.php'
                        });
                    </script>";
        }        
    ?>
    <div class="container my-5">
        <div class="title mb-3">
            <div class="text">
                <h1>เพิ่มข้อมูล<h class="text-primary">ชั้นวางสินค้า</h></h1>
                <h6>Add New Shelf Data</h6>
            </div>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <?php
                $sql = "SELECT * FROM Shelf";
                $result = $con->query($sql);
                $NewID_temp = mysqli_num_rows($result) + 1;
                $NewID_temp = str_pad($NewID_temp, 2, '0', STR_PAD_LEFT);
                $NewID = "SH" . $NewID_temp;
            ?>
            <div class="row">
                <div class="col-sm mb-3">
                    <label for="" class="form-label">รหัสชั้นวาง</label>
                    <input type="text" name="Shelf_no" class="form-control bg-body-secondary" value="<?php echo $NewID ?>">
                </div>
                <div class="col-sm mb-3">
                    <label for="" class="form-label">ชื่อชั้นวาง</label>
                    <input type="text" name="Shelf_name" class="form-control" placeholder="ชื่อชั้นวาง" required>
                </div>
                <!-- <div class="col-sm mb-3">
                    <label for="" class="form-label">รหัสกลุ่มจังหวัด</label>
                    <select name="" id="" class="form-select">
                        <option value="">เลือกรหัสกลุ่มจังหวัด...</option>
                    </select>
                </div> -->
            </div>
            <input type="submit" value="บันทึก" class="btn btn-primary" name="submit">
            <!-- <input type="submit" value="ยกเลิก" class="btn btn-secondary" name="cancel"> -->
            <a href="shelf.php" class="btn btn-secondary">ยกเลิก</a>
        </form>
    </div>

    <?php include_once "../import/js.php"; ?>
</body>

</html>