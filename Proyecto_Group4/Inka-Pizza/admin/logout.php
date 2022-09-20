<?php 
    //Incluir connectbd.php para SITEURL
    include('../connect_sql/connectbd.php');
    //Destruyendo la sesion
    session_destroy(); //Desastableciendo $_SESSION['user']

    //Redireccionando a la pagina login
    header('location:'.SITEURL.'admin/login.php');

?>