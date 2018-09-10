<?php

class WrkReport
{
    private $connection;

    public function get_report_general_infos(DBConnection $db_connection, $pk_report)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM report WHERE pk_report = $pk_report";
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

    public function get_audit_dates(DBConnection $db_connection, $pk_report)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT pk_auditDate, auditDate FROM auditDate WHERE fk_report = $pk_report";
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

    public function get_audit_scopes(DBConnection $db_connection, $pk_report)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM report_scope WHERE fk_report = $pk_report";
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
        $sql = "SELECT plan.pk_plan, plan.services, plan.startDate, plan.endDate, plan.place, plan.auditedStaff, plan.standardChapter, plan.fk_auditor, auditor.lastName, auditor.firstName from plan inner join auditPlan on auditPlan.pk_auditPlan = plan.fk_auditPlan inner join auditor on plan.fk_auditor = auditor.pk_auditor where auditPlan.fk_report = $pk_report";
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

    public function get_checklist_questions(DBConnection $db_connection, $pk_report_checklist)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT question.question, question_checklist_report.yes, question_checklist_report.comment from question_checklist_report INNER JOIN question on question_checklist_report.fk_question = question.pk_question INNER join report_checklist on question_checklist_report.fk_report_checklist = report_checklist.pk_report_checklist WHERE report_checklist.pk_report_checklist = $pk_report_checklist";
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row["yes"] == 0) {
                    $row["yes"] = false;
                } else {
                    $row["yes"] = true;
                }
                $emparray[] = $row;
            }
        } else {
        }
        mysqli_close($this->connection);
        return json_encode($emparray);
    }

    public function get_checklist_names(DBConnection $db_connection, $pk_report)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT checklist.pk_checklist, checklist.name, report_checklist.pk_report_checklist FROM checklist INNER JOIN report_checklist on report_checklist.fk_checklist = checklist.pk_checklist WHERE report_checklist.fk_report = $pk_report";
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

    public function get_other_checklist_names(DBConnection $db_connection, $pk_report)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "(SELECT checklist.pk_checklist, checklist.name FROM checklist INNER JOIN report_checklist on report_checklist.fk_checklist = checklist.pk_checklist WHERE report_checklist.fk_report != $pk_report) UNION (SELECT checklist.pk_checklist, checklist.name FROM checklist WHERE checklist.pk_checklist NOT IN (SELECT report_checklist.fk_checklist from report_checklist))";
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

    public function get_auditedPeople_list(DBConnection $db_connection, $pk_report)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * from auditedPeople where fk_report = $pk_report";
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row["openingMeeting"] == 0) {
                    $row["openingMeeting"] = false;
                } else {
                    $row["openingMeeting"] = true;
                }
                if ($row["onSiteAudit"] == 0) {
                    $row["onSiteAudit"] = false;
                } else {
                    $row["onSiteAudit"] = true;
                }
                if ($row["closingMeeting"] == 0) {
                    $row["closingMeeting"] = false;
                } else {
                    $row["closingMeeting"] = true;
                }
                $emparray[] = $row;
            }
        } else {
        }
        mysqli_close($this->connection);
        return json_encode($emparray);
    }

    public function get_generalFeelingManagementSystem(DBConnection $db_connection, $pk_report)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * from generalFeelingManagementSystem where fk_report = $pk_report";
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

    public function get_generalFeelingManagement(DBConnection $db_connection, $pk_report)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * from generalFeelingManagement where fk_report = $pk_report";
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

    public function get_generalFeelingPerformance(DBConnection $db_connection, $pk_report)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * from generalFeelingPerformance where fk_report = $pk_report";
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

    public function get_generalFeelingProduction(DBConnection $db_connection, $pk_report)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * from generalFeelingProduction where fk_report = $pk_report";
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

    public function get_generalFeelingRessource(DBConnection $db_connection, $pk_report)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * from generalFeelingRessource where fk_report = $pk_report";
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

    public function get_auditReports_list(DBConnection $db_connection, $pk_report)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * from auditReport where fk_report = $pk_report";
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

    public function get_conclusionComments(DBConnection $db_connection, $pk_report)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT conclusionComment.pk_conclusionComment, conclusionComment.title, conclusionComment_conclusion.yes, conclusionComment_conclusion.comment FROM conclusionComment_conclusion inner join conclusionComment on conclusionComment_conclusion.fk_conclusionComment = conclusionComment.pk_conclusionComment inner join conclusion on conclusionComment_conclusion.fk_conclusion = conclusion.pk_conclusion where conclusion.fk_report = $pk_report";
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row["yes"] == 0) {
                    $row["yes"] = false;
                } else {
                    $row["yes"] = true;
                }
                $emparray[] = $row;
            }
        } else {
        }
        mysqli_close($this->connection);
        return json_encode($emparray);
    }

    public function get_conclusionCompliance(DBConnection $db_connection, $pk_report)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT conclusionCompliance.pk_conclusionCompliance, conclusionCompliance.title, conclusionCompliance_conclusion.yes, conclusionCompliance_conclusion.comment FROM conclusionCompliance_conclusion inner join conclusionCompliance on conclusionCompliance_conclusion.fk_conclusionCompliance = conclusionCompliance.pk_conclusionCompliance inner join conclusion on conclusionCompliance_conclusion.fk_conclusion = conclusion.pk_conclusion where conclusion.fk_report = $pk_report";
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row["yes"] == 0) {
                    $row["yes"] = false;
                } else {
                    $row["yes"] = true;
                }
                $emparray[] = $row;
            }
        } else {
        }
        mysqli_close($this->connection);
        return json_encode($emparray);
    }

    public function get_conclusionNoncompliance(DBConnection $db_connection, $pk_report)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT conclusionNoncompliance.pk_conclusionNoncompliance, conclusionNoncompliance.title, conclusionNoncompliance_conclusion.yes, conclusionNoncompliance_conclusion.comment FROM conclusionNoncompliance_conclusion inner join conclusionNoncompliance on conclusionNoncompliance_conclusion.fk_conclusionNoncompliance = conclusionNoncompliance.pk_conclusionNoncompliance inner join conclusion on conclusionNoncompliance_conclusion.fk_conclusion = conclusion.pk_conclusion where conclusion.fk_report = $pk_report";
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row["yes"] == 0) {
                    $row["yes"] = false;
                } else {
                    $row["yes"] = true;
                }
                $emparray[] = $row;
            }
        } else {
        }
        mysqli_close($this->connection);
        return json_encode($emparray);
    }

    public function get_conclusionReview(DBConnection $db_connection, $pk_report)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT conclusionReview.pk_conclusionReview, conclusionReview.title, conclusionReview_conclusion.yes, conclusionReview_conclusion.comment FROM conclusionReview_conclusion inner join conclusionReview on conclusionReview_conclusion.fk_conclusionReview = conclusionReview.pk_conclusionReview inner join conclusion on conclusionReview_conclusion.fk_conclusion = conclusion.pk_conclusion where conclusion.fk_report = $pk_report";
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row["yes"] == 0) {
                    $row["yes"] = false;
                } else {
                    $row["yes"] = true;
                }
                $emparray[] = $row;
            }
        } else {
        }
        mysqli_close($this->connection);
        return json_encode($emparray);
    }

    public function get_conclusion(DBConnection $db_connection, $pk_report)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM  conclusion where conclusion.fk_report = $pk_report";
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

    public function get_certificationDecision(DBConnection $db_connection, $pk_report)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * from certificationDecision where fk_report = $pk_report";
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

    public function get_documents(DBConnection $db_connection, $pk_report)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * from variousDocument where fk_report = $pk_report";
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