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
    
    $student->studentId = isset($data->student_id) 
                            ? $data->student_id
                            : badFormatRequest("VARIABLE: 'student_id' not set");
    $student->assessment = isset($data->assessment_id) 
                            ? $data->assessment_id
                            : badFormatRequest("VARIABLE: 'assessment_id' not set");
    
    $stmt = $student->getResultPerAssessment();
    $num = $stmt->rowCount();

    if($num > 0)
    {   
        $results["student_results"] = array();
        /* Fetch individual students results for queried assessment */
        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            $studentResult = [
                "display_text" => $display_text,
                "result" => $result,
                "max_mark" => $max_mark,
                "comment"=>$comment
            ];
            array_push($results["student_results"],$studentResult);
        }
        /*Fetch aggreations of assessment results*/
        $stmt2 = $student->getAllResultsPerAssessment();
        $cohort["cohort_results"] = array();      
        while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
        {
            extract($row2);
            array_push($cohort["cohort_results"], $result);
        } 
        $records = [$results,$cohort];
        success();
        echo json_encode($records);
    }
    else
        notFound("results");
        
?>