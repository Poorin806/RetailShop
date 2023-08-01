function fetchDataAndRefreshTable(sale_id) {
    console.log('fetchDataAndRefreshTable');
    console.log("sale from fetch function id = " + sale_id);
    // Send AJAX request to the PHP file to fetch the updated data
    fetch("js/fetch_data.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "sale_id=" + encodeURIComponent(sale_id)
    })
        .then(response => response.json())
        .then(data => {
            console.log("Received JSON data:");
            console.log(data); // Log the received JSON data for debugging
            if (data === null || data.length === 0) {
                // If data is null or an empty array, disable the "receive_change" input
                document.getElementById("receive_price").value = null;
                document.getElementById("change_price").value = null;
                document.getElementById("receive_price").disabled = true;

                document.getElementById("btnConfirmSale").disabled = true;
                document.getElementById("btnCancelSale").disabled = true;
            } else {
                // If data is not null and not an empty array, enable the "sale_id" input
                document.getElementById("receive_price").disabled = false;

                document.getElementById("btnConfirmSale").disabled = false;
                document.getElementById("btnCancelSale").disabled = false;
            }

            // Clear the existing table rows
            var tableBody = document.querySelector("tbody");
            tableBody.innerHTML = "";

            let totalSalePrice = 0;
            let totalDiscount = 0;

            // Process the data and update the table
            data.forEach(item => {
                console.log("Processing item:");
                console.log(item); // Log each item for debugging

                const totalPrice_per_pro = (item.Amount * item.Sale_price - item.Discount).toFixed(2);

                var newRow = document.createElement("tr");
                newRow.innerHTML = `
                    <td>${item.Sale_id}</td>
                    <td>${item.pro_name}</td>
                    <td>${item.Amount}</td>
                    <td>${item.Sale_price}</td>
                    <td>${item.Discount}</td>
                    <td>${totalPrice_per_pro}</td>
                    <td><button type="button" class="btn btn-outline-danger" onclick="deleteRow('${item.pro_id}')"><i class="bi bi-x-circle-fill"></i></button></td>
                `;

                tableBody.appendChild(newRow);

                // Calculate summary values and add to the totals
                totalSalePrice += parseFloat(item.Amount*item.Sale_price);
                totalDiscount += parseFloat(item.Discount);

            });

            //Display summary and calculate net price
            document.getElementById("total_price").value = totalSalePrice.toFixed(2);
            document.getElementById("net_discount").value = totalDiscount.toFixed(2);
            document.getElementById("net_discount_hidden").value = totalDiscount.toFixed(2);
            var net_price = totalSalePrice - totalDiscount;
            document.getElementById("net_price").value = net_price.toFixed(2);
            document.getElementById("net_price_hidden").value = net_price.toFixed(2);
        })
        .catch(error => console.error("Error fetching data:", error));
}