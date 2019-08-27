<?php
    class Student
    {
        private $connection;

    

        public function __construct($connection)
        {
            $this->connection = $connection;
        }


        /**************************************
         * Needs testing properly
        ***************************************/
        public function addToSubject($studentList, $subjectId)
        {
            $this->connection->beginTransaction();
            $stmt = $this->connection->prepare("INSERT INTO student_subject (student_id, subject_session_id) VALUES(:student, :subject)");
    
            foreach($studentList as $student)
            {
                $stmt->bindParam(":student", $student);
                $stmt->bindParam(":subject", $subjectId);

                if(!$stmt->execute())
                {   //If an insertion does not execute correctly, rollnback transaction.    
                    $this->connection->rollBack();
                    return  false;
                }
            }   
            //Succesful batch insert completed, new data is commited in database
            $this->connection->commit();
            return true;
        }

    }
?>