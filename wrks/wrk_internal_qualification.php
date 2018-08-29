<?php

class WrkInternalQualification
{
    private $connection;

    public function get_internal_qualification_process_list(DBConnection $db_connection, $employee)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT internalqualificationprocess.pk_internalQualificationsProcess, internalqualificationprocess.process, internalqualificationprocess_employee.yesno, internalqualificationprocess_employee.fk_employee, internalqualificationprocess_employee.result, internalqualificationprocess_employee.validationDate, internalqualificationprocess_employee.attachement FROM internalqualificationprocess inner join internalqualificationprocess_employee on internalqualificationprocess.pk_internalQualificationsProcess = internalqualificationprocess_employee.fk_internalQualificationProcess where internalqualificationprocess_employee.fk_employee =" . $employee;
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row["yesno"] == 0) {
                    $row["yesno"] = false;
                } else {
                    $row["yesno"] = true;
                }
                $emparray[] = $row;
            }
        } else {
        }
        mysqli_close($this->connection);
        return json_encode($emparray);
    }

    public function get_internal_qualification_capacity_list(DBConnection $db_connection, $employee)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT internalqualificationcapacity.pk_internalQualificationsCapacity, internalqualificationcapacity.capacity, internalqualificationcapacity_employee.yesno, internalqualificationcapacity_employee.fk_employee, internalqualificationcapacity_employee.result, internalqualificationcapacity_employee.validationDate, internalqualificationcapacity_employee.attachement FROM internalqualificationcapacity inner join internalqualificationcapacity_employee on internalqualificationcapacity.pk_internalQualificationsCapacity = internalqualificationcapacity_employee.fk_internalQualificationCapacity where internalqualificationcapacity_employee.fk_employee =" . $employee;
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row["yesno"] == 0) {
                    $row["yesno"] = false;
                } else {
                    $row["yesno"] = true;
                }
                $emparray[] = $row;
            }
        } else {
        }
        mysqli_close($this->connection);
        return json_encode($emparray);
    }

    public function get_internal_qualification_standard_list(DBConnection $db_connection, $employee)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT internalqualificationstandard.pk_internalQualificationsStandard, internalqualificationstandard.standard, internalqualificationstandard_employee.yesno, internalqualificationstandard_employee.fk_employee, internalqualificationstandard_employee.concernedScope, internalqualificationstandard_employee.attachement FROM internalqualificationstandard inner join internalqualificationstandard_employee on internalqualificationstandard.pk_internalQualificationsStandard = internalqualificationstandard_employee.fk_internalQualificationStandard where internalqualificationstandard_employee.fk_employee =" . $employee;
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row["yesno"] == 0) {
                    $row["yesno"] = false;
                } else {
                    $row["yesno"] = true;
                }
                $emparray[] = $row;
            }
        } else {
        }
        mysqli_close($this->connection);
        return json_encode($emparray);
    }

    public function add_default_internal_qualification_process(DBConnection $db_connection, $pk_employee)
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

    public function add_default_internal_qualification_capacity(DBConnection $db_connection, $pk_employee)
    {
        $message = "";
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM internalqualificationcapacity";
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $sql = "INSERT INTO internalqualificationcapacity_employee (fk_internalQualificationCapacity, fk_employee, yesno, result, validationDate, attachement) VALUES ('" . $row["pk_internalQualificationsCapacity"] . "', '" . $pk_employee . "', '0', '', NULL, NULL)";
                if ($this->connection->query($sql)) {
                    $message .= "Internal qualification capacity employee with fk " . $row["pk_internalQualificationsCapacity"] . " added successfully \n";
                } else {
                    $message .= "Error while adding internal qualification capacity employee with fk " . $row["pk_internalQualificationsCapacity"] . " \n";
                }
            }
        } else {
        }
        mysqli_close($this->connection);
        return $message;
    }

    public function add_default_internal_qualification_standard(DBConnection $db_connection, $pk_employee)
    {
        $message = "";
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM internalqualificationstandard";
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $sql = "INSERT INTO internalqualificationstandard_employee (fk_internalQualificationStandard, fk_employee, yesno, attachement, concernedScope) VALUES ('" . $row["pk_internalQualificationsStandard"] . "', '" . $pk_employee . "', '0', NULL, NULL)";
                if ($this->connection->query($sql)) {
                    $message .= "Internal qualification standard employee with fk " . $row["pk_internalQualificationsStandard"] . " added successfully \n";
                } else {
                    $message .= "Error while adding internal qualification standard employee with fk " . $row["pk_internalQualificationsStandard"] . " \n";
                }
            }
        } else {
        }
        mysqli_close($this->connection);
        return $message;
    }

    public function update_internal_qualifications_process(DBConnection $db_connection, $internalQualificationsProcess)
    {
        $message = "";
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }

        foreach ($internalQualificationsProcess as $updatedIntQualProcess) {
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

    public function update_internal_qualifications_capacity(DBConnection $db_connection, $internalQualificationsCapacity)
    {
        $message = "";
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }

        foreach ($internalQualificationsCapacity as $updatedIntQualCapacity) {
            if ($updatedIntQualCapacity->yesno == false) {
                $updatedIntQualCapacity->yesno = 0;
            } else {
                $updatedIntQualCapacity->yesno = 1;
            }
            $sql = "UPDATE internalqualificationcapacity_employee SET yesno = '$updatedIntQualCapacity->yesno', result = '" . addslashes($updatedIntQualCapacity->result) . "', validationDate = '$updatedIntQualCapacity->validationDate', attachement = '$updatedIntQualCapacity->attachement' WHERE internalqualificationcapacity_employee.fk_internalQualificationCapacity = $updatedIntQualCapacity->pk_internalQualificationsCapacity AND internalqualificationcapacity_employee.fk_employee = $updatedIntQualCapacity->fk_employee";
            if ($this->connection->query($sql)) {
                $message .= "Internal qualification_employee with pk $updatedIntQualCapacity->pk_internalQualificationsCapacity updated \n";
            } else {
                $message .= "Error while updating internal qualification_employee with fk internal qualification $updatedIntQualCapacity->pk_internalQualificationsCapacity and fk employee $updatedIntQualCapacity->fk_employee \n";
            }
        }

        $this->connection->close();
        return $message;
    }

    public function update_internal_qualifications_standard(DBConnection $db_connection, $internalQualificationsStandard)
    {
        $message = "";
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }

        foreach ($internalQualificationsStandard as $updatedIntQualStandard) {
            if ($updatedIntQualStandard->yesno == false) {
                $updatedIntQualStandard->yesno = 0;
            } else {
                $updatedIntQualStandard->yesno = 1;
            }
            $sql = "UPDATE internalqualificationstandard_employee SET yesno = '$updatedIntQualStandard->yesno', concernedScope = '" . $updatedIntQualStandard->concernedScope . "', attachement = '$updatedIntQualStandard->attachement' WHERE internalqualificationstandard_employee.fk_internalQualificationStandard = $updatedIntQualStandard->pk_internalQualificationsStandard AND internalqualificationstandard_employee.fk_employee = $updatedIntQualStandard->fk_employee";

            if ($this->connection->query($sql)) {
                $message .= "Internal qualification_employee with pk $updatedIntQualStandard->pk_internalQualificationsStandard updated \n";
            } else {
                $message .= "Error while updating internal qualification_employee with fk internal qualification $updatedIntQualStandard->pk_internalQualificationsStandard and fk employee $updatedIntQualStandard->fk_employee \n";
            }
        }

        $this->connection->close();
        return $message;
    }

    public function get_internal_qualifications_process_name(DBConnection $db_connection)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM internalqualificationprocess";
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

    public function get_internal_qualifications_capacity_name(DBConnection $db_connection)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM internalqualificationcapacity";
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

    public function get_internal_qualifications_standard_name(DBConnection $db_connection)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM internalqualificationstandard";
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

    public function update_internal_qualifications_process_name(DBConnection $db_connection, $internal_qualifications_process_name)
    {
        $message = "";
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }

        $sql = "SELECT * FROM internalqualificationprocess";
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $old_int_quals_p_name[] = $row;
            }
        }

        foreach ($internal_qualifications_process_name as $updated_int_qual_p_name) {
            if ($updated_int_qual_p_name->pk_internalQualificationsProcess == null) {
                //if there's new internal qualification process (insert)
                $sql = "INSERT INTO internalqualificationprocess (pk_internalQualificationsProcess, process) VALUES (NULL, '" . addslashes($updated_int_qual_p_name->process) . "')";
                if ($this->connection->query($sql)) {
                    $this->add_new_internal_qualification_process_employee($db_connection, $this->connection->insert_id);
                    $message .= "New internal qualification process « $updated_int_qual_p_name->process » added \n";
                } else {
                    $message .= "Error while adding new internal qualification process « $updated_int_qual_p_name->process » \n";
                }
            } else {
                //if internal qualification process already exist (update)
                $sql = "UPDATE internalqualificationprocess SET process = '" . addslashes($updated_int_qual_p_name->process) . "' WHERE internalqualificationprocess.pk_internalQualificationsProcess = $updated_int_qual_p_name->pk_internalQualificationsProcess";
                if ($this->connection->query($sql)) {
                    $message .= "Internal qualification process with pk $updated_int_qual_p_name->pk_internalQualificationsProcess updated \n";
                } else {
                    $message .= "Error while updating internal qualification process with pk $updated_int_qual_p_name->pk_internalQualificationsProcess \n";
                }
            }
        }

        // deleting internal qualification process if it doesn't exist anymore
        foreach ($old_int_quals_p_name as $old_int_qual_p_name) {
            $stillExist = false;
            foreach ($internal_qualifications_process_name as $updated_int_qual_p_name) {
                $message .= "updated pk" . $updated_int_qual_p_name->pk_internalQualificationsProcess . "\n" . "old pk " . $old_int_qual_p_name["pk_internalQualificationsProcess"] . "\n";
                if ($updated_int_qual_p_name->pk_internalQualificationsProcess == $old_int_qual_p_name["pk_internalQualificationsProcess"]) {

                    $stillExist = true;
                }
            }
            if (!$stillExist) {
                $sql = "DELETE FROM internalqualificationprocess WHERE internalqualificationprocess.pk_internalQualificationsProcess = " . $old_int_qual_p_name["pk_internalQualificationsProcess"];
                if ($this->connection->query($sql)) {
                    $message .= "Internal qualification process with pk " . $old_int_qual_p_name["pk_internalQualificationsProcess"] . " deleted \n";
                } else {
                    $message .= "Error while deleting internal qualification process with pk " . $old_int_qual_p_name["pk_internalQualificationsProcess"] . "\n";
                }
            }
        }

        $this->connection->close();
        return $message;
    }

    public function update_internal_qualifications_capacity_name(DBConnection $db_connection, $internal_qualifications_capacity_name)
    {
        $message = "";
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }

        $sql = "SELECT * FROM internalqualificationcapacity";
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $old_int_quals_c_name[] = $row;
            }
        }

        foreach ($internal_qualifications_capacity_name as $updated_int_qual_c_name) {
            if ($updated_int_qual_c_name->pk_internalQualificationsCapacity == null) {
                //if there's new internal qualification capacity (insert)
                $sql = "INSERT INTO internalqualificationcapacity (pk_internalQualificationsCapacity, capacity) VALUES (NULL, '" . addslashes($updated_int_qual_c_name->capacity) . "')";
                if ($this->connection->query($sql)) {
                    $this->add_new_internal_qualification_capacity_employee($db_connection, $this->connection->insert_id);
                    $message .= "New internal qualification capacity « $updated_int_qual_c_name->capacity » added \n";
                } else {
                    $message .= "Error while adding new internal qualification capacity « $updated_int_qual_c_name->capacity » \n";
                }
            } else {
                //if internal qualification capacity already exist (update)
                $sql = "UPDATE internalqualificationcapacity SET capacity = '" . addslashes($updated_int_qual_c_name->capacity) . "' WHERE internalqualificationcapacity.pk_internalQualificationsCapacity = $updated_int_qual_c_name->pk_internalQualificationsCapacity";
                if ($this->connection->query($sql)) {
                    $message .= "Internal qualification capacity with pk $updated_int_qual_c_name->pk_internalQualificationsCapacity updated \n";
                } else {
                    $message .= "Error while updating internal qualification capacity with pk $updated_int_qual_c_name->pk_internalQualificationsCapacity \n";
                }
            }
        }

        // deleting internal qualification capacity if it doesn't exist anymore
        foreach ($old_int_quals_c_name as $old_int_qual_c_name) {
            $stillExist = false;
            foreach ($internal_qualifications_capacity_name as $updated_int_qual_c_name) {
                $message .= "updated pk" . $updated_int_qual_c_name->pk_internalQualificationsCapacity . "\n" . "old pk " . $old_int_qual_c_name["pk_internalQualificationsCapacity"] . "\n";
                if ($updated_int_qual_c_name->pk_internalQualificationsCapacity == $old_int_qual_c_name["pk_internalQualificationsCapacity"]) {

                    $stillExist = true;
                }
            }
            if (!$stillExist) {
                $sql = "DELETE FROM internalqualificationcapacity WHERE internalqualificationcapacity.pk_internalQualificationsCapacity = " . $old_int_qual_c_name["pk_internalQualificationsCapacity"];
                if ($this->connection->query($sql)) {
                    $message .= "Internal qualification capacity with pk " . $old_int_qual_c_name["pk_internalQualificationsCapacity"] . " deleted \n";
                } else {
                    $message .= "Error while deleting internal qualification capacity with pk " . $old_int_qual_c_name["pk_internalQualificationsCapacity"] . "\n";
                }
            }
        }

        $this->connection->close();
        return $message;
    }

    public function update_internal_qualifications_standard_name(DBConnection $db_connection, $internal_qualifications_standard_name)
    {
        $message = "";
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }

        $sql = "SELECT * FROM internalqualificationstandard";
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $old_int_quals_s_name[] = $row;
            }
        }

        foreach ($internal_qualifications_standard_name as $updated_int_qual_s_name) {
            if ($updated_int_qual_s_name->pk_internalQualificationsStandard == null) {
                //if there's new internal qualification standard (insert)
                $sql = "INSERT INTO internalqualificationstandard (pk_internalQualificationsStandard, standard) VALUES (NULL, '" . addslashes($updated_int_qual_s_name->standard) . "')";
                if ($this->connection->query($sql)) {
                    $this->add_new_internal_qualification_standard_employee($db_connection, $this->connection->insert_id);
                    $message .= "New internal qualification standard « $updated_int_qual_s_name->standard » added \n";
                } else {
                    $message .= "Error while adding new internal qualification standard « $updated_int_qual_s_name->standard » \n";
                }
            } else {
                //if internal qualification standard already exist (update)
                $sql = "UPDATE internalqualificationstandard SET standard = '" . addslashes($updated_int_qual_s_name->standard) . "' WHERE internalqualificationstandard.pk_internalQualificationsStandard = $updated_int_qual_s_name->pk_internalQualificationsStandard";
                if ($this->connection->query($sql)) {
                    $message .= "Internal qualification standard with pk $updated_int_qual_s_name->pk_internalQualificationsStandard updated \n";
                } else {
                    $message .= "Error while updating internal qualification standard with pk $updated_int_qual_s_name->pk_internalQualificationsStandard \n";
                }
            }
        }

        // deleting internal qualification standard if it doesn't exist anymore
        foreach ($old_int_quals_s_name as $old_int_qual_s_name) {
            $stillExist = false;
            foreach ($internal_qualifications_standard_name as $updated_int_qual_s_name) {
                $message .= "updated pk" . $updated_int_qual_s_name->pk_internalQualificationsStandard . "\n" . "old pk " . $old_int_qual_s_name["pk_internalQualificationsStandard"] . "\n";
                if ($updated_int_qual_s_name->pk_internalQualificationsStandard == $old_int_qual_s_name["pk_internalQualificationsStandard"]) {

                    $stillExist = true;
                }
            }
            if (!$stillExist) {
                $sql = "DELETE FROM internalqualificationstandard WHERE internalqualificationstandard.pk_internalQualificationsStandard = " . $old_int_qual_s_name["pk_internalQualificationsStandard"];
                if ($this->connection->query($sql)) {
                    $message .= "Internal qualification standard with pk " . $old_int_qual_s_name["pk_internalQualificationsStandard"] . " deleted \n";
                } else {
                    $message .= "Error while deleting internal qualification standard with pk " . $old_int_qual_s_name["pk_internalQualificationsStandard"] . "\n";
                }
            }
        }

        $this->connection->close();
        return $message;
    }

    private function add_new_internal_qualification_process_employee(DBConnection $db_connection, $id)
    {
        $message = "";
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM employee";
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $sql = "INSERT INTO internalqualificationprocess_employee (fk_internalQualificationProcess, fk_employee, yesno, result, validationDate, attachement) VALUES ('" . $id . "', '" . $row["pk_employee"] . "', '0', '', NULL, NULL)";
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

    private function add_new_internal_qualification_capacity_employee(DBConnection $db_connection, $id)
    {
        $message = "";
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM employee";
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $sql = "INSERT INTO internalqualificationcapacity_employee (fk_internalQualificationCapacity, fk_employee, yesno, result, validationDate, attachement) VALUES ('" . $id . "', '" . $row["pk_employee"] . "', '0', '', NULL, NULL)";
                if ($this->connection->query($sql)) {
                    $message .= "Internal qualification capacity employee with fk " . $row["pk_internalQualificationsCapacity"] . " added successfully \n";
                } else {
                    $message .= "Error while adding internal qualification capacity employee with fk " . $row["pk_internalQualificationsCapacity"] . " \n";
                }
            }
        } else {
        }
        mysqli_close($this->connection);
        return $message;
    }

    private function add_new_internal_qualification_standard_employee(DBConnection $db_connection, $id)
    {
        $message = "";
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM employee";
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $sql = "INSERT INTO internalqualificationstandard_employee (fk_internalQualificationStandard, fk_employee, yesno, attachement, concernedScope) VALUES ('" . $id . "', '" . $row["pk_employee"] . "', '0', NULL, NULL)";
                if ($this->connection->query($sql)) {
                    $message .= "Internal qualification standard employee with fk " . $row["pk_internalQualificationsStandard"] . " added successfully \n";
                } else {
                    $message .= "Error while adding internal qualification standard employee with fk " . $row["pk_internalQualificationsStandard"] . " \n";
                }
            }
        } else {
        }
        mysqli_close($this->connection);
        return $message;
    }

}

?>