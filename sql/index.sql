
/******************************************************
* Choose a FORCEd index based on item in where clause
******************************************************/
 -- User:
CREATE INDEX user_username ON user (username);
-- Subject Session:
CREATE INDEX subject_session_id ON subject_session (id);
CREATE INDEX subject_session_subject ON subject_session (subject_code);
CREATE INDEX subject_session_instituion  ON subject_session (i_id);
-- Assessment:
CREATE INDEX assessment_id ON assessment (id);
CREATE INDEX assessment_assessment ON assessment (a_number);
CREATE INDEX assessment_subject_session ON assessment (subject_session_id);
-- Criteria:
CREATE INDEX criteria_item_pk ON criteria_item (a_id, c_id);
-- student_subject:
CREATE INDEX student_subject_student_id ON student_subject (student_id);
CREATE INDEX student_subject_subject ON student_subject (subject_session_id);
-- student_results:
CREATE INDEX student_results_pk ON student_results (a_id, student_id);
CREATE INDEX student_results_student ON student_results (student_id);
CREATE INDEX student_results_assessment ON student_results (a_id);
--staff_allocation:
CREATE INDEX staff_allocation_pk ON staff_allocation (username, subject_id);
CREATE INDEX staff_allocation_subject ON staff_allocation (subject_id);
CREATE INDEX staff_allocation_usernamer ON staff_allocation (username);

