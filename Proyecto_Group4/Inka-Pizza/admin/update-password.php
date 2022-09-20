<?php include('menu_footer/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php 
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>

        <form action="" method="POST">
        
            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

    </div>
</div>

<?php 

            //Checkeando si el boton submit esta clickeado o no
            if(isset($_POST['submit']))
            {
                //Obteniendo los datos del formulario
                $id=$_POST['id'];
                $current_password = md5($_POST['current_password']);
                $new_password = md5($_POST['new_password']);
                $confirm_password = md5($_POST['confirm_password']);


                //Checkeando si el usuario con el actual id y actual password existe o no
                $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

                //Ejecutando la consulta
                $res = mysqli_query($conn, $sql);

                if($res==true)
                {
                    //Checkeando si los datos estan disponibles o no
                    $count=mysqli_num_rows($res);

                    if($count==1)
                    {
                        //El usuario existe y el password pueden ser cambiados
                        //echo "User Found";

                        //Checkeando si el nuevo password y confirmar si se emparejan o no
                        if($new_password==$confirm_password)
                        {
                            //Actualizando el password
                            $sql2 = "UPDATE tbl_admin SET 
                                password='$new_password' 
                                WHERE id=$id
                            ";

                            //Ejecutando la consulta
                            $res2 = mysqli_query($conn, $sql2);

                            //Checkeando si la consulta esta ejecutada o no
                            if($res2==true)
                            {
                                //Mostrando mensaje con exito
                                //Redireccionando a la pagina  Manage Admin con el mensaje exitoso
                                $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully. </div>";
                                //Redireccionando al usuario
                                header('location:'.SITEURL.'admin/manage-admin.php');
                            }
                            else
                            {
                                //Mostrando el mensaje de error
                                //Redireccionando a la pagina Manage Admin con el mensaje de error
                                $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password. </div>";
                                //Redireccionando al usuario
                                header('location:'.SITEURL.'admin/manage-admin.php');
                            }
                        }
                        else
                        {
                            //Redireccionando a la pagina Manage Admin Page con el mensaje de error
                            $_SESSION['pwd-not-match'] = "<div class='error'>Password Did not Patch. </div>";
                            //Redireccionando al usuario
                            header('location:'.SITEURL.'admin/manage-admin.php');

                        }
                    }
                    else
                    {
                        //Usuario no existe, mostrar mensaje y redireccionar
                        $_SESSION['user-not-found'] = "<div class='error'>User Not Found. </div>";
                        //Redireccionando al usuario
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }

                
            }

?>


<?php include('menu_footer/footer.php'); ?>