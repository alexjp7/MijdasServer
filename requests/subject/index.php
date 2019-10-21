<?php
    /************************************************
     Author:  Alex Perceval 
     Group:   Mijdas(kw01)
     Purpose: Routing script for Subject requests
    ************************************************/
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    include_once("../../config/responses.php"); 
    include_once("../../config/requests.php");

    //Helper arguments to aid in client-side debugging
    const AVAILABLE_METHODS =  ["VIEW_STUDENTS"."VIEW_OWNED_SUBJECTS","VIEW_TUTORS","REMOVE_TUTOR", 
                                "VIEW_SUBJECTS","ADD_TUTOR","POPULATE_SUBJECTS", "EDIT_SUBJECT",
                                "DELETE_SUBJECT","CREATE_SUBJECT", "ADD_STUDENTS" ];

    $data = json_decode(file_get_contents("php://input"));
    $request  = isset($data->request) 
                ? $data->request
                : badFormatRequest("No Data Posted");
    
    if(isset($data->token)) {
        $auth = post("https://accounts.mijdas.com/api/check_token/", [""], $data->token);
        badFormatRequest($auth);
    }

    //Defines Accessible routes based on request value
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

        case "REMOVE_TUTOR":
            include("removeTutor.php");
            break;

        case "VIEW_TUTORS":
            include("getTutors.php");
            break;
            
        case "VIEW_OWNED_SUBJECTS":
            include("viewSubjects.php");
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