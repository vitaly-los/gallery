<?php

/**
 * Class receive url request and depend on user's action make request and redirect user or cast error message
 */
class UserAction
{

    /**
     * validate all user input and register user or cast error if something went wrong
     */
    public function userRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $username = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
            $repass = filter_input(INPUT_POST, 'repass', FILTER_SANITIZE_STRING);

            if (Validate::validateRegister($username, $password, $repass) == false) {
                Validate::redirect('register');
            } else {
                $user = new User();

                if ($user->createUser($username, $password) == true) {
                    $_SESSION['username'] = $username;
                    $_SESSION['success'] = 'You successfully register on our site! Now you can login';
                    Validate::redirect('login');
                }
            }
        }
    }

    /**
     * validate all user input and login user or cast error if something went wrong
     */
    public function userLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);

            if (Validate::validateLogin($username, $password) == false) {
                Validate::redirect('login');
            } else {
                $user = new User();
            }

            if ($user->checkPassword($username, $password) == true) {
                if ($user->loginUser($username) == true) {
                    $row = $user->loginUser($username);
                    //$_SESSION['user_id'] = $row['user_id']; // @todo delete after testin session
                    $session = new Session();
                    $session->sessionLogin($row['user_id']);
                    $_SESSION['username'] = $row['username'];
                    Validate::redirect('index');
                } else {
                    $_SESSION['error'][] = 'Something went wrong. Please try again';
                    Validate::redirect('login');
                }
            } else {
                $_SESSION['error'][] = 'Password don\'t match! Please try again';
                Validate::redirect('login');
            }
        }
    }

    /**
     * upload image and redirect user to main page or cast error if something went wrong
     */
    public function upload()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $authorname = filter_input(INPUT_POST, 'authorname', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

            if (Validate::validateImageUpload($authorname, $description) == true) {
                $image = new Image();

                if ($image->saveImage($authorname, $description) == true) {
                    $_SESSION['success'] = 'You successfully upload image!';
                    Validate::redirect('index');
                }
            } else {
                Validate::redirect('form');
            }
        }
    }

    /**
     * logout user, destroy all session array and redirect user to main page
     */
    public function logout()
    {
        unset($_SESSION);
        session_destroy();
        Validate::redirect('index');
    }

    /**
     * receive image id by get request and delete image from database and server. Supress @error message if file doesn't exists
     * Check if user are image's owner but don't prevent from query injection
     */
    public function delete()
    {
        if (!empty($_GET['id']) && isset($_SESSION['user_id'])) {
            $id = (int) $_GET['id'];
            $result = Database::run("SELECT image_path, thumbnail_path FROM images WHERE image_id = :image_id", [':image_id' => $id]);
            $row = $result->fetch();
            @unlink($row['image_path']);
            @unlink($row['thumbnail_path']);
            Database::run("DELETE FROM images WHERE image_id = :image_id", [':image_id' => $id]);
            $_SESSION['success'] = 'You have deleted image';
            Validate::redirect('index');
        } else {
            Validate::redirect('index');
        }
    }

}
