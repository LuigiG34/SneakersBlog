<?php

namespace LuigiG34\App\Models;

use PDO;

class DatabaseClass {

    private static $pdo;

    // on définie la BDD
    private function setDB()
    {
        self::$pdo = new PDO("mysql:host=localhost;dbname=blog;charset=utf8","root","");

        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    // on récupere la BDD
    protected function getDB()
    {
        if(self::$pdo === null){
            $this->setDB();
        }
        return self::$pdo;
    }
}