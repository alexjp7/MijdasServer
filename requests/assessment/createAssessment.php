<?php
    include_once("../../config/database.php");
    include_once("../../models/assessment.php");

    $database = new Database();
    $connection = $database->getConnection();
    $assessment = new Assessment($connection);

    $assessment->subject_id = isset($data->subject_id)
            ? $data->subject_id
            :isBadFormatRequest("VARIABLE 'subject_id' is not set");

    $assessment->task_name = isset($data->task_name)
            ? $data->task_name
            :isBadFormatRequest("VARIABLE 'dispaly_text' is not set");    

    if($assessment->create())
    {
        success();
        echo json_encode(array("MESSAGE"=>"Assessment created succesfully!"));
    }
    else
    {
        conflictFound("task_name is not unique within subject");
    }

?>