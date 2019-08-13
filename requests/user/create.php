<?php
/*******************************
 * 201 = OK
 * 503 = Internal Server Error
 * 404 = Bad Request Made
 ********************************/
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST"); 
    include_once("../../config/database.php");
    include_once(DOCUMENT_ROOT."/config/database.php");
    include_once(DOCUMENT_ROOT."/models/user.php");

    $database = new Database();
    $connection = $database->getConnection();

    $user = new User($connection);

    //Get posted data
    $data = json_decode(file_get_contents("php://input"));

    //Bind Data from request to user obj.
    $user->username = $data->username;
    $user->password = $data->password;
    $user->email = $data->email;
    $user->permissionType = $data->permissionType;
 
    if(!empty($user->username) && !empty($user->password) && !empty($user->email) && !empty($user->permissionType))
    {
        if($user->create())
        {   //Request OK
            http_response_code(201);
            echo json_encode(array("message"=>"user creation succesful! "));
        }
        else
        {   //Service unailable
            http_response_code(503);
            echo json_encode(array("message"=>"account creation failed"));
        }
    }
    else
    {
        //Bad Request
        http_request_code(404);
        echo json_encode(array("message"=>"account creation failed"));
    }  
?>