<?php
     header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    //PROVIDES HTTP RESPONSE BEHAVIOURS 
    include_once("../../config/responses.php"); 

    const AVAILABLE_METHODS =  ["LOGIN", "SIGN_UP", "LOGOUT","VIEW_PROFILE", "EDIT_PROFILE","RECOVER_PASSWORD" ];
    $data = json_decode(file_get_contents("php://input"));
    $request  = isset($data->request) 
                ? $data->request
                : badFormatRequest("No Data Posted");


/***************************************************
 * Defines Accessible routes based on request value
*****************************************************/
    switch($request)
    {
        case "LOGIN":  
            include("login.php"); //DONE!
            break;

        case "SIGN_UP":  
            include("signUp.php"); //DONE!
            break;

        case "LOGOUT":  
            include("logout.php");
            break;

        case "VIEW_PROFILE": //DONE!
            include("viewProfile.php");
            break;

        case "EDIT_PROFILE":
            include("editProfile.php");
            break; 

        case "RECOVER_PASSWORD": // DISCUSS
            include("recoverPassword.php");
            break;

        default:
            invalidMethod(arrayToString(AVAILABLE_METHODS));
            break;
    }

?>