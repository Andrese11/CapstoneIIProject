<?php
    session_start();

    if (isset($_SESSION['userID'])) {
        $userID = $_SESSION['userID'];
    } else {
        $userID = null; // or handle it as needed
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
                <img src="../Cherry Clothing Designs/Shirts/CherryPlotionShirt/women_cherryplotion_shirt_front.jpg.jpg" id="Big">
                <img src="../Cherry Clothing Designs/Shirts/CherryPlotionShirt/women_cherryplotion_shirt_back.jpg.jpg" id="Small">
            </div>
            <div class="info">
                <form action = "PHPForms/addToCart.php" method="POST">
                <h2><strong>Cherryplotion Shirt for Women</strong></h2>
                <p>Vibrant and bold, this shirt features a splash of dynamic colors, ideal for making a statement.<br></p>
                <h4>Select your size:</h4>
                <select class="sortItems" name="types">
                    <option value="Size">Small</option>
                    <option value="Size">Medium</option>
                    <option value="Size">Large</option>
                </select>
                <h4>Select a color:</h4>
                <select class="sortItems" name="types">
                    <option value="Color">Red</option>
                    <option value="Color">Black</option>
                    <option value="Color">White</option>
                    <option value="Color">Green</option>
                </select>
                <h4>Enter quantity:</h4>
                    <input type="text" id="qty" name="qty" style="width: 150px; height: 35px; border: 1px solid red; font-size: 18px;">

                    <button class = "addtoCart">Add to Cart</button>
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