/************************************************
Author:  Alex Perceval 
Group:   Mijdas(kw01)
Purpose: provides the system with test data
************************************************/
-- Institutions:
INSERT INTO institution(tag, name, domain) VALUES("UOW", "University Of Wollongong", "uow.edu.au");
INSERT INTO institution(tag, name, domain) VALUES("UNWG", "University of North Wannoona", "unwg.learning.edu.au");
INSERT INTO institution(tag, name, domain) VALUES("NWSBS", "North Western Suburbs Business School", "sydbus.edu.au");
INSERT INTO institution(tag, name, domain) VALUES("STC", "Sydney Technology College", "southTech.edu.au");
-- Users:
INSERT INTO user (username, first_name, last_name, password, email, permission_type) VALUES("ap088","Alex","Perceval","1234","ap088@uowmail.edu.au","tutor");
INSERT INTO user (username, first_name, last_name, password, email, permission_type, about) VALUES("st111","Steve","Trooper","1234","st111088@hotmail.com","coordinator","Head of Students/Coordinator for CSCI592/892");
INSERT INTO user (username, first_name, last_name, password, email, permission_type) VALUES("hya555","Hannah","Yaragalo","1234","harry@gmail.com","tutor");
INSERT INTO user (username, first_name, last_name, password, email, permission_type) VALUES("ddb556","Beeton","David","1234","davidyenah@gmail.com","admin");
INSERT INTO user (username, first_name, last_name, password, email, permission_type) VALUES("dha316","Harrington","David"," 1234","dha132@hotmail.com","coordinator");
INSERT INTO user (username, first_name, last_name, password, email, permission_type) VALUES("ss116","Sanders","Sally","1234","sas@hotmail.com","tutor");
INSERT INTO user (username, first_name, last_name, password, email, permission_type) VALUES("Sammy62","Burton","Samuel","1234","sam@hotmail.com","tutor");
INSERT INTO user (username, first_name, last_name, password, email, permission_type) VALUES("Sanddos","Orella","Sandy","1234","Sandy@gmail.com","tutor");
INSERT INTO user (username, first_name, last_name, password, email, permission_type) VALUES("aa111","Augestine","A-ron","1234","aa@gmail.com","coordinator");
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
INSERT INTO subject(code, i_id, coordinator1) VALUES("ISIT207", 1,"st111");
-- Sessions:
INSERT INTO subject_session(isActive,session_expiry, subject_id) VALUES(true, DATE("2019-08-14"), 1);
INSERT INTO subject_session(isActive,session_expiry, subject_id) VALUES(true, DATE("2019-08-14"), 2);
INSERT INTO subject_session(isActive,session_expiry, subject_id)  VALUES(true, DATE("2019-08-14"), 3);
INSERT INTO subject_session(isActive,session_expiry, subject_id)  VALUES(true, DATE("2019-08-14"), 4);
INSERT INTO subject_session(isActive,session_expiry, subject_id) VALUES(true, DATE("2019-08-14"), 5);
INSERT INTO subject_session(isActive,session_expiry, subject_id) VALUES(true, DATE("2019-08-14"), 6);
INSERT INTO subject_session(isActive,session_expiry, subject_id) VALUES(true, DATE("2019-08-14"), 7);
INSERT INTO subject_session(isActive,session_expiry, subject_id) VALUES(true, DATE("2019-08-14"), 8);
INSERT INTO subject_session(isActive,session_expiry, subject_id) VALUES(true, DATE("2019-08-14"), 9);
INSERT INTO subject_session(isActive,session_expiry, subject_id) VALUES(false, DATE("2019-08-14"), 10);
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
INSERT INTO assessment(a_number, subject_id, name, isActive) VALUES(3,1,"Lab 3", false);
INSERT INTO assessment(a_number, subject_id, name, isActive) VALUES(4,1,"Lab 4", false);

INSERT INTO assessment(a_number, subject_id, name, isActive) VALUES(1,10,"Project Progress Review", false);
INSERT INTO assessment(a_number, subject_id, name, isActive) VALUES(1,10,"Final Presentation", false);
/*
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
*/
-- Assesment Cirteria:
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(1,1,4,null,"Comment");
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(1,2,0,5,"Commenting");
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(1,3,1,10,"Output");
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(1,4,0,2,"Style");
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(1,5,2,15,"Efficency");

INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(2,1,4,null,"Comment");
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(2,2,1,5,"Meeting Minutes");
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(2,3,1,5,"Stakeholder Analysis");
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(2,4,1,10,"Project Scope");
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(2,5,1,20,"Client Interaction");
/*
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(3,1,4,null,"Comment");
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(3,2,0,5,"Commenting");                     
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(3,3,1,10,"Output");
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(3,4,0,2,"Style");
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(3,5,2,15,"Efficency");

INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(4,1,4,null,"Comment");
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(4,2,0,5,"Commenting");
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(4,3,1,10,"Output");
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(4,4,0,2,"Style");
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(4,5,2,15,"Efficency");

INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(5,1,4,null,"Comment");
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(5,2,0,40,"UI");
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(5,3,1,10,"Demonstration");
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(5,4,0,45,"Report");
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(5,5,2,2,"Meeting Minutes");

INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(6,1,4,null,"Comment");
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(6,2,0,40,"UI");
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(6,3,1,10,"Demonstration");
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(6,4,0,45,"Report");
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(6,5,2,2,"Meeting Minutes");

INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(16,1,4,null,"Comment");
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(16,2,0,40,"Multiple Choice");
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(16,3,1,10,"Short Answers");
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(16,4,0,45,"Extended Response");

INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(17,1,4,null,"Comment");
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(17,2,0,45,"Extended Response");
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(17,3,0,40,"Multiple Choice");
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(17,4,1,10,"Short Answers");

INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(20,1,4,null,"Comment");
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(20,2,0,40,"Part 1");
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(20,3,1,10,"Part 2");
INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text) VALUES(20,4,0,45,"Part 3");
*/
-- Results:
INSERT INTO student_results (a_id, c_id, student_id, result, comment)  VALUES(1,1,"alice", null,"Good job overall, need to work on code stye, indentation consistency");
INSERT INTO student_results (a_id, c_id, student_id, result) VALUES(1,2,"alice",5);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(1,3,"alice",7);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(1,4,"alice",2);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(1,5,"alice",13);
INSERT INTO student_results (a_id, c_id, student_id, result, comment)  VALUES(2,1,"alice", null,"Good job overall, need to work on code stye, indentation consistency");
INSERT INTO student_results (a_id, c_id, student_id, result) VALUES(2,2,"alice",5);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(2,3,"alice",5);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(2,4,"alice",2);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(2,5,"alice",13);
INSERT INTO student_results (a_id, c_id, student_id, result, comment)  VALUES(1,1,"bob", null,"Bad job overall, need to work on code stye, indentation consistency");
INSERT INTO student_results (a_id, c_id, student_id, result) VALUES(1,2,"bob",2);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(1,3,"bob",1);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(1,4,"bob",0);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(1,5,"bob",9);
INSERT INTO student_results (a_id, c_id, student_id, result, comment)  VALUES(2,1,"bob", null,"Bad job overall, need to work on code stye, indentation consistency");
INSERT INTO student_results (a_id, c_id, student_id, result) VALUES(2,2,"bob",2);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(2,3,"bob",1);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(2,4,"bob",0);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(2,5,"bob",9);
INSERT INTO student_results (a_id, c_id, student_id, result, comment) VALUES(1,1,"carol",null,"Revise Lecture content");
INSERT INTO student_results (a_id, c_id, student_id, result) VALUES(1,2,"carol",1);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(1,3,"carol",2);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(1,4,"carol",0);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(1,5,"carol",9);
INSERT INTO student_results (a_id, c_id, student_id, result, comment) VALUES(2,1,"carol", null,"Good Attempt");
INSERT INTO student_results (a_id, c_id, student_id, result) VALUES(2,2,"carol",1);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(2,3,"carol",5);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(2,4,"carol",2);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(2,5,"carol",2);
INSERT INTO student_results (a_id, c_id, student_id, result, comment)  VALUES(1,1,"dave", null,"Try harder next time");
INSERT INTO student_results (a_id, c_id, student_id, result) VALUES(1,2,"dave",3);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(1,3,"dave",1);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(1,4,"dave",2);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(1,5,"dave",1);
INSERT INTO student_results (a_id, c_id, student_id, result, comment)  VALUES(2,1,"dave", null,"Good job with Client interaction");
INSERT INTO student_results (a_id, c_id, student_id, result) VALUES(2,2,"dave",1);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(2,3,"dave",1);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(2,4,"dave",2);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(2,5,"dave",12);
INSERT INTO student_results (a_id, c_id, student_id, result, comment)  VALUES(1,1,"edward", null,"Try make your code more consistent");
INSERT INTO student_results (a_id, c_id, student_id, result) VALUES(1,2,"edward",2);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(1,3,"edward",5);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(1,4,"edward",0);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(1,5,"edward",10);
INSERT INTO student_results (a_id, c_id, student_id, result, comment)  VALUES(2,1,"edward", null,"Scope needs to be more extensive");
INSERT INTO student_results (a_id, c_id, student_id, result) VALUES(2,2,"edward",5);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(2,3,"edward",2);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(2,4,"edward",2);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(2,5,"edward",10);
INSERT INTO student_results (a_id, c_id, student_id, result, comment)  VALUES(1,1,"freddrick", null,"Nice work!");
INSERT INTO student_results (a_id, c_id, student_id, result) VALUES(1,2,"freddrick",10);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(1,3,"freddrick",2);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(1,4,"freddrick",2);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(1,5,"freddrick",10);
INSERT INTO student_results (a_id, c_id, student_id, result, comment)  VALUES(2,1,"freddrick", null,"More work needed here");
INSERT INTO student_results (a_id, c_id, student_id, result) VALUES(2,2,"freddrick",2);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(2,3,"freddrick",1);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(2,4,"freddrick",2);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(2,5,"freddrick",12);
INSERT INTO student_results (a_id, c_id, student_id, result, comment)  VALUES(1,1,"george", null,"Please refer to course material");
INSERT INTO student_results (a_id, c_id, student_id, result) VALUES(1,2,"george",3);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(1,3,"george",1);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(1,4,"george",2);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(1,5,"george",1);
INSERT INTO student_results (a_id, c_id, student_id, result, comment)  VALUES(2,1,"george", null,"More Work needed");
INSERT INTO student_results (a_id, c_id, student_id, result) VALUES(2,2,"george",1.5);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(2,3,"george",1);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(2,4,"george",2);
INSERT INTO student_results (a_id, c_id, student_id, result)  VALUES(2,5,"george",12);

-- Get all s

/*
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