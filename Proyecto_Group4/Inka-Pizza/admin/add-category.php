<?php include('menu_footer/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?php 
        
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        
        ?>

        <br><br>

        <!-- Formulario Add Category empieza aqui -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
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
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
        <!-- Formulario Add Category acaba aqui -->

        <?php 
        
            //Checkeando si el boton submit esta clickeado o no
            if(isset($_POST['submit']))
            {
                //echo "Clicked";

                //Obteniendo los valores del formulario category
                $title = $_POST['title'];

                //Para el input radio, checkeando si el boton esta seleccionado o no
                if(isset($_POST['featured']))
                {
                    //Obteniendo los valores del formulario
                    $featured = $_POST['featured'];
                }
                else
                {
                    //Estableciendo los valores por defecto
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }

                //Checkeando si la imagen esta seleccionada o no y establecer los valores del nombre de imagen
                //print_r($_FILES['image']);

                //die();//Romper el codigo aqui

                if(isset($_FILES['image']['name']))
                {
                    //Subiendo la imagen
                    //Para subir la imagen, es necesario un nombre, ruta y destino de origen de la imagen
                    $image_name = $_FILES['image']['name'];
                    
                    // Subiendo la imagen solo la imagen esta seleccionada
                    if($image_name != "")
                    {

                        //Renombrar la imagen
                        //Obteniendo la extension de la imagen (jpg, png, gif, etc) e.g. " pizza.jpg"
                        $ext = end(explode('.', $image_name));

                        //Renombrar la imagen
                        $image_name = "Food_Category_".rand(000, 999).'.'.$ext; // e.g. Food_Category_1.jpg
                        

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        //Finalmente subir la imagen
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Checkendo si la imagen esta subida o no
                        //Y si la imagen no esta subida entonces se detendra el proceso y se redireccionara el mensaje de error
                        if($upload==false)
                        {
                            //Estableciendo mensaje
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                            //Redireccionando a la pagina Add Category 
                            header('location:'.SITEURL.'admin/add-category.php');
                            //Stopping the Process
                            die();
                        }

                    }
                }
                else
                {
                    //No subir la imagen y poner el valor del nombre de imagen como blanco
                    $image_name="";
                }

                //Creando la consulta SQL Query para insertar categoria en la base de datos
                $sql = "INSERT INTO tbl_category SET 
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                ";

                //Ejecutando la consulta y guardar en la base de datos
                $res = mysqli_query($conn, $sql);

                //Checkeando si la consulta esta ejecutada o no y los datos agregados o no
                if($res==true)
                {
                    //Consulta ejecutada y categoria ejecutada
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                    //Redireccionando a la pagina Manage Category
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    //Fallo al agregar categoria
                    $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
                    //Redireccionando a la pagina Manage Category 
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }
        
        ?>

    </div>
</div>

<?php include('menu_footer/footer.php'); ?>