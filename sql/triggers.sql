DROP TRIGGER results_after_insert;
DELIMITER  //

/***************************************************
* After an assesment is made active,
    grab each student apart of that subject and
        insert them into results.
***************************************************/
CREATE TRIGGER results_after_insert 
AFTER UPDATE
     ON Markit.assessment FOR EACH ROW
BEGIN

    DECLARE asssignmentID INT;
    DECLARE subjectID  INT;
    DECLARE s_id    VARCHAR(10);
    DECLARE done INT DEFAULT 0;
    DECLARE isActive BOOLEAN;

    IF NEW.isActive = true THEN 
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

SELECT student_id  
FROM (student_subject a INNER JOIN subject_session b ON  a.subject_session_id = b.id);
 

/*SELECTS all students from a subject, where the session_id = to updated Id
    not possible not becuae assessment FK is subject*/
SELECT student_id  
FROM student_subject 
WHERE subject_session_id = NEW.subject_session_id; 


SELECT session.id, subject.code
FROM (staff_allocation AS staff 
                INNER JOIN subject_session AS session ON staff.subject_id = session.id )
                INNER JOIN subject ON session.subject_id = subject.id
WHERE subject.i_id = 1  AND staff.username = 'st111'