/*****************************************************
    TODO: 
        - Change password to sha2
        - Introduce trigger to purge table after session
        - add check constraint/trigger to only allow coordinator 
           'typed' people as subject coordinator

*********************************************************/

CREATE TABLE INSTITUTION(
    id          INT             NOT NULL AUTO_INCREMENT, 
    name        VARCHAR (40)    NOT NULL,
    domain      VARCHAR(40)     NOT NULL,
    accessToken VARCHAR(50),

    CONSTRAINT PK_INSTITUTION PRIMARY KEY(id),
    CONSTRAINT UNIQUE_ID UNIQUE(id),
    CONSTRAINT UNIQUE_INSTITUION UNIQUE(domain,name)
);

CREATE TABLE USER(
    username        VARCHAR(20)    NOT NULL,
    password        VARCHAR (30)   NOT NULL, 
    email           VARCHAR (30)   NOT NULL,
    instituion_id   INT            NOT NULL, /*FK to Institution*/
    permissionType  ENUM ('coordinator','tutor','admin'),

    CONSTRAINT PK_USER PRIMARY KEY (username),
    CONSTRAINT FK_INSTITUION FOREIGN KEY(instituion_id) REFERENCES INSTITUTION (id)
);




CREATE TABLE SUBJECT(
    subjectCode         VARCHAR(10) NOT NULL,
    sessionExpiry       DATE        NOT NULL,
    coordinatorUsername VARCHAR(20) NOT NULL,
    path                VARCHAR(40) NOT NULL,
    extension           ENUM('.json', '.csv', '.xml', '.tsv'),

    CONSTRAINT PK_SUBJECT PRIMARY KEY (subjectCode,sessionExpiry)
);



CREATE TABLE ACTIVE_SESSION(
    subjectCode VARCHAR(10),
    sessionExpiry DATE NOT NULL, 

    CONSTRAINT FOREIGN KEY (subjectCode, sessionExpiry) REFERENCES SUBJECT(subjectCode, sessionExpiry)
);