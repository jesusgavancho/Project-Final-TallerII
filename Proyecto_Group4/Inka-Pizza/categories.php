<?php include('menu_footer/menu.php'); ?>



    <!-- La seccion de categorias empieza aqui -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 

                //Mostrar todas las categorias que estan activas
                //Consulta SQL
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                //Ejecutando la consulta
                $res = mysqli_query($conn, $sql);

                //Contando las filas
                $count = mysqli_num_rows($res);

                //Checkeando si las categorias disponibles o no
                if($count>0)
                {
                    //Categorias disponible
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Obteniendo los valores
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                        
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php 
                                    if($image_name=="")
                                    {
                                        //Imagen no disponible
                                        echo "<div class='error'>Image not found.</div>";
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
                    echo "<div class='error'>Category not found.</div>";
                }
            
            ?>
            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- La seccion de categorias acaba aqui -->


    <?php include('menu_footer/footer.php'); ?>