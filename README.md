
-------------------------------------------
MIJDAS REST API README
-------------------------------------------

 * The source contained documents the PHP driven API for Mijdas's markit app. 
 * The purpose of this API is to provide a modular and reusable interface which can be utilised by;
 	- Markit Mobile
 	- Markit Web.

 * The markit API will feature a RESTful (Representative State Transfer) API model.

 * The main functionality of this API is to provide an interface to perform the following HTTP methods
 	- GET 		- used for reading and retrieving data.
 	- POST 		- used for inserting data.
 	- PUT/PATCH - used for updating data.
 	- DELETE 	- used for deleting data

* The format of the output/response data will consistent with JSON conventions.

-------------------------------------------
FOLDER STRUCTURE (placeholder)
-------------------------------------------
├─ api/
├─── config/
├────── connect.php - file used for core configuration
├────── database.php - file used for connecting to the database.
├─── object/
├────── item.php - contains properties and methods for "item" database queries.
├─── requests/
├────── GET.php - file that will accept posted product data to be saved to database.

-------------------------------------------
NOTES:
-------------------------------------------


PDO Extension (Database connection object)
-------------------------------------------
1) In the <PHP_INSTALL_PATH>/php.ini' file, locate and uncomment extension=php_pdo_mysql.dll
2) Restart apache







