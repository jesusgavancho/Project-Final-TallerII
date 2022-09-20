<?php include('menu_footer/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>


        <?php 
        
            //Checkeando si el id esta establecido o no
            if(isset($_GET['id']))
            {
                //Obteniendo el id y todos los otros detalles 
                //echo "Getting the Data";
                $id = $_GET['id'];
                //Creando la consulta SQL para obtener todos los otros detalles
                $sql = "SELECT * FROM tbl_category WHERE id=$id";

                //Ejecutando la consulta
                $res = mysqli_query($conn, $sql);

                //Contando las filas para checkear el id si es valido o no
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Obteniendo todos los datos
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else
                {
                    //Redireccionando a la pagina manage category con un mensaje de sesion
                    $_SESSION['no-category-found'] = "<div class='error'>Category not Found.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }

            }
            else
            {
                //Redireccionando a la pagina manage category
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php 
                            if($current_image != "")
                            {
                                //Mostrando la imagen
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                                <?php
                            }
                            else
                            {
                                //Mostrando mensaje
                                echo "<div class='error'>Image Not Added.</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes 

                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes 

                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php 
        
            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                //Obteniendo todos los valores del formulario
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //Actualizando la nueva imagen si esta seleccionada
                //Checkeando si la imagen esta seleccionada o no
                if(isset($_FILES['image']['name']))
                {
                    //Obteniendo los detalles de la imagen
                    $image_name = $_FILES['image']['name'];

                    //Checkeando si la imagen esta disponible o no
                    if($image_name != "")
                    {
                        //Imagen disponible

                        //Subiendo la nueva imagen

                        //Renombrar la imagen
                        //Obteniendo la extension de la imagen (jpg, png, gif, etc) e.g. "pizza.jpg"
                        $ext = end(explode('.', $image_name));

                        //Renombrando la imagen
                        $image_name = "Food_Category_".rand(000, 999).'.'.$ext; // e.g. Food_Category_1.jpg
                        

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        //Finalmente subiendo la imagen
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Checkeando si la imagen esta subida o no
                        // Y si la imagen no esta subida entonces se parara el proceso y se redirecciona con el mensaje de error
                        if($upload==false)
                        {
                            //Estableciendo mensaje
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                            //Redireccionando a la pagina manage category
                            header('location:'.SITEURL.'admin/manage-category.php');
                            //Stopping the Process
                            die();
                        }

                        //Removiendo la imagen actual si esta disponible
                        if($current_image!="")
                        {
                            $remove_path = "../images/category/".$current_image;

                            $remove = unlink($remove_path);

                            //Checkeando si la imagen esta removida o no
                            //Si el proceso remover falla, mostrar mensaje y parar proceso
                            if($remove==false)
                            {
                                //Fallo al remover la imagen
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current Image.</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                die();//Parando proceso
                            }
                        }
                        

                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;
                }

                //Actualizando la base de datos
                $sql2 = "UPDATE tbl_category SET 
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active' 
                    WHERE id=$id
                ";

                //Ejecutando la consulta
                $res2 = mysqli_query($conn, $sql2);

                //Redireccionando a Manage Category con el mensaje
                //Checkeando si esta ejecutado o no
                if($res2==true)
                {
                    //Categoria actualizada
                    $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    //Fallo de la categoria actualizada
                    $_SESSION['update'] = "<div class='error'>Failed to Update Category.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }

            }
        
        ?>

    </div>
</div>

<?php include('menu_footer/footer.php'); ?>