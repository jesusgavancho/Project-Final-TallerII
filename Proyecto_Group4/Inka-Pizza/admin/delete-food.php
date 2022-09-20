<?php 
    include('../connect_sql/connectbd.php');

    //echo "Delete Food Page";

    if(isset($_GET['id']) && isset($_GET['image_name'])) // '&&' o 'AND'
    {
        //Procesando la eliminacion
        //echo "Process to Delete";

        //Obteniendo el id y el nombre de la imagen
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Removiendo la imagen si esta disponible
        //Checkeando si la imagen esta disponible o no y borrarlo si esta disponible
        if($image_name != "")
        {
            // Si la imagen necesita removerse de la carpeta
            //Obteniendo el destino de la imagen
            $path = "../images/food/".$image_name;

            //Removiendo el archivo de imagen de la carpeta 
            $remove = unlink($path);

            //Checkeando si la imagen esta removido o no
            if($remove==false)
            {
                //Fallo al remover la imagen
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
                //Redireccionando a la pagina Manage Food
                header('location:'.SITEURL.'admin/manage-food.php');
                //Parando el proceso 
                die();
            }

        }

        //Borrando la comida de la base de datos
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        //Ejecutando la consulta
        $res = mysqli_query($conn, $sql);

        //Checkeando si la consulta esta ejecutada o no y mostrar el mensaje de la sesion respectivamente
        //Redireccionando a Manage Food 
        if($res==true)
        {
            //Comida eliminada
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            //Fallo al eliminar la comida
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }

        

    }
    else
    {
        //Redireccionando a la pagina Manage Food
        //echo "Redirect";
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>