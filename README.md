# ALICE

Based in the basic relational operations term CRUD (Create, Read, Update and Delete), emerged the idea to name this project ALICE (Alteration, Login, Include, Consult, Exclude). 

## Proposal 

- Create two tables with an relationship one-to-many. The table receiving the key of the relationship must contain at least four fields and to be chosen to manipulation in PHP. 

- For the system to register the selling of the products, their data needs to be stored previously in the DB. There will be a program to Alter registered products, Login, Include , Consult and exclude (Delete) the data of the products, from this acronym, the name A.L.I.C.E.

## Technologies 

To construct this aplication, was used PHP and JavaScript with the DBMS Postgree 9.6.2 (and later ported over to MariaDB). The visual part of the website was built using HTML and pure CSS, in set with the JavaScript and JQuery to DOM manipulation. We worked together in order to develop our respective technologies (Back and Front).

We implement all the basic security measures for the account creation and storage in the DB, a noscript warning, and the possibility of changing/recovering you password by email using PHPMailer + Composer.

## View of the Project

![image](https://user-images.githubusercontent.com/69210720/123141339-a9f63080-d42e-11eb-9eea-4e1524f3e29c.png)

The project has a index startup screen, Login, Register and User page with visual error feedbacks. When the user performs the sign-in, he is redirected to the Home page, which has the interaction with the user to do the main operations of the application, insert, edit and exclude through modals and boxes. The User page alows the user to change their informations and profile picture. **The Profile Picute System won't work in the server version because of upload restrictions and old software**.

If you want to view our project quickly **[click on here](http://200.145.153.175/felipeestevanatto/Projetos/ALICE/).**

****

## Installation

### Connection 

The project can be Hosted in your machine through the instalation in an local server, to this is necessary just the alteration of the file ```connect.php```. Changing the informations of the connection according your server, user, password and database.

**Exemplo:**

```php
<?php

    $DB_dsn = 'mysql:host=localhost;dbname=alice_db';
    $DB_user = "root";
    $DB_password = "";

    try {
        $conn = new PDO($DB_dsn, $DB_user, $DB_password);
    }
    catch(PDOException $e) {
        echo 'Error: '.$e->getCode().' Message: '.$e->getMessage(); 
    }

?>
```

In this case we will use the ```MySQL``` DB in ```localhost``` with the user ```root``` and empty password, doing the connection with the database ```alice_db``` where all the information and tables will be inserted.

### SQL

To receive the data, you need to prepare your Database with the correct tables, the SQL code can be found in the file ```SQL.sql``` or right bellow:

**Data Base Creation**

```sql
CREATE DATABASE alice_db;
```

****

**Users Table Creation**

```sql
CREATE TABLE users (
id_user SERIAL PRIMARY KEY NOT NULL,
name_user VARCHAR(40) NOT NULL,
email_user VARCHAR(128) NOT NULL UNIQUE,
password_user VARCHAR(72) NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

****

**User Records Table Creation**

```sql
CREATE TABLE user_records (
id_record SERIAL PRIMARY KEY NOT NULL,
name_record VARCHAR(100),
quantity_record INT NOT NULL,
type_record VARCHAR(20),
price_record DECIMAL(10,2),
deleted BOOLEAN NOT NULL,
timeDeleted TIMESTAMP,
fk_user BIGINT UNSIGNED NOT NULL,
FOREIGN KEY (fk_user) REFERENCES users (id_user)
);
```

****

**User Profile Pictures Table Creation**

```sql
CREATE TABLE user_picture(
id_photo SERIAL PRIMARY KEY NOT NULL,
filename VARCHAR(128) NOT NULL,
fk_user BIGINT UNSIGNED NOT NULL, 
FOREIGN KEY (fk_user) REFERENCES users (id_user)
);
```

>For the Creation of this Tables in PostGreSQL to work, it's necessary to remove the ```UNSIGNED``` from the table ```user_records``` and ```user_picture``` because PostGree doesn't have the UNSIGNED attribute and it is needed in the MySQL/MariaDB version.
