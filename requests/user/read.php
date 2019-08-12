
<?php
    header("Content-Type: application/json; charset=UTF-8");
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
    
        http_response_code(200);

        echo json_encode($userArr);
    }
    else
    {
        invalidRequest();
    }
 


    function invalidRequest()
    {
        http_response_code(404);
        echo json_encode(array("message" => "No user found."));
        die;
    }
?>      