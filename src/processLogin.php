<?php

$post = $_POST;

if (validateLogin($post) && authUser($post['login'], $post['pass'])) {
    header('Location: /');
} else {
    header('Location: /login');
}

