<?php
    /************************************************
     Author:  Alex Perceval 
     Group:   Mijdas(kw01)
     Purpose: Assessment , and to provide an interface 
                for database transactions
    ************************************************/
    class Assessment
    {
        private $connection;
        private $errorMessage;

        public $a_number;
        public $subject_id;
        public $assessment_id;
        public $task_name;
        
        public function __construct($connection)
        {
            $this->connection = $connection;
        }

        public function getErrorMessage()
        {
            return $this->errorMessage;
        }

        public function countActive($subject_id)
        {
            $query = "SELECT DISTINCT COUNT(a_number) as count from assessment where subject_id = {$subject_id} AND isActive = true GROUP BY (subject_id)";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getBySubject($subject_id, $is_coordinator)
        {   
            $query = "SELECT id, a_number, name, isActive 
                      FROM assessment 
                      WHERE subject_id = {$subject_id} ";
            $query .=  $is_coordinator ? " " : "AND isActive = 1 ";
            $query .= "ORDER BY id ASC, a_number ASC";

            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function create()
        {   //Makes use of stored procedure to validate data
            $query = "call create_assessment(:subject_id,:name)";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(":subject_id",$this->subject_id, PDO::PARAM_INT);
            $stmt->bindValue(":name",$this->task_name, PDO::PARAM_STR);

            return $stmt->execute();
        }

        public function getMaxMark($assessment_id)
        {
            $query = "SELECT sum(max_mark) as max_mark from criteria_item where a_id = {$assessment_id} group by (a_id)";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        
        public function countCriteria($assessment_id) 
        {
            $countQuery = "SELECT count_criteria({$assessment_id}) as count";
            $countStmt = $this->connection->prepare($countQuery);
            $countStmt->execute();
            return $countStmt->fetch()["count"];
        }
    
        public function toggleActivation()
        {
            //Determine if an activation or deactivation is being requested
            $isActiveSelect = "SELECT isActive, subject_id FROM assessment WHERE id = {$this->assessment_id}";
            $isActiveStmt = $this->connection->prepare($isActiveSelect); 
            $isActiveStmt->execute();
            $result = $isActiveStmt->fetch();
            //Assume succesful transaction unless flagged
            //As unsuccesful by exception handlers.
            $isSuccesful = true;
            $hasCriteria = $this->countCriteria($this->assessment_id) > 0 ?  true : false;

            if(isset($result) || $selectStmt->rowCount() !== 1)
            {
                if($hasCriteria) 
                {   //Assessment is being activated
                    $this->subject_id = $result["subject_id"];
                    $update = "UPDATE assessment  SET isActive = NOT isActive  WHERE id = {$this->assessment_id}";
                    $updateStmt = $this->connection->prepare($update);
                    $updateStmt->execute();
                    !$result["isActive"] ? $this->addStudent($isSuccesful) : $this->removeStudent($isSuccesful);  
                }
                else
                {   //Assessment is being de-activated
                    $this->errorMessage = "Assessment requries criteria to be enabled!";
                    $isSuccesful = false;
                }
            }
            else
            {
                $this->errorMessage = "Assessment failed to be enabled/disabled";
                $isSuccesful = false;
            }
            return $isSuccesful;
        }

        private function addStudent(&$isSuccesful)
        {   //Grab all students enrolled in a subject
            $query = "CALL add_students(:subject, :assessment)";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(":subject",$this->subject_id, PDO::PARAM_INT);
            $stmt->bindParam(":assessment", $this->assessment_id, PDO::PARAM_INT);
            $isSuccesful = $stmt->execute();    
        }
   
        private function removeStudent(&$isSuccesful)
        {
            $this->connection->beginTransaction();
            try
            {  //Delete Students from results table .
                $query = "DELETE FROM student_results WHERE a_id ={$this->assessment_id}";
                $stmt = $this->connection->prepare($query);
                if(!$stmt->execute())
                {
                    $isSuccesful = false;
                    $this->connection->rollBack();
                }
                $this->connection->commit();
            }
            catch(Exception $e)
            {
                $this->errorMessage = "Student couldn't be removed from assessment";
            }
        }
        /* Assessment data aggregations */
        public function getAverage($assessment_id)
        {        
            $query = "SELECT SUM(result)/count(DISTINCT student_id) as average FROM student_results WHERE a_id = {$assessment_id} GROUP BY (a_id);";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function getInterQuartileDistribution($assessment_id)
        {   //Execute stored function
            $functionQuery = "CALL get_result_quartiles({$assessment_id},@q1, @q2, @q3,@q4)";
            $stmt = $this->connection->prepare($functionQuery);
            $stmt->execute();
            //retrieve data from output variables
            $quartileRetrieve = "SELECT @q1, @q2, @q3, @q4";
            $stmt2 = $this->connection->prepare($quartileRetrieve);
            $stmt2->execute();
            return $stmt2;
        }

        public function getPerformanceBreakdown($assessment_id)
        {
            $query = "SELECT results.c_id, AVG(result) AS average, criteria_item.display_text, criteria_item.max_mark
                        FROM student_results AS results
                        INNER JOIN criteria_item ON results.a_id = criteria_item.a_id AND results.c_id = criteria_item.c_id
                        WHERE results.a_id  = {$assessment_id} AND results.c_id != 1 GROUP BY (c_id) 
                        ORDER BY results.c_id;";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            return $stmt;
        }
    }
?>