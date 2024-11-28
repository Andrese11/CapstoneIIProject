<?php
    session_start();

    if (isset($_SESSION['userID'])) {
        $userID = $_SESSION['userID'];
        if ($userID != null) {
            header("Location: ./profile.php");
        }
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
        <link rel="stylesheet" href="designSignUp.css">
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

        <div class="form-containers">
            <h2 id="welcome"">Welcome Back!</h2>
            <p id="Please">Please login to your account.</p>
            <form action="PHPForms/loginCheck.php" method="POST">
                <!-- Email -->
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required><br>

                <!-- Password -->
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required><br>

                <!-- Login Button -->
                <button type="submit" id="btnLogin" name ="login">Login</button>
            </form>
            <p>Don't have an account? <a href="signup.php">Sign up here</a>.</p>
        </div>

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
