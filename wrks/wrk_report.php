<?php

class WrkReport
{
    private $connection;

    public function get_report_general_infos(DBConnection $db_connection, $fk_organization)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM report WHERE fk_organization = $fk_organization";
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

    public function get_auditPlan_auditManager(DBConnection $db_connection, $pk_report)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT auditor.lastName, auditor.firstName from auditor inner join auditPlan on auditPlan.fk_auditor_auditManager = auditor.pk_auditor where auditPlan.fk_report = $pk_report";
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

    public function get_auditPlan_auditors_list(DBConnection $db_connection, $pk_report)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT auditor.lastName, auditor.firstName from auditor inner join auditor_auditPlan on auditor_auditPlan.fk_auditor = auditor.pk_auditor inner join auditPlan on auditor_auditPlan.fk_auditPlan = auditPlan.pk_auditPlan where auditPlan.fk_report = $pk_report";
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

    public function get_auditPlan_plan(DBConnection $db_connection, $pk_report)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT plan.pk_plan, plan.services, plan.startDate, plan.endDate, plan.place, plan.auditedStaff, plan.standardChapter from plan inner join auditPlan on auditPlan.pk_auditPlan = plan.fk_auditPlan where auditPlan.fk_report = $pk_report";
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
}

?>