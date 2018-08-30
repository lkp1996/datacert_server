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
} else if (isset($_GET["auditor_internalqualificationsprocess"])) {
    echo $ctrl->get_organizations_list($_GET["auditor_internalqualificationsprocess"]);
} else if (isset($_GET["getUserID"])) {
    echo $ctrl->get_userId($_GET["getUserID"]);
} else if (isset($_GET["userType"])) {
    echo $ctrl->get_user_type($_GET["userType"]);
} else if (isset($_GET["type_list"])) {
    echo $ctrl->get_type_list();
} else if (isset($_GET["report_general_infos"])) {
    echo $ctrl->get_report_general_infos($_GET["report_general_infos"]);
} else if (isset($_GET["auditPlan_auditManager"])) {
    echo $ctrl->get_auditPlan_auditManager($_GET["auditPlan_auditManager"]);
} else if (isset($_GET["auditPlan_auditors_list"])) {
    echo $ctrl->get_auditPlan_auditors_list($_GET["auditPlan_auditors_list"]);
} else if (isset($_GET["auditPlan_plan"])) {
    echo $ctrl->get_auditPlan_plan($_GET["auditPlan_plan"]);
} else if (isset($_GET["report_checklist_questions"])) {
    echo $ctrl->get_checklist_questions($_GET["report_checklist_questions"]);
} else if (isset($_GET["other_checklist_names"])) {
    echo $ctrl->get_other_checklist_names($_GET["other_checklist_names"]);
} else if (isset($_GET["generalFeeling_name"])) {
    echo $ctrl->get_generalFeeling_name($_GET["generalFeeling_name"]);
} else if (isset($_GET["generalFeeling_positivePoints"])) {
    echo $ctrl->get_generalFeelings_positivePoints($_GET["generalFeeling_positivePoints"]);
} else if ($json = json_decode(file_get_contents('php://input'))) {
    if ($json->username && $json->password) {
        echo $ctrl->login($json);
    } else if (!$json->pk_auditor && $json->lastName) {
        echo $ctrl->add_auditor($json);
    } else if ($json->pk_auditor && $json->lastName) {
        echo $ctrl->update_auditor_admin($json);
    } else if ($json->pk_auditor && $json->oldPassword && $json->newPassword) {
        echo $ctrl->update_password($json);
    } else if ($json[0]->pk_internalQualificationsProcess && $json[0]->fk_auditor) {
        echo $ctrl->update_organization($json);
    } else if ($json[0]->pk_auditObservation || $json[0]->pk_auditObservation == "0") {
        echo $ctrl->update_auditor_auditObservations($json);
    } else if ($json[0]->pk_mandateSheet || $json[0]->pk_mandateSheet == "0") {
        echo $ctrl->update_auditor_mandateSheets($json);
    } else if ($json[0]->pk_objective || $json[0]->pk_objective == "0") {
        echo $ctrl->update_auditor_objectives($json);
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

    public function get_type_list()
    {
        return $this->wrk->get_type_list();
    }

    public function get_report_general_infos($fk_organization)
    {
        return $this->wrk->get_report_general_infos($fk_organization);
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

    public function get_checklist_questions($pk_report)
    {
        return $this->wrk->get_checklist_questions($pk_report);
    }

    public function get_other_checklist_names($pk_report)
    {
        return $this->wrk->get_other_checklist_names($pk_report);
    }

    public function get_generalFeeling_name($pk_report)
    {
        return $this->wrk->get_generalFeeling_name($pk_report);
    }

    public function get_generalFeelings_positivePoints($pk_generalFeeling)
    {
        return $this->wrk->get_generalFeelings_positivePoints($pk_generalFeeling);
    }
}

?>