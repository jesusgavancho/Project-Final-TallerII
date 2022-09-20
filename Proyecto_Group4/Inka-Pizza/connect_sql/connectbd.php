<?php 
//Empezar sesion
session_start();


define('SITEURL', 'http://localhost/Proyecto_Group4/Inka-Pizza/'); 
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'inka-pizza3');
    
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //Conexion Database
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //Seleccionando Database 

?>
