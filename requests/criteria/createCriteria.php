<?php
    /************************************************
     Author:  Alex Perceval 
     Date:    3/10/2018
     Group:   Mijdas(kw01)
     Purpose: Allows coordinators to create criteria
                for their assessments
    ************************************************/
    include_once("../../config/database.php");
    include_once("../../models/criteria.php");

    $database = new Database();
    $connection = $database->getConnection();
    $criteria = new Criteria($connection);

    $criteria->a_id = isset($data->assessment_id)
                    ? $data->assessment_id
                    : badFormatRequest("VARIABLE: 'assessment_id' not set");

    $criteria->element = isset($data->element)
                    ? $data->element
                    : badFormatRequest("VARIABLE: 'element' not set");

    $criteria->max_mark = isset($data->max_mark)
                    ? $data->max_mark
                    : badFormatRequest("VARIABLE: 'max_mark' not set");

    $criteria->display_text = isset($data->display_text)
                    ? $data->display_text
                    : badFormatRequest("VARIABLE: 'display_text' not set");

    if($criteria->create())
    {
        success();
        echo json_encode(array("MESSAGE"=>"criteria created succesfully!"));
    }
    else
        conflictFound("task_name is not unique within subject");

?>