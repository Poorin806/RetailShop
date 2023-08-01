function addProduct() {
    var sale_id = document.getElementById("sale_id").value;
    var pro_id = document.getElementById("pro_id").value;
    var pro_amount = document.getElementById("pro_amount").value;
    var pro_saleprice = document.getElementById("pro_saleprice").value;
    var discount = document.getElementById("discount").value;

    if (pro_id !== null && pro_amount !== null || pro_amount !== 0) {
        // Send AJAX request to the PHP file
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "js/add_product.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                if (xhr.responseText == 'true') {
                    console.log("success");
                    clearProductData();
                    fetchDataAndRefreshTable(sale_id);
                } else {
                    console.log("fail");
                }
            }
        };

        // Prepare data and send the request
        var data = "sale_id=" + encodeURIComponent(sale_id) + "&pro_id=" + encodeURIComponent(pro_id) + "&pro_amount=" + encodeURIComponent(pro_amount) + "&pro_amount=" + encodeURIComponent(pro_amount) + "&pro_saleprice=" + encodeURIComponent(pro_saleprice) + "&discount=" + encodeURIComponent(discount);
        xhr.send(data);
    }
}

function clearProductData() {
    document.getElementById("pro_id").value = null;
    document.getElementById("pro_name").value = null;
    document.getElementById("pro_saleprice").value = null;
    document.getElementById("pro_amount").value = null;
    document.getElementById("total_per_pro").value = null;
    document.getElementById("discount").value = null;
    document.getElementById("pro_id").focus();
}