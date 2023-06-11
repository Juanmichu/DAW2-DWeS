<?php

namespace Controllers;

use Models\MySQLConnector;

class Dispatcher
{

    /** @var MySQLConnector $mySqlConnector */
    protected $mySqlConnector;
    public function __construct()
    {
        $this->mySqlConnector = new MySQLConnector();
    }
}