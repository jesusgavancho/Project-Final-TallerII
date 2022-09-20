<?php include('../connect_sql/connectbd.php'); ?>

<html>
    <head>
        <title>Login - Inka Pizza System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>

            <!-- Formulario de Login empieza aqui -->
            <form action="" method="POST" class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder="Enter Username"><br><br>

            Password: <br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
            </form>
            <!-- Formulario de Login acaba aqui -->

           <p class="text-center">2021-2 Todos lo derechos reservados, Inka Pizza. Desarrollado por el  Group 04-Taller de Software II</p>
        </div>

    </body>
</html>

<?php 

    //Checkeando si el boto submit esta clickeado o no
    if(isset($_POST['submit']))
    {
        
        //Obteniendo los datos del formulario Login
        // $username = $_POST['username'];
        // $password = md5($_POST['password']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $raw_password);

        //SQL para ckeckear si el usuario con username y password existe o no
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //Ejecutando la consulta
        $res = mysqli_query($conn, $sql);

        //Contando las filas para checkear si el usuario existe o no
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //Usuario disponible y Login exitoso
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['user'] = $username; //Checkeando si el usario esta logueado o no y el deslogueo se desasteblecera

            //Redireccionando a Home Page/Dashboard
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            //Usuario no disponible y fallo de Login 
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            //Redireccionando a Home Page/Dashboard
            header('location:'.SITEURL.'admin/login.php');
        }


    }

?>