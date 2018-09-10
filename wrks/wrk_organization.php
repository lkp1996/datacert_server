<?php

class WrkOrganization
{
    private $connection;

    public function get_organizations_list(DBConnection $db_connection, $pk_auditor)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT pk_organization, name, headquartersLocation FROM organization";
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $emparray[] = $row;
            }
        } else {
        }
        mysqli_close($this->connection);
        return json_encode($emparray);
    }

    public function get_organization_profile(DBConnection $db_connection, $pk_organization)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM organization WHERE pk_organization = $pk_organization";
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $emparray[] = $row;
            }
        } else {
        }
        mysqli_close($this->connection);
        return json_encode($emparray);
    }

    public function get_organization_audits_list(DBConnection $db_connection, $pk_organization)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT pk_report, name FROM report WHERE fk_organization = $pk_organization";
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $emparray[] = $row;
            }
        } else {
        }
        mysqli_close($this->connection);
        return json_encode($emparray);
    }

    public function add_organization(DBConnection $db_connection, $pk_employee)
    {
        $message = "";
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM internalqualificationprocess";
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $sql = "INSERT INTO internalqualificationprocess_employee (fk_internalQualificationProcess, fk_employee, yesno, result, validationDate, attachement) VALUES ('" . $row["pk_internalQualificationsProcess"] . "', '" . $pk_employee . "', '0', '', NULL, NULL)";
                if ($this->connection->query($sql)) {
                    $message .= "Internal qualification process employee with fk " . $row["pk_internalQualificationsProcess"] . " added successfully \n";
                } else {
                    $message .= "Error while adding internal qualification process employee with fk " . $row["pk_internalQualificationsProcess"] . " \n";
                }
            }
        } else {
        }
        mysqli_close($this->connection);
        return $message;
    }

    public function update_organization(DBConnection $db_connection, $organization)
    {
        $message = "";
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }

        foreach ($organization as $updatedIntQualProcess) {
            if ($updatedIntQualProcess->yesno == false) {
                $updatedIntQualProcess->yesno = 0;
            } else {
                $updatedIntQualProcess->yesno = 1;
            }
            $sql = "UPDATE internalqualificationprocess_employee SET yesno = '$updatedIntQualProcess->yesno', result = '" . addslashes($updatedIntQualProcess->result) . "', validationDate = '$updatedIntQualProcess->validationDate', attachement = '$updatedIntQualProcess->attachement' WHERE internalqualificationprocess_employee.fk_internalQualificationProcess = $updatedIntQualProcess->pk_internalQualificationsProcess AND internalqualificationprocess_employee.fk_employee = $updatedIntQualProcess->fk_employee";
            if ($this->connection->query($sql)) {
                $message .= "Internal qualification_employee with pk $updatedIntQualProcess->pk_internalQualificationsProcess updated \n";
            } else {
                $message .= "Error while updating internal qualification_employee with fk internal qualification $updatedIntQualProcess->pk_internalQualificationsProcess and fk employee $updatedIntQualProcess->fk_employee \n";
            }
        }

        $this->connection->close();
        return $message;
    }

}

?>