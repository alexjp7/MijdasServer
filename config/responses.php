<?php
    /************************************************
     Author:  Alex Perceval 
     Group:   Mijdas(kw01)
     Purpose: Provides  general purpose responses
                    to HTTP requests
    ************************************************/
        //200
        function success()
        {
            http_response_code(200);
        }

        //400
        function badFormatRequest($optionalMsg ="")
        {
            http_response_code(400);
            echo json_encode(array("MESSAGE" => "Poorly formatted request - {$optionalMsg}. Please refer to API documentation for more details."));
            die;
        }
        
        //401
        function unauthorized ($optionalMsg ="")
        {
            http_response_code(401);
            echo json_encode(array("MESSAGE" => "Client unauthorized.  {$optionalMsg}"));
            die;
        }
        
        //404 
        function notFound($obj, $optionalMsg = "")
        {
            http_response_code(404);
            echo json_encode(array("MESSAGE" => "{$obj} not found! {$optionalMsg}"));
            die;
        }
        //405
        function invalidMethod($methodList)
        {
            http_response_code(405);
            echo json_encode(array("MESSAGE" => "Invalid Request made. Please refer to API documentation for more details.", "VALID_METHODS"=>$methodList));
            die;
        }

        //409
        function conflictFound($optionalMsg ="")
        {
            http_response_code(409);
            echo json_encode(array("MESSAGE" => "Duplicated/Conflicting data found: {$optionalMsg}. Check for repeated execution of requests."));
            die;
        }
        
        //503
        function serverError($optionalMsg ="")
        {
            http_response_code(503);
            echo json_encode(array("MESSAGE" => "Server error, try again later! {$optionalMsg}"));
            die;
        }

        function arrayToString($arr)
        {
            $result="";
            $size = count($arr);
            for($i = 0; $i < $size; $i++)
            {
                if($i === $size - 1)
                {
                    $result .= $arr[$i];
                    break;
                }

                $result .= $arr[$i].", ";
            }
            return $result;
        } 
?>