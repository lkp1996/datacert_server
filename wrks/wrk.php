<?php
include("../beans/db_connection.php");
include("wrk_auditor.php");
include("wrk_scope.php");
include("wrk_standard.php");
include("wrk_organization.php");
include("wrk_login.php");
include("wrk_userType.php");
include("wrk_report.php");
include("wrk_status.php");
include("wrk_auditType.php");

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
    private $wrk_status;
    private $wrk_auditType;

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
        $this->wrk_status = new WrkStatus();
        $this->wrk_auditType = new WrkAuditType();
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

    public function get_organizations_list($pk_auditor)
    {
        return $this->wrk_organization->get_organizations_list($this->db_connection, $pk_auditor);
    }

    public function get_organization_profile($pk_organization)
    {
        return $this->wrk_organization->get_organization_profile($this->db_connection, $pk_organization);
    }

    public function get_organization_audits_list($pk_organization)
    {
        return $this->wrk_organization->get_organization_audits_list($this->db_connection, $pk_organization);
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

    public function get_report_general_infos($pk_report)
    {
        return $this->wrk_report->get_report_general_infos($this->db_connection, $pk_report);
    }

    public function get_audit_dates($pk_report)
    {
        return $this->wrk_report->get_audit_dates($this->db_connection, $pk_report);
    }

    public function get_audit_scopes($pk_report)
    {
        return $this->wrk_report->get_audit_scopes($this->db_connection, $pk_report);
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

    public function get_auditedPeople_list($pk_report)
    {
        return $this->wrk_report->get_auditedPeople_list($this->db_connection, $pk_report);
    }

    public function get_generalFeelingManagementSystem($pk_report)
    {
        return $this->wrk_report->get_generalFeelingManagementSystem($this->db_connection, $pk_report);
    }

    public function get_generalFeelingManagement($pk_report)
    {
        return $this->wrk_report->get_generalFeelingManagement($this->db_connection, $pk_report);
    }

    public function get_generalFeelingPerformance($pk_report)
    {
        return $this->wrk_report->get_generalFeelingPerformance($this->db_connection, $pk_report);
    }

    public function get_generalFeelingProduction($pk_report)
    {
        return $this->wrk_report->get_generalFeelingProduction($this->db_connection, $pk_report);
    }

    public function get_generalFeelingRessource($pk_report)
    {
        return $this->wrk_report->get_generalFeelingRessource($this->db_connection, $pk_report);
    }

    public function get_auditReports_list($pk_report)
    {
        return $this->wrk_report->get_auditReports_list($this->db_connection, $pk_report);
    }

    public function get_conclusionComments($pk_report)
    {
        return $this->wrk_report->get_conclusionComments($this->db_connection, $pk_report);
    }

    public function get_conclusionCompliance($pk_report)
    {
        return $this->wrk_report->get_conclusionCompliance($this->db_connection, $pk_report);
    }

    public function get_conclusionNoncompliance($pk_report)
    {
        return $this->wrk_report->get_conclusionNoncompliance($this->db_connection, $pk_report);
    }

    public function get_conclusionReview($pk_report)
    {
        return $this->wrk_report->get_conclusionReview($this->db_connection, $pk_report);
    }

    public function get_status_list()
    {
        return $this->wrk_status->get_status_list($this->db_connection);
    }

    public function get_certificationDecision($pk_report)
    {
        return $this->wrk_status->get_certificationDecision($pk_report);
    }

    public function get_documents($pk_report)
    {
        return $this->wrk_status->get_documents($pk_report);
    }

    public function get_audit_type_list()
    {
        return $this->wrk_auditType->get_audit_type_list($this->db_connection);
    }
}


?>