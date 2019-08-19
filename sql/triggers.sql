DROP TRIGGER results_after_insert;
DELIMITER  //

/***************************************************
* After a new assesment is made
  insert all students apart of that subject into the 
  results table with a null value for result.
***************************************************/
CREATE TRIGGER results_after_insert 
AFTER INSERT
     ON Markit.assessment FOR EACH ROW
BEGIN

    DECLARE asssignmentID INT;
    DECLARE subjectID  INT;
    DECLARE s_id    VARCHAR(10);
    DECLARE done INT DEFAULT 0;
    /*Fetch each student that is enrolled in a subject*/
    DECLARE cur1 CURSOR FOR
                 SELECT student_id  
                 FROM student_subject 
                 WHERE subject_session_id = NEW.subject_session_id; 

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    /*******************************************
    * For each student enrolled in a subject, 
        make a record of them in results table,
        and set their result to NULL,
        flagging them as unmarked
    ********************************************/
    OPEN cur1;
        read_loop: LOOP

            FETCH cur1 INTO s_id;            
            IF done THEN
                leave read_loop;
                CLOSE cur1;
            END IF;
                INSERT INTO student_results(a_id, student_id) VALUES (NEW.a_number, s_id);


        END LOOP;
    CLOSE cur1;

END;//

DELIMITER  ;
