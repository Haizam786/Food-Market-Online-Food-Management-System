<?php

//Start SESSION
session_start();

//creating constants for non repeating values
define('HOMEURL','http://localhost/foodmarket/');
define('LOCALHOST', 'localhost');   //when ever user wish to change the database name or username of the database, 
define('DB_USERNAME', 'root');        //can easily change through here
define('DB_PASSWORD', '');
define('DB_NAME', 'foodmarket');    

$conn=mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die (mysqli_error($conn)); //Database Connection
$db_select=mysqli_select_db($conn, DB_NAME) or die (mysqli_error($conn)); //selecting database


?>