<?php
    /************************************************
     Author:  Alex Perceval 
     Group:   Mijdas(kw01)
     Purpose: Routing script for assessment requests
    ************************************************/
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    include_once("../../config/responses.php"); 
    //Helper arguments to aid in client-side debugging
    const AVAILABLE_METHODS =  ["VIEW_ASSESSMENT","CREATE_ASSESSMENT","DELETE_ASSESSMENT", 
                                "EDIT_ASSESSMENT","POPULATE_STUDENTS", "SUBMIT_MARK", "
                                TOGGLE_ACTIVATION"];

    $data = json_decode(file_get_contents("php://input"));
    $request  = isset($data->request) 
                ? $data->request
                : badFormatRequest("No Data Posted");

    if(isset($data->token)) {
        require "../../vendor/autoload.php";
        $guzzle = new GuzzleHttp\Client(['headers' => ['Authorization' => 'Bearer ' . $data->token]]);
        $response = $guzzle->request('POST', 'https://accounts.mijdas.com/api/check_token/', []);
        // badFormatRequest($response->getBody());
        $scopes = json_decode($response->getBody())->scopes;
        // badFormatRequest($scopes);

        $scope_methods = [
            'coordinator' => [
                'CREATE_ASSESSMENT',
                'DELETE_ASSESSMENT',
                'EDIT_ASSESSMENT',
                'TOGGLE_ACTIVATION',
                'VIEW_ASSESSMENT',
                'POPULATE_STUDENTS',
                'SUBMIT_MARK'
            ],
            'tutor' => [
                'VIEW_ASSESSMENT',
                'POPULATE_STUDENTS',
                'SUBMIT_MARK'
            ],
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
    }

    //Defines Accessible routes based on request value
    switch($request)
    {
        //Coordinator Functions 
        case "CREATE_ASSESSMENT":
            include("createAssessment.php");
            break;
 
        case "DELETE_ASSESSMENT":
            include("deleteAssessment.php");
            break;
        
        case "EDIT_ASSESSMENT":
            include("editAssessment.php");
            break;   
        case "TOGGLE_ACTIVATION":
            include("toggleActivation.php");
            break;
        //Tutor Functions 
        case "VIEW_ASSESSMENT":
            include("viewAssessment.php");
            break;
 
        case "POPULATE_STUDENTS":  
            include("populateStudents.php");
            break;

        case "SUBMIT_MARK": 
            include("submitMark.php");
            break;

        default:
            invalidMethod(arrayToString(AVAILABLE_METHODS));
            break;
    }
?>