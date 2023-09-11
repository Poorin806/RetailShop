<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<?php
include './connect.php';
$buy_id = $_GET['buy_id'];
$status = $_GET['status'];

$sql_check = "SELECT * FROM buy WHERE buy_id = '$buy_id'";
$result = $con->query($sql_check);
if ($row = mysqli_fetch_array($result)) {
    if ($row['Buy_status'] <> null) {
        header('location:list_buy.php');
    }
}

if ($status == 3) {
    //สินค้าครบ
    $sql_update = "UPDATE buy SET Receive_date = NOW(), Paid_date = NOW(), Paid_by = 0, Receive_by = 0, Buy_status = $status WHERE buy_id = '$buy_id'";
    $resultBuy = mysqli_query($con, $sql_update);

    if ($resultBuy) {
        $sql = "SELECT * FROM buy_detail WHERE buy_id = '$buy_id'";
        if ($result = $con->query($sql)) {
            $error_update = true;
            while ($row = mysqli_fetch_array(($result))) {
                $pro_id = $row['pro_id'];
                $amount = $row['Amount'];
                $sql_update = "UPDATE product SET pro_amount = pro_amount + '$amount' WHERE pro_id = '$pro_id'";
                if (!$result = mysqli_query($con, $sql_update)) {
                    $error_update = false;
                }
                if (!$error_update) {
                    echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาดในกับอัพเดตจำนวนสินค้า '" . mysqli_error($con) . ",
                                confirmButtonText: 'ตกลง'
                            }).then((result) => {
                                window.location='list_buy.php'
                            });
                        </script>
                        ";
                }
            }
        }
        echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'ยืนยันสินค้าครบ สำเร็จ',
                        confirmButtonText: 'ตกลง'
                    }).then((result) => {
                        window.location='list_buy.php'
                    });
                </script>
            ";
    } else {
        echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด '" . mysqli_error($con) . ",
                        confirmButtonText: 'ตกลง'
                    }).then((result) => {
                        window.location='list_buy.php'
                    });
                </script>
                ";
    }
}

if ($status == 1) {
    //ยกเลิก
    echo "<script>alert('1 condition')</script>";
    $sql_update = "UPDATE buy SET Receive_date = NOW(), Paid_date = NOW(), Paid_by = 0, Receive_by = 0, Buy_status = $status WHERE buy_id = '$buy_id'";
    $result = $con->query($sql_update);
    
    if ($result) {
        echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'ยกเลิก สำเร็จ',
                        confirmButtonText: 'ตกลง'
                    }).then((result) => {
                        window.location='list_buy.php'
                    });
                </script>
                ";
    } else {
        echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด '" . mysqli_error($con) . ",
                        confirmButtonText: 'ตกลง'
                    }).then((result) => {
                        window.location='list_buy.php'
                    });
                </script>
                ";
    }
}
?>