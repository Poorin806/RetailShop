function createSaleId(){
    var sale_id = document.getElementById("sale_id").value;
    document.getElementById("sale_id_hidden").value = sale_id;
    var cust_id = document.getElementById("cust_id").value;
    var sale_date = document.getElementById("sale_date").value;
    console.log('Create sale ID clicked');
    console.log(sale_id);
    console.log(cust_id);
    console.log(sale_date);


    // Send AJAX request to the PHP file
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "js/create_saleId.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            if (xhr.responseText=='true'){
                console.log("สร้างรายการขายสำเร็จ");
                var btn = document.getElementById("btn_addProduct");
                btn.classList.remove("btn-secondary");
                btn.classList.remove("disabled");
                btn.classList.add("btn-primary");
                btn.classList.add("enabled");
                document.getElementById("create_saleId").classList.add("disabled");
                document.getElementById("sale_id").disabled = true;
                document.getElementById("cust_id").disabled = true;
                document.getElementById("pro_id").focus();
                document.getElementById("btnCancelSale").disabled = false;
            }else{
                console.log("สร้างรายการขายไม่สำเร็จ");
                alert('สร้างรายการขายไม่สำเร็จ')
            }
        }
    };

    // Prepare data and send the request
    var data = "sale_id=" + encodeURIComponent(sale_id) + "&cust_id=" + encodeURIComponent(cust_id) + "&sale_date=" + encodeURIComponent(sale_date);
    xhr.send(data);
    console.log(data);
}