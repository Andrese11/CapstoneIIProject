<?php
    session_start();

    if (isset($_SESSION['userID'])) {
        $userID = $_SESSION['userID'];
    } else {
        $userID = null; // or handle it as needed
    }

    if (isset($_SESSION['cartID'])) {
        $cartID = $_SESSION['cartID'];
    } else {
        $cartID = 0;
    }
?><!DOCTYPE html>
<html>
    <head>
        <title>
            Cherry Clothing
        </title>
        <link rel="stylesheet" href="../designProducts.css">
    </head>
    <body>
        <nav>
            <a href="../main.php" class="logo"><img src="../NO_BACKGROUND.png" alt="Company Logo"></a>
            <ul class="nav-list">
                <li><a href="../main.php">Home</a></li>
                <li><a href="../catalog.php">Products</a></li>
                <li><a href="../contactUs.php">Contact Us</a></li>
                <li><a href="../cart.php">Cart</a></li>
                <li><a href="../signin.php">My Profile</a></li>
            </ul>
        </nav>                       

        <section class="product">
            <div class="images">
                <img src="../Cherry Clothing Designs/Hoodies/CherryPlotionHoodie/men_cherryplotion_hoodie_front.jpg.jpg" id="Big">
                <img src="../Cherry Clothing Designs/Hoodies/CherryPlotionHoodie/men_cherryplotion_hoodie_back.jpg.jpg" id="Small">
            </div>
            <div class="info">
                <form action = "../PHPForms/addToCart.php" method="POST">
                <h2><strong>Cherryplotion Hoodie for Men</strong></h2>
                <p>Featuring vibrant splashes of color, this hoodie is perfect for those who love bold, eye-catching designs.<br></p>
                <h4>Select your size:</h4>
                <select class="sortItems" name="size">
                        <option value="1" name="small">Small</option>
                        <option value="2" name="medium">Medium</option>
                        <option value="3" name="large">Large</option>
                    </select>
                    <h4>Select a color:</h4>
                    <select class="sortItems" name="color">
                        <option value="1" name="red">Red</option>
                        <option value="2" name="black">Black</option>
                        <option value="3" name="white">White</option>
                        <option value="4" name="green">Green</option>
                    </select>
                    <h4>Enter quantity:</h4>
                    <input type="text" id="qty" name="qty" style="width: 150px; height: 35px; border: 1px solid red; font-size: 18px;">

                    <input type="hidden" name="product_code" value="10-1">

                    <button class = "addtoCart" name="addToCart" >Add to Cart</button>
                </form>
            </div>
        </section>

        <footer class="footer">
            <div class ="footLeft">
                <img src = "../NO_BACKGROUND.png"/>
                <p>Cherry Clothing is a website made for a senior project with no intention for commercial use.</p>
            </div>
            <div class ="footRight">
                <ul>
                    <li><h2><u>Directory</u></h2></li>
                    <li><a href="../main.php">Home</a></li>
                    <li><a href="../catalog.php">Products</a></li>
                    <li><a href="../contactUs.php">Contact Us</a></li>
                    <li><a href="../cart.php">Cart</a></li>
                    <li><a href="../signin.php">My Profile</a></li>
                </ul>
            </div>
        </footer>
        <script src="productScript.js"></script>
    </body>
</html>