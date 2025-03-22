<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <style>
      .hero{
         background-color: blanchedalmond;
         border-radius: 3rem;

      }
.hero{
   background-color: rgb(205, 215, 230);
}
body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

.hero {
    position: relative;
    width: 100%;
    height: auto;
    overflow: hidden;
}

.hero-slider {
    width: 100%;
    height: 100%;
}

.swiper-wrapper {
    display: flex;
}

.swiper-slide {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 5%;
    box-sizing: border-box;
    background: #f5f5f5;
}

.content {
    max-width: 50%;
}

.content h5 {
    font-size: 2rem;
    color: #ff6f61;
}

.content span {
    font-size: 1.2rem;
    color: #333;
}

.content h3 {
    font-size: 3rem;
    margin: 10px 0;
}

.content .btn {
    display: inline-block;
    padding: 10px 20px;
    margin-top: 20px;
    background: #ff6f61;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background 0.3s;
}

.content .btn:hover {
    background: #e55b50;
}

.image img {
    max-width: 100%;
    height: auto;
}

.swiper-pagination-bullet {
    background: #ff6f61;
}

.swiper-button-next, .swiper-button-prev {
    color: #ff6f61;
}
.original-pric {
      text-decoration: line-through;
      color: red;
      margin-right: 10px;
   }
   .discounted-pric {
      color: green;
      font-weight: bold;
   }


   </style>




   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>



<section class="hero">

   <div class="swiper hero-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide">
            <div class="content">
               <h5>20% OFF</h5><br> 
               <h5>order online</h5>
              
               <h3>Sri Lanka </h3><br>
               <h5>Roti</h5>
               <!-- <span>Roti</span><br><br><br><br><br><br> -->
               <a href="menu.php" class="btn">see menu</a>
            </div>
            <div class="image">
               <img src="images/ss3.png" alt="">
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="content">
            <h5>20% OFF</h5><br>
           
             <h5>order online<h5>
               <h3>Italian Foods</h3><br>
               <h5>Pizza</h5>
               <a href="menu.php" class="btn">see menu</a>
            </div>
            <div class="image">
               <img src="images/ss2.png" alt="">
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="content">
            <h5>20% OFF</h5><br>
               <h5>order online</h5>
               <h3>Chines Foods</h3><br>
               <h5>Spaggetti</h5>
               <a href="menu.php" class="btn">see menu</a>
            </div>
            <div class="image">
               <img src="images/ss1.png" alt="">
            </div>
         </div>

         <!-- <div class="swiper-slide slide">
            <div class="content">
            <h5>20% OFF</h5><br>
               <h5>order online</h5>
               <h3>Japanees Foods</h3><br>
               <h5>Shushi</h5><br><br><br><br><br><br>
               <a href="menu.php" class="btn">see menu</a>

            </div> -->
            <div class="image">
               <img src="images/japanes.png" alt="">
               
            </div>
         </div>

      </div>
      

      <div class="swiper-pagination"></div>

   </div>

</section>

<section class="category">

   <h1 class="title">food category</h1><br><br>

   <div class="box-container">

      <a href="category.php?category=Sri lanka Foods" class="box">
         <img src="images/srifood.png" alt="">
         <h3>Sri Lanka Foods</h3>
      </a>

      <a href="category.php?category=Italian Foods" class="box">
         <img src="images/itafood.png" alt="">
         <h3>Italian Foods</h3>
      </a>

      <a href="category.php?category=Chines Foods" class="box">
         <img src="images/chifood.png" alt="">
         <h3>Chines Foods</h3>
      </a>

      <!-- <a href="category.php?category=desserts" class="box">
         <img src="images/japanese.png" alt="">
         <h3>Japanese Foods</h3>
      </a> -->

   </div>

</section>





<section class="products">

   <h1 class="title">latest dishes</h1><br>

   <div class="box-container">

      <?php
         $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
               $discounted_price = $fetch_products['price'] * 0.8;
      ?>
      <form action="" method="post" class="box">
         <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
         <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
         <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
         <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
         <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
         <div class="name"><?= $fetch_products['name']; ?></div>
         <div class="flex">
            <div class="price">
               <span class="original-pric">Rs.<?= $fetch_products['price']; ?></span>
               <span class="discounted-pric">Rs.<?= number_format($discounted_price, 2); ?></span>

            </div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
         </div>
      </form>
      <?php
            }
         }else{
            echo '<p class="empty">no products added yet!</p>';
         }
      ?>

   </div>

   <div class="more-btn">
      <a href="menu.php" class="btn">View All</a>
   </div>

</section>


















<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".hero-slider", {
   loop:true,
   grabCursor: true,
   effect: "flip",
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },

      autoplay:{
                delay: 3000, // 3 seconds delay between slides
                disableOnInteraction: false,
            },

            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
});

</script>

</body>
</html>


