<?php 
    include('../connect_sql/connectbd.php');

    //echo "Delete Page";
    //Checkeando si el id el nombre de imagen esta puesta o no 
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Obteniendo los valores y borrarlos
        //echo "Get Value and Delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Removiendo el archivo de la imagen disponible
        if($image_name != "")
        {
            //Imagen esta disponible asi que removerlo
            $path = "../images/category/".$image_name;
            //Removiendo la imagen
            $remove = unlink($path);

            //Si hay fallo al remover la imagen entonces agregar un mensaje de error y parar el proceso
            if($remove==false)
            {
                //Estableciendo el mensaje de sesion
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image.</div>";
                //Redireccionando a la pagina Manage Category 
                header('location:'.SITEURL.'admin/manage-category.php');
                //Deteniendo el proceso
                die();
            }
        }

        //Borrando los datos de la base de datos
        //Consulta SQL para borrar los datos de la base de datos
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //Ejecutando la consulta
        $res = mysqli_query($conn, $sql);

        //Checkeando si los datos esta borrado de la base datos o no
        if($res==true)
        {
            //Estableciendo el mensaje de exito y redireccionar
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
            //Redireccionando a la pagina Manage Category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //Estableciendo el mensaje de fallo y redireccionar
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";
            //Redireccionando a la pagina Manage Category
            header('location:'.SITEURL.'admin/manage-category.php');
        }

 

    }
    else
    {
        //Redireccionando a la pagina Manage Category 
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>