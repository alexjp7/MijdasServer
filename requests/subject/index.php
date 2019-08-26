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
        case "POPULATE_SUBJECTS":  
            include("populateSubjects.php"); //DONE!
            break;

        case "EDIT_SUBJECT":
            include("editSubject.php");
            break;
  
        case "DELETE_SUBJECT":
            include("deleteSubject.php");
            break;

        case "CREATE_SUBJECT":
            include("createSubject.php");
            break;
      
        default:
            invalidMethod();
            break;
    }

?>