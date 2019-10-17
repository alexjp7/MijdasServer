<?php
    /************************************************
     Author:  Alex Perceval 
     Group:   Mijdas(kw01)
     Purpose:  To authenticate user credentials when
                logging into a client side app.
    ************************************************/
    header("Access-Control-Allow-Methods: POST");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once("../../config/database.php");
    include_once("../../models/user.php");

    $database = new Database();
    $connection = $database->getConnection();
    $user = new User($connection);

    $data = json_decode(file_get_contents("php://input"));


    $user->username = $data->username;
    $providedUsername = $data->username;
    $providedPassword = $data->password;

    //Validate Login Credentials
    if(!empty($providedUsername)  && !empty($providedPassword))
    {
        $stmt = $user->readOne($providedUsername);
        $num = $stmt->rowCount();
        if($num === 1)
        {   
            extract($stmt->fetch(PDO::FETCH_ASSOC));

            if($username === $providedUsername && $password === $providedPassword)
            {   //Login Credentials Corrrect
                success();
                echo json_encode(array("MESSAGE:"=>"Login Succes!"));
            }
            else
            {   //Incorrect Login- user not found
                notFound("user");
            }
        }
        else
        {   //Incorect Login - user not found
            notFound("user");
        }
    }
    else 
    {  //Bad Request 400
        badFormatRequest("username or password not set");

    }
?>