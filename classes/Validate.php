<?php

final class Validate
{

    /**
     * Check if input string don't exceeded allowed length . 
     * @param string $value
     * @param int $max
     * @return boolean
     */
    public static function stringMaxLengh(string $value, int $max)
    {
        $lenth = strlen($value);
        return $lenth < $max;
    }

    /**
     * 
     * @param string from $_GET
     * @return sanitized data
     */
    public static function sanitizeGetInput($input)
    {
        $a = implode('', $input);
        return trim(htmlentities($a));
    }

    /**
     * @param string from $_POST
     * @return sanitized data
     */
    public static function sanitizePostInput($input)
    {
        return trim(htmlentities($input));
    }

    /**
     *  Receive data from input post and return true if all correct, or cast error's message
     * @param type $username
     * @param type $password
     * @param type $repass
     * @return boolean
     */
    public static function validateRegister($username, $password, $repass)
    {
        if (empty($username)) {
            $errors[] = 'Login shouldn\'t be empty';
        }

        if (empty($password) && empty($repass)) {
            $errors[] = 'Password shouldn\'t be empty';
        }

        if ($password != $repass) {
            $errors[] = 'Passwords don\'t match';
        }
        if (!empty($errors)) {
            $_SESSION['error'] = $errors;
            return false;
        } else {
            return true;
        }
    }

    /**
     *  Receive data from input post and return true if all correct, or cast error's message
     * @param type $username
     * @param type $password
     * @return boolean
     */
    public static function validateLogin($username, $password)
    {
        if (empty($username)) {
            $errors[] = 'Login shouldn\'t be empty';
        }

        if (empty($password)) {
            $errors[] = 'Password shouldn\'t be empty';
        }
        if (!empty($errors)) {
            $_SESSION['error'] = $errors;
            return false;
        } else {
            return true;
        }
    }

    /**
     * 
     * @param type redirect user
     */
    public static function redirect($to)
    {
        header('Location: ' . $to);
        die('Something went wrong in ' . __FILE__ . ' on ' . __LINE__);
    }

    /**
     *  Receive data from input post and return true if all correct, or cast error's message
     * @param type $author
     * @param type $desc
     * @return boolean
     */
    public static function validateImageUpload($author, $desc)
    {
        if (empty($_FILES['image']['tmp_name'])) {
            $_SESSION['error'][] = 'Please select a file';
            Validate::redirect('form');
        }
        if (empty($author)) {
            $errors[] = 'Author name shouldn\'t be empty';
        }

        if (empty($desc)) {
            $errors[] = 'Description shouldn\'t be empty';
        }
        $ext = $_FILES['image']['type'];
        $allowedExt = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];

        if (!in_array($ext, $allowedExt)) {
            $errors[] = 'Only image in .jpg, png or gif are allowed';
        }


        if ($_FILES['image']['size'] > 5000000) {
            $errors[] = 'Sorry, your file is too large.';
        }

        if (!empty($errors)) {
            $_SESSION['error'] = $errors;
            return false;
        } else {
            return true;
        }
    }

}
