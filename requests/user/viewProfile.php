<?php
    /************************************************
     Author:  Alex Perceval 
     Group:   Mijdas(kw01)
     Purpose: Provide user data back to a client
    ************************************************/
    header("Access-Control-Allow-Methods: GET");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once("../../config/database.php");
    include_once("../../models/user.php");
    $database = new Database();
    $conn = $database->getConnection();
    $user = new User($conn);

    $username = isset($data->username)
    ? $data->username
    : badFormatRequest("VARIABLE: 'username' not set");

    $stmt = $user->readOne($username);
    $num = $stmt->rowCount();

    if($num>0)
    {
        $userArr["records"]=array();
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
     
            $user=array(
                "username" => $username,
                "password" => $password,
                "first_name"=>$first_name,
                "last_name"=>$last_name,
                "about"=>$about,
                "email" => $email,
                "permission_type" => $permission_type
            );
            array_push($userArr["records"], $user);
        }
        success();
        echo json_encode($userArr);
    }
    else
        notFound("user");
 
?>      