<?php

class WrkUserType
{
    private $connection;

    public function get_user_type(DBConnection $db_connection, $fk_userType)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT userType.type FROM userType WHERE pk_userType = $fk_userType";
        //$sql = "SELECT isAdmin FROM auditor WHERE pk_auditor = $pk_auditor";
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $emparray = $row["type"];
            }
        }
        $this->connection->close();
        return $emparray;
    }

    public function get_type_list(DBConnection $db_connection)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM userType";
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $emparray[] = $row;
            }
        }
        $this->connection->close();
        return json_encode($emparray);
    }
}

?>