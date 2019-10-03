<?php
    /************************************************
     Author:  Alex Perceval 
     Date:    3/10/2019
     Group:   Mijdas(kw01)
     Purpose: Populates student table with results
                per assessment if assessments exist
    ************************************************/
    include_once("../../config/database.php");
    include_once("../../models/student.php");
    include_once("../../models/assessment.php");

    $database = new Database();
    $connection = $database->getConnection();
    $student = new student($connection);
    $assessment = new assessment($connection);
    //Validate post data
    $subject_id = isset($data->subject_id) ? $data->subject_id : badFormatRequest("VARIABLE 'subject_id' not set");
    $stmt = $assessment->countActive($subject_id);
    $hasAssessment = false; //Assume no assessments

    if($stmt->rowCount() === 1)
    {
        extract($stmt->fetch());
        $hasAssessment = true;
    }
 
    //Check If the subject has active assessments
    if($hasAssessment)
    {
        $stmt = $student->getBySubject($subject_id, $hasAssessment);
        $num = $stmt->rowCount();

        if($num > 0)
        {
            $records = array();
            $taskCursor = 0;

            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                extract($row);
                //Constract student object, with first task
                $students = [
                    "student_id"=>$student_id,
                    "tasks"=> array(
                        array(
                            "task_name" => $name,
                            "result" => $result,
                            "a_id" => $a_id
                        )
                    )     
                ];
                $taskCursor++; 
                //Keep Adding tasks to the student object while true
                while($taskCursor < $count)
                {
                    extract($stmt->fetch(PDO::FETCH_ASSOC));
                    $students["tasks"][] =  [
                        "task_name" => $name,
                        "result" => $result,
                        "a_id" => $a_id
                    ];                    
                    $taskCursor++;
                }
                $taskCursor = 0;            
                $records[] = $students; 
            }
            echo json_encode($records);
        }
        else
            notFound("students");

    }//If no ACTIVE assessments are available for the subject, just return list of students
    else
    {
        $stmt = $student->getBySubject($subject_id, $hasAssessment);
        $num = $stmt->rowCount();
        //Check if Students
        if($num > 0)
        {
            $records = array();
            $taskCursor = 0;

            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                extract($row);
                $records[] = [
                   "student_id" => $student_id,
                   "tasks" => null
                ];
            }
            echo json_encode($records);
        }
        else
            notFound("students");
    }
?>