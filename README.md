# Secure-Todo-List
To-Do List Application
A simple and efficient to-do list application built using PHP, MySQL, HTML, and CSS. This project allows users to manage their tasks with features like signup, email verification, login, and password reset. It also includes interactive functionalities like task filtering and animations.

Features:-

Signup: Create an account to manage your tasks.
User can't register with existing email id.
Email Verification (PHPMailer): Verify your email upon registration using PHPMailer.
Login: Secure login with session management.
Add Task: Easily add tasks to your list.
Mark Task: Mark tasks as complete or pending.
Delete Task: Remove tasks from the list.
Password Reset: Reset your password if forgotten.




Additional Features:-

AJAX for Real-Time Updates: Tasks are added or deleted without refreshing the page.
Task Filters: View tasks by two categories—pending or completed.
Slide Animations: Enjoy smooth slide animations when tasks are deleted.


Requirements for Installation:-
Before you begin, ensure you have the following installed:

External setup:-
XAMPP or WAMP (for local server setup)
PHP (version 7 or above)
MySQL
START APEHE SERVER AND MY SQL INSIDE XAMPP_CONTROL  APPLICATION
Add the to do list folder  INSIDE XAMPP  HTDOCS FOLDER 
Steps to Install
Clone the Repository

bash
Copy code
git clone https://github.com/akshay-paramanik/secure-todo-list.git
cd secure-todo-list
Start the Server

Database Setup:-
Open phpMyAdmin or your MySQL client.
Create a new database called "todolist"
sql
Copy code
CREATE DATABASE todolist;
Import the todolist.sql file  in the php my adim to set up the tables.
sql
Copy code
USE todolist;
SOURCE path_to_project/database/todolist.sql;8



Configure Database Connection:-

Open the connect.php file in the root directory.
Update the database credentials as follows:
php
Copy code
<?php
$host = 'localhost';
$db   = 'todolist';
$username = 'root';
$password = '';
?>
Access the Application

Move the project folder to the htdocs directory of XAMPP or WAMP.
bash
Copy code
C:/xampp/htdocs/todolist
Open a browser and navigate to:
bash
Copy code
http://localhost/todolist/index.php


Additional Setup Notes:-

Ensure the mail server is configured properly in mailerScript.php email verification and Password Reset.

Email Verification: The email verification process uses PHPMailer. Ensure you have correctly set up your SMTP server credentials in mailerScript.php.
i created a file where i add sender details whenever i need this file i include it php mailer

Password Reset: The password reset functionality also uses PHPMailer. Make sure your email provider supports SMTP.Submission
The full project is available on GitHub, including the database file: GitHub Repository.
