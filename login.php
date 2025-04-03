<?php
session_start();
require_once 'connect.php';

$errors = [];

// Process the login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Check if the user exists
    $stmt = $pdo->prepare('SELECT * FROM signup WHERE email = :email');
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user) {
        // If user exists, verify the password
        if (password_verify($password, $user['password'])) {
            // Correct password, proceed with login
            $_SESSION['user_id'] = $user['id']; // Store user info in session
            $_SESSION['email'] = $user['email'];

            // Redirect to the dashboard or home page
            header('Location: menu.html'); // Change this to your dashboard page
            exit();
        } else {
            $errors['login'] = 'Incorrect password.';
        }
    } else {
        $errors['login'] = 'Email is not registered.';
    }
}

// Store errors in the session to be displayed on the login page
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Delicious+Handrawn&family=Gloria+Hallelujah&family=Reenie+Beanie&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&family=Waiting+for+the+Sunrise&display=swap" rel="stylesheet">
</head>
<body>
    <div class="login-page">
        <h1>Login</h1>

        <!-- Display any login errors -->
        <?php
        if (isset($errors['login'])) {
            echo '<div class="error-main"> 
                    <p>' . $errors['login'] . '</p>
                </div>';
        }
        ?>

        <form action="login.php" method="POST">
            <div class="name">
                <label>Email: </label>
                <input type="email" name="email" id="email" placeholder="Enter your email" required>
            </div>
            <br>
            <div class="pass">
                <label>Password:</label>
                <input type="password" placeholder="Password" minlength="5" required id="passworda" name="password">
                <span id="iconone"><i class="fa-solid fa-eye"></i></span>
            </div>
            <button type="submit" name="login">Log-in</button>

            <h3>Forgotten Password?</h3>
            <div class="other-option">
                <hr>
                <p>or</p>
                <hr>
            </div>
            <input type="button" class="button" value="Sign-up" name="signUp" id="butt" style="cursor: pointer;">
        </form>
    </div>
    <script>
        let icona= document.getElementById("iconone");
        let button= document.getElementById("butt");
        icona.onclick = function() {
            if (passworda.type === "password") {
                passworda.type = "text";
                icona.innerHTML = "<i class='fa-solid fa-eye'></i>";
            } else {
                passworda.type = "password";
                icona.innerHTML = "<i class='fa-solid fa-eye-slash'></i>";
            }
        };
        button.onclick =function(){
            window.location.href="signup.php";
        }
    </script>
</body>
</html>
