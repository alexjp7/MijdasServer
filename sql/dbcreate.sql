
CREATE TABLE institution(
    id          INT             NOT NULL AUTO_INCREMENT, 
    name        VARCHAR (40)    NOT NULL,
    domain      VARCHAR(40)     NOT NULL,

    CONSTRAINT PK_INSTITUTION PRIMARY KEY(id),
    CONSTRAINT UNIQUE_INSTITUION UNIQUE(domain,name)
);



CREATE TABLE user( 
    username        VARCHAR(20)    NOT NULL,
    password        VARCHAR (50)   NOT NULL, 
    email           VARCHAR (30)   NOT NULL,
    permission_type ENUM ('coordinator','tutor','admin'),

    CONSTRAINT PK_USER PRIMARY KEY (username)
);

CREATE TABLE user_institution(
    username          VARCHAR(20) NOT NULL, 
    institution_id    INT  NOT NULL,

    CONSTRAINT PK1 PRIMARY KEY (username, institution_id),
    CONSTRAINT FK_USER FOREIGN KEY (username) REFERENCES user (username),
    CONSTRAINT FK_INSTITUTION FOREIGN KEY (institution_id) REFERENCES institution (id)

);



CREATE TABLE subject(
    id      INT  NOT NULL AUTO_INCREMENT,
    subject_code         VARCHAR(10) NOT NULL,
  
    CONSTRAINT UNIQUE_ID   UNIQUE(id),
    CONSTRAINT PK_SUBJECT PRIMARY KEY (id)
);


/*****************************************************************************************
       subject_session is  the instance of when a subject is ra
        * listed as inactive for  coordiantor prompt: DELETE SUB_SESION -> tutoring staff, results.  
*******************************************************************************************/


CREATE TABLE subject_session(
    
    id              INT         NOT NULL AUTO_INCREMENT,
    subject_id      INT         NOT NULL,
    isActive        BOOLEAN     NOT NULL,
    coordinator_id  VARCHAR(20) NOT NULL,
    session_expiry  DATE        NOT NULL,  
    
	CONSTRAINT PK_SUBJECT_SESSION PRIMARY KEY (id),
    CONSTRAINT FK1_SUBJECT FOREIGN KEY (subject_id) REFERENCES subject(id),
    CONSTRAINT FK2_USER FOREIGN KEY (coordinator_id) REFERENCES user(username)

);


CREATE TABLE assessment(
    id          INT NOT NULL AUTO_INCREMENT,
    a_number    INT NOT NULL,
    subject_id  INT NOT NULL,

    CONSTRAINT PK_ASSESSMENT PRIMARY KEY (id),
    CONSTRAINT FK_SUBJECT FOREIGN KEY (subject_id) REFERENCES subject(id)
);


CREATE TABLE criteria(
    id          INT NOT NULL AUTO_INCREMENT,
    a_id        INT NOT NULL,

	CONSTRAINT PK_CRITERIA	PRIMARY KEY (id),
    CONSTRAINT FK_ASSESSMENT FOREIGN KEY (a_id) REFERENCES subject(id)
);


CREATE TABLE criteria_items(
        id          INT NOT NULL AUTO_INCREMENT,
        criteria_id INT NOT NULL,
        element     INT NOT NULL,
        max_mark    INT NOT NULL,       

        CONSTRAINT PK_CRITERIA_ITEM PRIMARY KEY(id),  
        CONSTRAINT FK_CRITERIA FOREIGN KEY (criteria_id) REFERENCES subject(id)

);


CREATE TABLE student_results(
    id          INT NOT NULL AUTO_INCREMENT,
    a_id        INT NOT NULL,
    student_id  VARCHAR(8), 
    result      DECIMAL(5,2),
    access_token VARCHAR(50),  /*COME BACK TO THIS LATER!*/

    CONSTRAINT PK_STUDENT PRIMARY KEY (id),
    CONSTRAINT FK1_ASSESSMENT FOREIGN KEY (a_id) REFERENCES subject(id) 
);


CREATE TABLE staff_allocation(
    id                  INT NOT NULL AUTO_INCREMENT,
    username            VARCHAR(20) NOT NULL,
    subject_session_id  INT NOT NULL,

    CONSTRAINT PK_STAFF_ALLOCATION PRIMARY KEY (id),
    CONSTRAINT FK3_USER FOREIGN KEY (username) REFERENCES user(username),
    CONSTRAINT FK_SUBJECT_SESSION FOREIGN KEY (subject_session_id) REFERENCES subject_session(id)
);



/*

web/mobile

GET(
    [
        {[1,0,5]},   CRITEREA 1: slider: max 5 marks
        {[2,1,10]},  CRITEREA 2: checkBoox: max 10 marks
        {[3,2,15]}   CRITEREA 3: slider: max 15 marks
    ])


 0 == slider FOR criterea 1.
 1 == CHECKBOX
 2 == TEXT FIELD
*/


