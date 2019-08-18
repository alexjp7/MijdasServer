
/****************************************************************************************
*Removed artificial Identifier
* each institution can be identified by name 
*******************************************************************************************/
CREATE TABLE institution(
    name        VARCHAR (40)    NOT NULL,
    domain      VARCHAR(40)     NOT NULL,

    CONSTRAINT PK_INSTITUTION PRIMARY KEY(name)
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
    username            VARCHAR(20) NOT NULL, 
    institution_name    VARCHAR(40) NOT NULL,

    CONSTRAINT PK1 PRIMARY KEY (username, institution_name),
    CONSTRAINT FK_USER FOREIGN KEY (username) REFERENCES user (username),
    CONSTRAINT FK_INSTITUTION FOREIGN KEY (institution_name) REFERENCES institution(name)
);

/****************************************************************************************
* Provides a table to allow for historical storage of subjects irrespective 
    if they are actively running
*******************************************************************************************/
CREATE TABLE subject(
    code              VARCHAR(10) NOT NULL,
    institution_name  VARCHAR(40) NOT NULL,

    CONSTRAINT PK_SUBJECT PRIMARY KEY (code, institution_name),
    CONSTRAINT FK2_INSTITUTION FOREIGN KEY (institution_name) REFERENCES institution(name)
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
    institution_name    VARCHAR(40) NOT NULL,  
    
	CONSTRAINT PK_SUBJECT_SESSION PRIMARY KEY (id),
    CONSTRAINT FK1_SUBJECT FOREIGN KEY (subject_code, institution_name) REFERENCES subject(code, institution_name),
    CONSTRAINT FK2_USER FOREIGN KEY (coordinator_id) REFERENCES user(username)

);


CREATE TABLE assessment(
    id                  INT NOT NULL AUTO_INCREMENT,
    a_number            INT NOT NULL,
    subject_session_id  INT NOT NULL,

    CONSTRAINT PK_ASSESSMENT PRIMARY KEY (id),
    CONSTRAINT FK_SUBJECT FOREIGN KEY (subject_session_id) REFERENCES subject_session(id)
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
CREATE TABLE criteria_items(
        a_id            INT NOT NULL,
        c_id            INT NOT NULL,
        element         INT NOT NULL,
        max_mark        INT NOT NULL, 
        display_text    VARCHAR(20) NOT NULL,

        CONSTRAINT PK_CRITERIA_ITEM PRIMARY KEY(a_id, c_id),  
        CONSTRAINT FK_ASSESSMENT FOREIGN KEY (a_id) REFERENCES assessment(id)
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
    CONSTRAINT FK1_ASSESSMENT FOREIGN KEY (a_id) REFERENCES assessment(id) 
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


