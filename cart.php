<?php
session_start();
require_once "connection.php";
require_once "functions.php";
check_login($con);

$user_id = $_SESSION['active']['id'];
$sql = "SELECT * FROM cart WHERE user_id = $user_id";
$all_cart = $con->query($sql)

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible"content="IE-edge">
    <meta name="viewport" content="width-device-width,initial-scale=1.0">
    <link rel="stylesheet" href="font/css/all.min.css">
    <link rel='shortcut icon' type='image/x-icon' href='/favicon.ico' />
    <link rel="icon" href="assets/images/ncpb.png">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600%7cPlayfair+Display:400i" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="./assets/styles/plugins.min.css" rel="stylesheet">
    <link href="./assets/styles/template.css" rel="stylesheet">
    <title>My Cart</title>
</head>
<style>
    *{
  padding: 0;
  margin: 0;
  box-sizing: border-box;
  font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
  color:black
}
html{
  font-size: 62.5%;
}
body {
  font-family: Arial, sans-serif;
  font-size: 16px;
  line-height: 1.5;
  margin: 0;
}

/* Header styles */
header {
  background-color: #333;
  color: #fff;
  padding: 20px;
}

h1 {
  margin: 0;
  font-size: 2em;
  font-weight: bold;
}

nav ul {
  list-style: none;
  margin: 0;
  padding: 0;
  display: flex;
}

nav li {
  margin-right: 50px;
}

nav a {
  color: #fff;
  text-decoration: none;
}

nav a:hover {
  text-decoration: underline;
}
main {
  max-width: 1500px;
  margin: 30px auto;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  margin: auto;
}
main .card{
  max-width: 250px;
  flex: 1 1 210px;
  text-align: center;
  height: 400px;
  color:aqua;
  border: 2px solid lightgray;
  margin: 20px;
  opacity: 0.8;

}
main .card .image{
  height: 150px;
  margin-bottom: 20px;
}
main .card .image img{
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.main .card a{
  width: 50%;  
}
main .card button{
  border:2px solid black;
  padding: 1em;
  width: 80%;
  cursor: pointer;
  margin-top: 1em;
  margin-left:25px ;
  font-weight: bold;
  position: relative;
}
main .card button:hover{
 color: green;
}
main .card button::before{
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  bottom:0;
  width: 0;
  background-color: black;
  transition: all 5s;
  margin: 0;
}
main .card button::after{
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  bottom:0;
  width: 0;
  background-color: black;
  transition: all 5s;
  margin: 0;
}#slideshow {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: -1;
}
#slideshow {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: -1;
}

.slide {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-size: cover;
  background-position: center;
  opacity: 0;
  transition: opacity 1s ease-in-out;
}

.slide.active {
  opacity: 1;
}

</style>
<body>
<header style="background-color: green";>
    <nav class="navbar" >

  <a href="./dashboard.php" class="navbar-brand">NCPB sales Portal </a>
  <ul class="navbar-nav ml-auto d-flex flex-row">
    <li class="nav-item">
      <a href="#" class="nav-link"><i class="fas fa-bell"></i> Notifications</a>      
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link"><i class="fas fa-shopping-cart"></i> Cart</a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link"><i class="fas fa-user-circle"></i> Account</a>
    </li>
  </ul>
</nav>
    </header>
    <main>
        <h1><?php echo mysqli_num_rows($all_cart);?> items</h1>
        <BR>
        <?php
      while($row_cart = mysqli_fetch_assoc($all_cart)){
        $sql = "SELECT * FROM products WHERE product_id=".$row_cart["product_id"];
        $all_products = $con->query($sql);
        while($row = mysqli_fetch_assoc($all_products)){
      ?>
        <div class="card">
        <div class = "image">
            <img src="./uploads/<?php echo $row["image"]?>" alt="<?php echo $row["product_name"]?> image">
        </div>
        <div class="caption">
          <p class="product_name"><?php echo $row["product_name"]?></p>
          <p class="product_type"><?php echo $row["product_type"]?></p>
          <p class="product_quantity"><?php echo $row["quantity"]?> kilogram</p>
          <p class="price">ksh<?php echo $row["price"]?></p>
      </div>
      <button class="remove" data-id="<?php echo $row["product_id"]?>">Remove From cart</button>
      </div>
      <?php
      }
    }
      ?>
    </main>
    <div id="slideshow">
  <div class="slide"><img src="./assets/images/beans.jpg" alt=""></div>

  <div class="slide"><img src="./assets/images/maize.jpg" alt=""></div>

  <div class="slide"><img src="./assets/images/green grams.jpg" alt=""></div>

  <div class="slide"><img src="./assets/images/peas.jpg" alt=""></div>

  <div class="slide"><img src="./assets/images/wheat.jpg" alt=""></div>

  <div class="slide"><img src="./assets/images/rice.jpg" alt=""></div>

    </div>
    <script>
        var remove =document.getElementsByClassName("remove");
        for(var i =0;i<remove.length;i++){
            remove[i].addEventListener("click",function(event){
                var target =event.target;
                var cart_id = target.getAttribute("data-id");
                var xml = new XMLHttpRequest();
                xml.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        target.innerHTML = this.responseText;
                        target.style.opacity = .3;
                    }
                }
                xml.open("GET","connection.php?cart_id="+cart_id,true  )
                xml.send();
            })
        }

    const slides = document.querySelectorAll('.slide');
const slideshow = document.getElementById('slideshow');
let currentSlide = 0;

function showSlide() {
  slides[currentSlide].classList.add('active');
  setTimeout(() => {
    slides[currentSlide].classList.remove('active');
    currentSlide = (currentSlide + 1) % slides.length;
    showSlide();
  }, 5000);
}
showSlide();
</script>
</body>
</html>