<?php include('menu_footer/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
        
            <table class="tbl-30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the Food."></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php 
                                //Creando code php para mostrar las categorias de la base de datos
                                //Creando SQL para obtener todas las categorias activas de la base de datos
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                
                                //Ejecutando la consulta
                                $res = mysqli_query($conn, $sql);

                                //Contando las filas para checkear si hay categorias o no
                                $count = mysqli_num_rows($res);

                                //Si el contador es mayor que 0 , hay categorias sino no hay
                                if($count>0)
                                {
                                    //Hay categorias
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //Obteniendo los detalles de las categorias
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                    //No hay categorias
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }                            

                                
                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes 
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes 
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        
        <?php 

            //Checkeando si el boton esta clickeado o no
            if(isset($_POST['submit']))
            {
                //Agregando las comidas en la base de datos
                //echo "Clicked";
                
                //Obteniendo los datos del formulario
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                //Checkeando si el boton de radio esta destacado y activo estan checkeados o no
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No"; //Estableciendo los valores por defecto
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No"; //Estableciendo los valores por defecto
                }

                //Subiendo la imagen si esta seleccionada
                //Checkeando si la imagen seleccionada esta clickeada o no y subir la imagen solo si la imagen esta seleccionada
                if(isset($_FILES['image']['name']))
                {
                    //Obteniendo los detalles de la imagen seleccionada
                    $image_name = $_FILES['image']['name'];

                    //Checkeando si la imagen esta seleccionada o no y subir la imagen si esta seleccionada
                    if($image_name!="")
                    {
                        // Imagen seleccionada
                        //Renombrar la imagen
                        //Obteniendo la extension de la imagen seleccionada (jpg, png, gif, etc.) "pizza.jpg" 
                        $ext = end(explode('.', $image_name));

                        //Creando el nuevo nombre de la imagen
                        $image_name = "Food-Name-".rand(0000,9999).".".$ext; //Nueva imagen puede ser "Food-Name-1.jpg"

                        //Subiendo la imagen
                        //Obteniendo la ruta de origen y destino del archivo

                        //Ruta de origen es la ubicacion actual de la imagen
                        $src = $_FILES['image']['tmp_name'];

                        //Ruta de destino para la imagen esta subida
                        $dst = "../images/food/".$image_name;

                        //Finalmente imagen subida
                        $upload = move_uploaded_file($src, $dst);

                        //Checkeando si la imagen esta subida o no
                        if($upload==false)
                        {
                            //Fallo al subir de la imagen
                            //Redireccionando a la pagina Add Food Page con el mensaje de error
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            header('location:'.SITEURL.'admin/add-food.php');
                            //Deteniendo el proceso
                            die();
                        }

                    }

                }
                else
                {
                    $image_name = ""; //Estableciendo los valores por defecto en blanco
                }

                //Insertando en la base de datos

                //Creando una consulta SQL para guardar y agregar la comida
                // Para los numeros no se necesita pasar los valores por '' pero los valores string si es necesario
                $sql2 = "INSERT INTO tbl_food SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

                //Ejecutando la consulta
                $res2 = mysqli_query($conn, $sql2);

                //Checkeando si hay datos insertados o no
                //Redireccionando con el mensaje para la pagina manage food 
                if($res2 == true)
                {
                    //Datos insertados exitosamente
                    $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    //Fallo al insertar los datos
                    $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

                
            }

        ?>


    </div>
</div>

<?php include('menu_footer/footer.php'); ?>