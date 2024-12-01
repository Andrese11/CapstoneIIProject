<?php
/*
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


        "SELECT 
            su.username,
            su.phone_number,
            su.email_address,
            al.address_line,
            al.city,
            al.region,
            al.postal_code
         FROM site_user su
         INNER JOIN user_address ua ON su.site_user_id = ua.user_address_id
         INNER JOIN address_location al ON ua.address_id = al.address_id
         WHERE su.site_user_id = ?"
*/
require_once 'connect.php';

session_start();

if (!isset($_SESSION['userID'])) {
    header("Location: signin.php"); // Redirect if not logged in
    exit;
}



?>

