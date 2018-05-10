<?php
require_once './template/header.php';
require_once './imagespath.php';
require_once './functions.php';
?>

<?php

// Filter paramert's from GET form
$page = (string)filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);

switch ($page){
    case 'form':
        require_once './view/form.php';
        break;
    case 'gallery':
        require_once './view/gallery.php';
        break;
    default:
        require_once './index.php';
}

?>

<?php
// URL for images
$content = 'https://picsum.photos/list';

// If external server not work and we receive empty result kill script
if (checkServerStatus($content) == false)
    die('Ooops something went wrong');

// Set returned array for variable
$images = imagesList($content);

// Set number of images on page
$imagesOnPage = 9;
?>

<?php require_once './template/footer.php'; ?>
