<?php
    /************************************************
     Author:  Alex Perceval 
     Date:    3/10/2019
     Group:   Mijdas(kw01)
     Purpose: Allows coordinators to add students 
                to their subjects
    ************************************************/
    include_once("../../config/database.php");
    include_once("../../models/student.php");

    $database = new Database();
    $connection = $database->getConnection();

    $student = new Student($connection);

    $studentList = isset($data->students)
                ? $data->students
                : badFormatRequest("VARIABLE: 'students' not set");

    $subjectId = isset($data->subject_id)
                ? $data->subject_id
                : badFormatRequest("VARIABLE: 'subject_id' not set");

    if($student->addToSubject($studentList, $subjectId))
    {
        success();
        echo json_encode(array("message"=>"students added successfully! "));
    }
    else
        conflictFound("student already is listed as apart of this subject");

?>