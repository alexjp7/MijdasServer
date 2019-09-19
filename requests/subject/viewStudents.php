<?php
    header("Access-Control-Allow-Methods: POST");
    header("Content-Type: application/json; charset=UTF-8");

    include_once("../../config/database.php");
    include_once("../../models/student.php");

    $database = new Database();
    $connection = $database->getConnection();
    $student = new student($connection);

    $subject_id = isset($data->subject_id) ? $data->subject_id : badFormatRequest("VARIABLE 'subject_id' not set");
    
    $stmt = $student->getBySubject($subject_id);
    $num = $stmt->rowCount();
    if($num > 0)
    {
        $records = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            array_push($records, $student_id); 
        }
        echo json_encode($records);
    }
    else
    {
        notFound("students");
    }
?>