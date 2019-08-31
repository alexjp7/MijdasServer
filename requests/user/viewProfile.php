<?php
    header("Access-Control-Allow-Methods: GET");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once("../../config/database.php");
    include_once(DOCUMENT_ROOT."/config/database.php");
    include_once(DOCUMENT_ROOT."/models/user.php");

    $database = new Database();
    $conn = $database->getConnection();
    $user = new User($conn);


    $data = json_decode(file_get_contents("php://input"));

    $username = isset($data->username)
    ? $data->username
    : badFormatRequest("VARIABLE: 'username' not set");

    //Check if username has been passed as paramter 
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
                "email" => $email,
                "permission_type" => $permission_type
            );
  
            array_push($userArr["records"], $user);
        }
    
        success();
        echo json_encode($userArr);
    }
    else
    {
        notFound("user");
    }
 
?>      