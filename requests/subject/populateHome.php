<?php
    include_once("../../config/database.php");;
    include_once(DOCUMENT_ROOT."/models/subject.php");

    $username = isset($data->username) 
                ? $data->username
                : badFormatRequest();
    

    $database = new Database();
    $connection = $database->getConnection();
    $subject = new Subject($connection);

    $stmt = $subject->readInstitution($username);
    $num = $stmt->rowCount();

    if($num > 0)
    {
        $record["records"] = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            //Extract uni ID
            extract($row);

            $institutions = array("name" => $name);

            //Create query for each institution (in order to nest the data)
            $stmt2 = $subject->readSubject($id, $username);
            $num2 = $stmt2->rowCount();

            $subjectArr = array();
            if($num2 > 0)
            {   //Fetch the list of subjects for an institution
                while($row2  = $stmt2->fetch(PDO::FETCH_ASSOC))
                {
                    extract($row2);
                    $subj = array(
                        "subject_code"=>$subject_code,
                         "id" =>$id
                    );
                    //push each subject 
                    array_push($subjectArr, $subj);
                }
            }
            //push the list of subjects
            array_push($institutions, $subjectArr);
            array_push($record["records"], $institutions);
        }

        success();
        echo json_encode($record);

    }
    else
    {
        notFound("subjects");
    }

    
    

    
?>