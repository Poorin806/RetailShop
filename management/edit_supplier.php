<?php

    // Connection
    include_once('../import/connect.php');

    //If come to this page without ID parameter
    if (!isset($_GET['ID'])) {
        echo "<script>window.location='supplier.php'</script>";
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการข้อมูลตัวแทนจำหน่าย</title>
    <!-- Essentials Css Icons -->
    <?php include_once "../import/css.php"; ?>

</head>

<body>
    <!-- Navbar -->
    <?php include_once "../import/navbar.php" ?>

    <?php
        // If edited
        if (isset($_POST['submit'])) {
            $ID = $_POST['Sup_id'];
            $Name = $_POST['Sup_name'];
            $Address = $_POST['Sup_Address'];
            $Province = $_POST['Province_id'];
            $Phone = $_POST['Sup_tel'];
            $Contract = $_POST['Contract_name'];
        
            $sql = "UPDATE supplier SET Sup_name = '$Name', Sup_Address = '$Address', Sup_tel = '$Phone', Contract_name = '$Contract', Province_id = '$Province' WHERE Sup_id = '$ID'";
            $con->query($sql);

            echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'แก้ไขข้อมูลสำเร็จ',
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
                <h1>แก้ไขข้อมูล<h class="text-primary">ตัวแทนจำหน่าย</h></h1>
                <h6>Edit Supplier Data</h6>
            </div>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF'] . "?ID=" . $_GET['ID'] ?>" method="post">
            <?php
                $sql = "SELECT supplier.*, province.* FROM supplier, province WHERE (supplier.Province_id = province.Province_id) AND (supplier.Sup_id = '" . $_GET['ID'] . "')";
                $result = $con->query($sql);
                $data = mysqli_fetch_array($result);
            ?>
            <div class="row">
                <div class="col-sm-2 mb-3">
                    <label for="" class="form-label">รหัสตัวแทนจำหน่าย</label>
                    <input type="text" name="Sup_id" class="form-control bg-body-secondary" value="<?php echo $data['Sup_id'] ?>" readonly>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="" class="form-label">ชื่อร้าน</label>
                    <input type="text" name="Sup_name" class="form-control" placeholder="ชื่อร้าน" value="<?php echo $data['Sup_name'] ?>" required>
                </div>
                <div class="col-sm-4">
                    
                </div>
                <div class="col-sm-4 mb-3">
                    <label for="" class="form-label">ที่อยู่</label>
                    <textarea class="form-control" name="Sup_Address" rows="3"><?php echo $data['Sup_Address']; ?></textarea>
                </div>
                <div class="col-sm-4 mb-3">
                    <label for="" class="form-label">จังหวัด</label>
                    <select name="Province_id" class="form-select" required>
                        <option value="">เลือกจังหวัด...</option>
                        <?php
                            $sql = "SELECT * FROM province";
                            $result = $con->query($sql);
                            while ($province_data = mysqli_fetch_array($result)) {
                                if ($data['Province_id'] == $province_data['Province_id']) {
                                    ?>
                                    <option selected value="<?php echo $data['Province_id'] ?>"><?php echo $province_data['Province_name'] ?></option>
                                    <?php
                                }
                                else {
                                    ?>
                                    <option value="<?php echo $data['Province_id'] ?>"><?php echo $province_data['Province_name'] ?></option>
                                    <?php
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="col-sm-4">
                    
                </div>
                <div class="col-sm-3">
                    <label for="" class="form-label">เบอร์โทร</label>
                    <input type="tel" name="Sup_tel" class="form-control" placeholder="เบอร์โทรศัพท์" value="<?php echo $data['Sup_tel'] ?>" required>
                </div>
                <div class="col-sm-5 mb-3">
                    <label for="" class="form-label">ชื่อผู้ติดต่อ</label>
                    <input type="text" name="Contract_name" class="form-control" placeholder="ชื่อผู้ติดต่อ" value="<?php echo $data['Contract_name'] ?>" required>
                </div>
            </div>
            <input type="submit" value="บันทึก" class="btn btn-primary" name="submit">
            <a href="supplier.php" class="btn btn-secondary">ยกเลิก</a>
        </form>
    </div>

    <?php include_once "../import/js.php"; ?>
</body>

</html>