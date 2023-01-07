<?php

if (isset($_POST['url'])) {
  $url = $_POST['url'];

  // Fetch the content of the requested URL
  $content = file_get_contents($url);

  // Return the content to the iframe
  echo $content;
}

?>
