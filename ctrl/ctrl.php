<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Process-Data");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Credentials: true");
include("../wrks/wrk.php");

$ctrl = new Ctrl();

if (isset($_GET["employees_list"])) {
    echo $ctrl->display_employees_list($_GET["employees_list"]);
} else if (isset($_GET["employee_administration"])) {
    echo $ctrl->display_employee_administration($_GET["employee_administration"]);
} else if (isset($_GET["employee_formation"])) {
    echo $ctrl->display_employee_formation($_GET["employee_formation"]);
} else if (isset($_GET["employee_professionnalexperience"])) {
    echo $ctrl->display_employee_professionnalexperience($_GET["employee_professionnalexperience"]);
} else if (isset($_GET["employee_consultingexperience"])) {
    echo $ctrl->display_employee_consultingexperience($_GET["employee_consultingexperience"]);
} else if (isset($_GET["employee_auditexperience"])) {
    echo $ctrl->display_employee_auditexperience($_GET["employee_auditexperience"]);
} else if (isset($_GET["employee_internalqualification"])) {
    echo $ctrl->display_employee_internalqualification($_GET["employee_internalqualification"]);
} else if (isset($_GET["employee_auditobservation"])) {
    echo $ctrl->display_employee_auditobservation($_GET["employee_auditobservation"]);
} else if (isset($_GET["employee_objective"])) {
    echo $ctrl->display_employee_objective($_GET["employee_objective"]);
} else if (isset($_GET["employee_mandatesheet"])) {
    echo $ctrl->display_employee_mandatesheet($_GET["employee_mandatesheet"]);
} else if (isset($_GET["formation_types"])) {
    echo $ctrl->get_formation_types_list();
} else if (isset($_GET["nmsstandards"])) {
    echo $ctrl->get_nmsstandard_list();
} else if (isset($_GET["employee_internalqualificationsprocess"])) {
    echo $ctrl->get_internal_qualification_process_list($_GET["employee_internalqualificationsprocess"]);
} else if (isset($_GET["employee_internalqualificationscapacity"])) {
    echo $ctrl->get_internal_qualification_capacity_list($_GET["employee_internalqualificationscapacity"]);
} else if (isset($_GET["employee_internalqualificationsstandard"])) {
    echo $ctrl->get_internal_qualification_standard_list($_GET["employee_internalqualificationsstandard"]);
} else if (isset($_GET["getUserID"])) {
    echo $ctrl->get_userId($_GET["getUserID"]);
} else if (isset($_GET["employeeType"])) {
    echo $ctrl->get_employee_type($_GET["employeeType"]);
} else if (isset($_GET["type_list"])) {
    echo $ctrl->get_type_list();
} else if (isset($_GET["internalqualificationsprocess_name"])) {
    echo $ctrl->get_internal_qualifications_process_name();
} else if (isset($_GET["internalqualificationscapacity_name"])) {
    echo $ctrl->get_internal_qualifications_capacity_name();
} else if (isset($_GET["internalqualificationsstandard_name"])) {
    echo $ctrl->get_internal_qualifications_standard_name();
} else if ($json = json_decode(file_get_contents('php://input'))) {
    if ($json->username && $json->password) {
        echo $ctrl->login($json);
    } else if (!$json->pk_employee && $json->lastName) {
        echo $ctrl->add_employee($json);
    } else if ($json->pk_employee && $json->lastName) {
        echo $ctrl->update_employee_admin($json);
    } else if ($json->formations == "empty") {
        echo $ctrl->empty_employee_formations($json->fk_employee);
    } else if ($json->profexps == "empty") {
        echo $ctrl->empty_employee_professionnalExperiences($json->fk_employee);
    } else if ($json->conexps == "empty") {
        echo $ctrl->empty_employee_consultingExperiences($json->fk_employee);
    } else if ($json->auditexps == "empty") {
        echo $ctrl->empty_employee_auditExperiences($json->fk_employee);
    } else if ($json->auditObs == "empty") {
        echo $ctrl->empty_employee_auditObservations($json->fk_employee);
    } else if ($json->mandateSheets == "empty") {
        echo $ctrl->empty_employee_mandateSheets($json->fk_employee);
    } else if ($json->objectives == "empty") {
        echo $ctrl->empty_employee_objectives($json->fk_employee);
    } else if ($json->pk_employee && $json->oldPassword && $json->newPassword) {
        echo $ctrl->update_password($json);
    } else if ($json[0]->pk_formation || $json[0]->pk_formation == "0") {
        echo $ctrl->update_employee_formations($json);
    } else if ($json[0]->pk_professionnalExperience || $json[0]->pk_professionnalExperience == "0") {
        echo $ctrl->update_employee_professionnalExperiences($json);
    } else if ($json[0]->pk_consultingExperience || $json[0]->pk_consultingExperience == "0") {
        echo $ctrl->update_employee_consultingExperiences($json);
    } else if ($json[0]->pk_auditExperience || $json[0]->pk_auditExperience == "0") {
        echo $ctrl->update_employee_auditExperiences($json);
    } else if ($json[0]->pk_internalQualificationsProcess && $json[0]->fk_employee) {
        echo $ctrl->update_internal_qualifications_process($json);
    } else if ($json[0]->pk_internalQualificationsCapacity && $json[0]->fk_employee) {
        echo $ctrl->update_internal_qualifications_capacity($json);
    } else if ($json[0]->pk_internalQualificationsStandard && $json[0]->fk_employee) {
        echo $ctrl->update_internal_qualifications_standard($json);
    } else if ($json[0]->pk_auditObservation || $json[0]->pk_auditObservation == "0") {
        echo $ctrl->update_employee_auditObservations($json);
    } else if ($json[0]->pk_mandateSheet || $json[0]->pk_mandateSheet == "0") {
        echo $ctrl->update_employee_mandateSheets($json);
    } else if ($json[0]->pk_objective || $json[0]->pk_objective == "0") {
        echo $ctrl->update_employee_objectives($json);
    } else if (($json[0]->pk_internalQualificationsProcess || $json[0]->pk_internalQualificationsProcess == "0") && !($json[0]->fk_employee)) {
        echo $ctrl->update_internal_qualifications_process_name($json);
    } else if (($json[0]->pk_internalQualificationsCapacity || $json[0]->pk_internalQualificationsCapacity == "0") && !($json[0]->fk_employee)) {
        echo $ctrl->update_internal_qualifications_capacity_name($json);
    } else if (($json[0]->pk_internalQualificationsStandard || $json[0]->pk_internalQualificationsStandard == "0") && !($json[0]->fk_employee)) {
        echo $ctrl->update_internal_qualifications_standard_name($json);
    } else {
        echo "nothing yet";
    }
} else if (isset($_FILES["picture"])) {
    $pk_employee = $_POST['id'];
    $target_dir = "../attachements/picture/$pk_employee/";
    $target_file = $target_dir . basename($_FILES["picture"]["name"]);
    file_put_contents($target_file, file_get_contents($_FILES['picture']['tmp_name']));
} else if (isset($_FILES["cv"])) {
    $pk_employee = $_POST['id'];
    $target_dir = "../attachements/cv/$pk_employee/";
    $target_file = $target_dir . basename($_FILES["cv"]["name"]);
    file_put_contents($target_file, file_get_contents($_FILES['cv']['tmp_name']));
} else if (isset($_FILES["criminalRecord"])) {
    $pk_employee = $_POST['id'];
    $target_dir = "../attachements/criminalrecord/$pk_employee/";
    $target_file = $target_dir . basename($_FILES["criminalRecord"]["name"]);
    file_put_contents($target_file, file_get_contents($_FILES['criminalRecord']['tmp_name']));
} else if (isset($_FILES["formation"])) {
    $pk_employee = $_POST['id'];
    $target_dir = "../attachements/formation/$pk_employee/";
    $target_file = $target_dir . basename($_FILES["formation"]["name"]);
    file_put_contents($target_file, file_get_contents($_FILES['formation']['tmp_name']));
} else if (isset($_FILES["profexp"])) {
    $pk_employee = $_POST['id'];
    $target_dir = "../attachements/professionnalexperience/$pk_employee/";
    $target_file = $target_dir . basename($_FILES["profexp"]["name"]);
    file_put_contents($target_file, file_get_contents($_FILES['profexp']['tmp_name']));
} else if (isset($_FILES["intqual"])) {
    $pk_employee = $_POST['id'];
    $target_dir = "../attachements/internalqualification/$pk_employee/";
    $target_file = $target_dir . basename($_FILES["intqual"]["name"]);
    file_put_contents($target_file, file_get_contents($_FILES['intqual']['tmp_name']));
} else if (isset($_FILES["auditobs"])) {
    $pk_employee = $_POST['id'];
    $target_dir = "../attachements/auditobservation/$pk_employee/";
    $target_file = $target_dir . basename($_FILES["auditobs"]["name"]);
    file_put_contents($target_file, file_get_contents($_FILES['auditobs']['tmp_name']));
} else if (isset($_FILES["mandatesheets"])) {
    $pk_employee = $_POST['id'];
    $target_dir = "../attachements/mandatesheet/$pk_employee/";
    $target_file = $target_dir . basename($_FILES["mandatesheets"]["name"]);
    file_put_contents($target_file, file_get_contents($_FILES['mandatesheets']['tmp_name']));
} else if (isset($_GET["deleteId"])) {
    echo $ctrl->delete_employee($_GET["deleteId"]);
} else if (isset($_GET["deleteIdCV"])) {
    echo $ctrl->delete_cv($_GET["deleteIdCV"]);
} else if (isset($_GET["deleteIdCriminalRecord"])) {
    echo $ctrl->delete_criminal_record($_GET["deleteIdCriminalRecord"]);
} else if (isset($_GET["deleteIdPicture"])) {
    echo $ctrl->delete_picture($_GET["deleteIdPicture"]);
} else if (isset($_GET["deleteIdFormationAttachement"]) && isset($_GET["employeeId"])) {
    echo $ctrl->delete_formation_attachement($_GET["deleteIdFormationAttachement"], $_GET["employeeId"]);
} else if (isset($_GET["deleteIdProfessionnalExperienceAttachement"]) && isset($_GET["employeeId"])) {
    echo $ctrl->delete_professionnal_exp_attachement($_GET["deleteIdProfessionnalExperienceAttachement"], $_GET["employeeId"]);
} else if (isset($_GET["deleteIdMandateSheetsAttachements"]) && isset($_GET["employeeId"])) {
    echo $ctrl->delete_mandate_sheet_attachement($_GET["deleteIdMandateSheetsAttachements"], $_GET["employeeId"]);
} else if (isset($_GET["deleteIdQualificationsCapacityAttachements"]) && isset($_GET["employeeId"])) {
    echo $ctrl->delete_intqual_capacity_attachement($_GET["deleteIdQualificationsCapacityAttachements"], $_GET["employeeId"]);
} else if (isset($_GET["deleteIdQualificationsProcessAttachements"]) && isset($_GET["employeeId"])) {
    echo $ctrl->delete_intqual_process_attachement($_GET["deleteIdQualificationsProcessAttachements"], $_GET["employeeId"]);
} else if (isset($_GET["deleteIdInternalQualificationsStandardAttachements"]) && isset($_GET["employeeId"])) {
    echo $ctrl->delete_intqual_standard_attachement($_GET["deleteIdInternalQualificationsStandardAttachements"], $_GET["employeeId"]);
} else if (isset($_GET["deleteIdAuditObservationsAttachements"]) && isset($_GET["employeeId"])) {
    echo $ctrl->delete_auditobs_attachement($_GET["deleteIdAuditObservationsAttachements"], $_GET["employeeId"]);
}


class Ctrl
{
    private $wrk;

    public function __construct()
    {
        $this->wrk = new Wrk();
    }

    public function display_employees_list($pk_employee)
    {
        return $this->wrk->get_employees_list($pk_employee);
    }

    public function display_employee_administration($pk_employee)
    {
        return $this->wrk->get_employee_administration($pk_employee);
    }

    public function display_employee_formation($pk_employee)
    {
        return $this->wrk->get_employee_formation($pk_employee);
    }

    public function display_employee_professionnalexperience($pk_employee)
    {
        return $this->wrk->get_employee_professionnalexperience($pk_employee);
    }

    public function display_employee_consultingexperience($pk_employee)
    {
        return $this->wrk->get_employee_consultingexperience($pk_employee);
    }

    public function display_employee_auditexperience($pk_employee)
    {
        return $this->wrk->get_employee_auditexperience($pk_employee);
    }

    public function display_employee_internalqualification($pk_employee)
    {
        return $this->wrk->get_employee_internalqualification($pk_employee);
    }

    public function display_employee_auditobservation($pk_employee)
    {
        return $this->wrk->get_employee_auditobservation($pk_employee);
    }

    public function display_employee_objective($pk_employee)
    {
        return $this->wrk->get_employee_objective($pk_employee);
    }

    public function display_employee_mandatesheet($pk_employee)
    {
        return $this->wrk->get_employee_mandatesheet($pk_employee);
    }

    public function add_employee($employee)
    {
        return $this->wrk->add_employee($employee);
    }

    public function get_formation_types_list()
    {
        return $this->wrk->get_formation_types_list();
    }

    public function get_nmsstandard_list()
    {
        return $this->wrk->get_nmsstandard_list();
    }

    public function get_internal_qualification_process_list($employee)
    {
        return $this->wrk->get_internal_qualification_process_list($employee);
    }

    public function get_internal_qualification_capacity_list($employee)
    {
        return $this->wrk->get_internal_qualification_capacity_list($employee);
    }

    public function get_internal_qualification_standard_list($employee)
    {
        return $this->wrk->get_internal_qualification_standard_list($employee);
    }

    public function delete_employee($pk_employee)
    {
        return $this->wrk->delete_employee($pk_employee);
    }

    public function update_employee_admin($employee)
    {
        return $this->wrk->update_employee_admin($employee);
    }

    public function update_employee_formations($employee_formations)
    {
        return $this->wrk->update_employee_formations($employee_formations);
    }

    public function empty_employee_formations($pk_employee)
    {
        return $this->wrk->empty_employee_formations($pk_employee);
    }

    public function update_employee_professionnalExperiences($employee_professionnalExperience)
    {
        return $this->wrk->update_employee_professionnalExperiences($employee_professionnalExperience);
    }

    public function empty_employee_professionnalExperiences($pk_employee)
    {
        return $this->wrk->empty_employee_professionnalExperiences($pk_employee);
    }

    public function update_employee_consultingExperiences($employee_consultingExperiences)
    {
        return $this->wrk->update_employee_consultingExperiences($employee_consultingExperiences);
    }

    public function empty_employee_consultingExperiences($pk_employee)
    {
        return $this->wrk->empty_employee_consultingExperiences($pk_employee);
    }

    public function update_employee_auditExperiences($employee_auditExperiences)
    {
        return $this->wrk->update_employee_auditExperiences($employee_auditExperiences);
    }

    public function empty_employee_auditExperiences($pk_employee)
    {
        return $this->wrk->empty_employee_auditExperiences($pk_employee);
    }

    public function update_internal_qualifications_process($internalQualificationsProcess)
    {
        return $this->wrk->update_internal_qualifications_process($internalQualificationsProcess);
    }

    public function update_internal_qualifications_capacity($internalQualificationsCapacity)
    {
        return $this->wrk->update_internal_qualifications_capacity($internalQualificationsCapacity);
    }

    public function update_internal_qualifications_standard($internalQualificationsStandard)
    {
        return $this->wrk->update_internal_qualifications_standard($internalQualificationsStandard);
    }

    public function update_employee_auditObservations($employee_auditObservations)
    {
        return $this->wrk->update_employee_auditObservations($employee_auditObservations);
    }

    public function empty_employee_auditObservations($pk_employee)
    {
        return $this->wrk->empty_employee_auditObservations($pk_employee);
    }

    public function update_employee_mandateSheets($employee_mandateSheets)
    {
        return $this->wrk->update_employee_mandateSheets($employee_mandateSheets);
    }

    public function empty_employee_mandateSheets($pk_employee)
    {
        return $this->wrk->empty_employee_mandateSheets($pk_employee);
    }

    public function update_employee_objectives($employee_objectives)
    {
        return $this->wrk->update_employee_objectives($employee_objectives);
    }

    public function empty_employee_objectives($pk_employee)
    {
        return $this->wrk->empty_employee_objectives($pk_employee);
    }

    public function login($user)
    {
        return $this->wrk->login($user);
    }

    public function get_userId($username)
    {
        return $this->wrk->get_userId($username);
    }

    public function update_password($employee)
    {
        return $this->wrk->update_password($employee);
    }

    public function get_employee_type($pk_employee)
    {
        return $this->wrk->get_employee_type($pk_employee);
    }

    public function get_type_list()
    {
        return $this->wrk->get_type_list();
    }

    public function get_internal_qualifications_process_name()
    {
        return $this->wrk->get_internal_qualifications_process_name();
    }

    public function get_internal_qualifications_capacity_name()
    {
        return $this->wrk->get_internal_qualifications_capacity_name();
    }

    public function get_internal_qualifications_standard_name()
    {
        return $this->wrk->get_internal_qualifications_standard_name();
    }

    public function update_internal_qualifications_process_name($internal_qualifications_process_name)
    {
        return $this->wrk->update_internal_qualifications_process_name($internal_qualifications_process_name);
    }

    public function update_internal_qualifications_capacity_name($internal_qualifications_capacity_name)
    {
        return $this->wrk->update_internal_qualifications_capacity_name($internal_qualifications_capacity_name);
    }

    public function update_internal_qualifications_standard_name($internal_qualifications_standard_name)
    {
        return $this->wrk->update_internal_qualifications_standard_name($internal_qualifications_standard_name);
    }

    public function delete_cv($pk_employee)
    {
        return $this->wrk->delete_cv($pk_employee);
    }

    public function delete_criminal_record($pk_employee)
    {
        return $this->wrk->delete_criminal_record($pk_employee);
    }

    public function delete_picture($pk_employee)
    {
        return $this->wrk->delete_picture($pk_employee);
    }

    public function delete_formation_attachement($pk_formation, $pk_employee)
    {
        return $this->wrk->delete_formation_attachement($pk_formation, $pk_employee);
    }

    public function delete_professionnal_exp_attachement($pk_professionnal_exp, $pk_employee)
    {
        return $this->wrk->delete_professionnal_exp_attachement($pk_professionnal_exp, $pk_employee);
    }

    public function delete_mandate_sheet_attachement($pk_mandate_sheet, $pk_employee)
    {
        return $this->wrk->delete_mandate_sheet_attachement($pk_mandate_sheet, $pk_employee);
    }

    public function delete_intqual_capacity_attachement($fk_intqual_capacity, $pk_employee)
    {
        return $this->wrk->delete_intqual_capacity_attachement($fk_intqual_capacity, $pk_employee);
    }

    public function delete_intqual_process_attachement($fk_intqual_process, $pk_employee)
    {
        return $this->wrk->delete_intqual_process_attachement($fk_intqual_process, $pk_employee);
    }

    public function delete_intqual_standard_attachement($fk_intqual_standard, $pk_employee)
    {
        return $this->wrk->delete_intqual_standard_attachement($fk_intqual_standard, $pk_employee);
    }

    public function delete_auditobs_attachement($pk_auditobs, $pk_employee)
    {
        return $this->wrk->delete_auditobs_attachement($pk_auditobs, $pk_employee);
    }
}

?>