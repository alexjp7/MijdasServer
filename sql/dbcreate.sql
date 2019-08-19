
/****************************************************************************************

*******************************************************************************************/
CREATE TABLE institution(
    id      INT NOT NULL AUTO_INCREMENT,   
    name    VARCHAR(40) NOT NULL,
    domain  VARCHAR(40) NOT NULL,
    tag     VARCHAR(5), 

    CONSTRAINT PK_INSTITUTION PRIMARY KEY(id),
    CONSTRAINT UNIQUE (name, domain)
);



CREATE TABLE user( 
    username        VARCHAR(20)    NOT NULL,
    password        VARCHAR (50)   NOT NULL, 
    email           VARCHAR (30)   NOT NULL,
    permission_type ENUM ('coordinator','tutor','admin'),

    CONSTRAINT PK_USER PRIMARY KEY (username)
);

/****************************************************************************************
* Co-ordinators don't need a multivariate relationship with institution.
    -> however, tutors will need this in order to gain advertisments on the job board feature
*******************************************************************************************/

CREATE TABLE user_institution(
    username    VARCHAR(20) NOT NULL, 
    i_id        INT NOT NULL,

    CONSTRAINT PK1 PRIMARY KEY (username, i_id),
    CONSTRAINT FK_USER FOREIGN KEY (username) REFERENCES user (username),
    CONSTRAINT FK_INSTITUTION FOREIGN KEY (i_id) REFERENCES institution(id)
);

/****************************************************************************************
* Provides a table to allow for historical storage of subjects irrespective 
    if they are actively running
*******************************************************************************************/
CREATE TABLE subject(
    code    VARCHAR(10) NOT NULL,
    i_id    INT         NOT NULL,

    CONSTRAINT PK_SUBJECT PRIMARY KEY (code, i_id),
    CONSTRAINT FK2_INSTITUTION FOREIGN KEY (i_id) REFERENCES institution(id)
);


/****************************************************************************************
* Subject_session while 'highly redundant' does serve in filtering 
 out subjects that are not active in a session 

*Changed FK to subject (subject_code, institution_id)
        - While redundant, it improves JOIN dependancies
        - (Considerations into update cascades between subject and subject_session)
*subject_session is  the instance of when a subject is ra
* listed as inactive for  coordiantor prompt:
                        DELETE SUB_SESION -> tutoring staff, results.  
*******************************************************************************************/
CREATE TABLE subject_session(
    
    id                  INT         NOT NULL AUTO_INCREMENT,
    isActive            BOOLEAN     NOT NULL,
    coordinator_id      VARCHAR(20) NOT NULL,
    session_expiry      DATE        NOT NULL,
    subject_code        VARCHAR(10) NOT NULL,
    i_id                INT         NOT NULL,  
    
	CONSTRAINT PK_SUBJECT_SESSION PRIMARY KEY (id),
    CONSTRAINT FK1_SUBJECT FOREIGN KEY (subject_code, i_id) REFERENCES subject(code, i_id),
    CONSTRAINT FK2_USER FOREIGN KEY (coordinator_id) REFERENCES user(username),
    CONSTRAINT UNIQUE (subject_code, i_id)
);


CREATE TABLE assessment(
    id                  INT NOT NULL AUTO_INCREMENT,
    a_number            INT NOT NULL,
    subject_session_id  INT NOT NULL,

    CONSTRAINT PK_ASSESSMENT PRIMARY KEY (id),
    CONSTRAINT FK_SUBJECT FOREIGN KEY (subject_session_id) REFERENCES subject_session(id),
    CONSTRAINT UNIQUE(a_number, subject_session_id)
);

/****************************************************************************************
* Added FK to assessment, as a consequence of denormalising criteria/criteria_item
* Removed criteria artificial identifier
    -> each criteria does not necssarily need to be uniquely identified, but rather clustered
        ->  however in order to maintain sequential list of items, a criteria_id(c_id) 
                                                                   will be required
* Each criteria will redundantly store assessment ID, however reduces JOINs
* cirteria_item.max_mark could be aggregated to provide assessment mark_out_of?
*******************************************************************************************/
CREATE TABLE criteria_item(
        a_id            INT NOT NULL,
        c_id            INT NOT NULL,
        element         INT NOT NULL,
        max_mark        INT NOT NULL, 
        display_text    VARCHAR(20) NOT NULL,

        CONSTRAINT PK_CRITERIA_ITEM PRIMARY KEY(a_id, c_id),  
        CONSTRAINT FK_ASSESSMENT FOREIGN KEY (a_id) REFERENCES assessment(id)
);


/****************************************************************************************
*Added student_subject to be the table which stores student ids upon initial import
*******************************************************************************************/
CREATE TABLE student_subject(
    student_id             VARCHAR(8), 
    subject_session_id     INT NOT NULL,
    CONSTRAINT PK_STUTDENT_SUBJECT PRIMARY KEY(student_id, subject_session_id),
    CONSTRAINT FK2_SUBJECT FOREIGN KEY (subject_session_id) REFERENCES subject_session(id)
);


/****************************************************************************************
* Removed artificial primary ID
    -> each result can be identified by student_id and assessment id(a_id)
*******************************************************************************************/
CREATE TABLE student_results(
    a_id            INT NOT NULL,
    student_id      VARCHAR(8), 
    result          DECIMAL(5,2),
    access_token    VARCHAR(50),  /*COME BACK TO THIS LATER!*/

    CONSTRAINT PK_STUDENT PRIMARY KEY (a_id, student_id),
    CONSTRAINT FK1_ASSESSMENT FOREIGN KEY (a_id) REFERENCES assessment(id),
    CONSTRAINT FK_STUDENT_SUBJECT FOREIGN KEY (student_id) REFERENCES student_subject(student_id)
);



/****************************************************************************************
* Removed artificial primary ID
    -> each staff allocation  can be identified by username and subject
* Remamed subject_session_id to subject_id.
* CONSIDERATION: Staff_allocation can be denomralized with subject_session for less JOINs
*******************************************************************************************/
CREATE TABLE staff_allocation(

    username    VARCHAR(20) NOT NULL,
    subject_id  INT NOT NULL,

    CONSTRAINT PK_STAFF_ALLOCATION PRIMARY KEY (username, subject_id),
    CONSTRAINT FK3_USER FOREIGN KEY (username) REFERENCES user(username),
    CONSTRAINT FK_SUBJECT_SESSION FOREIGN KEY (subject_id) REFERENCES subject_session(id)
);



/********************************************************
    Example Format for JSON response for criteria_item

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


