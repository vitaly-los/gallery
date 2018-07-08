<?php

class Session
{

    private $logged = false;
    public $userid;

    public function __construct()
    {
        session_start();
        session_regenerate_id();
        $this->checkLogin();
    }

    private function checkLogin()
    {
        if (isset($_SESSION['user_id'])) {
            $this->userid = $_SESSION['user_id'];
            $this->logged = true;
        } else {
            $this->logged = false;
        }
    }

    /**
     *  database should find user based on username/password
     */
    public function sessionLogin($userid)
    {
        $this->userid = $_SESSION['user_id'] = $userid;
        $this->logged = true;
    }

}
