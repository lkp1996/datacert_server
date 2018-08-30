<?php
include("../beans/db_connection.php");
include("wrk_auditor.php");
include("wrk_scope.php");
include("wrk_standard.php");
include("wrk_organization.php");
include("wrk_login.php");
include("wrk_userType.php");
include("wrk_report.php");

session_start();

class Wrk
{
    private $db_connection;
    private $wrk_auditor;
    private $wrk_scope;
    private $wrk_standard;
    private $wrk_organization;
    private $wrk_login;
    private $wrk_userType;
    private $wrk_report;

    public function __construct()
    {
        //dev
        $this->db_connection = new DBConnection("datacert", "root", "root", "localhost");
        //prod
        //$this->db_connection = new DBConnection("incertit_hrm", "incertit_hrm", "root", "localhost");
        $this->wrk_auditor = new WrkAuditor();
        $this->wrk_scope = new WrkScope();
        $this->wrk_standard = new WrkStandard();
        $this->wrk_organization = new WrkOrganization();
        $this->wrk_login = new WrkLogin();
        $this->wrk_userType = new WrkUserType();
        $this->wrk_report = new WrkReport();
    }

    public function get_auditors_list($pk_auditor)
    {
        return $this->wrk_auditor->get_auditors_list($this->db_connection, $pk_auditor);
    }

    public function get_auditor_administration($pk_auditor)
    {
        return $this->wrk_auditor->get_auditor_administration($this->db_connection, $pk_auditor);
    }

    public function add_auditor($auditor)
    {
        $pk_auditor = $this->wrk_auditor->add_auditor($this->db_connection, $auditor);
        return $pk_auditor;
    }

    public function get_scopes_list()
    {
        return $this->wrk_scope->get_scopes_list($this->db_connection);
    }

    public function get_standard_list()
    {
        return $this->wrk_standard->get_standard_list($this->db_connection);
    }

    public function get_organizations_list($auditor)
    {
        return $this->wrk_organization->get_organizations_list($this->db_connection, $auditor);
    }

    public function delete_auditor($pk_auditor)
    {
        return $this->wrk_auditor->delete_auditor($this->db_connection, $pk_auditor);
    }

    public function update_auditor_admin($auditor)
    {
        return $this->wrk_auditor->update_auditor_admin($this->db_connection, $auditor);
    }

    public function login($user)
    {
        return $this->wrk_login->login($this->db_connection, $user);
    }

    public function get_userId($username)
    {
        return $this->wrk_auditor->get_userId($this->db_connection, $username);
    }

    public function update_password($auditor)
    {
        return $this->wrk_auditor->update_password($this->db_connection, $auditor);
    }

    public function get_user_type($fk_userType)
    {
        return $this->wrk_userType->get_user_type($this->db_connection, $fk_userType);
    }

    public function get_type_list()
    {
        return $this->wrk_userType->get_type_list($this->db_connection);
    }

    public function get_report_general_infos($fk_organization)
    {
        return $this->wrk_report->get_report_general_infos($this->db_connection, $fk_organization);
    }

    public function get_auditPlan_auditManager($pk_report)
    {
        return $this->wrk_report->get_auditPlan_auditManager($this->db_connection, $pk_report);
    }

    public function get_auditPlan_auditors_list($pk_report)
    {
        return $this->wrk_report->get_auditPlan_auditors_list($this->db_connection, $pk_report);
    }

    public function get_auditPlan_plan($pk_report)
    {
        return $this->wrk_report->get_auditPlan_plan($this->db_connection, $pk_report);
    }

    public function get_checklist_questions($pk_report)
    {
        return $this->wrk_report->get_checklist_questions($this->db_connection, $pk_report);
    }

    public function get_other_checklist_names($pk_report)
    {
        return $this->wrk_report->get_other_checklist_names($this->db_connection, $pk_report);
    }

    public function get_generalFeeling_name($pk_report)
    {
        return $this->wrk_report->get_generalFeeling_name($this->db_connection, $pk_report);
    }

    public function get_generalFeelings_positivePoints($pk_generalFeeling)
    {
        return $this->wrk_report->get_generalFeelings_positivePoints($this->db_connection, $pk_generalFeeling);
    }
}


?>