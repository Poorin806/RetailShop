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
    ?>

</body>
</html>