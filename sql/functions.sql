DELIMITER //
DROP FUNCTION IF EXISTS count_criteria //

CREATE FUNCTION count_criteria(assessment_id INT)
RETURNS tinyint(1)
BEGIN
	DECLARE result tinyint(1);
    
    SELECT IF(count(*)>0,1,0) INTO result FROM criteria_item WHERE criteria_item.a_id = assessment_id;
    
    return result;
END;//


DROP PROCEDURE IF EXISTS create_assessment//
CREATE PROCEDURE create_assessment(IN subj_id INT, ass_name VARCHAR(20))
BEGIN
	DECLARE currentANumber INT;
	DECLARE newANumber INT(11);
    
    SELECT count(*) INTO currentANumber FROM assessment WHERE assessment.subject_id = subj_id;
    SET newANumber = currentANumber + 1;
	INSERT INTO assessment(subject_id, a_number, name, isActive) VALUES(subj_id, newANumber, ass_name, false);

END//


DROP PROCEDURE IF EXISTS create_criteria//
CREATE PROCEDURE create_criteria(IN a_id INT, element INT, max_mark DECIMAL(5,2), display_text VARCHAR(20))
BEGIN
	DECLARE currentCriteria INT;
	DECLARE newCriteria INT(11);
    
    SELECT count(*) INTO currentCriteria FROM criteria_item WHERE criteria_item.a_id = a_id;
    SET newCriteria = currentCriteria + 1;
	INSERT INTO criteria_item(a_id, c_id, element, max_mark, display_text) VALUES(a_id, newCriteria, element, max_mark, display_text);

END//
DELIMITER ;