 <?php include('menu_footer/menu.php'); ?>

    <?php 
        //Checkeando si el id esta aprobado o no
        if(isset($_GET['category_id']))
        {
            //El id de la categoria esta establecida y obtener el id
            $category_id = $_GET['category_id'];
            //Obtener el titulo de la categoria basada en el id de la categoria
            $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

            //Ejecutando la consulta
            $res = mysqli_query($conn, $sql);

            //Obteniendo el valor de la base de datos
            $row = mysqli_fetch_assoc($res);
            //Obtener el titulo
            $category_title = $row['title'];
        }
        else
        {
            //Categoria no aprobada
            //Redireccionando a la pagina Home
            header('location:'.SITEURL);
        }
    ?>


    <!-- La secion de la busqueda de comida empieza aqui -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- La seccion de la busqueda de comida acaba aqui -->



    <!-- La seccion de Food Menu empieza aqui -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            
                //Creando la consulta SQL para obtener las comidas basadas en la categoria seleccionada
                $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";

                //Ejecutando la consulta
                $res2 = mysqli_query($conn, $sql2);

                //Contando las filas
                $count2 = mysqli_num_rows($res2);

                //Checkeando si la comida esta disponible o no
                if($count2>0)
                {
                    //Comida disponible
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        ?>
                        
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php 
                                    if($image_name=="")
                                    {
                                        //Imagen no disponible
                                        echo "<div class='error'>Image not Available.</div>";
                                    }
                                    else
                                    {
                                        //Imagen disponible
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt=" Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">S/.<?php echo $price; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                        <?php
                    }
                }
                else
                {
                    //Comida no disponible
                    echo "<div class='error'>Food not Available.</div>";
                }
            
            ?>

            

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- La seccion de Food Menu acaba aqui -->

    <?php include('menu_footer/footer.php'); ?>