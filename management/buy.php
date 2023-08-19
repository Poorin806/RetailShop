<?php include './connect.php' ?>
<?php
$today = date("Y-m-d H:i:s");

//create buy id
$sql_latestBuyId = "select max(buy_id) as buy_id from buy;";
$result_latestBuyId = $con->query($sql_latestBuyId);
$row_lastestBuyId = mysqli_fetch_array($result_latestBuyId);
$latest_BuyId = $row_lastestBuyId['buy_id'];
if ($latest_BuyId == null) {
    $latest_BuyId = 'ไม่มีรหัสการซื้อก่อนหน้า';
} else {
    $new_buy_id = preg_replace('/\D/', '', $latest_BuyId) + 1;
    $buy_id = "B" . str_pad($new_buy_id, 4,'0',STR_PAD_LEFT);
}


if (isset($_POST['confirmBuy'])) {
    // $buy_id = $_POST['buy_id'];
    $est_id = 'EMP01';
    // $sup_id = $_POST['sup_id'];
    $net_price = $_POST['net_price'];

    // Insert net_price into the 'buy' table
    $insertBuyQuery = "INSERT INTO buy (buy_id, emp_id, buy_date, net_price) VALUES ('$buy_id', '$est_id', NOW(), '$net_price')";
    $resultBuy = mysqli_query($con, $insertBuyQuery);

    if ($resultBuy) {
        // Get the last inserted ID (buy_id) for use in the buy_detail table
        // $buy_id = mysqli_insert_id($con);

        // Loop through the product quantities to insert into the 'buy_detail' table
        foreach ($_POST['pro_amount'] as $pro_id => $amount) {
            if($amount==0){
                continue;
            }
            $sql_pro = "SELECT * FROM product WHERE pro_id = '$pro_id'";
            if($result_pro=$con->query($sql_pro)){
                $row_pro=mysqli_fetch_array($result_pro);
                $total_price = $amount * $row_pro['Pro_salePrice']; // You need to fetch $unit_price from the database or calculate it
            }

            // Insert into 'buy_detail'
            $insertDetailQuery = "INSERT INTO buy_detail (buy_id, pro_id, amount, price) VALUES ('$buy_id', '$pro_id', '$amount', '$total_price')";
            $resultDetail = mysqli_query($con, $insertDetailQuery);
            if (!$resultDetail) {
                // Handle the case where insertion into buy_detail fails
                echo "Error inserting into buy_detail: " . mysqli_error($con);
            }

            //Update product amount
            $sql_update = "UPDATE product SET pro_amount = pro_amount + '$amount' WHERE pro_id = '$pro_id'";
            $result = mysqli_query($con, $sql_update);
            if (!$result) {
                // Handle the case where insertion into buy_detail fails
                echo "Error update product amount: " . mysqli_error($con);
            }
        }

        // Successfully inserted into both buy and buy_detail
        echo "Purchase successfully completed!";
    } else {
        // Handle the case where insertion into buy fails
        echo "Error inserting into buy: " . mysqli_error($con);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ขายสินค้า</title>
    <!-- Essentials Css Icons -->
    <?php include_once "../import/css.php"; ?>

</head>

<body>
    <!-- Navbar -->
    <?php include_once "../import/navbar.php" ?>
    <div class="container my-5 py-5">
        <div class="title mb-5">
            <div class="text">
                <h1>
                    <h class="fw-bolder text-primary">ซื้อสินค้าเข้าร้าน</h>
                </h1>
                <h6>Buy</h6>
            </div>
        </div>

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="mb-3">
                <label for="" class="form-label">เลือกตัวแทนจำหน่าย</label>
                <select name="sup_id" id="" class="form-select">
                    <option value="">--เลือก--</option>
                    <?php
                    $sql = "SELECT * FROM supplier";
                    if ($result = $con->query($sql)) {
                        while ($row = mysqli_fetch_array($result)) {
                    ?>
                            <option value="<?php echo $row['Sup_id'] ?>"><?php echo $row['Sup_name'] ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div>
                <input type="submit" value="ค้นหา" class="btn btn-primary" name="select_supplier">
            </div>

        </form>

        <hr>


        <?php
        if (isset($_POST['select_supplier'])) {
            $sup_id = $_POST['sup_id'];
            $sql_sup = "SELECT * FROM supplier WHERE sup_id = '$sup_id'";
            if ($result_sup = $con->query($sql_sup)) {
                $row_sup = mysqli_fetch_array($result_sup);
            }

            $sql_pro = "SELECT * FROM product WHERE sup_id = '$sup_id'";
            $result_pro = $con->query($sql_pro);
        ?>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">

                <div class="mb-3">
                    <label for="" class="form-label">รหัสการซื้อ</label>
                    <!-- <input type="text" name="buy_id" id="" class="form-control"> -->
                    <?php echo $buy_id ?>
                </div>

                <h1 class="text-primary"><?php echo $row_sup['Sup_name'] ?></h1>

                <!-- Table -->

                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th class="text-primary">รหัสสินค้า</th>
                            <th class="text-primary">ชื่อสินค้า</th>
                            <th class="text-primary">ราคาต่อหน่วย</th>
                            <th class="text-primary">จำนวน</th>
                            <!-- <th class="text-primary">ลดราคา</th> -->
                            <th class="text-primary">ราคารวม</th>
                            <!-- <th class="text-primary" style="width:10%;">จัดการ</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result_pro) {
                            while ($row_pro = mysqli_fetch_array($result_pro)) {
                        ?>
                                <tr>
                                    <td style="width:20%;"><input type="text" class="form-control disabled text-center" name="pro_id" value="<?php echo $row_pro['Pro_id'] ?>" readonly></td>
                                    <td><?php echo $row_pro['Pro_name'] ?></td>
                                    <td><?php echo $row_pro['Pro_salePrice'] ?></td>
                                    <td style="width:10%;">
                                        <input type="number" class="form-control pro_amount" value="0" min="0" max="100" name="pro_amount[<?php echo $row_pro['Pro_id']; ?>]">
                                    </td>
                                    <td>
                                        <b class="total_perPro"></b>
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                            // Display an error message if the query fails
                            echo "Query failed: " . mysqli_error($con);
                        }
                        ?>
                    </tbody>
                </table>

                <div class="mb-3">
                    <b>ราคารวม : </b>
                    <input type="text" name="net_price" id="net_price" class="form-control w-25" readonly>
                    <!-- <b class="net_price"></b> -->
                </div>

                <button type="submit" class="btn btn-success" name="confirmBuy">ยืนยันการซื้อ</button>
            </form>
        <?php
        }
        ?>

    </div>

    <?php include_once "../import/js.php"; ?>
    <script>
        // Get all elements with class "pro_amount"
        var quantityInputs = document.getElementsByClassName("pro_amount");

        // Loop through each input and attach an event listener
        for (var i = 0; i < quantityInputs.length; i++) {
            quantityInputs[i].addEventListener("input", calculateTotal);
        }

        // Function to calculate and update the total price
        function calculateTotal(event) {
            var input = event.target; // The input element that triggered the event
            var row = input.closest("tr"); // Find the closest parent <tr> element

            var unitPrice = parseFloat(row.cells[2].textContent); // Get the unit price from the third cell
            var quantity = parseFloat(input.value); // Get the entered quantity from the input

            var totalPrice = unitPrice * quantity; // Calculate the total price
            var totalCell = row.cells[4].querySelector(".total_perPro"); // Find the total cell

            totalCell.textContent = totalPrice.toFixed(2); // Update the total cell with the calculated total price
        }
    </script>

    <!-- Your existing code for the form and table -->

    <script>
        // Get all elements with class "total_perPro"
        var totalPerProElements = document.getElementsByClassName("total_perPro");
        var netPriceElement = document.getElementById("net_price");

        // Loop through each total_perPro element and calculate total net price
        function calculateNetPrice() {
            var netPrice = 0;

            for (var i = 0; i < totalPerProElements.length; i++) {
                var totalPerProValue = parseFloat(totalPerProElements[i].textContent);

                // Handle NaN or non-numeric values in totalPerProValue
                if (!isNaN(totalPerProValue)) {
                    netPrice += totalPerProValue;
                }
            }

            return netPrice.toFixed(2);
        }

        // Update the net price whenever total_perPro values change
        function updateNetPrice() {
            var netPrice = calculateNetPrice();
            netPriceElement.value = netPrice; // Set value of input instead of textContent
        }

        // Attach an event listener to each input with class "pro_amount"
        var quantityInputs = document.getElementsByClassName("pro_amount");
        for (var i = 0; i < quantityInputs.length; i++) {
            quantityInputs[i].addEventListener("input", updateTotalAndNetPrice);
        }

        // Function to update total price and net price when input changes
        function updateTotalAndNetPrice(event) {
            var input = event.target; // The input element that triggered the event
            var row = input.closest("tr"); // Find the closest parent <tr> element

            var unitPrice = parseFloat(row.cells[2].textContent); // Get the unit price from the third cell
            var quantity = parseFloat(input.value); // Get the entered quantity from the input

            // Handle NaN or empty values
            if (isNaN(quantity)) {
                quantity = 0; // Set quantity to 0 if it's NaN or empty
            }

            var totalPrice = unitPrice * quantity; // Calculate the total price
            var totalCell = row.cells[4].querySelector(".total_perPro"); // Find the total cell

            totalCell.textContent = isNaN(totalPrice) ? "" : totalPrice.toFixed(2); // Update the total cell with the calculated total price or leave it empty

            updateNetPrice(); // Update the net price
        }
    </script>

</body>

</html>