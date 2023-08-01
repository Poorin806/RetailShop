function searchProduct() {
    var pro_id = document.getElementById("pro_id").value;

    // Send AJAX request to the PHP file
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "js/search_product.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Parse the JSON response
            var response = JSON.parse(xhr.responseText);

            // Update the input fields with the received data
            var pro_nameInput = document.getElementById("pro_name");
            pro_nameInput.value = response.pro_name;

            var pro_priceInput = document.getElementById("pro_saleprice");
            pro_priceInput.value = response.pro_saleprice;

            var pro_amount = document.getElementById("pro_amount");

            pro_amount.min = 0;
            pro_amount.max = response.pro_amount;
        }
    };

    // Prepare data and send the request
    var data = "pro_id=" + encodeURIComponent(pro_id);
    xhr.send(data);
}
document.getElementById("pro_id").addEventListener("change", searchProduct);
