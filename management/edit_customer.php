<?php

    // Connection
    include_once('../import/connect.php');

    //If come to this page without ID parameter
    if (!isset($_GET['ID'])) {
        echo "<script>window.location='customer.php'</script>";
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการข้อมูลลูกค้า</title>
    <!-- Essentials Css Icons -->
    <?php include_once "../import/css.php"; ?>

</head>

<body>
    <!-- Navbar -->
    <?php include_once "../import/navbar.php" ?>

    <?php
        // If edited
        if (isset($_POST['submit'])) {
            $ID = $_POST['Cust_id'];
            $Name = $_POST['Cust_name'];
            $Lastname = $_POST['Cust_lastName'];
            $Address = $_POST['Cust_address'];
            $Province = $_POST['Province_id'];
            $Phone = $_POST['Cust_tel'];

            $sql = "UPDATE Customer 
                    SET
                        Cust_name = '$Name',
                        Cust_lastName = '$Lastname',
                        Cust_address = '$Address',
                        Province_id = '$Province',
                        Cust_tel = '$Phone'
                    WHERE
                        Cust_id = '$ID'
            ";
            
            $con->query($sql);

            echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'แก้ไขข้อมูลสำเร็จ',
                            confirmButtonText: 'ตกลง'
                        }).then((result) => {
                            window.location='customer.php'
                        });
                    </script>";
        }        
    ?>

    <div class="container my-5">
        <div class="title mb-3">
            <div class="text">
                <h1>แก้ไขข้อมูล<h class="text-primary">ลูกค้า</h></h1>
                <h6>Edit Customer Data</h6>
            </div>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF'] . "?ID=" . $_GET['ID'] ?>" method="post">
            <?php
                $sql = "SELECT 
                            Customer.*, Province.Province_name 
                        FROM 
                            Customer, Province 
                        WHERE 
                            (Customer.Province_id = Province.Province_id) AND
                            (Customer.Cust_id = '" . $_GET['ID'] . "')
                ";
                $result = $con->query($sql);
                $data = mysqli_fetch_array($result);
            ?>
            <div class="row">
                <div class="col-sm-2 mb-3">
                    <label for="" class="form-label">รหัสลูกค้า</label>
                    <input type="text" name="Cust_id" class="form-control bg-body-secondary" value="<?php echo $data['Cust_id'] ?>" readonly>
                </div>
                <div class="col-sm-3 mb-3">
                    <label for="" class="form-label">ชื่อ</label>
                    <input type="text" name="Cust_name" class="form-control" placeholder="ชื่อ" value="<?php echo $data['Cust_name'] ?>" required>
                </div>
                <div class="col-sm-3 mb-3">
                    <label for="" class="form-label">นามสกุล</label>
                    <input type="text" name="Cust_lastName" class="form-control" placeholder="นามสกุล" value="<?php echo $data['Cust_lastName'] ?>" required>
                </div>
                <div class="col-sm-4">
                    
                </div>
                <div class="col-sm-4 mb-3">
                    <label for="" class="form-label">ที่อยู่</label>
                    <textarea class="form-control" name="Cust_address" rows="3" required><?php echo $data['Cust_address'] ?></textarea>
                </div>
                <div class="col-sm-3 mb-3">
                    <label for="" class="form-label">จังหวัด</label>
                    <select name="Province_id" class="form-select" required>
                        <option value="">เลือกจังหวัด...</option>
                        <?php
                            $sql = "SELECT * FROM Province";
                            $result = $con->query($sql);
                            while ($temp_data = mysqli_fetch_array($result)) {
                                if ($data['Province_id'] == $temp_data['Province_id']) {
                                    ?>
                                    <option selected value="<?php echo $temp_data['Province_id'] ?>"><?php echo $temp_data['Province_name'] ?></option>
                                    <?php
                                }
                                else {
                                    ?>
                                    <option value="<?php echo $temp_data['Province_id'] ?>"><?php echo $temp_data['Province_name'] ?></option>
                                    <?php
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="col-sm-3">
                    <label for="" class="form-label">เบอร์โทร</label>
                    <input type="tel" name="Cust_tel" class="form-control" placeholder="เบอร์โทร" value="<?php echo $data['Cust_tel'] ?>" required>
                </div>
            </div>
            <input type="submit" value="บันทึก" class="btn btn-primary" name="submit">
            <a href="customer.php" class="btn btn-secondary">ยกเลิก</a>
        </form>
    </div>

    <?php include_once "../import/js.php"; ?>
</body>

</html>