<?php
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    //PROVIDES HTTP RESPONSE BEHAVIOURS 
    include_once("../../config/responses.php"); 

    const AVAILABLE_METHODS =  ["ADD_TUTOR","POPULATE_SUBJECTS", "EDIT_SUBJECT", "DELETE_SUBJECT","CREATE_SUBJECT", "ADD_STUDENTS" ];
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
        case "EDIT_SUBJECT":
            include("editSubject.php");
            break;
        
        case "DELETE_SUBJECT":
            include("deleteSubject.php");
            break;
        
        case "CREATE_SUBJECT":
            include("createSubject.php");
            break;
        
        case "ACTIVATE_SUBJECT":
            include("activateSubject.php");
            break;
        
        case "ADD_STUDENTS":  
            include("addStudentToSubject.php");
            break;
            
        case "ADD_TUTOR":
            include("addTutor.php");
            break;
        //Tutor Functions
        case "POPULATE_SUBJECTS": 
            include("populateSubjects.php"); 
            break;

        default:
            invalidMethod(arrayToString(AVAILABLE_METHODS));
            break;
    }

?>