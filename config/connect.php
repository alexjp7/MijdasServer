<?php
  /************************************************
   Author:  Alex Perceval 
  Date:    3/10/2018
  Group:   Mijdas(kw01)
  Purpose:  Provides database connection credentials 
              for Mysql local instnace
  ************************************************/
    DEFINE("HOST","localhost");
    DEFINE("DB_NAME","Markit");
    DEFINE("USERNAME","MarkitUser");
    DEFINE("PASSWORD","mijdas123");
    DEFINE("DOCUMENT_ROOT", realpath($_SERVER['DOCUMENT_ROOT'])."\api");
?>