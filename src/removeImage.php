<?php

$path = $_REQUEST['path'];

deleteImage($path);

header('Location: /');