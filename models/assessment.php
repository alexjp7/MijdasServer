<?php
    class Assessment
    {
        private $connection;
        private $errorMessage;

        public $a_number;
        public $subject_id;
        public $assessment_id;
        

        public function __construct($connection)
        {
            $this->connection = $connection;
        }

        public function getErrorMessage()
        {
            return $this->errorMessage;
        }

        public function getBySubject($subject_id)
        {   
            $query = "SELECT id, a_number, name, isActive 
                      FROM assessment 
                      WHERE subject_id = {$subject_id} AND isActive = 1";

            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            return $stmt;
        }
    
        public function toggleActivation()
        {
            $update = "UPDATE assessment 
                       SET isActive = NOT isActive  
                       WHERE id = {$this->assessment_id}";

            $updateStmt = $this->connection->prepare($update);
            $updateStmt->execute();
            $isSuccesful = true;

            if($updateStmt->rowCount() === 1)
            {
                $select = "SELECT isActive, subject_id FROM assessment WHERE id = {$this->assessment_id}";
                $selectStmt = $this->connection->prepare($select); 
                $selectStmt->execute();
                $result = $selectStmt->fetch();
                
                //If assessment is being enabled, add students,
                //else assessment is being disabled so remove students
                $this->subject_id = $result["subject_id"];
                $result["isActive"] ? $this->addStudent($isSuccesful) : $this->removeStudent($isSuccesful);  
            }
            return $isSuccesful;
        }


        private function addStudent(&$isSuccesful)
        {
            //Grab all students enrolled in a subject
            $studentQuery = "SELECT student_id 
                             FROM student_subject student 
                             INNER JOIN subject_session session 
                             ON student.subject_session_id =  session.subject_id  
                             WHERE session.subject_id = {$this->subject_id}";

            $stmt = $this->connection->prepare($studentQuery);
            $stmt->execute();
            //Begin transaction...
            $this->connection->beginTransaction();
            try
            {   //Insert them into student results, default result as null.
                while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    extract($row);
                    $query = "INSERT INTO student_results (student_id, a_id, result) VALUES('{$student_id}', {$this->assessment_id}, null )";
                    $stmt2 = $this->connection->prepare($query);
                    
                    if(!$stmt2->execute())
                    {
                        $isSuccesful = false;
                        $this->connection->rollBack();
                        break;
                    }
                }
                $this->connection->commit();
            }
            catch(Exception $e)
            {
                $this->errorMessage = "Student already exists";
            }
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
    }
?>

