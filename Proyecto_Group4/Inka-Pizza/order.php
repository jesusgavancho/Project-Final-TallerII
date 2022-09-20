<?php include('menu_footer/menu.php'); ?>

    <?php 
        //Checkeando si el id de la comida esta establecido  o no 
        if(isset($_GET['food_id']))
        {
            //Obtener el id de la comida y detalles de la comida seleccionada
            $food_id = $_GET['food_id'];

            //Obtener los detalles de la comida seleccionada 
            $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
            //Ejecutar la consulta
            $res = mysqli_query($conn, $sql);
            //Contando las filas
            $count = mysqli_num_rows($res);
            //Checkeando si los datos estan disponibles o no
            if($count==1)
            {
                
                //Obtener los datos de la base de datos
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            }
            else
            {
                //Comida no disponible
                //Redireccionando a la Pagina Home
                header('location:'.SITEURL);
            }
        }
        else
        {
            //Redireccionando a la Pagina Home
            header('location:'.SITEURL);
        }
    ?>

    <!-- La seccion de busqueda de comida empieza aqui-->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Rellena este formulario para confirmar tu orden.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php 
                        
                            //Checkeando si la imagen esta disponible o no
                            if($image_name=="")
                            {
                                //Imagen no esta disponible
                                echo "<div class='error'>Image not Available.</div>";
                            }
                            else
                            {
                                //Imagen esta disponible
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt=" Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price">S/.<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Jesus Gavancho" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 956xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. name@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Calle, Ciudad, Pais" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php 

                //Checkeando si el boton de submit esta clickeado o no
                if(isset($_POST['submit']))
                {
                    // Obtener todos los detalles del fromulario
                    
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];

                    $total = $price * $qty; // total = price x qty 

                    $order_date = date("Y-m-d H:i:s"); //Order Date

                    $status = "Ordered";  // Ordered, On Delivery, Delivered, Cancelled

                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];


                    //Guardando la orden en la base de datos
                    //Creando SQL para guardar los datos
                    $sql2 = "INSERT INTO tbl_order SET 
                        food = '$food',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                    ";

                    //echo $sql2; die();

                    //Ejecutando la consulta
                    $res2 = mysqli_query($conn, $sql2);

                    //Checkeando si la consulta ha sido ejecutada satisfactoriamente o no
                    if($res2==true)
                    {
                        //Consulta ejecutada y orden guardada
                        $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        //Fallo al guardar la orden
                        $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food.</div>";
                        header('location:'.SITEURL);
                    }

                }
            
            ?>

        </div>
    </section>
    <!-- La seccion de busqueda de comida acaba aqui-->

    <?php include('menu_footer/footer.php'); ?>