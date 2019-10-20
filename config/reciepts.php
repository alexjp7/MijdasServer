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
    function emailStudentReciept($user, $domain, $assessment, $subjectName)
    {
        $userLink = "https://mijdas.markit.com/results?id={$user}";
        $email = $user."@".$domain;
        $headers = "From: MarkIT >\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "X-Priority: 1\r\n"; 
        $headers .= "Content-Type: text/html; charset=iso-8859-1\n";
        
        $subject = "New Assessment Marked!";
        $message = "<p>Greetings,</p><p> {$assessment} for {$subjectName}  has been marked,</p>";
        $message .= "<p>Click <a href='{$userLink}'> here </a> to view your results!</p>";

        echo $message;

        mail("alnerdo@hotmail.com",$subject, $message, $headers);
    }





?>