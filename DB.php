<?php

    class DB
    {

        public function connect()
    {
        $conn = new PDO( parse_ini_file(".env")['host'],parse_ini_file(".env")['user'],parse_ini_file(".env")['pass']);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

        return $conn;
    }
    }

    