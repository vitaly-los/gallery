<?php

session_start();
//loaded file with all  functions
require_once('src/app.php');

switch (isAllowedPage($_GET['page']??'')) {
    case 'form':
        require('view/form.php');
        break;
    case 'submit':
        require('src/process.php');
        break;
    case 'login':
        require('view/login.php');
        break;
    case 'processLogin':
        require('src/processLogin.php');
        break;
    default:
        require('view/index.php');
}