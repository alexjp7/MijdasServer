<?php
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    //PROVIDES HTTP RESPONSE BEHAVIOURS 
    include_once("../../config/responses.php"); 

    const AVAILABLE_METHODS =  ["VIEW_STUDENT_MARKS","ADD_ANNOUNCEMENT","COMFIRM_ANNOUNCEMENT","VIEW_ANNOUNCEMENT"];
    $data = json_decode(file_get_contents("php://input"));

    $request  = isset($data->request) 
                ? $data->request
                : badFormatRequest("VARIABLE 'request' not set");

/***************************************************
 * Defines Accessible routes based on request value
*****************************************************/
    switch($request)
    {
        // Student Functions
        case "VIEW_STUDENT_MARKS":
            include("viewStudentMarks.php");
            break;

        default:
            invalidMethod(arrayToString(AVAILABLE_METHODS));
            break;
    }
?>