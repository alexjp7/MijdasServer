
-------------------------------------------
#MIJDAS REST API README
-------------------------------------------

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
#FOLDER STRUCTURE (placeholder)
-------------------------------------------
##├─ api/

###├─── config/

##├────── connect.php - file used for core configuration

###├────── database.php - file used for connecting to the database.

##├─── models/

###├────── user.php 
###├────── assessment.php 
###├────── subject.php 
###├────── institution.php  
###├────── criteria.php 

##├─── requests/

###├────── institution|| user || assessment || subject / 

####├──────────── create.php

####├──────────── read.php

####├──────────── update.php

####├──────────── delete.php

-------------------------------------------
#Valid Paths/METHODS
-------------------------------------------
##BASE URL -
* markit.mijdas.com/api/requests

##USER
* POST /user/create.php
* GET /user/read.php
* PUT /user/update.php
* DELETE /user/delete.php

##institution
* POST /institution/create.php
* GET /institution/read.php
* PUT /institution/update.php
* DELETE /institution/delete.php


##assessment
* POST /assessment/create.php
* GET /assessment/read.php
* PUT /assessment/update.php
* DELETE /assessment/delete.php






-------------------------------------------
#NOTES:
-------------------------------------------


PDO Extension (Database connection object)
-------------------------------------------
1) In the <PHP_INSTALL_PATH>/php.ini' file, locate and uncomment extension=php_pdo_mysql.dll
2) Restart apache







