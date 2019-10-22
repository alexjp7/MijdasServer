<?php
    /************************************************
     Author:  Alex Perceval 
     Group:   Mijdas(kw01)
     Purpose: Routing script for Sesssion requests
    ************************************************/
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    include_once("../../config/responses.php"); 
    //Helper arguments to aid in client-side debugging
    const AVAILABLE_METHODS =  ["VIEW_STUDENT_MARKS","ADD_ANNOUNCEMENT","COMFIRM_ANNOUNCEMENT","VIEW_ANNOUNCEMENT"];

    $data = json_decode(file_get_contents("php://input"));
    $request  = isset($data->request) 
                ? $data->request
                : badFormatRequest("VARIABLE 'request' not set");

    if(isset($data->token)) {
        require "../../vendor/autoload.php";
        $guzzle = new GuzzleHttp\Client(['headers' => ['Authorization' => 'Bearer ' . $data->token]]);
        $response = $guzzle->request('POST', 'https://accounts.mijdas.com/api/check_token/', []);
        // badFormatRequest($response->getBody());
        $scopes = json_decode($response->getBody())->scopes;
        // badFormatRequest($scopes);

        $scope_methods = [
            'coordinator' => [
                'VIEW_STUDENT_ENROLMENT',
                'VIEW_STUDENTS_BY_SUBJECT',
                'VIEW_STUDENT_RESULTS',
                'VIEW_COHORT_RESULTS'
            ],
            'tutor' => [
                'VIEW_STUDENT_ENROLMENT',
                'VIEW_STUDENTS_BY_SUBJECT',
                'VIEW_STUDENT_RESULTS',
                'VIEW_COHORT_RESULTS'
            ],
            'student' => [
                'VIEW_STUDENT_ENROLMENT',
                'VIEW_STUDENTS_BY_SUBJECT',
                'VIEW_STUDENT_RESULTS',
                'VIEW_COHORT_RESULTS'
            ]
        ];

        $scope_valid = false;
        for($i = 0; $i < count($scopes); $i++) {
            if(array_key_exists($scopes[$i], $scope_methods) && in_array($request, $scope_methods[$scopes[$i]])) {
                $scope_valid = true;
                break;
            }
        }

        if(!$scope_valid) {
            badFormatRequest("Invalid token scope");
        }
    } else {
        badFormatRequest("Missing token");
    }
                
    //Defines Accessible routes based on request value
    switch($request)
    {
        // Student Functions
        case "VIEW_STUDENT_ENROLMENT":
            include("viewStudentEnrolment.php");
            break;

        case "VIEW_STUDENTS_BY_SUBJECT":
            include("viewStudents.php");
            break;

        case "VIEW_STUDENT_RESULTS":
            include("viewStudentResults.php");
            break;

        case "VIEW_COHORT_RESULTS":
            include("viewCohortResults.php");
            break;
        default:
            invalidMethod(arrayToString(AVAILABLE_METHODS));
            break;
    }
?>