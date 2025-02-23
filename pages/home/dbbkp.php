<?php
// URL of the API endpoint
$url = 'http://util:5000/api/execute_backup';

// Data to send in the POST request
$data = [
    "id" => "e3e7c4fd-d260-4820-bfe6-0a64910c62b6"
];

// Convert data to JSON
$jsonData = json_encode($data);

// Initialize cURL
$ch = curl_init($url);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return response as a string
curl_setopt($ch, CURLOPT_POST, true);          // Use POST method
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',          // Set content type to JSON
    'Content-Length: ' . strlen($jsonData)     // Set content length
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData); // Attach JSON data

// Execute the request
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
} else {
    // Display the response
    echo 'Response: ' . $response;
}

// Close cURL
curl_close($ch);
?>
