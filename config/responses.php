<?php
        function success()
        {
            http_response_code(200);
        }
    
        function badFormatRequest()
        {
            http_response_code(400);
            echo json_encode(array("message" => "Poorly formatted request, refer to API documentation for more details"));
            die;
        }

        function unauthorized ()
        {
            http_response_code(401);
            echo json_encode(array("message" => "Client unauthorized."));
            die;
        }
 
        function notFound($obj)
        {
            http_response_code(404);
            echo json_encode(array("message" => "{$obj} not found!"));
            die;
        }
    
   
        function invalidMethod()
        {
            http_response_code(405);
            echo json_encode(array("message" => "Invalid Request made. Please refer to API documentation for more details"));
            die;
        }

        function serverError()
        {
            http_response_code(503);
            echo json_encode(array("message" => "Server error, try again later!"));
            die;
        }

        function conflictFound()
        {
            http_response_code(409);
            echo json_encode(array("message" => "Duplicated/Conflicting data found. Check for repeated execution of requests"));
            die;
        }
    
?>