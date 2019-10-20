<?php
    /************************************************
     Author:  Alex Perceval 
     Group:   Mijdas(kw01)
     Purpose:  Provides a list of students that 
                 are apart of an assessment
    ************************************************/
    include_once("../../config/database.php");
    include_once("../../models/student.php");
    include_once("../../models/assessment.php");

    $database = new Database();
    $connection = $database->getConnection();
    $student = new Student($connection);
    $assessment = new Assessment($connection);

    $a_id = isset($data->assessment_id) 
            ? $data->assessment_id 
            : badFormatRequest("VARIABLE: 'assessment_id' not set");

    $stmt = $student->getByAssessment($a_id);
    $criteriaCount =  $assessment->countCriteria($a_id);
    $num = $stmt->rowCount();



    if($num > 0)
    {
        $criteraiCursor = 0;
        $records = array();
        
        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $studentTotal = 0;
            extract($row);
            //Populate the first criteria of a students results for an assessment
            $students = [
                "student_id"=>$student_id,
                "result"=>0,
                "criteria"=> [ 
                    [
                        "id"=>$c_id,
                        "comment"=>$comment
                    ]
                ]
            ];
            //Keep Adding criteira marks to the student object while true
            while($criteraiCursor < $criteriaCount-1 )
            {
                extract($stmt->fetch(PDO::FETCH_ASSOC));
                $students["criteria"][] = [
                    "result"=>$result,
                    "id"=>$c_id,
                ];
                $studentTotal += $result;
                $criteraiCursor++;
            }
            $criteraiCursor = 0;
            $students["result"] = $studentTotal;
            $records[] = $students;
        }
        success();
        echo json_encode($records);
    }
    else
        notFound("Student List");
?>