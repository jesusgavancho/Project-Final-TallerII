<?php include('menu_footer/menu.php'); ?>

    <!-- La seccion de busqueda de comida empieza aqui -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- La seccion de busqueda de comida acaba aqui -->



    <!-- La seccion de Food Menu empieza aqui -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
                //Mostrar las comidas que estan activas
                $sql = "SELECT * FROM tbl_food WHERE active='Yes'";

                //Ejecutando la consulta
                $res=mysqli_query($conn, $sql);

                //Contando las filas
                $count = mysqli_num_rows($res);

                //Checkeando si las comidas estan disponibles o no
                if($count>0)
                {
                    //Comidas disponibles
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Obteniendo los valores
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        ?>
                        
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php 
                                    //Checkeando si la imgagen esta disponible o no
                                    if($image_name=="")
                                    {
                                        //Imagen no disponible
                                        echo "<div class='error'>Image not Available.</div>";
                                    }
                                    else
                                    {
                                        //Imagen disponible
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
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