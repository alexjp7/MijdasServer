<?php


    class Router
    {
        private $request;
        private $supportedMethods = array("GET","POST","PUT", "DELETE");

        function __construct(Request $request)
        {
            $this->request = $request;
        }
        
        //Invalid calls to Router will display appropriate error code
        function __call($name, $args)
        {   
            list($route, $method) = $args;

            //Check if supported HTTP method has been invoked
            if(!in_array(strtoupper($name), $this->supportedMethods))
            {

                $this->invalidMethodHandler();
            }
            //Assign a valid method type 
            $this->{ strtolower($name) } [$this->formatRoute($route)] = $method;


        }

        /***********************************************************
         * Removes trailing forward slashes from the right of the route.
         * @param route (string)
         *************************************************************/
        private function formatRoute($route)
        {
            $result = rtrim($route, '/');
            if ($result === '')
            {
                return '/';
            }

            return $result;
        }


        
        function resolve()
        {
            $methodDictionary = $this->{strtolower($this->request->requestMethod)};

            echo "methodDictionary: ". print_r($methodDictionary);
            $formatedRoute = $this->formatRoute($this->request->requestUri);
            echo "<br>Formated route = ".$formatedRoute;

            $method = $methodDictionary[$formatedRoute];
            echo "<br>";
            print_r($method);
            

            if(is_null($method))
            {
                $this->defaultRequestHandler();
                return;
            }
            echo call_user_func_array($method, array($this->request));
        }
        
      

        
        //Invalid method has been invoked
        private function invalidMethodHandler()
        {
            header("{$this->request->serverProtocol} 405 Method Not Allowed");
        }

        
        function __destruct()
        {
            $this->resolve();
        }
        

    }
    



?>