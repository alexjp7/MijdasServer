
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




-- Subjects:
INSERT INTO subject(code, i_id) VALUES("CSIT315", 1);
INSERT INTO subject(code, i_id) VALUES("CSIT316", 1);
INSERT INTO subject(code, i_id) VALUES("CSIT321", 1);
INSERT INTO subject(code, i_id) VALUES("CSIT121", 2);
INSERT INTO subject(code, i_id) VALUES("PHYS111", 3);
INSERT INTO subject(code, i_id) VALUES("MEDI101", 2);


--Sessions:
INSERT INTO subject_session(isActive, coordinator_id, session_expiry, subject_code, i_id)
                     VALUES(true,"st111",DATE("2019-08-14"),"CSIT315",1);

INSERT INTO subject_session(isActive, coordinator_id, session_expiry, subject_code, i_id)
                      VALUES(true,"st111",DATE("2019-08-14"),"CSIT316",1);

INSERT INTO subject_session(isActive, coordinator_id, session_expiry, subject_code, i_id)
                      VALUES(true,"st111",DATE("2019-08-14"),"CSIT321",1);

INSERT INTO subject_session(isActive, coordinator_id, session_expiry, subject_code, i_id)
                      VALUES(true,"st111",DATE("2019-08-14"),"CSIT121",2);

INSERT INTO subject_session(isActive, coordinator_id, session_expiry, subject_code, i_id)
                      VALUES(true,"st111",DATE("2019-08-14"),"MEDI101",2);


INSERT INTO subject_session(isActive, coordinator_id, session_expiry, subject_code, i_id)
                      VALUES(true,"st111",DATE("2019-08-14"),"PHYS111",3);





-- Staff:
INSERT INTO staff_allocation (username, subject_id) VALUES("st111", 1);
INSERT INTO staff_allocation (username, subject_id) VALUES("st111", 2);
INSERT INTO staff_allocation (username, subject_id) VALUES("st111", 3);
INSERT INTO staff_allocation (username, subject_id) VALUES("ap088", 4);
INSERT INTO staff_allocation (username, subject_id) VALUES("ap088", 5);
INSERT INTO staff_allocation (username, subject_id) VALUES("ap088", 6);
INSERT INTO staff_allocation (username, subject_id) VALUES("ap088", 7);

INSERT INTO user_institution VALUES("ap088",1);
INSERT INTO user_institution VALUES("ap088",2);

-- Assessments:
INSERT INTO assessment(a_number, subject_session_id) VALUES(1,1);
INSERT INTO assessment(a_number, subject_session_id) VALUES(2,1);
INSERT INTO assessment(a_number, subject_session_id) VALUES(3,1);
INSERT INTO assessment(a_number, subject_session_id) VALUES(4,1);
INSERT INTO assessment(a_number, subject_session_id) VALUES(1,2);
INSERT INTO assessment(a_number, subject_session_id) VALUES(2,2);
INSERT INTO assessment(a_number, subject_session_id) VALUES(3,2);


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
VALUES(2,1,0,40,"UI");

INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
VALUES(2,2,1,10,"Demonstration");

INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
VALUES(2,3,0,45,"Report");

INSERT INTO criteria_item (a_id, c_id, element, max_mark, display_text)
VALUES(2,4,2,2,"Meeting Minutes");



/* TO populate first page in app
 * tutor username, 
 * linked to subject (in session)  => subject => session
    -> coordinator username
        -> institution_id
            -> institution name*/




          
/*Query for All subjects taught by a tutor, and what instituion they are taught in*/
SELECT staff.username, session.subject_code, uni.name 
FROM (staff_allocation AS staff INNER JOIN subject_session AS session ON staff.subject_id = session.id)
                                INNER JOIN institution AS uni ON session.i_id = uni.id
WHERE staff.username = "ap088"
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



/*Query for all criteria for an assessment*/
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













/*
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








