# CRUD Application with PHP, MySQL, and Bootstrap

This project is a simple CRUD (Create, Read, Update, Delete) application built using PHP, MySQL, and Bootstrap. It provides a user-friendly interface to manage records in a MySQL database.

## Features

Create: Add new records to the database.

Read: Display records from the database in a tabular format.

Update: Edit and update existing records.

Delete: Remove records from the database.

Responsive Design: Uses Bootstrap for a responsive and mobile-friendly design.

## Requirements

PHP 7 or higher

MySQL 5 or higher

Web Server (e.g., Apache)

Composer (optional, for dependency management)

Installation

Clone the Repository:

bash

git clone https://github.com/aripardhana0/crud-php-mysql-bootstrap.git
cd crud-php-mysql-bootstrap
Set Up the Database:

Create a MySQL database.

Import the SQL file provided in the database folder to create the necessary tables:

sql

CREATE DATABASE your_database_name;

USE your_database_name;

SOURCE path/to/database.sql;

Configure the Database Connection:


Open config.php and update the database connection settings:

php

$servername = "localhost";

$username = "your_database_username";

$password = "your_database_password";

$dbname = "your_database_name";


Run the Application:


Open your web browser and navigate to the directory where the project is located, e.g., http://localhost/crud-php-mysql-bootstrap.

Usage

Create: Click on the "Add New Record" button to add a new record to the database.

Read: View the list of records in a table format on the main page.

Update: Click the "Edit" button next to a record to update its information.

Delete: Click the "Delete" button next to a record to remove it from the database.

## Contributing

Contributions are welcome! Please fork this repository, make your changes, and submit a pull request.

## ScreenSHoot

![image](https://github.com/Aripardhana0/CRUD-BASIC-PHP-MySQL-BOOTSTRAP/assets/143325663/2ad1e4b5-bbfe-4168-9b60-183b7538dbf0)


## License

This project is licensed under the MIT License. See the LICENSE file for more details.



## Acknowledgements

Bootstrap


PHP

MySQL



