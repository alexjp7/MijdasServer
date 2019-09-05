<?php
    include_once("../../config/database.php");
    include_once("../../models/student.php");

    $database = new Database();
    $connection = $database->getConnection();

    $student = new Student($connection);
    $a_id = isset($data->assessment_id) ? $data->assessment_id : badFormatRequest("VARIABLE: 'assessment_id' not set");
    
    $stmt = $student->getByAssessment($a_id);
    $num = $stmt->rowCount();

    if($num > 0)
    {
        $records["records"] = array();
        
        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            $student = array(
                "student_id"=>$student_id,
                "result" =>$result
            );
            array_push($records["records"],$student);
        }
        success();
        echo json_encode(array($records));
    }
    else
    {
        notFound("Student List");
    }
  
?>