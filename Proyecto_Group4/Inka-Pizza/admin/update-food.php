<?php include('menu_footer/menu.php'); ?>

<?php 
    //Checkeando si el id esta establecido o no 
    if(isset($_GET['id']))
    {
        //Obteniendo todos los detalles
        $id = $_GET['id'];

        //Consulta SQL para obtener la comida seleccionada
        $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
        //Ejecutando la consulta
        $res2 = mysqli_query($conn, $sql2);

        //Obteniendo los valores basados en la consulta ejecutada
        $row2 = mysqli_fetch_assoc($res2);

        //Obteniendo los valores individuales de la comida seleccionada
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];

    }
    else
    {
        //Redireccionando a la pagina Manage Food
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
        
        <table class="tbl-30">

            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">
                </td>
            </tr>

            <tr>
                <td>Description: </td>
                <td>
                    <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                </td>
            </tr>

            <tr>
                <td>Price: </td>
                <td>
                    <input type="number" name="price" value="<?php echo $price; ?>">
                </td>
            </tr>

            <tr>
                <td>Current Image: </td>
                <td>
                    <?php 
                        if($current_image == "")
                        {
                            //Image not Available 
                            echo "<div class='error'>Image not Available.</div>";
                        }
                        else
                        {
                            //Image Available
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px">
                            <?php
                        }
                    ?>
                </td>
            </tr>

            <tr>
                <td>Select New Image: </td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Category: </td>
                <td>
                    <select name="category">

                        <?php 
                            //Consulta para obtener las categorias activas
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            //Ejecutando la consulta
                            $res = mysqli_query($conn, $sql);
                            //Contando las filas
                            $count = mysqli_num_rows($res);

                            //Checkeando si la categoria esta disponible o no
                            if($count>0)
                            {
                                //Categoria disponible
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];
                                    
                                    //echo "<option value='$category_id'>$category_title</option>";
                                    ?>
                                    <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                    <?php
                                }
                            }
                            else
                            {
                                //Categoria no disponible
                                echo "<option value='0'>Category Not Available.</option>";
                            }

                        ?>

                    </select>
                </td>
            </tr>

            <tr>
                <td>Featured: </td>
                <td>
                    <input <?php if($featured=="Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes 
                    <input <?php if($featured=="No") {echo "checked";} ?> type="radio" name="featured" value="No"> No 
                </td>
            </tr>

            <tr>
                <td>Active: </td>
                <td>
                    <input <?php if($active=="Yes") {echo "checked";} ?> type="radio" name="active" value="Yes"> Yes 
                    <input <?php if($active=="No") {echo "checked";} ?> type="radio" name="active" value="No"> No 
                </td>
            </tr>

            <tr>
                <td>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                    <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                </td>
            </tr>
        
        </table>
        
        </form>

        <?php 
        
            if(isset($_POST['submit']))
            {
                //echo "Button Clicked";

                //Obteniendo todos los detalles del formulario
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];

                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //Subiendo la imagen si esta seleccionada

                //Checkeando si el boton upload esta clickeado o no
                if(isset($_FILES['image']['name']))
                {
                    //Subiendo boton clickeado
                    $image_name = $_FILES['image']['name']; //Nuevo nombre de imagen

                    //Checkeando si el archivo esta disponible o no
                    if($image_name!="")
                    {
                        //Imagen esta disponible
                        //A. Subiendo la nueva imagen

                        //Renombrando la imagen
                        $ext = end(explode('.', $image_name)); //Obteniendo la extension de la imagen

                        $image_name = "Food-Name-".rand(0000, 9999).'.'.$ext; //Esto sera la imagen renombrada

                        //Obteniendo la ruta de origen y destino
                        $src_path = $_FILES['image']['tmp_name']; //Ruta de origen
                        $dest_path = "../images/food/".$image_name; //Ruta de destino

                        //Subiendo la imagen
                        $upload = move_uploaded_file($src_path, $dest_path);

                        // Checkeando si la imagen esta subida o no
                        if($upload==false)
                        {
                            //Fallo al subir
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload new Image.</div>";
                            //Redireccionando a la pagina Manage Food 
                            header('location:'.SITEURL.'admin/manage-food.php');
                            //Parar al proceso
                            die();
                        }
                        //Removiendo la imagen si la nueva imagen esta subida y la imagen actual existe
                        //Removiendo la imagen actual si esta disponible
                        if($current_image!="")
                        {
                            //Actual imagen esta disponible
                            //Removiendo la imagen
                            $remove_path = "../images/food/".$current_image;

                            $remove = unlink($remove_path);

                            //Checkeando si la imagen esta removido o no
                            if($remove==false)
                            {
                                //Fallo al remover la imagen actual
                                $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image.</div>";
                                //Redireccionando a la pagina manage food
                                header('location:'.SITEURL.'admin/manage-food.php');
                                //Parar el proceso
                                die();
                            }
                        }
                    }
                    else
                    {
                        $image_name = $current_image; //Imagen por defecto cuando la imagen no esta seleccionada
                    }
                }
                else
                {
                    $image_name = $current_image; //Imagen por defecto cuando el boton no esta clickeado
                }

                

                //Actualizando la comida en la base de datos
                $sql3 = "UPDATE tbl_food SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                ";

                //Ejecutando la consulta SQL
                $res3 = mysqli_query($conn, $sql3);

                //Checkeando si la consulta esta ejeutada o no 
                if($res3==true)
                {
                    //Consulta ejecutada y comida actualizada
                    $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    //Fallo al actualizar la comida
                    $_SESSION['update'] = "<div class='error'>Failed to Update Food.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

                
            }
        
        ?>

    </div>
</div>

<?php include('menu_footer/footer.php'); ?>