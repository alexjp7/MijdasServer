
-------------------------------------------
<h1>MIJDAS REST API README</h1>


* The source contained documents the PHP driven API for Mijdas's markit app. 
* The purpose of this API is to provide a modular and reusable interface which can be utilised by;
* Markit Mobile
* Markit Web.

* The markit API will feature a RESTful (Representative State Transfer) API model.

* The main functionality of this API is to provide an interface to perform the following HTTP methods

* The format of the output/response data will consistent with JSON conventions.

-------------------------------------------
<h1>FOLDER STRUCTURE (placeholder)</h1>

<h2>├─ api/</h2>

<h3>├─── config/</h3>

<h4>├────── connect.php *file used for core configuration </h4>

<h4>├────── database.php *file used for connecting to the database./</h4>

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
<h1>Valid Paths/METHODS</h1>

BASE URL -
* markit.mijdas.com/api/requests

<h2>user</h2>
* LOGIN
* SIGN_UP
* LOGOUT
* VIEW_PROFILE
* EDIT_PROFILE
* RECOVER_PASSWORD

<h2>subject</h2>
* POPULATE_SUBJECTS
* EDIT_SUBJECT
* DELETE_SUBJECT
* VIEW_PROFILE
* CREATE_SUBJECT

<h2>assessment</h2>
* VIEW_ASSESSMENT
* CREATE_ASSESSMENT
* EDIT_ASSESSMENT
* DELETE_ASSESSMENT


<h2>criteria</h2>
* VIEW_CRITERIA
* CREATE_CRITERIA
* EDIT_CRITERIA
* DELETE_CRITERIA




-------------------------------------------
<h1>TODO List:</h1>


<h2>User Adminstration</h2>

* [ ] Login validation 
* [ ] Profile viewing
* [ ] Profile Editing
* [ ] Change Password
* [ ] Recover Password
* [ ] Deleting Account


<h2>Tutor Functionalities</h2>

* [X] View Subject List
* [X] View Assessment List 
* [X] View Criteria List (within marking a student)
* [ ] Student List
* [ ] Institution List (job board)

<h2>Co-ordinator Functionalities</h2>

* [ ] Subject Creation
* [ ] Subject Editing
* [ ] Subject Deleting
* [ ] Subject Viewing
* [ ] Active subject list(coordinator)
* [ ] Deactivated Subjects
* [ ] Linked tutors
* [ ] Linked coordinators
* [ ] Subject Tempalte
* [ ] Assessment Tempalte
* [ ] Job Advertisments (job-board)





-------------------------------------------
NOTES:


PDO Extension (Database connection object)
1) In the <PHP_INSTALL_PATH>/php.ini' file, locate and uncomment extension=php_pdo_mysql.dll
2) Restart apache
