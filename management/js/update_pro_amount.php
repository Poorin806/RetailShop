<?php
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the JSON data from the request body
    $json_data = file_get_contents("php://input");

    // Check if JSON data was received successfully
    if ($json_data === false) {
        // Handle the error if needed
        http_response_code(400); // Bad Request
        die("Error receiving data");
    }

    // Decode the JSON data into an associative array
    $rowsData = json_decode($json_data, true);

    // Check if JSON decoding was successful
    if ($rowsData === null) {
        // Handle the error if needed
        http_response_code(400); // Bad Request
        die("Error decoding JSON data");
    }

    // At this point, $rowsData contains the data sent from JavaScript as an array of associative arrays

    // Now you can process the data as needed, for example, you can loop through the rowsData array and access each row's data like this:

    foreach ($rowsData as $row) {
        $pro_name = $row["pro_name"];
        $pro_return_amount = $row["pro_return_amount"];

        // Perform your SQL operations using $pro_name and $pro_return_amount
        // Make sure to sanitize and validate the data before using it in SQL queries to prevent SQL injection vulnerabilities
        // Your SQL operations here...
    }

    // Respond with a success message if needed
    echo "Data received successfully and processed!";
} else {
    http_response_code(405); // Method Not Allowed
    die("Invalid request method");
}
