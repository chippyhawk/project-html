<?php

// Get the URL to be proxied
$url = $_GET['url'];

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

// Execute the request and get the response
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    // An error occurred, print the error message
    print curl_error($ch);
} else {
    // No errors, check the HTTP status code
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($status_code == 200) {
        // The request was successful, print the response
        print $response;
    } else {
        // The request was not successful, print the status code
        print "Status code: $status_code\n";
    }
}

// Close the cURL handle
curl_close($ch);

?>
