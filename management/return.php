<?php include './connect.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>คืนสินค้า</title>
    <?php include_once "../import/css.php"; ?>

</head>

<body>
    <!-- navbar -->
    <?php include_once "../import/navbar.php" ?>
    <div class="container my-5">
        <div class="title mb-5">
            <div class="text">
                <h1>
                    <h class="fw-bolder text-primary">คืนสินค้า</h>
                </h1>
                <h6>Return</h6>
            </div>
        </div>

        <form id="formReturn" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="title text-secondary">
                <h4><i class="bi bi-1-circle-fill text-primary"></i> กรอกรหัสการขาย</h4>
            </div>
            <div class="row d-flex align-items-end mb-3">
                <div class="col-sm-2">
                    <label for="" class="form-label">รหัสการขาย</label>
                    <input type="text" name="sale_id" id="sale_id" class="form-control" value="" list="sale_id_list">
                        <datalist id="sale_id_list">
                            <?php
                                $sql = "SELECT * FROM sale";
                                $result = $con->query($sql);
                                while ($data = mysqli_fetch_array($result)) {
                                    echo "<option value='" . $data['Sale_id'] . "'>";
                                }
                            ?>
                        </datalist>
                    <input type="hidden" name="sale_id_hidden" id="sale_id_hidden" class="form-control">
                </div>
                <div class="col-sm-1">
                    <label for="" class="form-label"></label>
                    <!-- <input type="submit" value="ค้นหา" name="search" class="btn btn-primary"> -->
                    <button type="button" class="btn btn-primary" id="search_sale_id" onclick="getSaleData()">ค้นหา</button>
                </div>
                <div class="col-sm-3">
                    <label for="" class="form-label">วันที่</label>
                    <input type="text" name="sale_date" class="form-control" id="sale_date" value="" disabled>
                </div>
                <div class="col-sm-2">
                    <label for="" class="form-label">รหัสลูกค้า</label>
                    <input type="text" name="" id="cust_id" class="form-control" disabled>
                </div>
                <div class="col-sm-4">
                    <label for="" class="form-label">ชื่อ-นามสกุล</label>
                    <input type="text" name="" id="cust_name" class="form-control" disabled>
                </div>
            </div>

            <div class="title text-secondary">
                <h4><i class="bi bi-2-circle-fill text-primary"></i> เลือกสินค้าที่ต้องการคืน</h4>
            </div>
            <table class="table table-bordered table-striped text-center" id="returnTable">
                <thead>
                    <tr>
                        <th class="text-primary">รหัสสินค้า</th>
                        <th class="text-primary">ชื่อสินค้า</th>
                        <th class="text-primary">จำนวน</th>
                        <th class="text-primary">ราคาต่อหน่วย</th>
                        <th class="text-primary">ลดราคา</th>
                        <th class="text-primary">ราคารวม</th>
                        <th class="text-primary" style="width:10%;">จำนวนการคืน</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <!-- Fetch_data_return.js -->
                    </tr>
                </tbody>
            </table>

            <div class="title text-secondary">
                <h4><i class="bi bi-3-circle-fill text-primary"></i> ยืนยันการคืน</h4>
            </div>
            <div class="row mb-3">
                <div class="col-sm-6">
                    <label for="" class="form-label">เหตุผลในการคืน</label>
                    <textarea name="" id="comment" cols="30" rows="3" class="form-control"></textarea>
                </div>
            </div>
            <div class="row-mb-3">
                <h6 class="text-danger">เมื่อยืนยันการคืน รายการสินค้าที่คืนจะถูกเพิ่มจำนวนคืนในสต็อก และข้อมูลการขายในรหัสกายขายนี้จะถูกบันทึกการเปลี่ยนแปลง</h6>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <button type="button" id="btnConfirmReturn" name="confirmReturn" value="ยืนยันการคืน" class="btn btn-primary w-100" onclick="ReturnConfirm()" disabled>ยืนยันการคืน</button>
                </div>
                <div class="col-sm-3">
                    <input type="submit" id="btnCancelSale" name="cancelSale" value="ยกเลิก" onclick="return confirm('ต้องการยกเลิกรายการขายนี้หรือไม่?')" class="btn btn-outline-danger w-100" disabled>
                </div>
            </div>
        </form>

        <div id="Hi">
        </div>
    </div>


    <!-- JavaScript -->
    <script>
        
        var Hi = document.getElementById('Hi');
        var data = [];
        var return_data = [];

        function ReturnUpdate() {
            var Sale_id = document.getElementById("sale_id").value;
            var Comment = document.getElementById("comment").value;
            var index = 0;
            var counter = 0;
            // return_data.push({id : "key1"});
            //Add new index into object
            // return_data[0]['Name'] = "key2";

            for (var i = 0; i < data.length; i++) {
                if (counter > 6) {
                    counter = 0;
                    index = index + 1;
                    return_data.push({pro_id : data[i]});
                    counter = counter + 1;
                }
                else {
                    if (i == 0) {
                        return_data.push({pro_id : data[i]});
                        counter = counter + 1;
                    }
                    else {
                        switch (counter) {
                            case 0:
                                return_data[index]["pro_id"] = data[i];
                                break;
                            case 1:
                                return_data[index]["pro_name"] = data[i];
                                break;
                            case 2:
                                return_data[index]["amount"] = data[i];
                                break;
                            case 3:
                                return_data[index]["sale_price"] = data[i];
                                break;
                            case 4:
                                return_data[index]["discount"] = data[i];
                                break;
                            case 5:
                                return_data[index]["total"] = data[i];
                                break;
                            case 6:
                                return_data[index]["return_amount"] = data[i];
                                break;
                        }
                        counter = counter + 1;
                    }
                }
            }
            return_data.push({comment : Comment});
            console.log(return_data);

            // Send AJAX request to the PHP file
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "js/update_return.php?Sale_id=" + Sale_id, true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'คืนสินค้าสำเร็จ',
                        confirmButtonText: 'ตกลง'
                    }).then((result) => {
                        window.location = "return_receipt.php?Sale_id=" + Sale_id;
                    });
                }
            };

            // Prepare data and send the request
            xhr.send(JSON.stringify(return_data));
            }

        // ฟังก์ชันแสดงข้อมูลใน innerHTML ของ div อื่น
        function displayDataDiv(row) {
            var cells = row.getElementsByTagName("td");

            for (var i = 0; i < cells.length; i++) {
                var cellContent = cells[i].innerText;
                var inputField = cells[i].querySelector("input");
                


                if (inputField) {
                    data.push(inputField.value);
                } else {
                    data.push(cellContent);
                }
            }
        }

        function ReturnConfirm() {
            const returnTable = document.getElementById('returnTable');
            var rows = returnTable.getElementsByTagName('tr');

            for (var i = 0; i < rows.length; i++) {
                displayDataDiv(rows[i]);
            }

            ReturnUpdate();
        }
    </script>
    
    <script src="js/get_sale_data.js"></script>
    <script src="js/fetch_data_return.js"></script>
    <!-- <script src="js/update_pro_amount.js"></script> -->
    <?php include_once "../import/js.php"; ?>
</body>

</html>