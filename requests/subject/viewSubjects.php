<?php
    /************************************************
     Author:  Alex Perceval 
     Group:   Mijdas(kw01)
     Purpose: Returns subjects of a coordinator
    ************************************************/
    include_once("../../config/database.php");;
    include_once("../../models/subject.php");

    $username = isset($data->username) 
                ? $data->username
                : badFormatRequest("VARIABLE: 'username' not set");
    
    $database = new Database();
    $connection = $database->getConnection();
    $subject = new Subject($connection);

    $stmt = $subject->readCoordinatorInstitution($username);
    $num = $stmt->rowCount();

    if($num > 0)
    {
        $record = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            //Extract uni ID
            extract($row);
            $subjectArr = array();
            //Create query for each institution (in order to nest the data)
            $stmt2 = $subject->readCoordinatorSubject($i_id, $username);
            $num2 = $stmt2->rowCount();

            if($num2 > 0)
            {   //Fetch the list of subjects for an institution
                while($row2  = $stmt2->fetch(PDO::FETCH_ASSOC))
                {
                    extract($row2);
                    $subj = array("subject_code"=>$code, "id" =>$id);
                    //push each subject 
                    $subjectArr[] = $subj;
                }
            }//push the list of subjects
            $record[] = array("institution" => $name, "i_id"=>$i_id, "subjects" =>$subjectArr);
        }
        success();
        echo json_encode($record);
    }
    else
        notFound("subjects");
?>