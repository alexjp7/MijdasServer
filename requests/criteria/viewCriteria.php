<?php
    /************************************************
     Author:  Alex Perceval 
     Date:    3/10/2019
     Group:   Mijdas(kw01)
     Purpose: Provides the existing criteria to 
                the client.
    ***********************************************
    include_once("../../config/database.php");
    include_once("../../models/criteria.php");

    $database = new Database();
    $connection = $database->getConnection();
    $criteria = new Criteria($connection);

    $assessment_id = isset($data->assessment_id)
                    ? $data->assessment_id
                    : badFormatRequest("VARIABLE: 'assessment_id' not set");

    $stmt = $criteria->getBySubject($assessment_id);
    $num = $stmt->rowCount();

    if($num > 0)
    {
        $records["records"] = array();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            $criteria = array(
                  "criteria" => $c_id,
                  "element" => $element,
                  "maxMark" => $max_mark,
                  "displayText" =>$display_text
            );
            array_push($records["records"],  $criteria);
        }
        success();
        echo json_encode(array($records));
    }
    else
        notFound("criteria");
?> 