<?php

    // Connect.php
    include_once('../import/connect.php');
    
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
            max-width: 700px;
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

    <div class="container my-5" style="max-width: 300px;">
        <script>
            function Search() {
                var Sale_id = document.getElementById('Search').value;
                window.location = 'return_receipt.php?Sale_id=' + Sale_id;
            }
        </script>
        <p class="fw-bold fs-5">ค้นหาใบเสร็จ</p>
        <select id="Search" class="form-select" onchange="Search()">
            <option value="none">- เลือกใบเสร็จ -</option>
            <?php
                $sql = "SELECT Rel_id, Sale_id FROM product_return
                        GROUP BY Sale_id
                        ORDER BY Sale_id DESC
                ";
                $query = $con->query($sql);
                while ($data = $query->fetch_array()) {
                    ?>
                    <option value="<?php echo $data['Sale_id'] ?>" 
                        <?php echo (isset($_GET['Sale_id']) && $_GET['Sale_id'] == $data['Sale_id']) ? "selected" : "" ?>
                    >
                        <?php echo $data['Sale_id'] ?>
                    </option>
                    <?php
                }
            ?>
        </select>
    </div>

    <?php

        // Check if selected Sale_id
        if (isset($_GET['Sale_id']) && $_GET['Sale_id'] != "none") {

            $Sale_id = $_GET['Sale_id'];

            $sql = "SELECT 
                        product_return.Rel_id, product_return.Sale_id, product_return.Pro_id,
                        SUM(product_return.Amount) AS Amount, product_return.Return_date, 
                        product_return.Comment, product_return.Return_type, product.Pro_name, 
                        product.Pro_salePrice, (product.Pro_salePrice * SUM(product_return.Amount)) AS TotalReturnPerItem
                    FROM 
                        product_return, product
                    WHERE
                        (product_return.Pro_id = product.Pro_id) AND
                        (product_return.Amount <> 0) AND
                        (product_return.Sale_id = '$Sale_id')
                    GROUP BY
                        product_return.Pro_id
                    HAVING
                        SUM(product_return.Amount)
                    ORDER BY product_return.Return_date DESC;
            ";
            $query = $con->query($sql);

            ?>

            <div class="w-100 my-5 text-center">
                <a href="return.php" class="btn btn-primary" style="margin: 0 auto;">ย้อนกลับ</a>
                <button class="btn btn-warning text-light" onclick="ScrollDown('ทดสอบ')">
                    พิมพ์ใบเสร็จ
                    <i class="bi bi-printer-fill"></i>
                </button>
            </div>

            <div class="receipt my-5" id="ReturnReceipt">
                <div class="receipt-header">
                    <h1>TATC SHOP</h1>
                    <p>รายการคืนสินค้า</p>
                    <p>
                        <b><?php echo $Sale_id ?></b>
                        <br>
                        <?php
                            $temp_data = $query->fetch_array();
                            echo formatDateTimeThai($temp_data['Return_date']);
                        ?>
                    </p>
                </div>
                <hr>
                <div class="receipt-items">
                    <div class="row">
                        <div class="col-sm-3">
                            <h6><b>NAME</b></h6>
                        </div>
                        <div class="col-sm-3 text-center">
                            <h6><b>QTY</b></h6>
                        </div>
                        <div class="col-sm-3 text-center">
                            <h6><b>PRICE</b></h6>
                        </div>
                        <div class="col-sm-3 text-end">
                            <h6><b>REASON</b></h6>
                        </div>
                    </div>
                    <?php
                        $TotalReturn = 0;
                        $sql = "SELECT 
                                    product_return.Rel_id, product_return.Sale_id, product_return.Pro_id,
                                    SUM(product_return.Amount) AS Amount, product_return.Return_date, 
                                    product_return.Comment, product_return.Return_type, product.Pro_name, 
                                    product.Pro_salePrice, (product.Pro_salePrice * SUM(product_return.Amount)) AS TotalReturnPerItem
                                FROM 
                                    product_return, product
                                WHERE
                                    (product_return.Pro_id = product.Pro_id) AND
                                    (product_return.Amount <> 0) AND
                                    (product_return.Sale_id = '$Sale_id')
                                GROUP BY
                                    product_return.Pro_id
                                HAVING
                                    SUM(product_return.Amount)
                                ORDER BY product_return.Return_date DESC;
                        ";
                        $query = $con->query($sql);            

                        while ($data = $query->fetch_array()) {
                            $TotalReturn += $data['TotalReturnPerItem'];
                            ?>
                            <div class="row">
                                <div class="col-sm-3">
                                    <span><?php echo $data['Pro_name'] ?></span>
                                </div>
                                <div class="col-sm-3 text-center">
                                    <span><?php echo $data['Amount'] ?> ชิ้น</span>
                                </div>
                                <div class="col-sm-3 text-center">
                                    <span><?php echo number_format($data['TotalReturnPerItem'], 2) ?> บาท</span>
                                </div>
                                <div class="col-sm-3 text-end">
                                    <span><?php echo ($data['Comment'] == null) ? "-" : $data['Comment']; ?></span>
                                </div>
                            </div>
                            <?php
                        }
                    ?>
                    <!-- Add more items as needed -->
                </div>
                <hr>
                <div class="total d-flex justify-content-between">
                    <strong>Total:</strong>
                    <?php echo number_format($TotalReturn, 2) ?> บาท
                </div>
                <hr>
                <div class="contact-info text-center">
                    <p style="font-size: 12px;">
                        "เราขอขอบคุณที่ท่านได้ให้ความสนใจและซื้อสินค้าจากทางร้านของเราเสมอ<br>
                        ขออภัยในความไม่สะดวกที่เกิดขึ้นกับสินค้าที่ท่านได้รับ<br>
                        เรายินดีน้อมรับคำติชมและนำไปแก้ไขพัฒนาต่อไป"
                    </p>
                    <p>หากมีข้อส่งสัย โปรดติดต่อ<br>โทรศัพท์ 038-238398,038-238527</p>
                </div>
            </div>
            <?php
        }
        else {
            ?>
            <div class="mt-5 container alert alert-warning" role="alert">
                กรุณาค้นหาข้อมูลใบเสร็จ
            </div>
            <?php
        }

    ?>

    <?php include_once "../import/js.php"; ?>

    <script>

        function PrintReceipt(filenameInput) {
            var element = document.getElementById("ReturnReceipt");
            // var opt = {
            //     margin:			0.5,
            //     filename:		filenameInput,
            //     image:			{ type: 'jpeg', quality: 0.98 },
            //     html2canvas:	{ scale: 2 },
            //     jsPDF:			{ unit: 'in', format: 'letter', orientation: 'portrait' }
            // };

            var opt = {
                margin: 0,
                filename: 'mypdf.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };

            html2pdf().set(opt).from(element).outputPdf('datauristring').then(function (pdfDataUri) {
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