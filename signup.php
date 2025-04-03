<?php

session_start();
if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']); 
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-up Page</title>
    <link rel="stylesheet" href="signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Delicious+Handrawn&family=Gloria+Hallelujah&family=Reenie+Beanie&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&family=Waiting+for+the+Sunrise&display=swap" rel="stylesheet">
</head>
<body>
    <div class="sign-up">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZsjzwXmEgFp17eZ07qHJoNdMlg8q3DdYJ_A&s" alt="image" id="image">
        <?php
        if (isset($errors['user_exist'])) {
            echo '<div class="error-main">
                    <p>' . $errors['user_exist'] . '</p>
                    </div>';
                    unset($errors['user_exist']);
        }
        ?>
        <form method="POST" action="user-account.php">
            <div class="name">
            <label>Name: </label>
            <input type="text" name="name" minlength="5" required>
            <?php
            if (isset($errors['name'])) {
                    echo '<div class="error">
                    <p>' . $errors['name'] . '</p>
                    </div>';
                    unset($errors['name']);

                }
            ?>
        </div>
        <div class="email">
            <label>Email:</label>
            <input type="email" name="email" minlength="10" required>
            <?php
            if (isset($errors['email'])) {
                    echo '<div class="error">
                    <p>' . $errors['email'] . '</p>
                    </div>';
                    unset($errors['email']);

                }
            ?>
        </div>
        <div class="pass">
            <label>Password:</label>
            <div class="on">
                <input type="password" name="password" placeholder="password" minlength="5" required id="pass1">
                <span id="iconone"><i class="fa-solid fa-eye"></i></span>
                <?php
            if (isset($errors['password'])) {
                    echo '<div class="error">
                    <p>' . $errors['password'] . '</p>
                    </div>';
                    unset($errors['password']);

                }
            ?>
            </div>
        </div>
        <div class="pass">
            <label>Re-enter Password:</label>
            <div class="on">
                <input type="password"name="confirm_password" placeholder="re-enter password" minlength="5" required id="pass2">
                <span id="icon2"><i class="fa-solid fa-eye"></i></span>
            <?php
                if (isset($errors['confirm_password'])) {
                    echo '<div class="error">
                    <p>' . $errors['confirm_password'] . '</p>
                    </div>';
                    unset($errors['confirm_password']);

                }
            ?>
            </div>
            <span id="error">Passwords do not match!</span><br>
        </div>
        
        <button name="signUp">Sign-up</button>
        </form> 
    </div>
    <!-- js -->
    <script>
        let icona= document.getElementById("iconone");
        let icon2 = document.getElementById("icon2");
        let passworda = document.getElementById("pass1");
        let password2 = document.getElementById("pass2");
        let errorMessage = document.getElementById("error");
        let imag = document.getElementById("image");

        icona.onclick = function() {
            if (passworda.type === "password") {
                passworda.type = "text";
                icona.innerHTML = "<i class='fa-solid fa-eye'></i>";
            } else {
                passworda.type = "password";
                icona.innerHTML = "<i class='fa-solid fa-eye-slash'></i>";
            }
        };
        icon2.onclick = function(){
            if(password2.type == "password"){
                password2.type = "text";
                icon2.innerHTML ="<i class='fa-solid fa-eye'></i>";
            }
            else{
                console.log("error two");
                password2.type = "password";
                icon2.innerHTML = "<i class='fa-solid fa-eye-slash'></i>";
            }
        }
        document.querySelector("button").onclick = function(event) {
            // Check if the passwords match
            if (passa !== pass2) {
            event.preventDefault(); // Prevent form submission
            errorMessage.style.display = "block"; // Show the error message
            document.getElementById("passsword2").focus(); // Focus on the "repassword" field
        } else {
            errorMessage.style.display = "none"; // Hide the error message if passwords match
        }
    };

        document.querySelector("button").onclick = function(event) {
            let passa = passworda.value.trim(); // Get updated values
            let pass2 = password2.value.trim();

            if (passa !== pass2) {
                event.preventDefault(); // Prevent form submission
                errorMessage.style.display = "block"; // Show error message
                password2.focus(); // Corrected focus
            } else {
                errorMessage.style.display = "none"; // Hide error message
            }
        };
        imag.onclick = function(){
            if(imag.src=="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZsjzwXmEgFp17eZ07qHJoNdMlg8q3DdYJ_A&s"){
            window.location.href="login.php";
            }
            else{
                imag.src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZsjzwXmEgFp17eZ07qHJoNdMlg8q3DdYJ_A&s";
            }
        }
     </script>
</body>
</html>