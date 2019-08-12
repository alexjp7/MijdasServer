<?php
    include_once("../../config/database.php");
    include_once(DOCUMENT_ROOT."\config\database.php");
    include_once(DOCUMENT_ROOT."\models\user.php");

    $database = new Database();
    $conn = $database->getConnection();

    $user = new User($conn);

    //Check if username has been passed as paramter 
    $stmt = isset($_GET["id"])
    ? $user->readOne($_GET["id"])
    : invalidRequest();

    $num = $stmt->rowCount();

    if($num>0)
    {
        $user_arr["records"]=array();
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
     
            $user=array(
                "username" => $username,
                "password" => $password,
                "email" => $email,
                "permission_type" => $permission_type
            );

              //  echo strval($institutionId);
     
            array_push($user_arr["records"], $user);
        }
    
        http_response_code(200);

        // show products data in json format
        echo json_encode($user_arr);
    }
    else
    {
        //User not found
        http_response_code(404);
        // tell the client no products found
        echo json_encode(array("message" => "No products found."));
    }
 


    function invalidRequest()
    {
        http_response_code(404);
        die;
    }

  





?>      