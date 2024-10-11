<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username exists
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $db_username, $db_password);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $db_password)) {
            // Store user info in session
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $db_username;
            
            // Redirect to account page
            header("Location: singup.html");
            exit;
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "User does not exist!";
    }

    $stmt->close();
    $conn->close();
}
?>
