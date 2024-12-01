<?php
    session_start();

    if (isset($_SESSION['userID'])) {
        $userID = $_SESSION['userID'];
    } else {
        $userID = null; // or handle it as needed
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
        <title>
            Cherry Clothing
        </title>
        <link rel="stylesheet" href="designMain.css">
    </head>
    <body>
        <nav>
            <a href="main.php" class="logo"><img src="NO_BACKGROUND.png" alt="Company Logo"></a>
            <ul class="nav-list">
                <li><a href="main.php">Home</a></li>
                <li><a href="catalog.php">Products</a></li>
                <li><a href="contactUs.php">Contact Us</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="signin.php">My Profile</a></li>
            </ul>
        </nav>                          
        <div class ="products-mainPage">
            <img src ="Images/main1.jpg" id="mainProduct"> 
            <img src ="Images/main2.jpg" id="mainProduct">
        </div>
        <div class="productNav">
            <div class="background"></div>
            <a href="catalog.php"><button>Browse our catalog of products!</button></a>
        </div> 
        <div class="advertising">
            <div class="advertising1">
                <button onclick="window.location.href='catalog.php'"><u>The Best Prices Around!</u></button>
                <button onclick="window.location.href='catalog.php'"><u>The Best Prices Around!</u></button>
            </div>
            <div class="advertising2">
                <button onclick="window.location.href='cart.php'"><u>Check Out Your Shopping Cart!</u></button>
                <button onclick="window.location.href='cart.php'"><u>Check Out Your Shopping Cart!</u></button>
            </div>
            <div class="advertising3">
                <button onclick="window.location.href='signin.php'"><u>Visit your Profile!</u></button>
                <button onclick="window.location.href='signin.php'"><u>Visit your Profile!</u></button>
            </div>
        </div>
        
        <footer class="footer">
            <div class ="footLeft">
                <img src = "NO_BACKGROUND.png"/>
                <p>Cherry Clothing is a website made for a senior project with no intention for commercial use.</p>
            </div>
            <div class ="footRight">
                <ul>
                    <li><h2><u>Directory</u></h2></li><!-- updatecomment -->
                    <li><a href="main.php">Home</a></li>
                    <li><a href="catalog.php">Products</a></li>
                    <li><a href="contactUs.php">Contact Us</a></li>
                    <li><a href="cart.php">Cart</a></li>
                    <li><a href="signin.php">My Profile</a></li>
                </ul>
            </div>
        </footer>
    </body>
</html>