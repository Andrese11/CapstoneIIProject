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

        <div class="form-container">
            <h2 id="createAccount">Create Your Account</h2>
            <p id="fillInfo">Please fill in this form to create an account.</p>
            <form action="PHPForms/signUpUser.php" method="POST" enctype="multipart/form-data">
                <!-- Name -->
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required><br>

                <!-- Email -->
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required><br>

                <label for="phone_number">Phone Number</label>
                <input type="text" id="phone_number" name="phone_number" required><br>

                <!-- Address -->
                <label for="address">Address</label>
                <input type="text" id="address" name="address" required><br>

                <label for="State">State</label>
                <input type="text" id="region" name="region" required><br>
                
                <label for="City">City</label>
                <input type="text" id="city" name="city" required><br>

                <label for="postal_code">Postal Code</label>
                <input type="text" id="postal_code" name="postal_code" required><br>

                <!-- Password -->
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required><br>

                <!-- Signup Button -->
                <button type="submit" id="btnSignUp" name="signUp">Sign Up</button>
            </form>
            <p>Already have an account? <a href="signin.php">Sign in here</a>.</p>
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
