<?php

    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET"); 
    include_once("../../config/database.php");
    include_once(DOCUMENT_ROOT."/config/database.php");
    include_once(DOCUMENT_ROOT."/models/subject.php");

    $database = new Database();
    $connection = $database->getConnection();
    $subject = new Subject($connection);


    $stmt = isset($_GET["username"]) 
    ? $subject->readInstitution(($_GET["username"]))
    :invalidRequest();

    $username = ($_GET["username"]);
    
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
                    $subj = array("subject_code"=>$subject_code);
                    //push each subject 
                    array_push($subjectArr, $subj);
                }
            }
            //push the list of subjects
            array_push($institutions, $subjectArr);
            array_push($record["records"], $institutions);
        }

        http_response_code(201);
        echo json_encode($record);

    }

    


    

    
    function invalidRequest()
    {
        http_response_code(404);
        echo json_encode(array("message" => "No subjects found."));
        die;
    }


?>