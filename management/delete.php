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
    
    <?php
        // If Province Deleted
        if (isset($_GET['Province'])) {
            $ID = $_GET['Province'];
        
            $sql = "DELETE FROM Province WHERE Province_id = '$ID'";
            $con->query($sql);

            echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'ลบข้อมูลสำเร็จ',
                            confirmButtonText: 'ตกลง'
                        }).then((result) => {
                            window.location='province.php'
                        });
                    </script>";
        }
        else if (isset($_GET['Shelf'])) {
            $ID = $_GET['Shelf'];
        
            $sql = "DELETE FROM Shelf WHERE Shelf_no = '$ID'";
            $con->query($sql);

            echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'ลบข้อมูลสำเร็จ',
                            confirmButtonText: 'ตกลง'
                        }).then((result) => {
                            window.location='shelf.php'
                        });
                    </script>";
        }
        else if (isset($_GET['Product_Category'])) {
            $ID = $_GET['Product_Category'];
        
            $sql = "DELETE FROM product_category WHERE Cate_id = '$ID'";
            $con->query($sql);

            echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'ลบข้อมูลสำเร็จ',
                            confirmButtonText: 'ตกลง'
                        }).then((result) => {
                            window.location='product_category.php'
                        });
                    </script>";
        }
        else if (isset($_GET['Employee'])) {
            $ID = $_GET['Employee'];
        
            $sql = "DELETE FROM employee WHERE Emp_id = '$ID'";
            $con->query($sql);

            echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'ลบข้อมูลสำเร็จ',
                            confirmButtonText: 'ตกลง'
                        }).then((result) => {
                            window.location='employee.php'
                        });
                    </script>";
        }
        else if (isset($_GET['Supplier'])) {
            $ID = $_GET['Supplier'];
        
            $sql = "DELETE FROM supplier WHERE Sup_id = '$ID'";
            $con->query($sql);

            echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'ลบข้อมูลสำเร็จ',
                            confirmButtonText: 'ตกลง'
                        }).then((result) => {
                            window.location='supplier.php'
                        });
                    </script>";
        }
        else if (isset($_GET['Product'])) {
            $ID = $_GET['Product'];
        
            $sql = "DELETE FROM product WHERE Pro_id = '$ID'";
            $con->query($sql);

            echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'ลบข้อมูลสำเร็จ',
                            confirmButtonText: 'ตกลง'
                        }).then((result) => {
                            window.location='product.php'
                        });
                    </script>";
        }
        else if (isset($_GET['Customer'])) {
            $ID = $_GET['Customer'];
        
            $sql = "DELETE FROM Customer WHERE Cust_id = '$ID'";
            $con->query($sql);

            echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'ลบข้อมูลสำเร็จ',
                            confirmButtonText: 'ตกลง'
                        }).then((result) => {
                            window.location='customer.php'
                        });
                    </script>";
        }
        else {
            echo "<script>window.location='../index.php'</script>";
        }
    ?>

</body>
</html>