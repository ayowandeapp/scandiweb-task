# OOPSystem # 
---------

## Introduction 
OOP is a simple CRUD system that views, creates and deletes products. The web app contains two pages for product listing and adding a new product.


## Tech Stack (Dependencies)

 * **PHP**, **Apache** and **MSQLI** - as our server language and our database of choice

 You can download and install the dependencies mentioned above as:

- Download and install WAMP 
- Download and install composer from https://getcomposer.org
- Update Composer
	``` composer update ```
- start the Apache and Mysqli

## Development Setup

1. **Clone or Fork the project starter code locally in to the ``` C:\wamp64\www ```**
2. craete a new database
3. setup the database connection in the app/core/DB file, change the databse detail as required
```
<?php

	private $_host = 'localhost';
	private $_username = 'root';
	private $_password = '';
	private $_database = 'test';

```
4. create the table in the databse by importing the recsys.sql 
5. **Run the development server:**
```
php -S localhost:8080
```
6. **Verify on the Browser**<br>
Navigate to project homepage [http://127.0.0.1:8080/](http://127.0.0.1:8080/) or [http://localhost:8080](http://localhost:8080)