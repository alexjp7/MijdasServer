<?php
    /************************************************
     Author:  Alex Perceval 
     Group:   Mijdas(kw01)
     Purpose: Routing script for user requests
    ************************************************/
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    include_once("../../config/responses.php"); 
    //Helper arguments to aid in client-side debugging
    const AVAILABLE_METHODS =  ["SEARCH_USER_PARTIAL","LOGIN", "SIGN_UP", 
                                "LOGOUT","VIEW_PROFILE", "EDIT_PROFILE",
                                "RECOVER_PASSWORD" ];

    $data = json_decode(file_get_contents("php://input"));
    $request  = isset($data->request) 
                ? $data->request
                : badFormatRequest("No Data Posted");
    //Defines Accessible routes based on request value
    switch($request)
    {   //All Users
        case "LOGIN":  
            include("login.php"); 
            break;

        case "SIGN_UP":  
            include("signUp.php"); 
            break;

        case "LOGOUT":  
            include("logout.php");
            break;

        case "VIEW_PROFILE": 
            include("viewProfile.php");
            break;

        case "EDIT_PROFILE":
            include("editProfile.php");
            break; 

        case "RECOVER_PASSWORD": 
            include("recoverPassword.php");
            break;
        case "SEARCH_USER_PARTIAL":
            include("searchUserPartial.php");
            break;
        default:
            invalidMethod(arrayToString(AVAILABLE_METHODS));
            break;
    }
?>