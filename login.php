<?php

    // Connection
    include_once('import/connect.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retail Shop</title>

    <!-- Essentials Css Icons -->
    <?php include_once "import/css.php"; ?>

    <style>
        @media (max-width: 576px) {
            .Title-img {
                width: 150px; /* ปรับขนาดรูปภาพให้เหมาะสมกับ breakpoint sm ที่มีขนาดเล็กกว่าหรือเท่ากับ 576px */
            }
        }
    </style>

    <!-- Essentials JS -->
    <?php include_once "import/js.php"; ?>
</head>
<body>

    <?php
        // If Logged in (Submitted)
        if (isset($_POST['Submit'])) {
            $username = $_POST['Username'];
            $password = $_POST['Password'];

            $sql = "SELECT * FROM employee WHERE User_name = '$username' AND BINARY Pass_word = '$password'";
            $query = $con->query($sql);
            $LoginResult = $query->num_rows;
            $data = $query->fetch_array();

            if ($LoginResult != 0) {
                $_SESSION['Emp_id'] = $data['Emp_id'];
                $_SESSION['Emp_name'] = $data['Emp_name'];
                $_SESSION['Emp_status'] = $data['Emp_status'];
                $_SESSION['Emp_type'] = $data['Emp_type'];
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'เข้าสู่ระบบสำเร็จ',
                        confirmButtonText: 'ตกลง'
                    }).then((result) => {
                        window.location='$rootDirectory'
                    });
                </script>";
            }
            else {
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'เข้าสู่ระบบไม่สำเร็จ',
                            text: 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง!',
                            confirmButtonText: 'ตกลง'
                        });
                    </script>";
            }
        }
    ?>

    <div class="container" style="position: relative; height: 100vh; width: 100%;">
        <div class="row align-items-center" style="position: absolute; top: 50%; transform: translateY(-50%); width: 100%;">
            <!-- Left Side -->
            <div class="col-12 col-sm-6 text-center">
                <img src="image/TATC.png" width="250" alt="Logo / Banner" class="img-fluid Title-img">
            </div>
            <!-- Right Side -->
            <div class="col-12 col-sm-6 text-center">
                <div class="card">
                    <div class="card-header"><h1 class="m-0 p-0 fw-bold">เข้าสู่ระบบ</h1></div>
                    <div class="card-body text-start">
                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                            <div class="mb-3">
                                <label class="form-label">ชื่อผู้ใช้</label>
                                <input type="text" name="Username" class="form-control" placeholder="ชื่อผู้ใช้">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">รหัสผ่าน</label>
                                <input type="password" name="Password" class="form-control" placeholder="รหัสผ่าน">
                            </div>
                            <div class="mb-3">
                                <input type="submit" name="Submit" value="เข้าสู่ระบบ" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-start">
                        <p class="m-0 p-0">ระบบ Retail Shop (Ver 1.0)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>