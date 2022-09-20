<?php 

    //Autorizacion- Control de acceso
    //Checkeando si el usuario esta logueado o no
    if(!isset($_SESSION['user'])) //If user session is not set
    {
        //Usuario no esta logueado
        //Redireccionando a la pagina login con el sgt mensaje
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Admin Panel.</div>";
        //Redireccionando a la pagina login
        header('location:'.SITEURL.'admin/login.php');
    }

?>