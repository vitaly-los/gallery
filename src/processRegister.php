<?php

$post = $_POST;

if (validateRegistration($post) && createUser($post['login'], $post['pass'], $post['repass'])) {
    header('Location: /');
} else {
    header('Location: /register');
}

