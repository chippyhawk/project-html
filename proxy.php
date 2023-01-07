<?php

// Get the URL to be proxied
$url = $_GET['url'];

// Validate the URL
if (!filter_var($url, FILTER_VALIDATE_URL)) {
    // The URL is not valid, return an error message
    http_response_code(400);
    die("Error: Invalid URL");
}

// Set the user agent to use
$user_agent = 'MyProxy/1.0';

// Set the timeout limit for the request
$timeout = 5;

// Initialize cURL and set the options
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

// Set the host header to use your domain
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Host: chicago2.org"
));

// Execute the request and get the response
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    // An error occurred, return an error message
    http_response_code(500);
    die("Error: " . curl_error($ch));
} else {
    // No errors, check the HTTP status code
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($status_code == 200) {
        // The request was successful, return the response
        header("Content-Type: text/html");
        print $response;
    } else {
        // The request was not successful, return the status code
        http_response_code($status_code);
        die("Error: HTTP status code $status_code");
    }
}

// Close the cURL handle
curl_close($ch);

?>
