<?php 
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET"); 
    include_once("../../config/database.php");
    include_once(DOCUMENT_ROOT."/config/database.php");
    include_once(DOCUMENT_ROOT."/models/institution.php");

    $database = new Database();
    $conn = $database->getConnection();

    $institution = new Institution($conn);


    /************************************************
     * Check if a username has been provided
     * If it is set, request all linked institutions
     ***********************************************/
    $stmt = isset($_GET['user'])
    ? $institution->readAllUserInstituions($_GET['user'])
    : invalidRequest();


    $num = $stmt->rowCount();

    if($num > 0)
    {
        $records["records"] = array();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            $institution = array(
                "name"=>$name,
                "institution_id"=>$id
            );

            array_push($records["records"], $institution);
        }

        http_response_code(200);
        echo json_encode($records);

    }
    else
    {   //Request not found 
        invalidRequest();
    }

    function invalidRequest()
    {
        http_response_code(404);
        echo json_encode(array("message" => "No instituions found."));
        die;
    }
?>