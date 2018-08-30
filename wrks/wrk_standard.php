<?php

class WrkStandard
{
    private $connection;

    public function get_standard_list(DBConnection $db_connection)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM standard";
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $emparray[] = $row;
            }
        } else {
            echo "No standard available";
        }
        mysqli_close($this->connection);
        return json_encode($emparray);
    }
}

?>