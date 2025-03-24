<?php

namespace Utente\Sakila2 ;

class DBConfig{

    public string $host;

    public string $port;

    public string $DBName;

    public string $user;

    public string $password;

    public function __construct(string $host, string $port, string $DBName, string $user, string $password){

        $this->host = $host;
        $this->port = $port;
        $this->DBName = $DBName;
        $this->user = $user;
        $this->password = $password;
    }
}