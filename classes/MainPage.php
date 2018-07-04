<?php

class MainPage
{

    /**
     * Construct register given function as __autoload() implementation
     * 
     */
    public function __construct()
    {
        spl_autoload_register(function ($classname) {
            require_once('./classes/' . $classname . '.php');
        });
    }

    /**
     * Receive url query and include file depending on request
     */
    public function returnPage()
    {
        /**
         * @var $getinput receive GET query 
         * @return validate request query for next action
         */
        $getinput = Validate::sanitizeGetInput($_GET);
        $page = $getinput . '.php';
        $files = scandir('./view/');

        if (in_array($page, $files)) {
            if (file_exists('./view/' . $page)) {
                include_once ('./view/' . $page);
            }
        } elseif (in_array($getinput, get_class_methods('UserAction'))) {
            $useraction = new UserAction();
            $useraction->$getinput();
        } elseif (in_array('delete', $_GET)) {
            $useraction = new UserAction();
            $useraction->delete();
        } elseif ($getinput = '' or $getinput = '/' or $getinput = 'index') {
            include_once ('./view/index.php');
        }
    }

}
