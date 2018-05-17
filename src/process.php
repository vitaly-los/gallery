<?php

$request = $_REQUEST;

if (($valid = validateUpload($request)) === true) {
    if (save()) {
        header('Location: /');
    } else {
        header('Location: /form?' . http_build_query(array('errors[]' => 'Something went wrong')));
    }
} else {
    header('Location: /form?' . http_build_query(array('errors' => $valid)));
}
