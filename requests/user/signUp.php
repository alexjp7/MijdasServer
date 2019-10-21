<?php
    /************************************************
     Author:  Alex Perceval 
     Group:   Mijdas(kw01)
     Purpose: To create user accounts
    ************************************************/
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST"); 
    include_once("../../config/database.php");
    include_once("../../models/user.php");

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
    $user->firstName = $data->firstName;
    $user->lastName = $data->lastName;
 
    if(!empty($user->username) && !empty($user->password) && !empty($user->email) && !empty($user->permissionType))
    {
        if($user->create())
        {   //Request OK
            success();
            echo json_encode(array("message"=>"user creation succesful! "));
        }
        else
        {   //Service unailable
            serverError();
        }
    }
    else
    {   //Bad Request
        badFormatRequest("User data not formatted properly");
    }  
?>