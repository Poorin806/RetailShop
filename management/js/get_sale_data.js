function getSaleData() {
    var sale_id = document.getElementById("sale_id").value;
    console.log(sale_id);

    // Send AJAX request to the PHP file
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "js/get_sale_data.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Parse the JSON response
            if (xhr.responseText == false) {
                alert('ไม่พบรหัสการขาย '+sale_id);
            } else {
                fetchDataAndRefreshTable(sale_id);
                var response = JSON.parse(xhr.responseText);
                var returnHistory = document.getElementById("returnHistory");

                // Update the input fields with the received data
                document.getElementById("sale_id").value = response.sale_id;
                document.getElementById("cust_id").value = response.cust_id;
                document.getElementById("cust_name").value = response.cust_name;
                document.getElementById("sale_date").value = response.sale_date;

                $.ajax({
                    url: "js/get_sale_data.php",
                    method: "POST",
                    data: {
                        function: "returnHistory",
                    },
                    success: function(data) {
                        // Do something
                        alert(data);
                    },
                    error: function(xhr, status, error) {
                        console.log("Error:", error);
                    }
                });

            }
        }
    };

    // Prepare data and send the request
    var data = "sale_id=" + encodeURIComponent(sale_id);
    xhr.send(data);
}