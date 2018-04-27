<?php

define('TITLE', 'My Demo Gallery'); // Add default title to index page

// Get list of images in JSON format
$content = file_get_contents('https://picsum.photos/list');
// Convert it into arrray
$json = json_decode($content, true);
// If something went wrong asign default image
$defaultImage = 'https://fakeimg.pl/1024x680/';

?>
