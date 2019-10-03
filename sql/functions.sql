/************************************************
Author:  Alex Perceval 
Date:    3/10/2018
Group:   Mijdas(kw01)
Purpose: provides common procedures and logic
		 for database operations.
************************************************/
DELIMITER //
DROP FUNCTION IF EXISTS count_criteria //
/* Returns if an assessment has criteria */
CREATE FUNCTION count_criteria(assessment_id INT)
RETURNS tinyint(1)
BEGIN
	DECLARE result tinyint(1); 
    SELECT IF(count(*)>0,1,0) INTO result FROM criteria_item WHERE criteria_item.a_id = assessment_id;
    return result;
END;//

/*Creates an assessment based on the given inputs*/
DROP PROCEDURE IF EXISTS create_assessment//
CREATE PROCEDURE create_assessment(IN subj_id INT, ass_name VARCHAR(20))
BEGIN
	DECLARE currentANumber INT;
	DECLARE newANumber INT(11);
	DECLARE aId INT(11);
    
    SELECT count(*) INTO currentANumber FROM assessment WHERE assessment.subject_id = subj_id;
    SET newANumber = currentANumber + 1;
	INSERT INTO assessment(subject_id, a_number, name, isActive) VALUES(subj_id, newANumber, ass_name, false);

	SELECT id INTO aId FROM assessment WHERE  subject_id = subj_id AND a_number = newANumber;
	/*Createa a default criteria for comment box*/
	INSERT INTO criteria_item(a_id, c_id, element, max_mark, display_text) VALUES(aId,1,4, NULL, "Comment");
END//

/*Creates an assessment's criteria based on the given inputs*/
DROP PROCEDURE IF EXISTS create_criteria//
CREATE PROCEDURE create_criteria(IN a_id INT, element INT, max_mark DECIMAL(5,2), display_text VARCHAR(20))
BEGIN
	DECLARE currentCriteria INT;
	DECLARE newCriteria INT(11);
    
    SELECT count(*) INTO currentCriteria FROM criteria_item WHERE criteria_item.a_id = a_id;
    SET newCriteria = currentCriteria + 1;
	INSERT INTO criteria_item(a_id, c_id, element, max_mark, display_text) VALUES(a_id, newCriteria, element, max_mark, display_text);
END//

/* Adds students to an assessment when it is activated */
DROP PROCEDURE IF EXISTS add_students//
CREATE PROCEDURE add_students(IN subject_id INT, assessment_id INT)
BEGIN

	DECLARE done TINYINT;
	DECLARE countCriteria INT;
	DECLARE currentStudent VARCHAR(20);
	DECLARE currentCriteria INT;
	/*Cursor for fetching all students in a subject*/
	DECLARE studentCursor CURSOR FOR SELECT student_id FROM student_subject student  INNER JOIN subject_session session ON student.subject_session_id =  session.subject_id WHERE session.subject_id = subject_id;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

	/*Determine how many criteria_items exists within the activated subject*/
	SELECT COUNT(*) INTO countCriteria FROM criteria_item WHERE a_id = assessment_id;

 	OPEN studentCursor;
		/*Loop over every student*/
		getStudents: LOOP
			SET currentCriteria = 1;
			FETCH studentCursor INTO currentStudent;
				IF done = 1 THEN
					LEAVE getStudents;
				END IF;
			/*Insert a null result for each criteria item of the subject */
			criteriaInsert: LOOP
				IF currentCriteria = countCriteria + 1 THEN
					leave criteriaInsert;
				END IF;
				/*Perform insert on  each student for each criteria */
				INSERT INTO student_results (a_id, c_id, student_id, result, comment) 
				VALUES(assessment_id,currentCriteria, currentStudent, NULL, NULL);
				SET currentCriteria = currentCriteria + 1;
			END LOOP;
		END LOOP;	

	CLOSE studentCursor;
END //

/* Used in the case of adding a student late to a subject
	 with already existing active assessments */
DROP PROCEDURE IF EXISTS add_late_student//
CREATE PROCEDURE add_late_student(IN subject_id INT, student_id VARCHAR(20))
BEGIN
	DECLARE done TINYINT;
	DECLARE currentAssessment INT;
	DECLARE currentCriteria INT;
	DECLARE criteriaCount INT;
	/*Cursor for grabbing the active assessments*/
	DECLARE assessmentCursor CURSOR FOR SELECT id FROM assessment  WHERE subject_id = subject_id AND isActive = true;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
	/*Add a student to each active assessment */
	OPEN assessmentCursor;
		getAssessments: LOOP
			SET currentCriteria = 1;
			/* NOT FOUND - Exit condition */
			FETCH assessmentCursor INTO currentAssessment;
				IF done = 1 THEN 
					LEAVE getAssessments;
				END IF;
				/* Grab the amount of criteria per assessment */
				SELECT count(*) INTO criteriaCount FROM criteria_item WHERE a_id = currentAssessment;
				resultsLoop: LOOP
					IF currentCriteria = criteriaCount + 1 THEN
						LEAVE resultsLoop;
					END IF; /* Set default values for result and comment to NULL. */
						INSERT INTO student_results (a_id, c_id, student_id, result, comment) 
						VALUES(currentAssessment,currentCriteria, student_id, NULL, NULL);
					SET currentCriteria = currentCriteria + 1;
				END LOOP;
		END LOOP;
	close assessmentCursor;
END //

DELIMITER ;
