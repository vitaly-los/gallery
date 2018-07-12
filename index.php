<?php

require './classes/MainPage.php';

$main = new MainPage();
$session = new Session();
$main->returnPage();
$log = new Logger();

