<?php

    /*****************************************************
     * Enables CORS (Cross-Origin Resource  Sharing)
     
     * To improve web applications, developers 
        asked browser vendors to allow cross-domain requests.
        The Cross-Origin Resource Sharing (CORS) mechanism
        gives web servers cross-domain access controls, 
        which enable secure cross-domain data transfers.

    *****************************************************/
    
    header("Access-Control-Allow-Origin:", "*"); // "*" - (asteriks) determines that anyoen can read the returned content
    //Defines the return type of the data which will be returned from the GET Request
    header("Content-Type: application/json; charset=UTF-8");
  
    //Local Imports
    include_once("../config/database.php");
    include_once("../models/user.php");

 
    //Database instantiations

    $database = new Database();
    $dbConnection = $database->getConnection();
    $record = new User($dbConnection);
    $stmt = $record->read();
    
    //TODO: Check if ? variables are set, then define  query logic

    $num = $stmt->rowCount();



    if($num > 0)
    {
        $itemArr["records"] = array();

        while($row = $stmt -> fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
        
            $_item = ["username" => $username,
                     "password" => $password, 
                     "email" => $email,
                     "institution_id" => $institution_id];
        
 

            array_push($itemArr["records"], $_item);
        }
    
        http_response_code(200);

        echo json_encode($itemArr);
    }
    else
    {
        http_response_code(404);
        echo json_encode( array("message" => "No products found."));
    }

    


?>