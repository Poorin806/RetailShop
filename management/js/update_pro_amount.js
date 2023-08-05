document.getElementById("btnConfirmReturn").addEventListener("click", function() {
    const rowsData = []; // Array to store data from each row

    // Loop through each row and collect the data
    data.forEach(item => {
        const proId = item.pro_id;
        const proReturnAmount = document.getElementById(`pro_return_amount_${proId}`).value;

        // Add the data to the rowsData array
        rowsData.push({
            pro_id: proId,
            pro_return_amount: proReturnAmount
        });
    });

    // Send the data to the PHP file using AJAX
    fetch("js/update_pro_amount.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(rowsData)
        })
        .then(response => response.json())
        .then(responseData => {
            // Handle the response from the PHP file if needed
            console.log("Response from PHP file:", responseData);
        })
        .catch(error => console.error("Error sending data to PHP file:", error));
});