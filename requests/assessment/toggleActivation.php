<?php
    include_once("../../config/database.php");
    include_once("../../models/assessment.php");

    $assessment_id = isset($data->assessment_id)
    ? $data->assessment_id
    : badFormatRequest("VARIABLE: 'assessment_id' not set"); 

    $database = new Database();
    $connection = $database->getConnection();
    $assessment = new Assessment($connection);
    $assessment->assessment_id = $assessment_id;

    if($assessment->toggleActivation())
    {
        success();
        echo json_encode(array("MESSAGE"=>" Assessment Activation/De-Activation Succesful!"));
    }
    else
    {
        conflictFound($assessment->getErrorMessage());
    }
?>