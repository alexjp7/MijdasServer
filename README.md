
-------------------------------------------
<h1>MIJDAS REST API README</h1>


* The source contained documents the PHP driven API for Mijdas's markit app. 
* The purpose of this API is to provide a modular and reusable interface which can be utilised by;
- Markit Mobile
- Markit Web.

* The markit API will feature a RESTful (Representative State Transfer) API model.

* The main functionality of this API is to provide an interface to perform the following HTTP methods
- GET 		- used for reading and retrieving data.
- POST 		- used for inserting data.
- PUT		- used for updating data.
- DELETE 	- used for deleting data

* The format of the output/response data will consistent with JSON conventions.

-------------------------------------------
<h1>FOLDER STRUCTURE (placeholder)</h1>

<h2>├─ api/</h2>

<h3>├─── config/</h3>

<h4>├────── connect.php - file used for core configuration </h4>

<h4>├────── database.php - file used for connecting to the database./</h4>

<h3>├─── models//</h3>

<h4>├────── user.php /</h4>
<h4>├────── assessment.php </h4>
<h4>├────── subject.php </h4>
<h4>├────── institution.php  </h4>
<h4>├────── criteria.php </h4>

<h3>├─── requests/</h3>

<h4>├────── institution|| user || assessment || subject / </h4>

<h5>├──────────── create.php</h5>

<h5>├──────────── read.php </h5>

<h5>├──────────── update.php </h5>

<h5>├──────────── delete.php </h5>

-------------------------------------------
Valid Paths/METHODS

BASE URL -
* markit.mijdas.com/api/requests

USER
* POST /user/create.php
* GET /user/read.php
* PUT /user/update.php
* DELETE /user/delete.php

INSTITUTION
* POST /institution/create.php
* GET /institution/read.php
* PUT /institution/update.php
* DELETE /institution/delete.php


ASSESS,EMT
* POST /assessment/create.php
* GET /assessment/read.php
* PUT /assessment/update.php
* DELETE /assessment/delete.php



<h1>TODO List:</h1>
-------------------------------------------

<h2>User Adminstration</h2>
-------------------
- [ ] Login validation 
- [ ] Profile viewing
- [ ] Profile Editing
- [ ] Change Password
- [ ] Recover Password
- [ ] Deleting Account


<h2>Tutor Functionalities</h2>
-------------------
- [ ] View Subject List
- [ ] View Assessment List 
- [ ] View Criteria List (within marking a student)
- [ ] Student List
- [ ] Institution List (job board)

<h2>Co-ordinator Functionalities</h2>
-----------------------------
- [ ] Subject Creation
- [ ] Subject Editing
- [ ] Subject Deleting
- [ ] Subject Viewing
- [ ] Active subject list(coordinator)
- [ ] Deactivated Subjects
- [ ] Linked tutors
- [ ] Linked coordinators
- [ ] Subject Tempalte
- [ ] Assessment Tempalte
- [ ] Job Advertisments (job-board)





-------------------------------------------
NOTES:


PDO Extension (Database connection object)
1) In the <PHP_INSTALL_PATH>/php.ini' file, locate and uncomment extension=php_pdo_mysql.dll
2) Restart apache
