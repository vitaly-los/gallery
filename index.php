<?php

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