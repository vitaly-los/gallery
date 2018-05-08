<?php
header("HTTP/1.0 404 Not Found");
switch ($_GET['page']??'') {
    case 'form':
        require('view/form.php');
        break;
    case 'submit':
        require('src/process.php');
        break;
    default:
        require('view/index.php');
}