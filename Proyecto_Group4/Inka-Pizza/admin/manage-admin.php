<?php include('menu_footer/menu.php'); ?>


        <!-- La seccion del contenido principal empieza aqui -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Admin</h1>

                <br />

                <?php 
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add']; //Mostrando el mensaje de sesion
                        unset($_SESSION['add']); //Removiendo el mensaje de sesion
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['user-not-found']))
                    {
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }

                    if(isset($_SESSION['pwd-not-match']))
                    {
                        echo $_SESSION['pwd-not-match'];
                        unset($_SESSION['pwd-not-match']);
                    }

                    if(isset($_SESSION['change-pwd']))
                    {
                        echo $_SESSION['change-pwd'];
                        unset($_SESSION['change-pwd']);
                    }

                ?>
                <br><br><br>

                <!-- Boton para agregar admin -->
                <a href="add-admin.php" class="btn-primary">Add Admin</a>

                <br /><br /><br />

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>

                    
                    <?php 
                        //Consulta para obtener todos los admin
                        $sql = "SELECT * FROM tbl_admin";
                        //Ejecutando la consulta
                        $res = mysqli_query($conn, $sql);

                        //Checkeando si la consulta esta ejecutada o no
                        if($res==TRUE)
                        {
                            // Contando las filas para checkear si tenemos datos en la base de datos o no
                            $count = mysqli_num_rows($res); // Funcion para obtner todas las filas de la base de datos

                            $sn=1; //Creando una variable y asignar el valor 1

                            //Checkeando el numero de filas
                            if($count>0)
                            {
                                //Tenemos datos en la base de datos
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    //Usando el loop while para obtener todos los datos de la base de datos
                                    //Y el loop while correra siempre y cuando tengamos datos en nuestra base de datos

                                    //Obteniendo los datos
                                    $id=$rows['id'];
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];

                                    //Mostrando los valores en la tabla
                                    ?>
                                    
                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                        </td>
                                    </tr>  
                                    <?php

                                }
                            }
                            else
                            {
                                //No tenemos datos
                            }
                        }

                    ?>                                                  
                </table>

            </div>
        </div>
        <!-- La seccion de contenido principal acaba aqui -->

<?php include('menu_footer/footer.php'); ?>