<?php

require_once('src/app.php');

$request = $_REQUEST;

if (($valid = validate($request)) === true) {
    if (save()) {
        header('Location: /');
    } else {
        header('Location: /form?' . http_build_query(array('errors[]' => 'Something went wrong')));
    }
} else {
    header('Location: /form?' . http_build_query(array('errors' => $valid)));
}