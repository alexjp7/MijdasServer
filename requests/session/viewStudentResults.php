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
    include_once("../../models/assessment.php");
    $database = new Database();
    $connection = $database->getConnection();
    $student = new Student($connection);
    $assessment = new Assessment($connection);
    
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
        /*Fetch cohort  assessment results*/
        $stmt2 = $student->getAllResultsPerAssessment();
        $cohort["cohort_results"] = array();      
        while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
        {
            extract($row2);
            array_push($cohort["cohort_results"], $result);
        } 
        /*Fetch assessment aggregations */
        $stmt3 = $assessment->getAverage($data->assessment_id);
        $stmt4 = $assessment->getPerformanceBreakdown($data->assessment_id);
        
        $average = $stmt3->fetch();
        $criteria = array();
        while($row3 = $stmt4->fetch(PDO::FETCH_ASSOC))
        {
            extract($row3);
            $criterion = [ 
                "c_id"=>$c_id,
                "average"=>$average,
                "display_text"=>$display_text,
                "max_mark" => $max_mark
            ];
            array_push($criteria, $criterion);
        }
        $aggregates["aggregates"] = ["assessment_average"=>$average, "criteria_performance"=>$criteria];
        $records = [$results,$cohort,$aggregates];
        success();
        echo json_encode($records);
    }
    else
        notFound("results");
        
?>