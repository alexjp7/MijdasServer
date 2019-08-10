
/*TEST DATA*/
INSERT INTO INSTITUTION(name,domain) VALUES("UOW","uow.edu.au");
INSERT INTO INSTITUTION(name,domain) VALUES("UNWG","unwg.learning.edu.au");
INSERT INTO INSTITUTION(name,domain) VALUES("NWSBS","sydbus.edu.au");
INSERT INTO INSTITUTION(name,domain) VALUES("STC","southTech.edu.au");



INSERT INTO USER VALUES("ap088","1234","ap088@uowmail.edu.au", 1,"tutor");
INSERT INTO USER VALUES("st111","1234","st111088@hotmail.com",2,"coordinator");
INSERT INTO USER VALUES("hya555","1234","harry@gmail.com",1,"tutor");
INSERT INTO USER VALUES("ddb556","1234","davidyenah@gmail.com",3,"admin");
INSERT INTO USER VALUES("dha316","1234","dha132@hotmail.com",1,"coordinator");


INSERT INTO SUBJECT(subjectCode, sessionExpiry, coordinatorUsername, path) 
VALUES ("CSCI203", DATE("2019-06-12"), "st111","/CSIT321/");

INSERT INTO SUBJECT(subjectCode, sessionExpiry, coordinatorUsername, path) 
VALUES ("CSIT127", DATE("2019-05-12"), "st111","/CSIT127/");

INSERT INTO SUBJECT(subjectCode, sessionExpiry, coordinatorUsername, path) 
VALUES ("CSCI235", DATE("2019-01-12"), "st111","/CSCI235/");

INSERT INTO SUBJECT(subjectCode, sessionExpiry, coordinatorUsername, path) 
VALUES ("CSCI203", DATE("2019-06-12"), "st111","/CSIT321/");

INSERT INTO SUBJECT(subjectCode, sessionExpiry, coordinatorUsername, path) 
VALUES ("CS255", DATE("2019-06-12"), "dha316","/CS255/");


