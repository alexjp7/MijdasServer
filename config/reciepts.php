<?php
    /************************************************
     Author:  Alex Perceval 
     Group:   Mijdas(kw01)
     Purpose: Provide the email template for
     students recipets for  after mark submisison

     Note: This source file was seperated,
     as to provide  modularity for  the email/reciept
     system to aid in the evovlability of this feature.
    ************************************************/
    function emailStudentReciept($recipientAddress)
    {
        echo $recipientAddress;
        mail("alnerdo@hotmail.com","New Assessment Has Been Marked!","test");
    }





?>