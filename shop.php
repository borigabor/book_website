<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
}

if(isset($_POST['add_to_cart'])){
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $check_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if(mysqli_num_rows($check_cart_number) > 0){
        $message[] = 'product has already added!';
    }else{
        mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES
        ('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
        $message[] = 'product added sucesfully!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>shop</title>

    <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="css/style.css">

</head>
<body>
    <?php include 'header.php'; ?>
<!-- custom js file link  -->

<div class="heading">
    <h3>our shop</h3>
    <p><a href="home.php">home</a> / shop</p>
</div>

<section class="products">

<h1 class="title">latest products</h1>

<div class="box-container">

<?php
$select_product = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
if(mysqli_num_rows($select_product) > 0){
    while($fetch_product = mysqli_fetch_assoc($select_product)){
?>
<form action="" method="post" class="box">
    <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="" class="image">
    <div class="name"><?php echo $fetch_product['name']; ?></div>
    <div class="price"><?php echo $fetch_product['price']; ?></div>
    <input type="number" min="1" value="1" name="product_quantity" class="qty">
    <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
    <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
    <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
    <input type="submit" name="add_to_cart" class="btn" value="add to cart">
</form>
<?php
}
}else{
    echo '<p class="empty">no products added yet!</p>'; 
}
?>
</div>

</section>

<?php include 'footer.php'; ?>
<script src="js/script.js"></script>
</body>
</html>