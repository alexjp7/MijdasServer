<?php
    /************************************************
     Author:  Alex Perceval 
     Group:   Mijdas(kw01)
     Purpose: Removes an existing staff member 
              from a subject
    ************************************************/
    header("Access-Control-Allow-Methods: POST");
    header("Content-Type: application/json; charset=UTF-8");

    include_once("../../config/database.php");
    include_once("../../models/subject.php");

    $database = new Database();
    $connection = $database->getConnection();
    $subject = new subject($connection);

    $subject_id = isset($data->subject_id) ? $data->subject_id : badFormatRequest("VARIABLE 'subject_id' not set");
    $tutor_username = isset($data->tutor_username) ? $data->tutor_username : badFormatRequest("VARIABLE 'tutor_username' not set");
    $subject->removeTutorFromSubject($subject_id, $tutor_username) ? success(): notFound("tutor");
?>