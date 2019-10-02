<?php
        include_once("../../config/database.php");;
        include_once("../../models/student.php");

  
        $database = new Database();
        $connection = $database->getConnection();
        $student = new Student($connection);
        
        //Set Subject variables
        $student->studentId = isset($data->student_id) 
                                ? $data->student_id
                                : badFormatRequest("VARIABLE: 'student_id' not set");
       
        $stmt = $student->getSubjectsEnrolled();
        $num = $stmt->rowCount();

        if($num > 0)
        {   
            $records = array();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                extract($row);
         
                $stmt2 = $student->getActiveTasks($subject_id);
                $num2 = $stmt->rowCount();
                $assessments = array();
                if($num2 > 0)
                {
                    while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
                    {
                        extract($row2);
                        $assessments[] = ["id"=>$assessment_id, "name"=>$name,"file"=>"task"];
                    }
                }
                $records[] = [
                    "id" => $subject_id,
                    "name" => $code,
                    "children"=>$assessments
                ];
                
            }
            success();
            echo json_encode($records);

        }
        else
        {
            notFound("subjects");
        }
?>