<?php
        include_once("../../config/database.php");;
        include_once("../../models/subject.php");


        $database = new Database();
        $connection = $database->getConnection();
        $subject = new Subject($connection);
        
        //Set Subject variables
        $subject->code = isset($data->code) 
                        ? $data->code 
                        : badFormatRequest("VARIABLE: 'code' not set");
                        
        $subject->institution_id = isset($data->institution_id) 
                                ? $data->institution_id 
                                : badFormatRequest("VARIABLE: 'institution_id' not set");
                                        
        $subject->coordinator1 = isset($data->coordinator) 
                                ? $data->coordinator 
                                : badFormatRequest("VARIABLE: 'coordinator' not set");
        //Process Data                       
        if($subject->create())
        {
            success();
            echo json_encode(array("MESSAGE"=>"Subject Created Successfully!"));
        }
        else
        {
            conflictFound("Subject already exists");
        }
?>