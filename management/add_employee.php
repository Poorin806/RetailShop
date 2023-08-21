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
            $ID = $_POST['Emp_id'];
            $Name = $_POST['Emp_name'];
            $Username = $_POST['User_name'];
            $Password = $_POST['Pass_word'];
            $Type = $_POST['Emp_type'];
            $Status = $_POST['Emp_status'];
        
            $sql = "INSERT INTO employee VALUES ('$ID', '$Username', '$Password', '$Name', '$Type', '$Status')";
            $con->query($sql);

            echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'เพิ่มข้อมูลสำเร็จ',
                            confirmButtonText: 'ตกลง'
                        }).then((result) => {
                            window.location='employee.php'
                        });
                    </script>";
        }        
    ?>
    <div class="container my-5">
        <div class="title mb-3">
            <div class="text">
                <h1>เพิ่มข้อมูล<h class="text-primary">พนักงาน</h></h1>
                <h6>Add New Employee Data</h6>
            </div>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <?php
                $sql = "SELECT * FROM employee ORDER BY Emp_id DESC LIMIT 1";
                $result = $con->query($sql);
                $NewID = mysqli_fetch_array($result);
                $NewID = "EMP" . preg_replace('/\D/', '', $NewID['Emp_id']) + 1;
            ?>
            <div class="row">
                <div class="col-sm-6 mb-3">
                    <label for="" class="form-label">รหัสพนักงาน</label>
                    <input type="text" name="Emp_id" class="form-control bg-body-secondary" value="<?php echo $NewID ?>" readonly>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="" class="form-label">ชื่อ-นามสกุล</label>
                    <input type="text" name="Emp_name" class="form-control" placeholder="ชื่อพนักงาน" required>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="" class="form-label">Username</label>
                    <input type="text" name="User_name" class="form-control" placeholder="Username" required>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="" class="form-label">Password</label>
                    <input type="text" name="Pass_word" class="form-control" placeholder="Password" required>
                </div>
                <div class="col-sm-6 mb-3">
                    <label class="form-label">สถานะ</label>
                    <select name="Emp_status" class="form-select" required>
                        <option value="" selected>เลือกสถานะ...</option>
                        <option value="1">เข้าสู่ระบบได้</option>
                        <option value="2">ไม่อนุญาตให้เข้าระบบ</option>
                    </select>
                </div>
                <div class="col-sm-6 mb-3">
                    <label class="form-label">ประเภทพนักงาน</label>
                    <select name="Emp_type" class="form-select" required>
                        <option value="" selected>เลือกประเภทพนักงาน...</option>
                        <option value="1">พนักงาน</option>
                        <option value="2">เจ้าของกิจการ</option>
                    </select>
                </div>
            </div>
            <input type="submit" value="บันทึก" class="btn btn-primary" name="submit">
            <a href="employee.php" class="btn btn-secondary">ยกเลิก</a>
        </form>
    </div>

    <?php include_once "../import/js.php"; ?>
</body>

</html>