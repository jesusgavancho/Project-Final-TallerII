<?php    
    include('../connect_sql/connectbd.php');

    // Obteniendo el id del admin y borrarlo
    $id = $_GET['id'];

    //Creando la consulta SQL y borrar el admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Ejecutando la consulta
    $res = mysqli_query($conn, $sql);

    // Checkeando si la consulta ejecutada esta exitosamente o no
    if($res==true)
    {
        //Consulta ejecutada exitosamente y admin borrado
        //echo "Admin Deleted";
        //Creando la variable de sesion y mostrar el mensaje
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
        //Redireccionando a la pagina Manage Admin 
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //Fallo al borrar admin
        //echo "Failed to Delete Admin";

        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try Again Later.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

   

?>