<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <!-- Favicon -->
    <link rel="icon" href="/img/icon.ico" type="image/x-icon">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;900&family=Ubuntu:ital@0;1&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/cc5e355fff.js" crossorigin="anonymous"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <!-- Nav Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">
            <img class="logo" src="LOGO.png" alt="Avatar">
        </a>
        <a class="navbar-brand" href="">Brew Haven</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" id="col" href="#contact">Contact</a></li>
                <li class="nav-item"><a class="nav-link" id="col" href="login.html">Login</a></li>
                <li class="nav-item"><a class="nav-link" id="col" href="#pricing">Order</a></li>
                <li class="nav-item"><a class="nav-link" id="col" href="#testimonials">Gallery</a></li>
            </ul>
        </div>
    </nav>

    <div class="login-container">
        <section id="sign">
            <div class="container pt-4 my-5">
                <br>
                <p style="font-size:30px;" class="text-center" id="subHead1"><b>Create Your Account</b></p>
                <hr>
                <div class="form-container">
                    <form id="MedicalForm" action="signup.php" method="post">
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email Id</label>
                            <div class="col-sm-10 position-relative">
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10 position-relative">
                                <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                            </div>
                        </div>

                        <button type="submit" class="btn text-light btn-large btn-block" style="background-color: #CA965C;" id="add-record-btn">Done</button>

                        <p>Have an existing account? <a class="link-page" href="login.html">Login</a> here</p>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <!-- PHP Logic to Handle Form Submission -->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "localhost"; // Hostname
        $db_username = "root"; // Your MySQL username
        $db_password = ""; // Your MySQL password
        $dbname = "brew_haven"; // Your database name

        // Create connection
        $conn = new mysqli($servername, $db_username, $db_password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get user input and sanitize it
        $email = $conn->real_escape_string($_POST['email']);
        $username = $conn->real_escape_string($_POST['username']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<p class='text-center' style='color: green;'>Registration successful!</p>";
        } else {
            echo "<p class='text-center' style='color: red;'>Error: " . $stmt->error . "</p>";
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
    ?>

    <!-- Footer -->
    <footer id="footer">
        <div class="d-flex justify-content-between some">
            <div>
                <a class="navbar-brand" href="#">
                    <img class="logo" src="LOGO.png" alt="Avatar"> Brew Haven
                </a>
            </div>
            <div class="social-media-icons">
                <a href="https://www.facebook.com/" target="blank"><i class="social-icon fab fa-facebook fa-2x"></i></a>
                <a href="https://www.instagram.com/" target="blank"><i class="social-icon fab fa-instagram fa-2x"></i></a>
                <a href="https://twitter.com/" target="blank"><i class="social-icon fab fa-twitter fa-2x"></i></a>
                <a href="#"><i class="social-icon fas fa-envelope fa-2x"></i></a>
            </div>
        </div>
        <div class="copyright text-center">©2023 Brew Haven | All Rights Reserved</div>
    </footer>
</body>
</html>
