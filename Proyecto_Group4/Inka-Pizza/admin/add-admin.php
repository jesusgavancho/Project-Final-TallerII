<?php include('menu_footer/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['add'])) //Checkeando si la sesion esta establecida o no
            {
                echo $_SESSION['add']; //Mostrar el mensaje de sesion si esta establecida 
                unset($_SESSION['add']); //Removiendo el mensaje de sesion
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>


    </div>
</div>

<?php include('menu_footer/footer.php'); ?>


<?php 
    //Procesando el valor del fromulario y guardar en la base de datos

    //Checkeando si el boton submit esta clickeado o no

    if(isset($_POST['submit']))
    {
        // Button clickeado
        //echo "Button Clicked";

        // Obteniendo los datos del formulario
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //Password Encryption con MD5

        //Consulta SQL  para guardar los datos en la base de datos
        $sql = "INSERT INTO tbl_admin SET 
            full_name='$full_name',
            username='$username',
            password='$password'
        ";
 
        //Ejecutando la consulta y guardar los datos en la base de datos
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // Checkeando si la consulta esta ejecutada y si los datos han sido insertados y mostrar los mensajes
        if($res==TRUE)
        {
            //Datos insertados
            //echo "Data Inserted";
            //Creando una variable de sesion para mostrar mensaje
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";
            //Redireccionando a la pagina Manage Admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //Fallo para insertar los datos
            //echo "Failed to Insert Data";
            //Creando una variable de sesion para mostrar mensaje
            $_SESSION['add'] = "<div class='error'>Failed to Add Admin.</div>";
            //Redireccionando a la pagina Add Admin
            header("location:".SITEURL.'admin/add-admin.php');
        }

    }
    
?>