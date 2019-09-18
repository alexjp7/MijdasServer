<?php
    header("Access-Control-Allow-Methods: POST");
    header("Content-Type: application/json; charset=UTF-8");

    include_once("../../config/database.php");
    include_once("../../models/user.php");

    $database = new Database();
    $connection = $database->getConnection();
    $user = new User($connection);

    $data = json_decode(file_get_contents("php://input"));
    $query_string = isset($data->query_string) ? $data->query_string : badFormatRequest("VARIABLE 'query_string' not set");
    
    $stmt = $user->matchUser($query_string);
    $num = $stmt->rowCount();
    if($num > 0)
    {
        $records = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            array_push($records, $username); 
        }
        echo json_encode($records);
    }
    else
    {
        notFound("users");
    }
?>