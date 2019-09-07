<?php
    include_once("../../config/database.php");;
    include_once("../../models/subject.php");

    $database = new Database();
    $connection = $database->getConnection();
    $subject = new Subject($connection);

    $tutors = isset($data->tutors) 
                ? $data->tutors
                : badFormatRequest("VARIABLE: 'tutors' not set");

    $subject->subject_id = isset($data->subject_id) 
                            ? $data->subject_id
                            : badFormatRequest("VARIABLE: 'subject_id' not set");

    if($subject->addTutor($tutors))
    {
        success();
        echo json_encode(array("MESSAGE"=>"Tutors added succesfully!"));
    }
    else
    {
        conflictFound($subject->getErrorMessage());
    }
?>