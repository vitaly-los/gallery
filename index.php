<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php

require './classes/MainPage.php';

$main = new MainPage();
$session = new Session();
$main->returnPage();

