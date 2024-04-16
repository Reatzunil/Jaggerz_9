<?php

require_once 'includes/dbh.inc.php';


$message = ""; // Initialize an empty message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize form data
    $name = htmlspecialchars($_POST["name"]);
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) ? $_POST["email"] : null;
    $number = $_POST["number"];
    $availability = $_POST["availability"];
    $time = $_POST["time"];
    $services = $_POST["services"];
    $image_path = $_FILES["file"]["name"];

    // Check if all required fields are provided
    if (empty($name) || empty($email) || empty($number) || empty($availability) || empty($time) || empty($services) || empty($image_path)) {
        $message = "Error: Please fill in all required fields.";
    } else {
        // Prepare and execute SQL statement using prepared statements
        $stmt = $conn->prepare("INSERT INTO reservations (name, email, number, availability, time, services, image_path) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $name, $email, $number, $availability, $time, $services, $image_path);

        if ($stmt->execute()) {
            $message = "Reservation successfully created.";
        } else {
            $message = "Error: " . $stmt->error;
        }

        // Close prepared statement
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, inital-scale=1.0">
    <title>Jagger Cuts and Tattoo</title>
    
    <!--website's icon-->
    <link rel="icon" type="image/png" href="images-folder/logo.png">

    <!--font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!---custom css file link---->
    <link rel="stylesheet" href="styles_copy1.css">

</head>
<body>

<div>
    <?php if (!empty($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
</div>
    
<!----header section starts---->

<header class="header">

    <a href="#" class="logo">
        <img src="images-folder/logo.png" width="70px">
    </a>

    <nav class="navbar">
        <a href="#home">home</a>
        <a href="#about">about</a>
        <a href="#products">products</a>
        <a href="#services">services</a>
        <a href="#booking">reservation</a>
        <a href="#contacts">contacts</a>
    </nav>

        <div class="icons">
            <div class="fas fa-bars" id="menu-btn">
            </div>
        </div>
    <div class="navbar1">
        <a href="index.php">Logout</a>
    </div>

    <div id="personModal" class="modal">
        <span class="close-btn" onclick="closePersonDetails()">&times;</span>
        
        <div class="modal-content">
           
            <img src="images-folder/logo.png" alt="Person Image" class="person-image">
            <div>
                <h2>User</h2>
                <p>Name:</p>
            </div>
        </div>
    </div>
</header>

<section class="home" id="home">

    <div class="content">
        <h3>Always looks good</h3>
        <p>In JavaScript, there will be times when you need to access an HTML element. The querySelector method is a web API that selects the first element that matches the specified CSS selector passed into it.</p>
        <a href="#booking" class="btn1">Reserve Now</a>
    </div>
</section>

<!---home section ends-->

<!---about section starts-->

<section class="about" id="about">

    <h1 class="heading"><span>about</span>us</h1>

    <div class="row">

        <div class="image">
            <img src="images-folder/logo_1.jpg" width="400px">
        </div>

        <div class="content">
            <h3>What makes us special?</h3>
            <p>It appears that you’re trying to create a centered layout with a background image using CSS. Let’s break down your code snippet</p>
            <div class="hidden" id="additional-info">
                <p>This is additional information that slides down when you click on "Learn More".</p>
            </div>
            <a href="#" class="btn1" id="learn-more-btn">Learn More</a>
        </div>

    </div>
</section>
<!---about section ends-->


<!---products section starts----->

<section class="products" id="products">

    <h1 class="heading">our<span>products</span></h1>

    <div class="box-container">
        
        <div class="box">
            <div class="image">
                <img src="images-folder/product-1.jpg" width="250px" height="350px" alt="">
            </div>
            <div class="content">
                <h3>Pomade Hair Wax</h3>
                
            <div class="price">₱150</div>
            </div>
        </div>
    </div>
</section>

<!---products section ends----->

<!---services section starts----->
<section class="services" id="services"> 

    <h1 class="heading"> our<span>services</span></h1>

    <div class="box-container">

        <div class="box">
            <img src="images-folder/minimalist.jpg" width="250px" height="350px" alt="">
            <h3>Minimalist</h3>
            <div class="price">₱150</div>
            <h3>Bale Minimalist Tattoo</h3>
            <div class="price">₱150</div>
        </div>
        <div class="box">
            <img src="images-folder/tattoo.jpg" width="250px" height="350px" alt="">
            <h3>Tattoo</h3>
            <div class="price">₱800</div>
        </div>
        <div class="box">
            <img src="images-folder/service.jpg" width="250px" height="350px" alt="">
            <h3>Haircut</h3>
            <div class="price">₱150</div>
            <h3>With shave</h3>
            <div class="price">₱200</div>
            <h3>With shampoo</h3>
            <div class="price">₱200</div>
            <h3>With haircolor</h3>
            <div class="price">₱500</div>
        </div>
        
    </div>
</section>

 
<!---services section ends----->

<!---booking section starts----->

<section class="booking" id="booking">

    <h1 class="heading"> <span>reserve</span>now</h1>

    <!-- Reservation Form -->
    <div class="row">
        <form method="post" enctype="multipart/form-data">
        <div class="inputBox">
            <span class="fas fa-user"></span>
            <input type="text" name="name" placeholder="Name">
        </div>

        <div class="inputBox">
            <span class="fas fa-envelope"></span>
            <input type="email" name="email" placeholder="Email">
        </div>

        <div class="inputBox">
            <span class="fas fa-phone"></span>
            <input type="tel" name="number" placeholder="Number">
        </div>

        <div class="inputWithIcon">
            <label for="availability" class="date-picker-label">
                <span class="fas fa-calendar"></span>
                <input type="date" id="availability" name="availability" placeholder="Availability">
            </label>
        </div>

        <div class="inputWithIcon">
            <label for="time" class="time-picker-label">
                <span class="fas fa-clock time-picker-icon"></span>
                <input type="time" id="time" name="time" placeholder="Time">
            </label>
        </div>

        <div class="inputBox">
            <span class="fas fa-bar"></span>
                <select id="services" name="services">
                    <option value="1">Minimalist</option>
                    <option value="2">Bale Minimalist Tattoo</option>
                    <option value="3">Tattoo</option>
                    <option value="4">HairCut</option>
                    <option value="5">HairCut with shave</option>
                    <option value="6">Haircut wiht haircolor</option>
                    <option value="7">HairCut with shampoo</option>
                </select>
            </div>

            <div class="upload-container">
                <label for="file-upload" class="custom-button">Upload ID</label>
                <input type="file" id="file-upload" name="file" accept="image/*" onchange="previewImage(event)">
            </div>

            <div id="image-preview"></div>
            <button type="submit" name="send" class="btn">Reserve Now</button>
        </form>

        <!-- Reservation Form -->
    </div>
</section>
   
<!---booking ends here--->

<!---contact section starts----->

<section class="contacts" id="contacts">

    <h1 class="heading"> <span>contact</span>us</h1>

    <div class="row">

        <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d247.39745675318113!2d124.53892297913605!3d7.199782656765955!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zN8KwMTEnNTkuNiJOIDEyNMKwMzInMjEuMCJF!5e0!3m2!1sen!2sph!4v1709469690633!5m2!1sen!2sph" allowfullscreen="" loading="lazy"></iframe>
    
        <form action="" method="post" class="contacts"> 
            <h4>Get in touch</h4>
            <br>
            <div class="inputBox">
                <h3>Poblacion 5, Midsayap, Cotabato, Philippines</h3>
                <h3>906-461-8563</h3>
                <h3>regfuna@gmail.com</h3>
            </div>
            <br>
            <button type="submit" name="send" class="btn1">Contact now</button>
        </form>

    </div>
</section>

<!---contact section ends----->

<!---footer section starts----->

<section class="footer">

    <div class="share">
        
    </div>

    <div class="links">
        <a href="#">home</a>
        <a href="#">about</a>
        <a href="#">products</a>
        <a href="#">reservation</a>
        <a href="#">contacts</a>
    </div>
    <div class="contact">
       <h3> Poblacion 5, Midsayap, Cotabato, Philippines</h3>
       <h3> 906-461-8563</h3>
       <h3> regfuna@gmail.com</h3>
    </div>
    <div class="credit">created by <span>da barberz</span> | all rights reserved</div>
</section>





<!----custom js file link---->
<script src="scripter.js"></script>

</body>
</html>