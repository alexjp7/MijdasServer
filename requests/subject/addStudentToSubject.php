<?php
    include_once("../../config/database.php");
    include_once("../../models/student.php");

    $database = new Database();
    $connection = $database->getConnection();

    $student = new Student($connection);
    //Validate correct data has been provided
    $studentList = isset($data->students)
                ? $data->students
                : badFormatRequest();

    $subjectId = isset($data->subject_id)
                ? $data->subject_id
                : badFormatRequest();

    if($student->addToSubject($studentList, $subjectId))
    {
        success();
        echo json_encode(array("message"=>"students added successfully! "));
    }
    else
    {
        //Student already exists as apart of the requested subject.
        conflictFound();
    }

?>