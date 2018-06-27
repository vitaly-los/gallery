<?php

require './Database.php';

class User
{
    public function __construct()
    {
        ;
    }
}

$row = Database::run('select * from users');
var_dump($row);