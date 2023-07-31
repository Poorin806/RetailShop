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
            $ID = $_POST['Cust_id'];
            $Name = $_POST['Cust_name'];
            $Lastname = $_POST['Cust_lastName'];
            $Address = $_POST['Cust_address'];
            $Province = $_POST['Province_id'];
            $Phone = $_POST['Cust_tel'];
            $currentDate = date('Y-m-d');
        
            $sql = "INSERT INTO customer VALUES ('$ID', '$Name', '$Lastname', '$Address', '$Province', '$Phone', '$currentDate', null, 1)";

            $con->query($sql);

            echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'เพิ่มข้อมูลสำเร็จ',
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
                <h1>เพิ่มข้อมูล<h class="text-primary">ลูกค้า</h></h1>
                <h6>Add New Customer Data</h6>
            </div>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <?php
                $sql = "SELECT * FROM Customer ORDER BY Cust_id DESC LIMIT 1";
                $result = $con->query($sql);
                $NewID = mysqli_fetch_array($result);
                $NewID = preg_replace('/\D/', '', $NewID['Cust_id']);   //แยกตัวเลขและตัวหนังสือออกจากกัน
                $NewID += 1;                                            //เพิ่มค่า 1 หน่วยทำให้เป็นข้อมูล record ล่าสุด
                $NewID = str_pad($NewID, 4, '0', STR_PAD_LEFT);         //Format ให้ขึ้นต้นด้วย 0
                $NewID = "C" . $NewID;                                  //นำตัวหนังสือและตัวเลขมาต่อกัน
            ?>
            
            <div class="row">
                <div class="col-sm-4 mb-3">
                    <label for="" class="form-label">รหัสลูกค้า</label>
                    <input type="text" name="Cust_id" class="form-control bg-body-secondary" value="<?php echo $NewID ?>" readonly>
                </div>
                <div class="col-sm-4 mb-3">
                    <label for="" class="form-label">ชื่อ</label>
                    <input type="text" name="Cust_name" class="form-control" placeholder="ชื่อ" required>
                </div>
                <div class="col-sm-4 mb-3">
                    <label for="" class="form-label">นามสกุล</label>
                    <input type="text" name="Cust_lastName" class="form-control" placeholder="นามสกุล" required>
                </div>

                <div class="col-sm-4 mb-3">
                    <label for="" class="form-label">ที่อยู่</label>
                    <textarea name="Cust_address" cols="30" rows="3" class="form-control" required></textarea>
                </div>
                
                <div class="col-sm-4 mb-3">
                    <label for="" class="form-label">จังหวัด</label>
                    <select name="Province_id" class="form-select" required>
                        <option value="">เลือกจังหวัด...</option>
                        <?php
                            $sql = "SELECT * FROM province";
                            $result = $con->query($sql);
                            while ($temp_data = mysqli_fetch_array($result)) {
                                ?>
                                <option value="<?php echo $temp_data['Province_id']; ?>"><?php echo $temp_data['Province_name']; ?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>

                <div class="col-sm-4 mb-3">
                    <label for="" class="form-label">ที่อยู่</label>
                    <input type="tel" name="Cust_tel" class="form-control" placeholder="เบอร์โทร" required>
                </div>
                
            </div>
            
            <input type="submit" value="บันทึก" class="btn btn-primary" name="submit">
            <a href="customer.php" class="btn btn-secondary">ยกเลิก</a>
        </form>
    </div>

    <?php include_once "../import/js.php"; ?>
</body>

</html>