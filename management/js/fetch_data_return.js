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
                console.log('data is null');
            } else {
                // If data is not null and not an empty array, enable the "sale_id" input

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
                  <td>${item.pro_id}</td>
                  <td>${item.pro_name}</td>
                  <td>${item.Amount}</td>
                  <td>${item.Sale_price}</td>
                  <td>${item.Discount}</td>
                  <td>${totalPrice_per_pro}</td>
                  <td><input type="number" name="pro_return_amount" value="0" min="0" max="${item.Amount}" id="pro_return_amount_${item.pro_id}" class="return_amount form-control"></td>
                `;

                tableBody.appendChild(newRow);

                // Limit return amount input

                // Get a reference to the current input element by ID
                const proReturnAmountInput = document.getElementById(`pro_return_amount_${item.pro_id}`);

                // Add an 'input' event listener to the current input element
                proReturnAmountInput.addEventListener("input", function () {
                    const enteredValue = parseInt(proReturnAmountInput.value, 10);
                    const maxValue = parseInt(proReturnAmountInput.max, 10);

                    // Check if the entered value is greater than the maximum value
                    if (enteredValue > maxValue) {
                        // If the entered value exceeds the maximum, update the input's value to the maximum value
                        proReturnAmountInput.value = maxValue;
                    }
                    if (isNaN(enteredValue)) {
                        // If the entered value is not a valid number (e.g., empty input), set it to 0
                        proReturnAmountInput.value = 0;
                        return; // Exit the function, as there's no need to proceed further
                    }
                });

                // Enable / Disable Confirm Return Btn

                // Get all the input elements with the class "form-control"
                const inputElements = document.querySelectorAll('.return_amount');

                // Function to check if any input value is greater than zero
                function checkInputValues() {
                    for (const input of inputElements) {
                        const enteredValue = parseInt(input.value, 10);
                        if (enteredValue > 0) {
                            // If any input value is greater than zero, enable the "Confirm Return" button and return early
                            document.getElementById('btnConfirmReturn').disabled = false;
                            return;
                        }
                    }
                    // If no input value is greater than zero, disable the "Confirm Return" button
                    document.getElementById('btnConfirmReturn').disabled = true;
                }

                // Add an 'input' event listener to each input element
                inputElements.forEach(input => {
                    input.addEventListener('input', checkInputValues);
                });

            });

        })
        .catch(error => console.error("Error fetching data:", error));
}