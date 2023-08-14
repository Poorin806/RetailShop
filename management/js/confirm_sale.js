document.getElementById('btnConfirmSale').addEventListener("click", function () {

    // $sale_id = $_POST['sale_id_hidden'];
    // $net_price = $_POST['net_price_hidden'];
    // $net_discount = $_POST['net_discount_hidden'];
    // $sale_status = 0;

    const sale_id = document.getElementById("sale_id").value;
    const net_price = document.getElementById("net_price").value;
    const net_discount = document.getElementById("net_discount").value;
    const sale_status = 0;

    console.log(sale_id);
    console.log(net_price);
    console.log(net_discount);
    console.log(sale_status);


    alert('ยืนยันการขาย');
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "js/confirm_sale.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            if (xhr.responseText) {
                // alert('ไปยังหน้าพิมพ์ใบเสร็จ');
                window.location.href='receipt.php?sale_id='+sale_id;
            } else {
                alert('ยืนยันการขายไม่สำเร็จ');
            }
        }
    };

    // Prepare data and send the request
    var data = "sale_id=" + encodeURIComponent(sale_id) + "&net_price=" + encodeURIComponent(net_price) + "&net_discount=" + encodeURIComponent(net_discount) + "&sale_status=" + encodeURIComponent(sale_status);
    xhr.send(data);
    // console.log(data);
});