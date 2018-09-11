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

    public function add_organization(DBConnection $db_connection, $organization)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
        $sql = "INSERT INTO organization (pk_organization, name, contactLastName, contactFirstName, phone, email)
            VALUES (NULL, '" . addslashes($organization->name) . "', '" . addslashes($organization->contactLastName) . "', '" . addslashes($organization->contactFirstName)
            . "', '" . $organization->phone . "', '" . addslashes($organization->email) . "')";
        if ($this->connection->query($sql)) {
            $last_id = $this->connection->insert_id;
        } else {
            $last_id = null;
        }

        $this->connection->close();
        return $last_id;
    }

    public function update_organization(DBConnection $db_connection, $organization)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }

        $sql = "UPDATE organization SET name = '" . addslashes($organization->name) . "', email = '" . addslashes($organization->email) . "', phone = '" . addslashes($organization->phone) . "', 
                    website = '" . addslashes($organization->website) . "', branches = '" . addslashes($organization->branches) . "', contactLastName = '" . addslashes($organization->contactLastName) . "', 
                    contactFirstName = '" . addslashes($organization->contactFirstName) . "', generalDescription = '" . addslashes($organization->generalDescription) . "', 
                    outsourcedProcessAndProductsDescription = '" . addslashes($organization->outsourcedProcessAndProductsDescription) . "', headquartersName = '" . addslashes($organization->headquartersName) . "', 
                    headquartersNP = '" . addslashes($organization->headquartersNP) . "', headquartersAddress = '" . addslashes($organization->headquartersAddress) . "', 
                    headquartersLocation = '" . addslashes($organization->headquartersLocation) . "', employeesNumber = '$organization->employeesNumber', fullTimeNumber = '$organization->fullTimeNumber', 
                    changesSinceLastAudit = '" . addslashes($organization->changesSinceLastAudit) . "' WHERE organization.pk_organization = $organization->pk_organization";
        if ($this->connection->query($sql)) {
            $message = "OK";
        } else {
            $message = "KO";
        }

        $this->connection->close();
        return $message;
    }

    public function get_addresses(DBConnection $db_connection, $pk_organization)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM address WHERE fk_organization = $pk_organization";
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

    public function update_addresses(DBConnection $db_connection, $addresses)
    {
        $message = "";
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }

        $sql = "SELECT * FROM address WHERE fk_organization = " . $addresses[0]->fk_organization;
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $oldAddresses[] = $row;
            }
        }

        foreach ($addresses as $updatedAddress) {
            if ($updatedAddress->pk_address == null) {
                //if there's new addresses (insert)
                $sql = "INSERT INTO address (pk_address, np, address, location, country, fk_organization) 
                      VALUES (NULL, '$updatedAddress->np', '" . addslashes($updatedAddress->address) . "', '" . addslashes($updatedAddress->location) . "', 
                      '" . addslashes($updatedAddress->country) . "', '$updatedAddress->fk_organization')";
                if ($this->connection->query($sql)) {
                    $message .= "New address « $updatedAddress->pk_formation » added \n";
                } else {
                    $message .= "Error while adding new address « $updatedAddress->address » \n";
                }
            } else {
                //if address already exist (update)
                $sql = "UPDATE address SET np = '$updatedAddress->np', 
                          address = '" . addslashes($updatedAddress->address) . "', location = '" . addslashes($updatedAddress->location) . "', 
                          country = '" . addslashes($updatedAddress->country) . "' WHERE pk_address = $updatedAddress->pk_address";
                if ($this->connection->query($sql)) {
                    $message .= "Address with pk $updatedAddress->pk_address updated \n";
                } else {
                    $message .= "Error while updating address with pk $updatedAddress->pk_address \n";
                }
            }
        }
        foreach ($oldAddresses as $oldAddress) {
            $stillExist = false;
            foreach ($addresses as $updatedAddress) {
                //$message .= "updated pk" . $updatedAddress->pk_address . "\n" . "old pk " . $oldAddress["pk_address"] . "\n";
                if ($updatedAddress->pk_address == $oldAddress["pk_address"]) {
                    $stillExist = true;
                }
            }
            if (!$stillExist) {
                $sql = "DELETE FROM address WHERE pk_address = " . $oldAddress["pk_address"];
                if ($this->connection->query($sql)) {
                    $message .= "Address with pk " . $oldAddress["pk_address"] . " deleted \n";
                } else {
                    $message .= "Error while deleting address with pk " . $oldAddress["pk_address"] . "\n";
                }
            }
        }

        $this->connection->close();
        return $message;
    }

}

?>