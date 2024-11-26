<!DOCTYPE html>
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
                <img src="../Cherry Clothing Designs/Pants/CherryRelaxedPant/men_cherry_relaxed_pant_front.jpg.jpg" id="Big">
                <img src="../Cherry Clothing Designs/Pants/CherryRelaxedPant/men_cherry_relaxed_pant_back.jpg.jpg" id="Small">
            </div>
            <div class="info">
                <h2><strong>Cherry Relaxed Fit Pant for Men</strong></h2>
                <p>Designed for maximum comfort, these pants offer a loose and easy fit, perfect for laid-back and casual settings.<br></p>
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
                <button class = "addtoCart">Add to Cart</button>
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