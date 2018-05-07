<?php
/**
*  Because of educational purpose and lack of time
* I didn't made checking for empty result from external servers
*/
define('TITLE', 'My Demo Gallery'); // Add default title to index page

// Get list of images in JSON format
$content = file_get_contents('https://picsum.photos/list');
// Convert it into arrray
$json = json_decode($content, true);
// If something went wrong asign default image
$defaultImage = 'https://fakeimg.pl/1024x680/';

?>
