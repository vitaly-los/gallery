<?php

class User
{

    /**
     * 
     * @param type $username validate data from register form
     * @param type $pass data from login form
     * @return boolean
     */
    public function createUser($username, $pass)
    {
        /**
         * @var $password hashed password for database insertion
         */
        $password = password_hash($pass, PASSWORD_DEFAULT);
        Database::run('INSERT INTO users(user_id, username, password) VALUES(NULL, :username, :password)', [':username' => $username, ':password' => $password]);
        return true;
    }

    /**
     * 
     * @param type $username validate data from login form
     * @param type $password
     * @return bool
     */
    public function checkPassword($username, $password): bool
    {
        $result = Database::run('SELECT password FROM users WHERE username = :username', [':username' => $username]);
        $pass = $result->fetch();
        if (password_verify($password, $pass['password'])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @param type $username select user if all input are correct
     * @return type
     */
    public function loginUser($username)
    {
        $smtm = Database::run('SELECT * FROM users WHERE username = :username', [':username' => $username]);
        $result = $smtm->fetch();
        return $result;
    }

}
