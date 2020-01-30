# The MarkIt Project

* The source contained documents the PHP driven API for Mijdas's MarkIt app as developed during final year development project. 
* The purpose of this API is to provide a modular and reusable interface which can be utilised by our mobile and web applications
* The format of the output/response data will consistent with JSON conventions.

# Other MarkIt repos:
* [Markit Mobile](https://github.com/alexjp7/MijdasMobile).
* [Markit Web](https://github.com/alexjp7/MijdasWeb).

# Links to MarkIt's Documentation:
* [Technical Documentation](https://docs.google.com/document/d/1Z2MqpAQx7kH8sAXyBceEtuVXf-e3QI7tjFyjzcmygUM/edit?usp=sharing )
* [User Manual](https://docs.google.com/document/d/1u3mMrD9jspegA7CbiDzYNqmAJoSQUHNqry6Ky13ZLVE/edit?usp=sharing)
-------------------------------------------

#Mijdas' MarkIt Server
<h1>FOLDER STRUCTURE </h1>

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
* [x] Subject Editing
* [x] Subject Deleting
* [ ] Add Coordiantor2

<h3>Session Use Cases </h3>

* [x] Subject Activation (Within a session)
* [x] Active subject list
* [ ] View Deactivated Subjects
* [ ] Delete Deactivated Subjects
* [ ] Renew Deactivated Subjects
* [X] Add Student to Subject

<h3>Assessment Use Cases </h3>

* [x] Assessment Creation
* [x] Assessment Editing
* [x] Assessment Deleting
* [x] Enable Assessment 
* [x] Disable Assessment

<h3>Criteria Use Cases </h3>

* [x] Criteria Creation
* [x] Criteria Editing
* [x] Criteria Deleting

<h3>Staff Management Use Cases </h3>

* [x] Add tutors
* [x] View tutors
* [x] Add coordinator
* [ ] View coordinators
* [ ] Job Advertisments (job-board)







-------------------------------------------
NOTES:


PDO Extension (Database connection object)
1) In the <PHP_INSTALL_PATH>/php.ini' file, locate and uncomment extension=php_pdo_mysql.dll
2) Restart apache
