<?php
    /*******************************************************
     Author:  Alex Perceval 
     Group:   Mijdas(kw01)
     Purpose: Provides only cohort results to client
    *********************************************************/
    include_once("../../config/database.php");;
    include_once("../../models/student.php");
    include_once("../../models/assessment.php");
    $database = new Database();
    $connection = $database->getConnection();
    $assessment = new Assessment($connection);
    $student = new Student($connection);

    $student->assessment = isset($data->assessment_id) 
                            ? $data->assessment_id
                            : badFormatRequest("VARIABLE: 'assessment_id' not set");
    


        
    /*Fetch cohort  assessment results*/
    $stmt = $student->getAllResultsPerAssessment();
    $cohort = array();      
    while($row2 = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        extract($row2);
        array_push($cohort, $result);
    } 
    /*Fetch assessment aggregations */
    $cohortAverage = $assessment->getAverage($data->assessment_id);
    $iQDistribution = $assessment->getInterQuartileDistribution($data->assessment_id);
    $performanceBreakdown = $assessment->getPerformanceBreakdown($data->assessment_id);

    // Get cohort average mark 
    $average = $cohortAverage->fetch()["average"];
    // Fetch cohorts average performance per criteria
    $criteria = array();
    while($row3 = $performanceBreakdown->fetch(PDO::FETCH_ASSOC))
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
    
    //get quartile distribution 
    $quartiles = $iQDistribution->fetch(PDO::FETCH_ASSOC);
    $formatedQuartiles = array();
    $qSize = sizeof($quartiles);
    for ($i = 0; $i < $qSize; $i++) 
    {   
        $qIndex = $i + 1;
        $formatedQuartiles[] =  $quartiles["@q{$qIndex}"];
    }   
    
    //fetch the count of marked students
    $totalStudents = $assessment->getStudentCount($data->assessment_id);
    $markedStudents = $assessment->getMarkedStudents($data->assessment_id);


    $records = [
            "cohort_average" => $average, 
            "quartiles"=> $formatedQuartiles,
            "criteria_performance"=>$criteria,
            "total_students"=>$totalStudents,
            "markedStudents"=>$markedStudents
    ];
    success();
    echo json_encode($records, JSON_NUMERIC_CHECK);


      

  

?>