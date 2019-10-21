<?php
    /************************************************
     Author:  Alex Perceval 
     Group:   Mijdas(kw01)
     Purpose: Deletes a criteria from the database
    ***********************************************/
    include_once("../../config/database.php");
    include_once("../../models/criteria.php");

    $database = new Database();
    $connection = $database->getConnection();
    $criteria = new Criteria($connection);

    $a_id = isset($data->a_id)
                    ? $data->a_id
                    : badFormatRequest("VARIABLE: 'a_id' not set");
    $c_id = isset($data->c_id)
                    ? $data->c_id
                    : badFormatRequest("VARIABLE: 'c_id' not set");


    if($criteria->delete($a_id,$c_id))
        success();
    else
        conflictFound("criteria");
?> 