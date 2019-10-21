<?php

// function post($url, $postVars = array(), $token){
//     //Transform our POST array into a URL-encoded query string.
//     $postStr = http_build_query($postVars);
//     //Create an $options array that can be passed into stream_context_create.
//     $options = array(
//         'http' =>
//             array(
//                 'method'  => 'POST', //We are using the POST HTTP method.
// 				// 'header'  => 'Content-Type: application/x-www-form-urlencoded\r\n'
// 				// 	. 'Authorization: Bearer ' . $token . '\r\n',
// 				'header' => array(
// 					'Content-Type' => 'application/x-www-form-urlencoded',
// 					'Authorization' => 'Bearer ' . $token
// 				),
//                 'content' => $postStr //Our URL-encoded query string.
//             )
//     );
//     //Pass our $options array into stream_context_create.
//     //This will return a stream context resource.
//     $streamContext  = stream_context_create($options);
//     //Use PHP's file_get_contents function to carry out the request.
//     //We pass the $streamContext variable in as a third parameter.
//     $result = file_get_contents($url, false, $streamContext);
//     //If $result is FALSE, then the request has failed.
//     if($result === false){
//         //If the request failed, throw an Exception containing
//         //the error.
//         $error = error_get_last();
//         throw new Exception('POST request failed: ' . $error['message']);
//     }
//     //If everything went OK, return the response.
//     return $result;
// }

require "../vendor/autoload.php";