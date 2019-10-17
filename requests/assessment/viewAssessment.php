<?php
    /************************************************
     Author:  Alex Perceval 
     Group:   Mijdas(kw01)
     Purpose: Provides list of active assessments to 
                the client.
     NOTE: If client is flagged as coordinator, 
        a list of ALL assessments is returned
    ************************************************/
    include_once("../../config/database.php");
    include_once("../../models/assessment.php");

    $subject_id = isset($data->subject_id)
                    ? $data->subject_id
                    : badFormatRequest("VARIABLE: 'subject_id' not set"); 

    $is_coordinator = isset($data->is_coordinator)
                    ? $data->is_coordinator
                    : badFormatRequest("VARIABLE: 'is_coordinator` not set");                   

    $database = new Database();
    $connection = $database->getConnection();
    $assessment = new Assessment($connection);
    $stmt = $assessment->getBySubject($subject_id, $is_coordinator);

    $row = $stmt->rowCount();

    if($row > 0 )
    {   
        $records["records"] = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            $stmt2 = $assessment->getMaxMark($id);
            $row2 = $stmt2->rowCount();     
            $maxMark = $row2 === 1 
                        ? $maxMark = $stmt2->fetch()["max_mark"]
                        : $maxMark = null;
    
            $assessmentTask = array(
                "id"=>$id,
                "a_number" => $a_number,
                "name"=>$name,
                "isActive"=>$isActive,
                "max_mark"=> $maxMark
            );
            array_push($records["records"], $assessmentTask);  
        }
        success();
        echo json_encode($records);
    }
    else
        notFound("assessment");
?>