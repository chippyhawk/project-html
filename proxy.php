<?php

// Get the URL to be proxied from the "url" query parameter
$url = $_GET['url'];

// Validate the URL
if ($url == '') {
    die('Error: No URL provided');
}
if (!preg_match('/^https?:\/\//', $url)) {
    $url = 'http://' . $url;
}

// Set the user agent to use
$options = array(
    'http' => array(
        'header' => "User-Agent: MyProxy/1.0\r\n",
    ),
);

// Set the timeout limit for the request
$context = stream_context_create($options);
$timeout = 5;

// Execute the request and return the response
echo file_get_contents($url, false, $context, -1, $timeout);

?>
