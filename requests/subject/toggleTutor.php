<?
    include_once("../../config/database.php");;
    include_once("../../models/subject.php");

    $tutors = isset($data->username) 
                ? $data->username
                : badFormatRequest("VARIABLE: 'username' not set");
    
    $database = new Database();
    $connection = $database->getConnection();

?>