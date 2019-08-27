<?php
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    //PROVIDES HTTP RESPONSE BEHAVIOURS 
    include_once("../../config/responses.php"); 

    $data = json_decode(file_get_contents("php://input"));

    $request  = isset($data->request) 
                ? $data->request
                : badFormatRequest();


/***************************************************
 * Defines Accessible routes based on request value
*****************************************************/
    switch($request)
    {
        case "VIEW_ASSESSMENT":  //DONE!
            include("viewAssessment.php");
            break;

        case "CREATE_ASSESSMENT":  
            include("createAssessment.php");
            break;
 
        case "DELETE_ASSESSMENT":  
            include("deleteAssessment.php");
            break;
        
        case "EDIT_ASSESSMENT":  
            include("editAssessment.php");
            break;

        case "POPULATE_STUDENTS":  
            include("populateStudents.php");
            break;

        default:
            invalidMethod();
            break;
    }

?>