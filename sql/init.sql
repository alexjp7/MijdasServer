/************************************************
Author:  Alex Perceval 
Date:    3/10/2019
Group:   Mijdas(kw01)
Purpose: initializes database and SQL user
NOTE: only is requried to be ran once.
************************************************/
CREATE DATABASE Markit;
CREATE USER MarkitUser identified BY "mijdas123";
USE Markit;
GRANT ALL PRIVILEGES ON  Markit.* TO MarkitUser;



