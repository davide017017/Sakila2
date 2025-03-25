<?php

namespace Utente\Sakila2\Database ;

class DBConfig{

    public string $host;

    public string $port;

    public string $dbName;

    public string $user;

    public string $password;

    public function __construct(string $host, string $port, string $dbName, string $user, string $password){

        $this->host = $host;
        $this->port = $port;
        $this->dbName = $dbName;
        $this->user = $user;
        $this->password = $password;
    }
}

?>