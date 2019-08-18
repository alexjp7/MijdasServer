
/*TEST DATA*/
INSERT INTO institution(tag, name, domain) VALUES("UOW", "University Of Wollongong", "uow.edu.au");
INSERT INTO institution(tag, name, domain) VALUES("UNWG", "University of North Wannoona", "unwg.learning.edu.au");
INSERT INTO institution(tag, name, domain) VALUES("NWSBS", "North Western Suburbs Business School", "sydbus.edu.au");
INSERT INTO institution(tag, name, domain) VALUES("STC", "Sydney Technology College", "southTech.edu.au");



INSERT INTO user VALUES("ap088","1234","ap088@uowmail.edu.au","tutor");
INSERT INTO user VALUES("st111","1234","st111088@hotmail.com","coordinator");
INSERT INTO user VALUES("hya555","1234","harry@gmail.com","tutor");
INSERT INTO user VALUES("ddb556","1234","davidyenah@gmail.com","admin");
INSERT INTO user VALUES("dha316","1234","dha132@hotmail.com","coordinator");


INSERT INTO user_institution VALUES("ap088",1);
INSERT INTO user_institution VALUES("ap088",2);

INSERT INTO subject(code, i_id) VALUES("CSIT315", 1);
INSERT INTO subject(code, i_id) VALUES("CSIT316", 1);
INSERT INTO subject(code, i_id) VALUES("CSIT321", 1);

INSERT INTO subject_session(isActive, coordinator_id, session_expiry, subject_code, i_id)
                     VALUES(true,"st111",DATE("2019-08-14"),"CSIT315",1);

INSERT INTO subject_session(isActive, coordinator_id, session_expiry, subject_code, i_id)
                      VALUES(true,"st111",DATE("2019-08-14"),"CSIT316",1);

INSERT INTO subject_session(isActive, coordinator_id, session_expiry, subject_code, i_id)
                      VALUES(true,"st111",DATE("2019-08-14"),"CSIT321",1);

INSERT INTO staff_allocation (username, subject_id) VALUES("ap088", 1);
INSERT INTO staff_allocation (username, subject_id) VALUES("ap088", 2);
INSERT INTO staff_allocation (username, subject_id) VALUES("ap088", 3);








/* TO populate first page in app
 * tutor username, 
 * linked to subject (in session)  => subject => session
    -> coordinator username
        -> institution_id
            -> institution name*/




          
/*Query for All subjects taught by a tutor, and what instituion they are taught in*/
SELECT staff.username, session.subject_code, uni.name
FROM (staff_allocation AS staff INNER JOIN subject_session AS session ON a.subject_id = b.id)
                                INNER JOIN institution AS uni ON session.i_id = uni.id
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








