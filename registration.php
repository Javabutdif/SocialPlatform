    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8"/>
        <title>Registration</title>
        <link rel="stylesheet" href=""/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
        <script>
            function togglePassword() {
                var passwordInput = document.getElementById("password");
                var eyeIcon = document.getElementById("eye-icon");

                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                    eyeIcon.classList.remove("fa-eye-slash");
                    eyeIcon.classList.add("fa-eye");
                } else {
                    passwordInput.type = "password";
                    eyeIcon.classList.remove("fa-eye");
                    eyeIcon.classList.add("fa-eye-slash");
                }
            }

            function checkPasswordMatch() {
                var password = document.getElementById("password").value;
                var confirmPassword = document.getElementById("confirmPassword").value;
                // var confirmPasswordInput = document.getElementsBy("confirmPassword")[0];
                var message = document.getElementById("confirmMessage");

                if (password === confirmPassword) {
                    message.innerHTML = "Passwords match";
                
                    message.style.color = "green";
                } else {
                    message.innerHTML = "Passwords do not match";
              
                    message.style.color = "red";
                }
            }
            function checkPasswordStrength() {
    var password = document.getElementById("password").value;
    var strengthMeter = document.getElementById("password-strength-meter");
    var score = getPasswordStrength(password);

    // Reset class list
    strengthMeter.className = '';
    switch (score) {
        case 5:
            strengthMeter.classList.add('strength-very-strong');
            break;
        case 4:
            // Optional: Handle the case for 4 criteria met (strong password but not very strong)
            strengthMeter.classList.add('strength-strong');
            break;
        case 3:
            strengthMeter.classList.add('strength-medium');
            break;
        case 2:
            strengthMeter.classList.add('strength-weak');
            break;
        default:
            strengthMeter.classList.add('strength-very-weak'); // Consider adding this class for clarity
            break;
    }
}


    function getPasswordStrength(password) {
    var hasUppercase = /[A-Z]/.test(password);
    var hasLowercase = /[a-z]/.test(password);
    var hasNumbers = /\d/.test(password);
    var hasSpecialChars = /[!@#$%^&*]/.test(password);
    var minLength = password.length >= 8;

    // Calculate score based on the presence of each criteria
    var score = 0;
    if (hasUppercase) score++;
    if (hasLowercase) score++;
    if (hasNumbers) score++;
    if (hasSpecialChars) score++;
    if (minLength) score++;

    return score;
}
    document.addEventListener('DOMContentLoaded', function() {
        var passwordInput = document.getElementsByName("password")[0];
        var confirmPasswordInput = document.getElementsByName("repeat_password")[0];

        passwordInput.addEventListener('input', function() {
            checkPasswordStrength();
            checkPasswordMatch(); 
        });

        confirmPasswordInput.addEventListener('keyup', checkPasswordMatch);
    });

    function validateEmail() {
    var emailInput = document.getElementById("email");
    var errorMessage = document.getElementById("emailErrorMessage");
    var email = emailInput.value;
    var isValidFormat = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

    if (!isValidFormat) {
        errorMessage.innerHTML = "Invalid email format";
        errorMessage.style.color = "red";
    } else {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "check_email.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function() {
            if (xhr.status == 200) {
                if (xhr.responseText.trim() === "exists") {
                    errorMessage.innerHTML = "Email is already in use";
                    errorMessage.style.color = "red";
                } else {
                    errorMessage.innerHTML = ""; // Clear error message if email is not in use
                }
            }
        };
        xhr.send("email=" + email);
    }
}
function checkUsernameAvailability() {
            var username = document.getElementById("username").value;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var response = this.responseText;
                    var errorMessage = document.getElementById("username-error");
                    if (response === "taken") {
                        errorMessage.innerHTML = "Username is already taken";
                        errorMessage.style.color = "red";
                    } else if (response === "not_found") {
                        errorMessage.innerHTML = "Username not found";
                        errorMessage.style.color = "red";
                    } else {
                        errorMessage.innerHTML = "";
                    }
                }
            };
            xhr.send("username=" + username);
        }

            function suggestStrongPassword() {
                var passwordInput = document.getElementById("password");
                var password = passwordInput.value;
                var message = document.getElementById("passwordStrengthMessage");
                var hasUppercase = /[A-Z]/.test(password);
                var hasLowercase = /[a-z]/.test(password);
                var hasNumbers = /\d/.test(password);
                var hasSpecialChars = /[!@#$%^&*]/.test(password);

                message.innerHTML = "";

                if (!hasUppercase) {
                    message.innerHTML += "Include at least one uppercase letter, ";
                }
                if (!hasLowercase) {
                    message.innerHTML += "one lowercase letter, ";
                }
                if (!hasNumbers) {
                    message.innerHTML += "one number, ";
                }
                if (!hasSpecialChars) {
                    message.innerHTML += "special character (!@#$%^&*), ";
                }
                if (password.length < 8) {
                    message.innerHTML += "Password should be at least 8 characters long ";
                }

                if (message.innerHTML !== "") {
                    message.style.color = "red";
                } 
            }

            function validateForm() {
                var password = document.getElementById("password").value;
                var message = document.getElementById("passwordStrengthMessage");
                var strongRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;

                if (!strongRegex.test(password)) {
                    message.innerHTML = "Password should be at least 8 characters long and include uppercase letters, lowercase letters, numbers, and special characters (!@#$%^&*)";
                    message.style.color = "red";
                    return false;
                }
                message.innerHTML = "";
                return true;
            }
          
        </script>
    </head>
    <style>
    body{

            background-image:url('img/R.jpg');
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
            background-repeat: no-repeat;
                    background-size: cover;
    }

    *{
        margin: 0px;
        box-sizing: padding-box;
    }

    form{
        background-color: transparent;
            margin-left: -810px;
            margin-top: 50px;
            width: 300px;


    }

    h2{
        color:#00B88C;
        text-align: center;
        margin-bottom: 12px;
        font-size: 300%;
        margin-top: 3%;
        
    }

    input{
        color: black;
            background: white;
            font-size: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
            height: 15px;
            width: calc(100% - 23px);
            margin-left: 35px;
            position:relative;
    }

    label{
        color: White;
        font-size: 16px;
        padding: 35px;
    
        

    }

    button{
        color: #fff;
            background: green;
            border: 0;
            border-radius: 5px;
            outline: 0;
            width: 100%;
            height: 40px;
            font-size: 16px;
            text-align: center;
            cursor: pointer;
            margin-left: 35px;
    }

    button:hover{

        opacity: .10;
        
    }

    .error {
        background: #2D2F34; 
        color: red;
       
        width: 95%;
        border-radius: 5px;
        margin: 20px auto;
        
    }
    .error, #emailErrorMessage, #passwordStrengthMessage, #confirmMessage {
        font-size: 9px; 
        margin-top: -10px; 
        margin-bottom: 10px;
        margin-left: 40px;
    }
    h1{
        text-align: center;
        color: rgb(134, 3, 3);
    }
    .link{
    color:white;
    margin-left: 15%;
    }
    a{
    color: red;
    border: none;
    text-decoration: none;

    }

    a:hover{
        opacity: .7;
    color: white;
    transition: .4s;
    }
    img{
        display: block;
    width: 47%;
    position: absolute;
    top: 55%;
    left: 72%;
    transform: translate(-50%,-50%);
    }
    .lg{
        display: block;
        width:15%;
    position: absolute;
    top: 9%;
    left: 3%;
    transform: translate(-50%,-50%);
    }
    p{
        margin: center;
        color: white;
    }
    .border {
            height: 5px;
            width: 100%;
            background-color: transparent; 
            margin-top: -10px;
            border-radius: 10px;
            position: absolute; 
            left: 30px;
    }

    #password-strength-meter {
    height: 100%; 
    width: 0%; 
    background-color: white; 
    border-radius: 10px; 
    position: absolute; 
    left: 3px; 
    transition: width 1s ease; 
}   
    .strength-weak {
            width: 10% !important; 
            background-color: red !important;
    }

        .strength-medium {
            width: 50% !important; 
            background-color: yellow !important;
        }

        .strength-strong {
            width: 75% !important; 
            background-color: orange !important;
        }

        .strength-very-strong {
            width: 100% !important; 
            background-color: green !important;
        }
    </style>
    <body>
    <?php
    require('db_connect.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = stripslashes($_POST['email']); // Changed from username to email
        $email = mysqli_real_escape_string($con, $email);
        $name = stripslashes($_POST['name']);
        $name = mysqli_real_escape_string($con, $name);
        $password = stripslashes($_POST['password']);
        $password = mysqli_real_escape_string($con, $password); 
        $username = stripslashes($_POST['username']);
$username = mysqli_real_escape_string($con, $username);
$contact_number = stripslashes($_POST['contact_number']);
$contact_number = mysqli_real_escape_string($con, $contact_number);
        // Processing continues as before

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message = "Invalid email format";
        } else {
            $query  = "SELECT * FROM `users` WHERE `email`='$email'";
            $result = mysqli_query($con, $query);
            $rows   = mysqli_num_rows($result);
            if ($rows > 0) {
                $error_message = "email already exists";
            } else {
                if (empty($name) || empty($password)) {
                    $error_message = "You must fill in all the fields!";
                } else {
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $query = "INSERT into `users` (email, username, contact, password, name) VALUES ('$email', '$username', '$contact_number', '$hashed_password', '$name')";
                    $result          = mysqli_query($con, $query);
                    if ($result) {
                        echo "<div class='form'>
                            <script>alert('Registered Successfully');</script>;
                            <script>window.location.href ='login.php'</script>;
                            </div>";
                        exit();
                    } else {
                        $error_message = "Error during registration. Please try again later.";
                    }
                }
            }
        }
    }
    ?>
  <form class="form" action="" method="post" onsubmit="return validateForm()">
    <?php if (!empty($error_message)) { ?>
        <p class="error"><?php echo $error_message; ?></p>
    <?php } ?>
    <label>Full Name</label>
    <input type="text" class="login-input" name="name" placeholder="Name" required >
    
    <label>Email</label>
    <input type="email" class="login-input" name="email" id="email" placeholder="Email" required onblur="validateEmail()" oninput="validateEmail()" />
    <p id="emailErrorMessage" style="color: red;"></p>
    
    <label>User Name</label>
            <input type="text" class="login-input" name="username" id="username" placeholder="Username"
                onkeyup="checkUsernameAvailability()" required>
            <p id="username-error" style="color: red;"></p>
    <label>Contact Number</label>
    <input type="text" class="login-input" name="contact_number" id="contact_number" placeholder="Contact Number" required />
    
    <label>Password</label>
    <div style="position: relative;">
        <input type="password" class="login-input" name="password" id="password" placeholder="Password" onkeyup="suggestStrongPassword()" onfocus="suggestStrongPassword()" required />
        <p id="passwordStrengthMessage" style="color: red;"></p> 
        <!-- <div class="border">
            <div id="password-strength-meter"></div>
        </div> -->
    </div>
    <br>
    <label>Confirm Password</label>
    <input type="password" class="login-input" name="confirmPassword" required  id="confirmPassword" placeholder="Confirm Password" onkeyup="checkPasswordMatch()"/>
    <div id="confirmMessage"></div>
    
    <button type="submit">Register</button>
    <br>
    <br>
    <div><p class="link">Already Registered?<a href="login.php">Login Here!</a></p></div>
</form>

    </body>
    </html>
