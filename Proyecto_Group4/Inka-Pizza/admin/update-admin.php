<?php include('menu_footer/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>

        <?php 
            //Obteniendo el id del admin seleccionando
            $id=$_GET['id'];

            //Creando la consulta SQL para obtener los detalles
            $sql="SELECT * FROM tbl_admin WHERE id=$id";

            //Ejecutando la consulta
            $res=mysqli_query($conn, $sql);

            //Checkeando si la consulta esta ejecutada o no
            if($res==true)
            {
                //Checkeando si los datos estan disponibles o no
                $count = mysqli_num_rows($res);
                //Checkeando si se tiene los datos del admin o no
                if($count==1)
                {
                    //Obteniendo los detalles
                    //echo "Admin Available";
                    $row=mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else
                {
                    //Redireccionando a la pagina Manage Admin 
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
        
        ?>


        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>

<?php 

    //Checkeando si el boton de submit esta clickeado o no
    if(isset($_POST['submit']))
    {
        //echo "Button CLicked";
        //Obteniendo todos los valores del formulario para actualizar
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        //Creando consulta SQL para actualizar admin
        $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username' 
        WHERE id='$id'
        ";

        //Ejecutando la consulta
        $res = mysqli_query($conn, $sql);

        //Checkeando si la consulta ha sido ejecutada satisfactoriamente o no
        if($res==true)
        {
            //Consulta ejecutada y admin actualizado
            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
            //Redireccionando a la pagina Manage Admin
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //Fallo al actualizar admin
            $_SESSION['update'] = "<div class='error'>Failed to Delete Admin.</div>";
            //Redireccionando a la pagina Manage Admin 
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }

?>


<?php include('menu_footer/footer.php'); ?>