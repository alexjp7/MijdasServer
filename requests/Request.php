<?php
    class Request 
    {
        //Upon Construction, the object will be bounded to the server data. 
        function __construct()
        {
            $this->bindRequestData();
        }

        private function bindRequestData()
        {
            //for each key/pair in global SERVER array, assign it to `this`
            foreach($_SERVER as $key => $value)
            {   //re-format KEY into camelCase (in order to be appropriate for use as a variable).
                $this->{ $this->toCamelCase($key) } = $value;
            }
        }

    
        //Used to grab POST data from request
        public function getRequestBody()
        {
            //Array to hold the input params for POST request.
            $body = array();

            //If request is GET, no data handling will be necessary
            if($this->requestMethod === "GET")
            {
                return;
            }
            
            if($this->requestMethod === "POST")
            {
                //Fill in request data
             
            }

            return $body;
        }
   
        //Formatting function
        private function toCamelCase($string)
        {
          $result = strtolower($string);
              
          preg_match_all('/_[a-z]/', $result, $matches);

          foreach($matches[0] as $match)
          {
              //remove _ (between words) and capitalise first letter of next word
              $c = str_replace('_', '', strtoupper($match));
              $result = str_replace($match, $c, $result);
          }

          return $result;
        }
        

    }
?>