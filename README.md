
-------------------------------------------
<h1>MIJDAS REST API README</h1>


* The source contained documents the PHP driven API for Mijdas's markit app. 
* The purpose of this API is to provide a modular and reusable interface which can be utilised by
  * Markit Mobile,
  * Markit Web.

* The format of the output/response data will consistent with JSON conventions.

-------------------------------------------
<h1>FOLDER STRUCTURE (placeholder)</h1>

<h2>├─ api/</h2>

<h3>├─── config/</h3>

<h4>├────── connect.php *file used for core configuration </h4>

<h4>├────── database.php *file used for connecting to the database./</h4>

<h3>├─── models/</h3>

<h4>├────── user.php /</h4>
<h4>├────── assessment.php </h4>
<h4>├────── subject.php </h4>
<h4>├────── institution.php  </h4>
<h4>├────── criteria.php </h4>

<h3>├─── requests/</h3>

<h4>├────── institution|| user || assessment || subject / </h4>

-------------------------------------------
<h1>Valid Paths/METHODS</h1>

BASE URL - markit.mijdas.com/api/requests
1) <h2>user</h2>
* LOGIN
* SIGN_UP
* LOGOUT
* VIEW_PROFILE
* EDIT_PROFILE
* RECOVER_PASSWORD
2)  <h2>subject</h2>
* POPULATE_SUBJECTS
* EDIT_SUBJECT
* DELETE_SUBJECT
* VIEW_PROFILE
* CREATE_SUBJECT
3)  <h2>assessment</h2>
* VIEW_ASSESSMENT
* CREATE_ASSESSMENT
* EDIT_ASSESSMENT
* DELETE_ASSESSMENT
4)  <h2>criteria</h2>
* VIEW_CRITERIA
* CREATE_CRITERIA
* EDIT_CRITERIA
* DELETE_CRITERIA


-------------------------------------------
<h1>TODO List:</h1>


<h2>User Adminstration</h2>

* [x] Login validation 
* [x] Profile viewing
* [ ] Profile Editing
* [ ] Change Password
* [ ] Recover Password
* [ ] Deleting Account


<h2>Tutor Functionalities</h2>

* [X] View Subject List
* [X] View Assessment List 
* [X] View Criteria List (within marking a student)
* [x] Student List
* [x] Update Student Marks
* [ ] Institution List (job board)


<h2>Co-ordinator Functionalities</h2>

<h3>Subject Use Cases </h3>

* [x] Subject Creation
* [ ] Subject Editing
* [ ] Subject Deleting
* [ ] Add Coordiantor2

<h3>Session Use Cases </h3>

* [x] Subject Activation (Within a session)
* [ ] Active subject list
* [ ] View Deactivated Subjects
* [ ] Delete Deactivated Subjects
* [ ] Renew Deactivated Subjects
* [X] Add Student to Subject

<h3>Assessment Use Cases </h3>

* [x] Assessment Creation
* [ ] Assessment Editing
* [ ] Assessment Deleting
* [x] Enable Assessment 
* [x] Disable Assessment
* [ ] Import Assessment From Previos Semester

<h3>Criteria Use Cases </h3>

* [x] Criteria Creation
* [ ] Criteria Editing
* [ ] Criteria Deleting

<h3>Staff Management Use Cases </h3>

* [x] Add tutors
* [ ] View tutors
* [ ] Add coordinator
* [ ] View coordinators
* [ ] Job Advertisments (job-board)







-------------------------------------------
NOTES:


PDO Extension (Database connection object)
1) In the <PHP_INSTALL_PATH>/php.ini' file, locate and uncomment extension=php_pdo_mysql.dll
2) Restart apache
