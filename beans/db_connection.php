<?php

class DBConnection
{
    private $dbname;
    private $username;
    private $password;
    private $server;

    public function __construct($dbname, $username, $password, $server)
    {
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
        $this->server = $server;
    }

    public function get_dbname()
    {
        return $this->dbname;
    }

    public function set_dbnamed($dbname)
    {
        $this->dbname = $dbname;
    }

    public function get_username()
    {
        return $this->username;
    }

    public function set_username($username)
    {
        $this->username = $username;
    }

    public function get_password()
    {
        return $this->password;
    }

    public function set_password($password)
    {
        $this->password = $password;
    }

    public function get_server()
    {
        return $this->server;
    }

    public function set_server($server)
    {
        $this->server = $server;
    }
}

?>