<?php

include './connect.php';

if (isset($_GET['Buy_id'])) {
    $Buy_id = $_GET['Buy_id'];

    $sql = "SELECT Buy.*, employee.Emp_name 
                FROM Buy, employee
                WHERE 
                    (Buy.Emp_id = employee.Emp_id) AND
                    (Buy_id = '$Buy_id')
        ";
    $query = $con->query($sql);
    $data = $query->fetch_array();
} else {
    echo "<script>window.location = 'buy.php';</script>";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <?php include_once "../import/css.php"; ?>
    <style>
        .receipt {
            border: 1px solid #000;
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
        }

        .receipt-header {
            text-align: center;
            margin-bottom: 10px;
        }

        .receipt-items {
            margin-top: 10px;
        }

        .item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>

    <?php include_once "../import/navbar.php" ?>

    <div class="w-100 my-5 text-center">
        <a href="buy.php" class="btn btn-primary" style="margin: 0 auto;">ย้อนกลับ</a>
        <button class="btn btn-warning text-light" onclick="ScrollDown('ทดสอบ')">
            พิมพ์ใบเสร็จ
            <i class="bi bi-printer-fill"></i>
        </button>
    </div>

    <div class="receipt my-5" id="Receipt">
        <div class="receipt-header">
            <h1>TATC SHOP</h1>
            <p>ผู้ซื้อ: <?php echo $data['Emp_name'] ?></p>
            <p>
                <?php echo $Buy_id ?><br>
                <?php echo formatDateTimeThai($data['Buy_date']) ?>
            </p>
        </div>
        <hr>
        <div class="receipt-items">
            <div class="row">
                <div class="col-sm-4">
                    <h6><b>SUPPLIER</b></h6>
                </div>
                <div class="col-sm-3">
                    <h6><b>NAME</b></h6>
                </div>
                <div class="col-sm-3 text-center">
                    <h6><b>QTY</b></h6>
                </div>
                <div class="col-sm-2 text-end">
                    <h6><b>PRICE</b></h6>
                </div>
            </div>
            <?php
            $sql_detail = "SELECT buy_detail.*, product.Pro_name, supplier.Sup_name, supplier.Sup_id
                            FROM buy_detail, product, supplier
                            WHERE
                                (buy_detail.pro_id = product.Pro_id) AND
                                (product.Sup_id = supplier.Sup_id) AND
                                (buy_detail.buy_id = '$Buy_id')
                            ORDER BY supplier.Sup_name";
            $previous_supplier_id = null; // Variable to track the previous supplier's ID
            $total_price = 0;
            if ($result_detail = $con->query($sql_detail)) {
                while ($row_detail = mysqli_fetch_array($result_detail)) {
                    $current_supplier_id = $row_detail['Sup_id'];
                    $total_price += $row_detail['price'];
            ?>
                    <div class="row">
                        <?php if ($current_supplier_id !== $previous_supplier_id) { ?>
                            <div class="col-sm-4">
                                <span><?php echo $row_detail['Sup_name'] ?></span>
                            </div>
                        <?php } else { ?>
                            <div class="col-sm-4"></div>
                        <?php } ?>
                        <div class="col-sm-3">
                            <span><?php echo $row_detail['Pro_name'] ?></span>
                        </div>
                        <div class="col-sm-3 text-center">
                            <span><?php echo number_format($row_detail['Amount']) ?></span>
                        </div>
                        <div class="col-sm-2 text-end">
                            <span>฿<?php echo number_format($row_detail['price'], 2) ?></span>
                        </div>
                    </div>
            <?php
                    $previous_supplier_id = $current_supplier_id; // Update the previous supplier's ID
                }
            }
            ?>
            <!-- Add more items as needed -->
        </div>
        <hr>
        <div class="total d-flex justify-content-between">
            <strong>Total:</strong>
            <?php echo '฿' . number_format($total_price, 2); ?>
        </div>
        <hr>
        <div class="contact-info text-center">
            <p>หากมีข้อส่งสัย โปรดติดต่อ<br>โทรศัพท์ 038-238398,038-238527</p>
        </div>
    </div>

    <?php include_once "../import/js.php"; ?>

    <script>
        function PrintReceipt(filenameInput) {
            var element = document.getElementById("Receipt");
            // var opt = {
            //     margin:			0.5,
            //     filename:		filenameInput,
            //     image:			{ type: 'jpeg', quality: 0.98 },
            //     html2canvas:	{ scale: 2 },
            //     jsPDF:			{ unit: 'in', format: 'letter', orientation: 'portrait' }
            // };

            var opt = {
                margin: 0,
                filename: filenameInput + '.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait'
                }
            };

            html2pdf().set(opt).from(element).outputPdf('datauristring').then(function(pdfDataUri) {
                // [Preview file in new tab]
                var newTab = window.open();
                newTab.document.open();
                newTab.document.write('<iframe src="' + pdfDataUri + '" width="100%" height="100%"></iframe>');
                newTab.document.close();

                // [Download file in the same page]
                // สร้างลิงค์สำหรับดาวน์โหลด PDF
                // var downloadLink = document.createElement('a');
                // downloadLink.href = pdfDataUri;
                // downloadLink.download = filenameInput + ".pdf";

                // คลิกลิงค์ดาวน์โหลด PDF
                // downloadLink.click();
            });
        }

        function ScrollDown(name) {
            window.scrollTo({
                top: document.body.scrollHeight,
                behavior: 'smooth'
            });

            // setTimeout(() => {
            //     PrintReceipt(name);
            // }, 500);

            PrintReceipt(name);
        }
    </script>

</body>

</html>