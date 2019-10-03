<?php
    /*******************************************************
     Author:  Alex Perceval 
     Date:    3/10/2019
     Group:   Mijdas(kw01)
     Purpose: Provides results to a student,
             along with an aggregation of other statistical
              information about assessment performance
    *********************************************************/
    include_once("../../config/database.php");;
    include_once("../../models/student.php");
    $database = new Database();
    $connection = $database->getConnection();
    $student = new Student($connection);
    
    //Set Subject variables
    $student->studentId = isset($data->student_id) 
                            ? $data->student_id
                            : badFormatRequest("VARIABLE: 'student_id' not set");
    
    $stmt = $student->getResults();
    $num = $stmt->rowCount();

    if($num > 0)
    {   
        $records = array();
      
        success();
        echo json_encode($records);
    }
    else
        notFound("results");
        
?>