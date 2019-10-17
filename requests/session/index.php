<?php
    /************************************************
     Author:  Alex Perceval 
     Group:   Mijdas(kw01)
     Purpose: Routing script for Sesssion requests
    ************************************************/
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    include_once("../../config/responses.php"); 
    //Helper arguments to aid in client-side debugging
    const AVAILABLE_METHODS =  ["VIEW_STUDENT_MARKS","ADD_ANNOUNCEMENT","COMFIRM_ANNOUNCEMENT","VIEW_ANNOUNCEMENT"];

    $data = json_decode(file_get_contents("php://input"));
    $request  = isset($data->request) 
                ? $data->request
                : badFormatRequest("VARIABLE 'request' not set");

    //Defines Accessible routes based on request value
    switch($request)
    {
        // Student Functions
        case "VIEW_STUDENT_ENROLMENT":
            include("viewStudentEnrolment.php");
            break;

        case "VIEW_STUDENTS_BY_SUBJECT":
            include("viewStudents.php");
            break;

        case "VIEW_RESULTS":
            include("viewStudentResults.php");
            break;
        default:
            invalidMethod(arrayToString(AVAILABLE_METHODS));
            break;
    }
?>