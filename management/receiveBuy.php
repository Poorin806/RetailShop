<?php
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รับสินค้า</title>
    <?php include_once "../import/js.php"; ?>
    <?php include_once "../import/css.php"; ?>
</head>
<body>
<?php
$status = $_GET['status'];
$buy_id = $_GET['buy_id'];
$sql = "UPDATE buy SET receive_date = NOW(), paid_date = NOW(), paid_by = 0, receive_by = 0, Buy_status = '$status' WHERE buy_id = '$buy_id'";
if ($result = $con->query($sql)) {
    echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'รับสินค้าสำเร็จ',
                            confirmButtonText: 'ตกลง'
                        }).then((result) => {
                            window.location='list_buy.php'
                        });
                    </script>";
}
?>
</body>
</html>