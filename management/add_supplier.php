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
            $ID = $_POST['Sup_id'];
            $Name = $_POST['Sup_name'];
            $Address = $_POST['Sup_Address'];
            $Phone = $_POST['Sup_tel'];
            $Province = $_POST['Province_id'];
            $Contract = $_POST['Contract_name'];
        
            $sql = "INSERT INTO supplier VALUES ('$ID', '$Name', '$Address', '$Phone', '$Contract', '$Province')";
            $con->query($sql);

            echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'เพิ่มข้อมูลสำเร็จ',
                            confirmButtonText: 'ตกลง'
                        }).then((result) => {
                            window.location='supplier.php'
                        });
                    </script>";
        }        
    ?>
    <div class="container my-5">
        <div class="title mb-3">
            <div class="text">
                <h1>เพิ่มข้อมูล<h class="text-primary">ตัวแทนจำหน่าย</h></h1>
                <h6>Add New Supplier Data</h6>
            </div>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <?php
                $sql = "SELECT * FROM supplier ORDER BY Sup_id DESC LIMIT 1";
                $result = $con->query($sql);
                $NewID = mysqli_fetch_array($result);
                $NewID = "SUP" . preg_replace('/\D/', '', $NewID['Sup_id']) + 1;
            ?>
            <div class="row">
                <div class="col-sm-6 mb-3">
                    <label for="" class="form-label">รหัสตัวแทนจำหน่าย</label>
                    <input type="text" name="Sup_id" class="form-control bg-body-secondary" value="<?php echo $NewID ?>" readonly>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="" class="form-label">ร้านค้า</label>
                    <input type="text" name="Sup_name" class="form-control" placeholder="ชื่อตัวแทนจำหน่าย" required>
                </div>
                <div class="col-sm-6 mb-3">
                    <label class="form-label">จังหวัด</label>
                    <select name="Province_id" class="form-select" required>
                        <option value="" selected>เลือกจังหวัด...</option>
                        <?php
                            $sql = "SELECT * FROM Province";
                            $result = $con->query($sql);
                            while ($province_data = mysqli_fetch_array($result)) {
                                ?>
                                <option value="<?php echo $province_data['Province_id'] ?>"><?php echo $province_data['Province_name'] ?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="" class="form-label">เบอร์โทร</label>
                    <input type="text" name="Sup_tel" class="form-control" placeholder="เบอร์โทร" required>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="" class="form-label">ชื่อผู้ติดต่อ</label>
                    <input type="text" name="Contract_name" class="form-control" placeholder="ชื่อผู้ติดต่อ" required>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="" class="form-label">ที่อยู่</label>
                    <textarea name="Sup_Address" cols="30" rows="3" class="form-control" required></textarea>
                </div>
            </div>
            <input type="submit" value="บันทึก" class="btn btn-primary" name="submit">
            <a href="supplier.php" class="btn btn-secondary">ยกเลิก</a>
        </form>
    </div>

    <?php include_once "../import/js.php"; ?>
</body>

</html>