<?php
@include 'db_connection.php';

if(isset($_POST['add_to_cart'])){

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;

    $select_cart = mysqli_query($connection, "SELECT * FROM `cart` WHERE name = '$product_name'");

    if(mysqli_num_rows($select_cart) > 0){
        $message[] = 'product already added to cart';
    }else{
        $insert_product = mysqli_query($connection, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
        $message[] = 'product added to cart successfully';
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>products</title>
    <script src="assets/bootstrap/js/bootstrap.js"></script>
    <script src="assets/bootstrap/js/jquery-3.4.0.js"></script>
    <script src="assets/bootstrap/js/popper.min.js"></script>
    <link rel="stylesheet" href="assets/bootstrap/css/custom.css">


</head>
<body>

<?php

if(isset($message)){
    foreach($message as $message){
        echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
    };
};

?>

<?php include 'header.php'; ?>

<div class="container">

    <section class="products">

        <h1 class="heading">latest products</h1>

        <div class="box-container">

            <?php

            $select_products = mysqli_query($connection, "SELECT * FROM `products`");
            if(mysqli_num_rows($select_products) > 0){
                while($fetch_product = mysqli_fetch_assoc($select_products)){
                    ?>

                    <form action="" method="post">
                        <div class="box">
                            <img src="uploaded image/<?php echo $fetch_product['image']; ?>" alt="">
                            <h3><?php echo $fetch_product['name']; ?></h3>
                            <div class="price">$<?php echo $fetch_product['price']; ?>/-</div>
                            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                            <input type="submit" class="btn" value="add to cart" name="add_to_cart">
                        </div>
                    </form>

                    <?php
                };
            };
            ?>

        </div>

    </section>

</div>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
