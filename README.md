# _ with PHP_

#### _A basic web application which , September 9, 2016_

#### By _**Stephen Burden**_

## Description
_This application is . It from user's form inputs._

## Specifications
| Behavior | Input Ex. | Output Ex. |
| --- | --- | --- |
| Takes and returns |   |   |

## Setup/Installation Requirements
* _Clone the repository from the link below to your desktop_
* _Run Composer Install to include all dependencies_
* _Download and install a program named 'MAMP' on your system_
* _Open MAMP and select Start Servers OR on terminal enter the command: apachectl start_
* _To access the MySQL shell at Epicodus, open the bash terminal and run: mysql.server start followed by the command mysql -uroot -proot then type in _"apachectl start" in the command line._
* _To access the database admin page use your browser to open localhost:8080/phpmyadmin, or localhost:8888/phpmyadmin depending on your networks settings with the user:root and password:root_
* _In Terminal or Command Prompt go to the /web directory and enter the command: php -S localhost:8000_
* _To browse the website go to http://localhost:8000/ in the browser of your choosing_
* _If the server's database is not functioning: change the server number in the app file to match your MySQL Port number in MAMP (Preferences... -> Ports). EXAMPLE: 'mysql:host=localhost:8889;dbname=hair_salon' OR uncomment out the 'ALTERNATIVE SERVER' in the app file and comment out the other._

## MySQL commands ran for project:
* _/Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot_
* _SELECT DATABASE();_
* _CREATE DATABASE hair_salon;_
* _SHOW DATABASES;_
* _USE hair_salon;_
* _CREATE TABLE stylists (id serial PRIMARY KEY, name VARCHAR (255));_
* _CREATE TABLE clients (id serial PRIMARY KEY, name VARCHAR (255), stylist_id INT);_
* __

## Link
https://github.com/spburden/-php

## Known Bugs
_There are no known bugs with this application._

## Support and contact details
_spburden@hotmail.com_

## Technologies Used
_PHP, Silex, Twig, PHP Unit, HTML, and Bootstrap_

### License
The MIT License (MIT)

Copyright (c) 2016 **_Stephen Burden_**
