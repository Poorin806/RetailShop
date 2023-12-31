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
            $ID = $_POST['Province_id'];
            $Name = $_POST['Province_name'];
        
            $sql = "INSERT INTO Province VALUES ($ID, '$Name')";
            $con->query($sql);

            echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'เพิ่มข้อมูลสำเร็จ',
                            confirmButtonText: 'ตกลง'
                        }).then((result) => {
                            window.location='province.php'
                        });
                    </script>";
        }        
    ?>
    <div class="container my-5">
        <div class="title mb-3">
            <div class="text">
                <h1>เพิ่มข้อมูล<h class="text-primary">จังหวัด</h></h1>
                <h6>Add New Province Data</h6>
            </div>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <?php
                $sql = "SELECT * FROM Province";
                $result = $con->query($sql);
                $NewID = mysqli_num_rows($result) + 1;
            ?>
            <div class="row">
                <div class="col-sm mb-3">
                    <label for="" class="form-label">รหัสจังหวัด</label>
                    <input type="text" name="Province_id" class="form-control bg-body-secondary" value="<?php echo $NewID ?>" readonly>
                </div>
                <div class="col-sm mb-3">
                    <label for="" class="form-label">ชื่อจังหวัด</label>
                    <input type="text" name="Province_name" class="form-control" placeholder="ชื่อจังหวัด" required>
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
            <a href="province.php" class="btn btn-secondary">ยกเลิก</a>
        </form>
    </div>

    <?php include_once "../import/js.php"; ?>
</body>

</html>