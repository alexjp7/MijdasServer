<?php
    /************************************************
     Author:  Alex Perceval 
     Date:    3/10/2018
     Group:   Mijdas(kw01)
     Purpose: Allows coordinators to create subjects
    ************************************************/
    include_once("../../config/database.php");
    include_once("../../models/subject.php");

    $database = new Database();
    $connection = $database->getConnection();
    $subject = new Subject($connection);
    
    //Set Subject variables
    $subject->code = isset($data->code) 
                    ? $data->code 
                    : badFormatRequest("VARIABLE: 'code' not set");
                    
    $subject->institution_id = isset($data->institution_id) 
                            ? $data->institution_id 
                            : badFormatRequest("VARIABLE: 'institution_id' not set");
                                    
    $subject->coordinator1 = isset($data->coordinator) 
                            ? $data->coordinator 
                            : badFormatRequest("VARIABLE: 'coordinator' not set");
    if($subject->create())
    {
        $stmt = $subject->readID($subject->code, $subject->institution_id, $subject->coordinator1);
        if($stmt->rowCount() > 0)
        {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $subject_id = $row['id'];
        } else
            $subject_id = '';

        success();
        echo json_encode(array(
            "MESSAGE" => "Subject Created Successfully!",
            "subject_id" => $subject_id
        ));
    }
    else
        conflictFound("Subject already exists");
?>