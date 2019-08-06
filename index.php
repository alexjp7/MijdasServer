<?php
   include_once "requests/Request.php";

   $request  = new Request();
   $root = "/mijdas/api";

   //REQUEST PATHS
   $paths = array("GET"=>"{$root}/requests/Get.php",
                  "POST"=> "{$root}/requests.Post.php");


   echo "hey ".$request->queryString;


   switch($request->requestMethod)
   {
      case "GET":
            header("Location:".$paths["GET"]."?".$request->queryString);
         break;

      case "POST":
       
         break;

      default:
         break;


   }
   



?>