// Search Customer by ID and return Fullname
function searchCustomer() {
    var cust_id = document.getElementById("cust_id").value;

    // Send AJAX request to the PHP file
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "js/search_customer.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Handle the response
            var resultInput = document.getElementById("cust_name");
            resultInput.value = xhr.responseText; // Set the value of the input tag
        }
    };

    // Prepare data and send the request
    var data = "cust_id=" + encodeURIComponent(cust_id);
    xhr.send(data);
}
document.getElementById("cust_id").addEventListener("change", searchCustomer);
