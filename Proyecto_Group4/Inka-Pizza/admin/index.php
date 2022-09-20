<?php include('menu_footer/menu.php'); ?>

        <!-- La seccion del contenido principal empieza aqui -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Dashboard</h1>
                <br><br>
                <?php 
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br><br>

                <div class="col-4 text-center">

                    <?php 
                        //Consulta SQL
                        $sql = "SELECT * FROM tbl_category";
                        //Ejecutando consulta
                        $res = mysqli_query($conn, $sql);
                        //Contando filas
                        $count = mysqli_num_rows($res);
                    ?>

                    <h1><?php echo $count; ?></h1>
                    <br />
                    Categories
                </div>

                <div class="col-4 text-center">

                    <?php 
                        //Consulta SQL 
                        $sql2 = "SELECT * FROM tbl_food";
                        //Ejecutando consulta
                        $res2 = mysqli_query($conn, $sql2);
                        //Contando filas
                        $count2 = mysqli_num_rows($res2);
                    ?>

                    <h1><?php echo $count2; ?></h1>
                    <br />
                    Foods
                </div>

                <div class="col-4 text-center">
                    
                    <?php 
                        //Consulta SQL
                        $sql3 = "SELECT * FROM tbl_order";
                        //Ejecutando consulta
                        $res3 = mysqli_query($conn, $sql3);
                        //Contando las filas
                        $count3 = mysqli_num_rows($res3);
                    ?>

                    <h1><?php echo $count3; ?></h1>
                    <br />
                    Total Orders
                </div>

                <div class="col-4 text-center">
                    
                    <?php 
                        //Creando consulta SQL para obtner el Total Revenue (Ingresos) generados
                        //Agregando la funcion en SQL
                        $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";

                        //Ejecutando la consulta
                        $res4 = mysqli_query($conn, $sql4);

                        //Obtener los datos
                        $row4 = mysqli_fetch_assoc($res4);
                        
                        //Obtener el Total Revenue(ingresos)
                        $total_revenue = $row4['Total'];

                    ?>

                    <h1>S/.<?php echo $total_revenue; ?></h1>
                    <br />
                    Revenue Generated
                </div>

                <div class="clearfix"></div>

            </div>
        </div>
        <!-- La seccion del contenido principal acaba aqui -->

<?php include('menu_footer/footer.php') ?>