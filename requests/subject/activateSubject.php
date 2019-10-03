<?php
    /************************************************
     Author:  Alex Perceval 
     Date:    3/10/2018
     Group:   Mijdas(kw01)
     Purpose: Allows tutors to activate a subject 
    ************************************************/
    include_once("../../config/database.php");;
    include_once("../../models/subject.php");

    $database = new Database();
    $connection = $database->getConnection();
    $subject = new Subject($connection);
    
    $subject->subject_id = isset($data->subject_id) 
                            ? $data->subject_id
                            : badFormatRequest("VARIABLE: 'subject_id' not set");
    
    $subject->session_expiry = isset($data->session_expiry) 
                                ? $data->session_expiry
                                : badFormatRequest("VARIABLE: 'session_expiry' not set");
    //Process Activation                     
    if($subject->activateSubject())
    {
        success();
        echo json_encode(array("MESSAGE"=>"Subject Activation Successfully!"));
    }
    else
        conflictFound("Subject activation failed");
?>