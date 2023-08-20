<?php

    // Connection
    include_once('../import/connect.php');

    //If come to this page without ID parameter
    if (!isset($_GET['ID'])) {
        echo "<script>window.location='employee.php'</script>";
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการข้อมูลพนักงาน</title>
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
            $Type = $_POST['Emp_type'];
            $Status = $_POST['Emp_status'];
            $Username = $_POST['User_name'];
            $Password = $_POST['Pass_word'];
        
            $sql = "UPDATE employee SET Emp_name = '$Name', Emp_type = '$Type', Emp_status = '$Status', User_name = '$Username', Pass_word = '$Password' WHERE Emp_id = '$ID'";
            $con->query($sql);

            echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'แก้ไขข้อมูลสำเร็จ',
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
                <h1>แก้ไขข้อมูล<h class="text-primary">พนักงาน</h></h1>
                <h6>Edit Employee Data</h6>
            </div>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF'] . "?ID=" . $_GET['ID'] ?>" method="post">
            <?php
                $sql = "SELECT * FROM employee WHERE Emp_id = '" . $_GET['ID'] . "'";
                $result = $con->query($sql);
                $data = mysqli_fetch_array($result);
            ?>
            <div class="row">
                <div class="col-sm-2 mb-3">
                    <label for="" class="form-label">รหัสพนักงาน</label>
                    <input type="text" name="Emp_id" class="form-control bg-body-secondary" value="<?php echo $data['Emp_id'] ?>" readonly>
                </div>
                <div class="col-sm-4 mb-3">
                    <label for="" class="form-label">ชื่อพนักงาน</label>
                    <input type="text" name="Emp_name" class="form-control" placeholder="ชื่อพนักงาน" value="<?php echo $data['Emp_name'] ?>" required>
                </div>
                <div class="col-sm mb-3">
                    <label class="form-label">สถานะ</label>
                    <select name="Emp_status" class="form-select" required>
                        <option value="" selected>เลือกสถานะ...</option>
                        <option <?php if ($data['Emp_status'] == 1) { echo "selected"; }  ?> value="1">เข้าสู่ระบบได้</option>
                        <option <?php if ($data['Emp_status'] == 2) { echo "selected"; }  ?> value="2">ไม่อนุญาตให้เข้าระบบ</option>
                    </select>
                </div>
                <div class="col-sm mb-3">
                    <label class="form-label">ประเภทพนักงาน</label>
                    <select name="Emp_type" class="form-select" required>
                        <option value="" selected>เลือกประเภทพนักงาน...</option>
                        <option <?php if ($data['Emp_type'] == 1) { echo "selected"; }  ?> value="1">พนักงาน</option>
                        <option <?php if ($data['Emp_type'] == 2) { echo "selected"; }  ?> value="2">เจ้าของกิจการ</option>
                    </select>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="" class="form-label">Username</label>
                    <input type="text" name="User_name" class="form-control" placeholder="Username" value="<?php echo $data['User_name'] ?>" required>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="" class="form-label">Password</label>
                    <input type="text" name="Pass_word" class="form-control" placeholder="Password" value="<?php echo $data['Pass_word'] ?>" required>
                </div>
            </div>
            <input type="submit" value="บันทึก" class="btn btn-primary" name="submit">
            <a href="employee.php" class="btn btn-secondary">ยกเลิก</a>
        </form>
    </div>

    <?php include_once "../import/js.php"; ?>
</body>

</html>