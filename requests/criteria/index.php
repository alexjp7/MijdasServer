<?php
    /************************************************
     Author:  Alex Perceval 
     Group:   Mijdas(kw01)
     Purpose: Routing script for Criteria requests
    ************************************************/
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    include_once("../../config/responses.php"); 
    //Helper arguments to aid in client-side debugging
    const AVAILABLE_METHODS =  ["VIEW_CRITERIA", "CREATE_CRITERIA","EDIT_CRITERIA","DELETE_CRITERIA"];
    $data = json_decode(file_get_contents("php://input"));
    $request  = isset($data->request) 
                ? $data->request
                : badFormatRequest("No Data Posted");


    //Defines Accessible routes based on request value
    switch($request)
    {
        //Coordinator Functions 
        case "CREATE_CRITERIA":  
        include("createCriteria.php");
            break;
            
        case "EDIT_CRITERIA":  
        include("editCriteria.php");
            break;

        case "DELETE_CRITERIA":  
        include("deleteCriteria.php");
            break;

        //Tutor Functions 
        case "VIEW_CRITERIA":  
            include("viewCriteria.php");
            break;
        default:
            invalidMethod(arrayToString(AVAILABLE_METHODS));
            break;
    }

?>