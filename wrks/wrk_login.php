<?php

class WrkLogin
{
    private $connection;

    public function login(DBConnection $db_connection, $user)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM employee WHERE username = '$user->username' AND password = '$user->password'";
        $result = mysqli_query($this->connection, $sql);
        $exist = false;
        if (mysqli_num_rows($result) > 0) {
            $exist = true;
        }

        mysqli_close($this->connection);
        return $exist;
    }
}

?>