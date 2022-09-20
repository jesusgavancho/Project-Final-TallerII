<?php include('menu_footer/menu.php'); ?>

    <!-- La seccion de busqueda de comida empieza aqui-->
    <section class="food-search text-center">
        <div class="container">
            <?php 

                //Obtener las palabras clave de la busqueda
                // $search = $_POST['search'];
                $search = mysqli_real_escape_string($conn, $_POST['search']);
            
            ?>


            <h2>Foods on Your Search "<?php echo $search; ?>"</h2>
            <h3><a href="<?php echo SITEURL;?> " class="text-white"> Search again</a><h3>

        </div>
    </section>
    <!-- La seccion de busqueda de comida acaba aqui -->



    <!-- La seccion de Food Menu empieza aqui -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 

                //Consulta SQL para obtener las comidas basadas en las palabras claves de la busqueda
                //$search = pizza '; DROP database name;
                // "SELECT * FROM tbl_food WHERE title LIKE '%pizza%' OR description LIKE '%mozzarella%'";
                $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                //Ejecutando la consulta 
                $res = mysqli_query($conn, $sql);

                //Contando las filas
                $count = mysqli_num_rows($res);

                //Checkeando si la comida esta disponible o no
                if($count>0)
                {
                    //Comida disponible
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Obteniendo los detalles
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php 
                                    // Checkeando si la imagen esta disponible o no
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
                    echo "<div class='error'>Food not found.</div>";
                }
            
            ?>

            

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- La seccion de Food Menu acaba aqui -->

    <?php include('menu_footer/footer.php'); ?>