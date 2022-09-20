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
    <?php 
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>

    <!-- La seccion de categorias empieza aqui -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
                //Creacion de la consulta SQL para mostrar las categorias de la base de datos
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
                //Ejecutando la consulta
                $res = mysqli_query($conn, $sql);
                //Contando las filas para checkear si la categoria esta disponible o no
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    //Categorias disponibles
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Obtener los valores como id, title, image_name
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                        
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php 
                                    //Checkeando si la imagen esta disponible o no
                                    if($image_name=="")
                                    {
                                        //Mostrar mensaje
                                        echo "<div class='error'>Image not Available</div>";
                                    }
                                    else
                                    {
                                        //Imagen disponible
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                

                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>

                        <?php
                    }
                }
                else
                {
                    //Categorias no disponibles
                    echo "<div class='error'>Category not Added.</div>";
                }
            ?>
             <div class="clearfix"></div>
        </div>
    </section>
    <!-- La seccion de categorias empieza aqui -->



    <!-- La seccion de Food Menu empieza aqui -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            
            //Obteniendo las comidas de la base de datos que estan activos y destacados
            //Consulta SQL
            $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

            //Ejecutando la consulta
            $res2 = mysqli_query($conn, $sql2);

            //Contando las filas
            $count2 = mysqli_num_rows($res2);

            //Checkeando si la comida esta disponible o no
            if($count2>0)
            {
                //Comida disponible
                while($row=mysqli_fetch_assoc($res2))
                {
                    //Obtener todos los valores
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>

                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                                //Checkeando si la imagen esta disponible o no
                                if($image_name=="")
                                {
                                    //Imagen no disponible
                                    echo "<div class='error'>Image not available.</div>";
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
                echo "<div class='error'>Food not available.</div>";
            }
            
            ?>

            <div class="clearfix"></div>

            </div>

        <p class="text-center">
            <a href="<?php echo SITEURL; ?>foods.php">See All Foods</a>
        </p>
    </section>
    <!-- La seccion de Food Menu acaba aqui -->

    
    <?php include('menu_footer/footer.php'); ?>