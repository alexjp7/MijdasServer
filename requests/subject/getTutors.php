<?php
    header("Access-Control-Allow-Methods: POST");
    header("Content-Type: application/json; charset=UTF-8");

    include_once("../../config/database.php");
    include_once("../../models/subject.php");

    $database = new Database();
    $connection = $database->getConnection();
    $subject = new subject($connection);

    $data = json_decode(file_get_contents("php://input"));
    $subject_id = isset($data->subject_id) ? $data->subject_id : badFormatRequest("VARIABLE 'subject_id' not set");
    
    $stmt = $subject->getTutorsBySubject($subject_id);
    $num = $stmt->rowCount();
    if($num > 0)
    {
        $records = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            array_push($records, $username); 
        }
        echo json_encode($records);
    }
    else
    {
        notFound("tutors");
    }
?>