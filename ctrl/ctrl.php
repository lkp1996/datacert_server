<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Process-Data");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Credentials: true");
include("../wrks/wrk.php");

$ctrl = new Ctrl();

if (isset($_GET["auditors_list"])) {
    echo $ctrl->display_auditors_list($_GET["auditors_list"]);
} else if (isset($_GET["auditor_administration"])) {
    echo $ctrl->display_auditor_administration($_GET["auditor_administration"]);
} else if (isset($_GET["scopes"])) {
    echo $ctrl->get_scopes_list();
} else if (isset($_GET["standards"])) {
    echo $ctrl->get_standard_list();
} else if (isset($_GET["organizations_list"])) {
    echo $ctrl->get_organizations_list($_GET["organizations_list"]);
} else if (isset($_GET["organizations_profile"])) {
    echo $ctrl->get_organization_profile($_GET["organizations_profile"]);
} else if (isset($_GET["organization_audits_list"])) {
    echo $ctrl->get_organization_audits_list($_GET["organization_audits_list"]);
} else if (isset($_GET["getUserID"])) {
    echo $ctrl->get_userId($_GET["getUserID"]);
} else if (isset($_GET["userType"])) {
    echo $ctrl->get_user_type($_GET["userType"]);
} else if (isset($_GET["type_list_auditor"])) {
    echo $ctrl->get_type_list_auditor();
} else if (isset($_GET["type_list_organization"])) {
    echo $ctrl->get_type_list_organization();
} else if (isset($_GET["report_general_infos"])) {
    echo $ctrl->get_report_general_infos($_GET["report_general_infos"]);
} else if (isset($_GET["audit_dates"])) {
    echo $ctrl->get_audit_dates($_GET["audit_dates"]);
} else if (isset($_GET["audit_scopes"])) {
    echo $ctrl->get_audit_scopes($_GET["audit_scopes"]);
} else if (isset($_GET["auditPlan_auditManager"])) {
    echo $ctrl->get_auditPlan_auditManager($_GET["auditPlan_auditManager"]);
} else if (isset($_GET["auditPlan_auditors_list"])) {
    echo $ctrl->get_auditPlan_auditors_list($_GET["auditPlan_auditors_list"]);
} else if (isset($_GET["auditPlan_plan"])) {
    echo $ctrl->get_auditPlan_plan($_GET["auditPlan_plan"]);
} else if (isset($_GET["report_checklist_questions"])) {
    echo $ctrl->get_checklist_questions($_GET["report_checklist_questions"]);
} else if (isset($_GET["checklist_names"])) {
    echo $ctrl->get_checklist_names($_GET["checklist_names"]);
} else if (isset($_GET["other_checklist_names"])) {
    echo $ctrl->get_other_checklist_names($_GET["other_checklist_names"]);
} else if (isset($_GET["auditedPeople_list"])) {
    echo $ctrl->get_auditedPeople_list($_GET["auditedPeople_list"]);
} else if (isset($_GET["generalFeelingManagementSystem"])) {
    echo $ctrl->get_generalFeelingManagementSystem($_GET["generalFeelingManagementSystem"]);
} else if (isset($_GET["generalFeelingManagement"])) {
    echo $ctrl->get_generalFeelingManagement($_GET["generalFeelingManagement"]);
} else if (isset($_GET["generalFeelingPerformance"])) {
    echo $ctrl->get_generalFeelingPerformance($_GET["generalFeelingPerformance"]);
} else if (isset($_GET["generalFeelingProduction"])) {
    echo $ctrl->get_generalFeelingProduction($_GET["generalFeelingProduction"]);
} else if (isset($_GET["generalFeelingRessource"])) {
    echo $ctrl->get_generalFeelingRessource($_GET["generalFeelingRessource"]);
} else if (isset($_GET["auditReports_list"])) {
    echo $ctrl->get_auditReports_list($_GET["auditReports_list"]);
} else if (isset($_GET["conclusionComments"])) {
    echo $ctrl->get_conclusionComments($_GET["conclusionComments"]);
} else if (isset($_GET["conclusionCompliance"])) {
    echo $ctrl->get_conclusionCompliance($_GET["conclusionCompliance"]);
} else if (isset($_GET["conclusionNoncompliance"])) {
    echo $ctrl->get_conclusionNoncompliance($_GET["conclusionNoncompliance"]);
} else if (isset($_GET["conclusionReview"])) {
    echo $ctrl->get_conclusionReview($_GET["conclusionReview"]);
} else if (isset($_GET["conclusion"])) {
    echo $ctrl->get_conclusion($_GET["conclusion"]);
} else if (isset($_GET["status_list"])) {
    echo $ctrl->get_status_list($_GET["status_list"]);
} else if (isset($_GET["certificationDecision"])) {
    echo $ctrl->get_certificationDecision($_GET["certificationDecision"]);
} else if (isset($_GET["variousDocuments"])) {
    echo $ctrl->get_documents($_GET["variousDocuments"]);
} else if (isset($_GET["auditType_list"])) {
    echo $ctrl->get_audit_type_list($_GET["auditType_list"]);
} else if (isset($_GET["interpretations"])) {
    echo $ctrl->get_interpretation_list();
} else if (isset($_GET["checklists_names"])) {
    echo $ctrl->get_checklists_names();
} else if (isset($_GET["checklist_questions_all"])) {
    echo $ctrl->get_checklists_questions($_GET["checklist_questions_all"]);
} else if (isset($_GET["language_list"])) {
    echo $ctrl->get_language_list();
} else if (isset($_GET["addresses"])) {
    echo $ctrl->get_addresses($_GET["addresses"]);
} else if ($json = json_decode(file_get_contents('php://input'))) {
    if ($json->username && $json->password) {
        echo $ctrl->login($json);
    } else if (!$json->pk_auditor && $json->lastName) {
        echo $ctrl->add_auditor($json);
    } else if (!$json->pk_organization && $json->name && $json->contactLastName) {
        echo $ctrl->add_organization($json);
    } else if ($json->pk_auditor && $json->lastName) {
        echo $ctrl->update_auditor_admin($json);
    } else if ($json->pk_organization && $json->name && $json->contactLastName) {
        echo $ctrl->update_organization($json);
    } else if ($json->pk_auditor && $json->oldPassword && $json->newPassword) {
        echo $ctrl->update_password($json);
    } else if ($json[0]->pk_address || $json[0]->pk_address == "0") {
        echo $ctrl->update_addresses($json);
    } else {
        echo "nothing yet";
    }
} else if (isset($_FILES["picture"])) {
    $pk_auditor = $_POST['id'];
    $target_dir = "../attachements/picture/$pk_auditor/";
    $target_file = $target_dir . basename($_FILES["picture"]["name"]);
    file_put_contents($target_file, file_get_contents($_FILES['picture']['tmp_name']));
} else if (isset($_FILES["cv"])) {
    $pk_auditor = $_POST['id'];
    $target_dir = "../attachements/cv/$pk_auditor/";
    $target_file = $target_dir . basename($_FILES["cv"]["name"]);
    file_put_contents($target_file, file_get_contents($_FILES['cv']['tmp_name']));
} else if (isset($_FILES["criminalRecord"])) {
    $pk_auditor = $_POST['id'];
    $target_dir = "../attachements/criminalrecord/$pk_auditor/";
    $target_file = $target_dir . basename($_FILES["criminalRecord"]["name"]);
    file_put_contents($target_file, file_get_contents($_FILES['criminalRecord']['tmp_name']));
} else if (isset($_FILES["formation"])) {
    $pk_auditor = $_POST['id'];
    $target_dir = "../attachements/formation/$pk_auditor/";
    $target_file = $target_dir . basename($_FILES["formation"]["name"]);
    file_put_contents($target_file, file_get_contents($_FILES['formation']['tmp_name']));
} else if (isset($_FILES["profexp"])) {
    $pk_auditor = $_POST['id'];
    $target_dir = "../attachements/professionnalexperience/$pk_auditor/";
    $target_file = $target_dir . basename($_FILES["profexp"]["name"]);
    file_put_contents($target_file, file_get_contents($_FILES['profexp']['tmp_name']));
} else if (isset($_FILES["intqual"])) {
    $pk_auditor = $_POST['id'];
    $target_dir = "../attachements/internalqualification/$pk_auditor/";
    $target_file = $target_dir . basename($_FILES["intqual"]["name"]);
    file_put_contents($target_file, file_get_contents($_FILES['intqual']['tmp_name']));
} else if (isset($_FILES["auditobs"])) {
    $pk_auditor = $_POST['id'];
    $target_dir = "../attachements/auditobservation/$pk_auditor/";
    $target_file = $target_dir . basename($_FILES["auditobs"]["name"]);
    file_put_contents($target_file, file_get_contents($_FILES['auditobs']['tmp_name']));
} else if (isset($_FILES["mandatesheets"])) {
    $pk_auditor = $_POST['id'];
    $target_dir = "../attachements/mandatesheet/$pk_auditor/";
    $target_file = $target_dir . basename($_FILES["mandatesheets"]["name"]);
    file_put_contents($target_file, file_get_contents($_FILES['mandatesheets']['tmp_name']));
} else if (isset($_GET["deleteId"])) {
    echo $ctrl->delete_auditor($_GET["deleteId"]);
}


class Ctrl
{
    private $wrk;

    public function __construct()
    {
        $this->wrk = new Wrk();
    }

    public function display_auditors_list($pk_auditor)
    {
        return $this->wrk->get_auditors_list($pk_auditor);
    }

    public function display_auditor_administration($pk_auditor)
    {
        return $this->wrk->get_auditor_administration($pk_auditor);
    }

    public function add_auditor($auditor)
    {
        return $this->wrk->add_auditor($auditor);
    }

    public function get_scopes_list()
    {
        return $this->wrk->get_scopes_list();
    }

    public function get_standard_list()
    {
        return $this->wrk->get_standard_list();
    }

    public function get_organizations_list($auditor)
    {
        return $this->wrk->get_organizations_list($auditor);
    }

    public function get_organization_profile($pk_organization)
    {
        return $this->wrk->get_organization_profile($pk_organization);
    }

    public function get_organization_audits_list($pk_organization)
    {
        return $this->wrk->get_organization_audits_list($pk_organization);
    }

    public function delete_auditor($pk_auditor)
    {
        return $this->wrk->delete_auditor($pk_auditor);
    }

    public function update_auditor_admin($auditor)
    {
        return $this->wrk->update_auditor_admin($auditor);
    }

    public function update_organization($organization)
    {
        return $this->wrk->update_organization($organization);
    }

    public function login($user)
    {
        return $this->wrk->login($user);
    }

    public function get_userId($username)
    {
        return $this->wrk->get_userId($username);
    }

    public function update_password($auditor)
    {
        return $this->wrk->update_password($auditor);
    }

    public function get_user_type($fk_userType)
    {
        return $this->wrk->get_user_type($fk_userType);
    }

    public function get_type_list_auditor()
    {
        return $this->wrk->get_type_list_auditor();
    }

    public function get_type_list_organization()
    {
        return $this->wrk->get_type_list_organization();
    }

    public function get_report_general_infos($pk_report)
    {
        return $this->wrk->get_report_general_infos($pk_report);
    }

    public function get_audit_dates($pk_report)
    {
        return $this->wrk->get_audit_dates($pk_report);
    }

    public function get_audit_scopes($pk_report)
    {
        return $this->wrk->get_audit_scopes($pk_report);
    }

    public function get_auditPlan_auditManager($pk_report)
    {
        return $this->wrk->get_auditPlan_auditManager($pk_report);
    }

    public function get_auditPlan_auditors_list($pk_report)
    {
        return $this->wrk->get_auditPlan_auditors_list($pk_report);
    }

    public function get_auditPlan_plan($pk_report)
    {
        return $this->wrk->get_auditPlan_plan($pk_report);
    }

    public function get_checklist_questions($pk_report_checklist)
    {
        return $this->wrk->get_checklist_questions($pk_report_checklist);
    }

    public function get_checklist_names($pk_report)
    {
        return $this->wrk->get_checklist_names($pk_report);
    }

    public function get_other_checklist_names($pk_report)
    {
        return $this->wrk->get_other_checklist_names($pk_report);
    }

    public function get_auditedPeople_list($pk_report)
    {
        return $this->wrk->get_auditedPeople_list($pk_report);
    }

    public function get_generalFeelingManagementSystem($pk_report)
    {
        return $this->wrk->get_generalFeelingManagementSystem($pk_report);
    }

    public function get_generalFeelingManagement($pk_report)
    {
        return $this->wrk->get_generalFeelingManagement($pk_report);
    }

    public function get_generalFeelingPerformance($pk_report)
    {
        return $this->wrk->get_generalFeelingPerformance($pk_report);
    }

    public function get_generalFeelingProduction($pk_report)
    {
        return $this->wrk->get_generalFeelingProduction($pk_report);
    }

    public function get_generalFeelingRessource($pk_report)
    {
        return $this->wrk->get_generalFeelingRessource($pk_report);
    }

    public function get_auditReports_list($pk_report)
    {
        return $this->wrk->get_auditReports_list($pk_report);
    }

    public function get_conclusionComments($pk_report)
    {
        return $this->wrk->get_conclusionComments($pk_report);
    }

    public function get_conclusionCompliance($pk_report)
    {
        return $this->wrk->get_conclusionCompliance($pk_report);
    }

    public function get_conclusionNoncompliance($pk_report)
    {
        return $this->wrk->get_conclusionNoncompliance($pk_report);
    }

    public function get_conclusionReview($pk_report)
    {
        return $this->wrk->get_conclusionReview($pk_report);
    }

    public function get_conclusion($pk_report)
    {
        return $this->wrk->get_conclusion($pk_report);
    }

    public function get_status_list()
    {
        return $this->wrk->get_status_list();
    }

    public function get_certificationDecision($pk_report)
    {
        return $this->wrk->get_certificationDecision($pk_report);
    }

    public function get_documents($pk_report)
    {
        return $this->wrk->get_documents($pk_report);
    }

    public function get_audit_type_list()
    {
        return $this->wrk->get_audit_type_list();
    }

    public function get_interpretation_list()
    {
        return $this->wrk->get_interpretation_list();
    }

    public function get_checklists_names()
    {
        return $this->wrk->get_checklists_names();
    }

    public function get_checklists_questions($pk_checklist)
    {
        return $this->wrk->get_checklists_questions($pk_checklist);
    }

    public function get_language_list()
    {
        return $this->wrk->get_language_list();
    }

    public function add_organization($organization)
    {
        return $this->wrk->add_organization($organization);
    }

    public function get_addresses($pk_organization)
    {
        return $this->wrk->get_addresses($pk_organization);
    }

    public function update_addresses($addresses)
    {
        return $this->wrk->update_addresses($addresses);
    }
}

?>