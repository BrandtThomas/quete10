<?php

class Database{
    
    public static function dbConnect(){
        return new PDO(
            'mysql:host=localhost;dbname=quete10;charset=UTF8',
            'root',
            '',
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }
}

