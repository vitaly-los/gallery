<?php

/** Validate field values
 *
 * @param $data
 * @return array|bool
 */
function validate($data)
{
    $errors = array();

    if (empty($data['authorname']) || strlen($data['authorname']) > 40) {
        $errors[] = 'Author shouldn\'t be empty or more 40 characters';
    }

    if (empty($data['description']) || strlen($data['description']) > 255) {
        $errors[] = 'Description shouldn\'t be empty or more 255 characters';
    }

    if (!empty($errors)) {
        return $errors;
    } else {
        return true;
    }
}

/** Processing data from form
 *
 * @param $data
 */
function process(&$data)
{
    if (is_array($data)) {
        foreach ($data as &$value) {
            addslashes($value);
        }
    }
}

$request = $_REQUEST;
if (($valid = validate($request)) === true) {
    process($request);
    header('Location: /');
} else {

    header('Location: /form?' . http_build_query(array('errors' => $valid)));
}
