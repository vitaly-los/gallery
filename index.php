<?php
error_reporting(E_ALL | E_STRICT);
session_start();
//loaded file with all  functions
require_once('src/app.php');

//registered error handler and shutdown functions
set_error_handler('errorHandler', -1);
set_exception_handler('exceptionHandler');
register_shutdown_function('shutDown');

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
        case 'logout':
        require('src/logout.php');
        break;
    case 'processLogin':
        require('src/processLogin.php');
        break;
    case 'register':
        require('view/register.php');
        break;
    case 'processRegister':
        require('src/processRegister.php');
        break;
    case 'removeImage':
        require('src/removeImage.php');
        break;
    default:
        require('view/index.php');
}