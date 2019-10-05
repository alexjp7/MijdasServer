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
        $results = array();
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
            array_push($results,$studentResult);
        }
        /*Fetch cohort  assessment results*/
        $stmt2 = $student->getAllResultsPerAssessment();
        $cohort = array();      
        while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
        {
            extract($row2);
            array_push($cohort, $result);
        } 
        /*Fetch assessment aggregations */
        $stmt3 = $assessment->getAverage($data->assessment_id);
        $stmt4 = $assessment->getInterQuartileDistribution($data->assessment_id);
        
        $average = $stmt3->fetch()["average"];

        $quartiles = $stmt4->fetch(PDO::FETCH_ASSOC);
        $formatedQuartiles = array();
        $qSize = sizeof($quartiles);
        for ($i = 0; $i < $qSize; $i++) 
        {   
            $qIndex = $i + 1;
            $formatedQuartiles[] = ["q{$qIndex}" => $quartiles["@q{$qIndex}"]];
        }         
       
        $records = ["student_results"=>$results, "cohort_average" => $average, "quartiles"=> $formatedQuartiles];
        success();
        echo json_encode($records);
    }
    else
        notFound("results");
        
?>