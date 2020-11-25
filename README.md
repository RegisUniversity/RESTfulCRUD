# RestfulCRUD
This is a simple database-driven web-application designed to capture aficionado's favorite adult beverages (i.e., spirits and beers). The architecture for this application is based on a LAMP stack (Linux, Apache2, MySQL, PHP) with RESTful services. The overarching design goal was to demonstrate simple CRUD functionality and RESTful services in a LAMP stack.  [^1]
[^1]: hello
# Configuration instructions
## Configure _AMP Stack
This application can be easilty configured to your local or remote development environment on top of an already existing LAMP, WAMP, XAMP, or similarly appropriate _AMP stack. You will need to have a MySQL server installed with a user and sudo privileges. 
## Configure webroot directory
You will also need a webroot directory created which will be where the installation files will reside. In the example used here, the directory was /var/www/html.

# Installation instructions
In time, I plan to create a setup.php file which can be run to initiatie setup for this application. For now, to install this application, the following steps are necessary.

## Create Application Directory
- Create an application directory where you will next copy project files into (e.g., /var/www/project1)
## Copy files to webroot directory
In the application package there are seven files that need to be copied over to the application directory you created in earlier step.

## Database Installation
- create MySQL Database
- create table called "people"
- Run the following SQL script to create values used for people table.
```sql
CREATE TABLE people (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    spirit VARCHAR(255) NOT NULL,
    beer VARCHAR(255) NOT NULL
);
```
## config.php

- Configure config.php. Specifically, modify as necessary database name, user name and login. Here is the code for configure.php as used in this demosntration. 

```php
<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root'); /note. root is used here, although any user can be used as you see fit.
define('DB_PASSWORD', '');     /note. this field is shown blank, however, use the password for the stated user above.
define('DB_NAME', 'fivex5');   /note. for this demo fivex5 was the name of the db, name the db as you see fit.
 
/* Attempt to connect to MySQL database */
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
?>
```

# Operating instructions
- Now go to localhost and you should see the following:

<img src= https://github.com/RegisUniversity/RestfulCRUD/blob/master/Screenshot%20from%202020-11-14%2019-22-47.png>

# A file manifest (list of files included)
- config.php
- create.php
- delete.php
- error.php
- index.php
- read.php
- update.php

# Copyright and licensing information.
This work conforms to "Libre" in that it is free to study, free to copy, free to share, and free to modify.

# Contact information for the distributor or programmer.
Kevin Pyatt, Ph.D. kpyatt@regis.edu

# Known bugs.


# Troubleshooting.
