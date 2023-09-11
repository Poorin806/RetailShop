<?php include './connect.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>คืนสินค้า</title>
    <?php include_once "../import/css.php"; ?>
    
    <!-- JQuery JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

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
                    <button type="button" class="btn btn-primary" id="search_sale_id" onclick="Search()">ค้นหา</button>
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
            <div class="container">
                <div class="mx-5 my-4 alert alert-primary" role="alert">
                    <h5><b><i>ประวัติการคืนสินค้า</i></b></h5>
                    <table class="table table-striped table-bordered text-center align-middle table-hover">
                        <thead>
                            <tr>
                                <th class="text-primary">รหัสสินค้า</th>
                                <th class="text-primary">ชื่อสินค้า</th>
                                <th class="text-primary">จำนวน</th>
                                <th class="text-primary">ราคาต่อหน่วย</th>
                                <th class="text-primary">ราคารวม</th>
                                <th class="text-primary">วันที่คืน</th>
                            </tr>
                        </thead>
                        <tbody id="returnHistory">
                                <!-- Js Fetch_data_return.js -->
                        </tbody>
                    </table>
                </div>
            </div>
            <table class="table table-bordered table-striped text-center table-hover">
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
                <tbody id="returnTable">
                    <!-- Fetch_data_return.js -->
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

        var Pro_id_arr = [];
        var Amount_arr = [];
        var Return_arr = [];
        
        var btnConfirmReturn = document.getElementById("btnConfirmReturn");
        btnConfirmReturn.disabled = true;

        function Search() {
            var Sale_id = document.getElementById("sale_id").value;
            var returnHistory = document.getElementById("returnHistory");
            var returnTable = document.getElementById("returnTable");
            var sale_date = document.getElementById("sale_date");
            var cust_id = document.getElementById("cust_id");
            var cust_name = document.getElementById("cust_name");

            returnHistory.innerHTML = "";
            returnTable.innerHTML = "";

            Pro_id_arr = [];
            Amount_arr = [];
            Return_arr = [];

            btnConfirmReturn.disabled = false;

            // Ajax for call return history
            $.ajax({
                url: "js/get_sale_data.php",
                type: "POST",
                data: {
                    function: "SearchSale_Info",
                    Sale_id: Sale_id
                },
                dataType: "JSON",
                success: function(data) {
                    sale_date.value = data.sale_date;
                    cust_id.value = data.cust_id;
                    cust_name.value = data.cust_name;
                },
                error: function(xhr, status, error) {
                    console.error("Error:", status, error);
                }
            });

            // Ajax for call return history
            $.ajax({
                url: "js/get_sale_data.php",
                type: "POST",
                data: {
                    function: "SearchSale",
                    Sale_id: Sale_id
                },
                dataType: "JSON",
                success: function(data) {

                    sale_date

                    if (data === false) {
                        returnHistory.innerHTML = `
                            <tr>
                                <td colspan="6">
                                    <div class="alert alert-warning m-0" role="alert">ไม่มีประวัติการคืน</div>
                                </td>
                            </tr>
                        `;
                    }
                    else {
                        for (var i = 0; i < data.length; i++) {
                            returnHistory.innerHTML += `
                                <tr>
                                    <td>${ data[i].Pro_id }</td>
                                    <td>${ data[i].Pro_name }</td>
                                    <td>${ data[i].Amount }</td>
                                    <td>${ data[i].Pro_salePrice }</td>
                                    <td>${ data[i].total }</td>
                                    <td>${ data[i].Return_date }</td>
                                </tr>
                            `
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error:", status, error);
                }
            });

            // Ajax for call sale detail
            $.ajax({
                url: "js/get_sale_data.php",
                type: "POST",
                data: {
                    function: "getSaleDetail",
                    Sale_id: Sale_id
                },
                dataType: "JSON",
                success: function(data) {

                    if (data === false) {
                        returnTable.innerHTML = `
                            <tr>
                                <td colspan="6">
                                    <div class="alert alert-danger m-0" role="alert">เกิดข้อผิดพลาด</div>
                                </td>
                            </tr>
                        `;
                    }
                    else {
                        for (var i = 0; i < data.length; i++) {
                            returnTable.innerHTML += `
                                <tr class="align-middle">
                                    <td>${ data[i].Pro_id }</td>
                                    <td>${ data[i].Pro_name }</td>
                                    <td>${ data[i].Amount }</td>
                                    <td>${ data[i].Sale_price }</td>
                                    <td>${ data[i].Discount }</td>
                                    <td>${ data[i].Total }</td>
                                    <td><input type="number" id="${ data[i].Pro_id }" class="form-control" min="0" max="${ data[i].Amount }"></td>
                                </tr>
                            `
                            Pro_id_arr.push(data[i].Pro_id);
                            Amount_arr.push(data[i].Amount);
                        }
                        returnTable.innerHTML += `
                            <tr>
                                <td>
                                    <textarea class="form-control" row="1" name="Pro_id_List" readonly hidden>${ Pro_id_arr.join(', ') }</textarea>
                                </td>
                                <td>
                                    <textarea class="form-control" row="1" name="Amount_List" readonly hidden>${ Amount_arr.join(', ') }</textarea>
                                </td>
                            </tr>
                        `;
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error:", status, error);
                }
            });
        }

        function ReturnConfirm() {
            var Sale_id = document.getElementById("sale_id").value;
            var total_return_amount = 0;
            var Hi = document.getElementById("Hi");
            var comment = document.getElementById("comment").value;

            Hi.innerHTML = "";

            for (var i = 0; i < Pro_id_arr.length; i++) {
                var temp_amount = document.getElementById(Pro_id_arr[i]).value;

                if ((temp_amount == 0) || (temp_amount == null)) {
                    Return_arr[i] = 0;
                }
                else {
                    Return_arr[i] = temp_amount;
                }
            }

            // Ajax for call sale detail
            $.ajax({
                url: "js/get_sale_data.php",
                type: "POST",
                data: {
                    function: "confirmReturn",
                    Sale_id: Sale_id,
                    Pro_id_arr: Pro_id_arr,
                    Return_arr: Return_arr,
                    Comment: comment
                },
                dataType: "JSON",
                success: function(data) {
                    console.log(data);
                    Swal.fire({
                        icon: 'success',
                        title: 'คืนสินค้าสำเร็จ',
                        confirmButtonText: 'ตกลง'
                    }).then((result) => {
                        window.location = "return_receipt.php?Sale_id=" + Sale_id;
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error:", status, error);
                }
            });
        }
    </script>
    
    <!-- <script src="js/get_sale_data.js"></script>
    <script src="js/fetch_data_return.js"></script> -->
    <!-- <script src="js/update_pro_amount.js"></script> -->
    <?php include_once "../import/js.php"; ?>
</body>

</html>