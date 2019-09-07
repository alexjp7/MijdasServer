
/*TEST DATA*/
-- Institutions:
INSERT INTO institution(tag, name, domain) VALUES("UOW", "University Of Wollongong", "uow.edu.au");
INSERT INTO institution(tag, name, domain) VALUES("UNWG", "University of North Wannoona", "unwg.learning.edu.au");
INSERT INTO institution(tag, name, domain) VALUES("NWSBS", "North Western Suburbs Business School", "sydbus.edu.au");
INSERT INTO institution(tag, name, domain) VALUES("STC", "Sydney Technology College", "southTech.edu.au");


-- Users:
INSERT INTO user VALUES("ap088","1234","ap088@uowmail.edu.au","tutor");
INSERT INTO user VALUES("st111","1234","st111088@hotmail.com","coordinator");
INSERT INTO user VALUES("hya555","1234","harry@gmail.com","tutor");
INSERT INTO user VALUES("ddb556","1234","davidyenah@gmail.com","admin");
INSERT INTO user VALUES("dha316","1234","dha132@hotmail.com","coordinator");
INSERT INTO user VALUES("aa111","1234","aa111@hotmail.com","coordinator");




-- Subjects:
INSERT INTO subject(code, i_id, coordinator1) VALUES("CSIT315", 1,"st111");
INSERT INTO subject(code, i_id, coordinator1) VALUES("CSIT219", 1,"st111");
INSERT INTO subject(code, i_id, coordinator1) VALUES("COMM306", 1,"aa111");
INSERT INTO subject(code, i_id, coordinator1) VALUES("CSCI203", 2,"dha316");
INSERT INTO subject(code, i_id, coordinator1) VALUES("LHA100", 2,"dha316");
INSERT INTO subject(code, i_id, coordinator1) VALUES("CSCI291", 2,"aa111");
INSERT INTO subject(code, i_id, coordinator1) VALUES("CSIT115", 2,"aa111");
INSERT INTO subject(code, i_id, coordinator1) VALUES("MATH221", 3,"aa111");
INSERT INTO subject(code, i_id, coordinator1) VALUES("MEDI995", 3,"dha316");



-- Sessions:
INSERT INTO subject_session(isActive,session_expiry, subject_id)
                            VALUES(true, DATE("2019-08-14"), 1);

INSERT INTO subject_session(isActive,session_expiry, subject_id)
                            VALUES(true, DATE("2019-08-14"), 2);

INSERT INTO subject_session(isActive,session_expiry, subject_id)
                            VALUES(true, DATE("2019-08-14"), 3);

INSERT INTO subject_session(isActive,session_expiry, subject_id)
                            VALUES(true, DATE("2019-08-14"), 4);

INSERT INTO subject_session(isActive,session_expiry, subject_id)
                            VALUES(true, DATE("2019-08-14"), 5);

INSERT INTO subject_session(isActive,session_expiry, subject_id)
                            VALUES(true, DATE("2019-08-14"), 6);

INSERT INTO subject_session(isActive,session_expiry, subject_id)
                            VALUES(true, DATE("2019-08-14"), 7);
INSERT INTO subject_session(isActive,session_expiry, subject_id)
                            VALUES(true, DATE("2019-08-14"), 8);

INSERT INTO subject_session(isActive,session_expiry, subject_id)
                            VALUES(true, DATE("2019-08-14"), 9);





-- Staff:
INSERT INTO staff_allocation (username, subject_id) VALUES("st111", 1);
INSERT INTO staff_allocation (username, subject_id) VALUES("st111", 2);
INSERT INTO staff_allocation (username, subject_id) VALUES("st111", 3);
INSERT INTO staff_allocation (username, subject_id) VALUES("st111", 4);
INSERT INTO staff_allocation (username, subject_id) VALUES("ap088", 5);
INSERT INTO staff_allocation (username, subject_id) VALUES("ap088", 6);

INSERT INTO staff_allocation (username, subject_id) VALUES("aa111", 1);
INSERT INTO staff_allocation (username, subject_id) VALUES("aa111", 2);
INSERT INTO staff_allocation (username, subject_id) VALUES("aa111", 3);
INSERT INTO staff_allocation (username, subject_id) VALUES("aa111", 4);
INSERT INTO staff_allocation (username, subject_id) VALUES("aa111", 5);
INSERT INTO staff_allocation (username, subject_id) VALUES("aa111", 9);


INSERT INTO user_institution VALUES("ap088",1);
INSERT INTO user_institution VALUES("ap088",2);



-- Student:

INSERT INTO student_subject VALUES("alice",1);
INSERT INTO student_subject VALUES("bob",1);
INSERT INTO student_subject VALUES("carol",1);
INSERT INTO student_subject VALUES("dave",1);
INSERT INTO student_subject VALUES("edward",1);
INSERT INTO student_subject VALUES("freddrick",1);
INSERT INTO student_subject VALUES("george",1);


-- Assessments:

INSERT INTO assessment(a_number, subject_id, name, isActive) VALUES(1,1,"Lab 1", true);
INSERT INTO assessment(a_number, subject_id, name, isActive) VALUES(2,1,"Lab 2", true);
INSERT INTO assessment(a_number, subject_id, name, isActive) VALUES(3,1,"Lab 3", true);
INSERT INTO assessment(a_number, subject_id, name, isActive) VALUES(4,1,"Lab 4", true);
INSERT INTO assessment(a_number, subject_id, name, isActive) VALUES(5,1,"Assignment  1", true);
INSERT INTO assessment(a_number, subject_id, name, isActive) VALUES(6,1,"Assignment  2", true);
INSERT INTO assessment(a_number, subject_id, name, isActive) VALUES(1,2,"Lab 1", true);
INSERT INTO assessment(a_number, subject_id, name, isActive) VALUES(2,2,"Lab 2", true);
INSERT INTO assessment(a_number, subject_id, name, isActive) VALUES(3,2,"Lab 3", true);
INSERT INTO assessment(a_number, subject_id, name, isActive) VALUES(4,2,"Lab 4", true);
INSERT INTO assessment(a_number, subject_id, name, isActive) VALUES(5,2,"Lab 5", true);
INSERT INTO assessment(a_number, subject_id, name, isActive) VALUES(6,2,"Lab 6", true);
INSERT INTO assessment(a_number, subject_id, name, isActive) VALUES(7,2,"Lab 7", true);
INSERT INTO assessment(a_number, subject_id, name, isActive) VALUES(8,2,"Lab 8", true);
INSERT INTO assessment(a_number, subject_id, name, isActive) VALUES(9,2,"Report Part A", true);
INSERT INTO assessment(a_number, subject_id, name, isActive) VALUES(10,2,"Report Part B", true);
INSERT INTO assessment(a_number, subject_id, name, isActive) VALUES(1,3,"Quiz 1", true);
INSERT INTO assessment(a_number, subject_id, name, isActive) VALUES(2,3,"Quiz 2", true);
INSERT INTO assessment(a_number, subject_id, name, isActive) VALUES(3,3,"Quiz 3", true);
INSERT INTO assessment(a_number, subject_id, name, isActive) VALUES(4,3,"Quiz 4", true);
INSERT INTO assessment(a_number, subject_id, name, isActive) VALUES(1,4,"Assignment 1", true);
INSERT INTO assessment(a_number, subject_id, name, isActive) VALUES(2,4,"Assignment 2", true);
INSERT INTO assessment(a_number, subject_id, name, isActive) VALUES(3,4,"Assignment 3", true);
INSERT INTO assessment(a_number, subject_id, name, isActive) VALUES(4,4,"Assignment 4", true);


-- Assesment Cirteria:
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
                      VALUES(1,1,0,5,"Commenting");
                      
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
                      VALUES(1,2,1,10,"Output");

INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
                      VALUES(1,3,0,2,"Style");

INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
                      VALUES(1,4,2,15,"Efficency");


INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
                      VALUES(2,1,0,5,"Commenting");
                      
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
                      VALUES(2,2,1,10,"Output");

INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
                      VALUES(2,3,0,2,"Style");

INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
                      VALUES(2,4,2,15,"Efficency");


INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
                      VALUES(3,1,0,5,"Commenting");
                      
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
                      VALUES(3,2,1,10,"Output");

INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
                      VALUES(3,3,0,2,"Style");

INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
                      VALUES(3,4,2,15,"Efficency");


INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
                      VALUES(4,1,0,5,"Commenting");
                      
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
                      VALUES(4,2,1,10,"Output");

INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
                      VALUES(4,3,0,2,"Style");

INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
                      VALUES(4,4,2,15,"Efficency");

                      
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
                          VALUES(5,1,0,40,"UI");

INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
                          VALUES(5,2,1,10,"Demonstration");

INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
                          VALUES(5,3,0,45,"Report");

INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
                          VALUES(5,4,2,2,"Meeting Minutes");


INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
                          VALUES(6,1,0,40,"UI");

INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
                          VALUES(6,2,1,10,"Demonstration");

INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
                          VALUES(6,3,0,45,"Report");

INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
                          VALUES(6,4,2,2,"Meeting Minutes");



INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
                          VALUES(16,1,0,40,"Multiple Choice");

INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
                          VALUES(16,2,1,10,"Short Answers");

INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
                          VALUES(16,3,0,45,"Extended Response");


INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
                          VALUES(17,1,0,40,"Multiple Choice");

INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
                          VALUES(17,2,1,10,"Short Answers");

INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
                          VALUES(17,3,0,45,"Extended Response");


INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
                          VALUES(20,1,0,40,"Part 1");

INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
                          VALUES(20,2,1,10,"Part 2");

INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
                          VALUES(20,3,0,45,"Part 3");

























/* TO populate first page in app
 * tutor username, 
 * linked to subject (in session)  => subject => session
    -> coordinator username
        -> institution_id
            -> institution name*/




          
/*Query for All subjects taught by a tutor, and what instituion they are taught in
SELECT staff.username, session.subject_code, uni.name 
FROM (staff_allocation AS staff INNER JOIN subject_session AS session ON staff.subject_id = session.id)
                                INNER JOIN institution AS uni ON session.i_id = uni.id
WHERE staff.username = "st111"
ORDER BY uni.name;



-- Get subject list per campuses :
SELECT session.subject_code
FROM staff_allocation AS staff INNER JOIN subject_session AS session ON staff.subject_id = session.id  
WHERE session.i_id = 1 AND staff.username = "ap088";


-- Get distinct campuses that tutor works at:
SELECT distinct(uni.id), uni.name 
FROM (staff_allocation AS staff INNER JOIN subject_session AS session ON staff.subject_id = session.id)
INNER JOIN institution AS uni ON session.i_id = uni.id
WHERE staff.username = "ap088";



/*Query for all criteria for an assessment
SELECT c_id, element, max_mark, display_text
FROM criteria_item 
WHERE a_id = 1;

SELECT c_id, element, max_mark, display_text
FROM criteria_item 
WHERE a_id = 2;



SELECT staff.username as "Staff", session.subject_code as "Subject Taught", uni.name "Campus Name", ass.a_number  as "Assessment#", criteria.element, criteria.max_mark, criteria.display_text
FROM (((staff_allocation AS staff INNER JOIN subject_session AS session ON staff.subject_id = session.id)
                                INNER JOIN institution AS uni ON session.i_id = uni.id)
                                INNER JOIN assessment as ass ON ass.subject_session_id = staff.subject_id)
                                INNER JOIN criteria_item as criteria ON criteria.a_id = ass.id
                                
WHERE staff.username = "ap088";









what each tutor does  
200 rows               8000                        1*20*4  64000                    
(1 -> 2)            JOIN session(active subject) -> JOIN subject(cource code)   -> user_institution()


tutor -> subject(session) -> coordinator -> institution

coordinator_id dilema
----
1) IF an institution who provides the subject (via the coordinator) is dervied from coordinator
  - is it necessary to allow for this relationship 
                e.g.  user 1 -> * institutions

  - if we don't need a multivaraiate relationship user -> instituion, we have to null check institution_id  in user???


how will tutors link to a subject
--------------------------------
  * a link is generated e.g. mijdas.com/api/staff_allocation?id=unique_subject_id  NOTE: should url params be hashed?
  * tutor has 2 fields  username and url.  
  * link is combined to  mijdas.com/api/staff_allocation?id=unique_subject_id, username=<username>


how to link other coordinators
--------------------------------
 * same as above but seperate link for coordinator

coordinators perspective on above
--------------------------------
1)* manage subjets view: 
93:4e:68:35:51:6e:ad:a4:1f:18:89:c7:b2:00:60:75 

2) create advertisment(pre-req) 
    - tutor applies 




account status
--------------
1) unlinked i.e. you've jsut made your account fresh
2) linked via subject (tutor has entered link providedd by coordinator)

3) * linked via institution (for  job board)



big NOTE: Coordinator should have NOT multivariate relation to institiuion HOWEVER, tutors should or job boarding reasons 


* if coordinator, their suject list (subject list page) will populate.  
    SELECT*FROM subject_session WHERE co-orindaotr_id = {loggedinUser.username} (provided by request call)

id     = 1         
subject_id      =CSI203
isActive   = TRUE      
isShared  ?????? 
coordinator_id  = Frank
session_expiry  same as below

id       =2       
subject_id    =CSI203   
isActive      = TRUE   
coordinator_id  = Steve
session_expiry  same as above

 ^^ above 


*/








