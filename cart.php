<?php
    session_start();

    if (isset($_SESSION['userID'])) {
        $userID = $_SESSION['userID'];
    } else {
        $userID = null; // or handle it as needed
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cherry Clothing</title>
        <link rel="stylesheet" href="designCart.css">
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
        <header>
            <h1 class="cart">Shopping Cart</h1>
        </header>
        <section class="cart-items">
            <div class="cart-item">
                <img src="Images/product1.jpg" alt="Cherry T-shirt 1">
                <h2>Cherry T-shirt 1</h2>
                <p>Price: $25.00</p>
                <label>Quantity: <input type="number" value="1"></label>
                <button>Remove</button>
            </div>
            <div class="cart-item">
                <img src="Images/product2.jpg" alt="Cherry T-shirt 2">
                <h2>Cherry T-shirt 2</h2>
                <p>Price: $30.00</p>
                <label>Quantity: <input type="number" value="2"></label>
                <button>Remove</button>
            </div>
            <div class="cart-footer">
                <p class="total" id="total">Total: $85.00</p>
                <button class="checkout" id="checkout">Checkout</button>
            </div>
        </section>

        <footer class="footer">
            <div class ="footLeft">
                <img src = "NO_BACKGROUND.png"/>
                <p>Cherry Clothing is a website made for a senior project with no intention for commercial use.</p>
            </div>
            <div class ="footRight">
                <ul>
                    <li><h2><u>Directory</u></h2></li>
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
