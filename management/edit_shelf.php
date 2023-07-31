<?php

    // Connection
    include_once('../import/connect.php');

    //If come to this page without ID parameter
    if (!isset($_GET['ID'])) {
        echo "<script>window.location='shelf.php'</script>";
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการข้อมูลชั้นวาง</title>
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
            $Name_old = $_POST['Shelf_name_old'];
        
            $sql = "UPDATE Shelf SET Shelf_name = '$Name' WHERE Shelf_no = '$ID'";
            $con->query($sql);

            echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'แก้ไขข้อมูลสำเร็จ',
                            text: 'จาก $Name_old เป็น $Name',
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
                <h1>แก้ไขข้อมูล<h class="text-primary">ชั้นวาง</h></h1>
                <h6>Edit Shelf Data</h6>
            </div>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF'] . "?ID=" . $_GET['ID'] ?>" method="post">
            <?php
                $sql = "SELECT * FROM Shelf WHERE Shelf_no = '" . $_GET['ID'] . "'";
                $result = $con->query($sql);
                $data = mysqli_fetch_array($result);
            ?>
            <div class="row">
                <div class="col-sm mb-3">
                    <label for="" class="form-label">รหัสชั้นวาง</label>
                    <input type="text" name="Shelf_no" class="form-control bg-body-secondary" value="<?php echo $data['Shelf_no'] ?>" readonly>
                </div>
                <div class="col-sm mb-3">
                    <label for="" class="form-label">ชื่อชั้นวาง</label>
                    <input type="text" name="Shelf_name" class="form-control" placeholder="ชื่อชั้นวาง" value="<?php echo $data['Shelf_name'] ?>" required>
                    <input type="text" name="Shelf_name_old" class="form-control" value="<?php echo $data['Shelf_name'] ?>" hidden>
                </div>
            </div>
            <input type="submit" value="บันทึก" class="btn btn-primary" name="submit">
            <a href="shelf.php" class="btn btn-secondary">ยกเลิก</a>
        </form>
    </div>

    <?php include_once "../import/js.php"; ?>
</body>

</html>