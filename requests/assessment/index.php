<?php
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    //PROVIDES HTTP RESPONSE BEHAVIOURS 
    include_once("../../config/responses.php"); 

    const AVAILABLE_METHODS =  ["VIEW_ASSESSMENT","CREATE_ASSESSMENT","DELETE_ASSESSMENT", "EDIT_ASSESSMENT","POPULATE_STUDENTS", "SUBMIT_MARK", "TOGGLE_ACTIVATION"];
    $data = json_decode(file_get_contents("php://input"));
    $request  = isset($data->request) 
                ? $data->request
                : badFormatRequest("No Data Posted");

/***************************************************
 * Defines Accessible routes based on request value
*****************************************************/
    switch($request)
    {
        //Coordinator Functions 
        case "CREATE_ASSESSMENT":
            include("createAssessment.php");
            break;
 
        case "DELETE_ASSESSMENT":
            include("deleteAssessment.php");
            break;
        
        case "EDIT_ASSESSMENT":
            include("editAssessment.php");
            break;   
        case "TOGGLE_ACTIVATION":
            include("toggleActivation.php");
            break;
       
        //Tutor Functions 
        case "VIEW_ASSESSMENT":
            include("viewAssessment.php");
            break;
 
        case "POPULATE_STUDENTS":  
            include("populateStudents.php");
            break;

        case "SUBMIT_MARK": 
            include("submitMark.php");
            break;

        default:
            invalidMethod(arrayToString(AVAILABLE_METHODS));
            break;
    }

?>