function searchProduct() {
    const pro_id = document.getElementById("pro_id").value;

    // Send AJAX request to the PHP file
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "js/search_product.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {

            if(xhr.responseText==false){
                alert('ไม่พบสินค้ารหัส '+pro_id);
                document.getElementById('pro_id').focus();
                document.getElementById('pro_name').value='';
                document.getElementById('pro_saleprice').value='';
                document.getElementById('pro_amount').value='';
                document.getElementById('total_per_pro').value='';
                document.getElementById('discount').value='';
            }else{
                // Parse the JSON response
                var response = JSON.parse(xhr.responseText);
                
                // Update the input fields with the received data
                var pro_nameInput = document.getElementById("pro_name");
                pro_nameInput.value = response.pro_name;
                
                var pro_priceInput = document.getElementById("pro_saleprice");
                pro_priceInput.value = response.pro_saleprice;
                
                const pro_amount = document.getElementById("pro_amount");
                
                pro_amount.min = 0;
                pro_amount.max = response.pro_amount;      
            }
        };
    };

    // Prepare data and send the request
    var data = "pro_id=" + encodeURIComponent(pro_id);
    xhr.send(data);
}
document.getElementById("pro_id").addEventListener("change", searchProduct);

// Add an 'input' event listener to the current input element
pro_amount.addEventListener("input", function () {
    console.log('pro_amount input');
    const enteredValue = parseInt(pro_amount.value, 10);
    const maxValue = parseInt(pro_amount.max, 10);

    // Check if the entered value is greater than the maximum value
    if (enteredValue > maxValue) {
        // If the entered value exceeds the maximum, update the input's value to the maximum value
        pro_amount.value = maxValue;
    }
    if (isNaN(enteredValue)) {
        // If the entered value is not a valid number (e.g., empty input), set it to 0
        pro_amount.value = 0;
        return; // Exit the function, as there's no need to proceed further
    }
});
