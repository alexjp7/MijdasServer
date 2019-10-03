<?php
    /************************************************
     Author:  Alex Perceval 
     Date:    3/10/2018
     Group:   Mijdas(kw01)
     Purpose: Provides subjects taught by a tutor
    ************************************************/
    include_once("../../config/database.php");;
    include_once("../../models/subject.php");

    $username = isset($data->username) ? $data->username : badFormatRequest("VARIABLE: 'username' not set");

    $database = new Database();
    $connection = $database->getConnection();
    $subject = new Subject($connection);

    $stmt = $subject->readInstitution($username);
    $num = $stmt->rowCount();

    if($num > 0)
    {
        $record = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            //Extract uni ID
            extract($row);
            $institutions = array("institution" => $name);
            $subjectArr   = array();
            //Create query for each institution (in order to nest the data)
            $stmt2 = $subject->readSubject($id, $username);
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
            $record[] = array("institution" => $name, "subjects" =>$subjectArr);
        }
        success();
        echo json_encode($record);
    }
    else
        notFound("subjects");
?>