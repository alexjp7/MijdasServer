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
        case "HOME_PAGE":  
            include("populateHome.php");
            break;
        case "MANAGE_SUBJECTS":

            break;
      
        default:
            invalidMethod();
            break;
    }

?>