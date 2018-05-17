<?php

switch ($_GET['page']??'') {
    case 'form':
        require('view/form.php');
        break;
    case 'submit':
        require('src/process.php');
        break;
    case 'login':
        require('view/login.php');
        break;
    default:
        require('view/index.php');
}