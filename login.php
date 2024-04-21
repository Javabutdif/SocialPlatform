<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href=""/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <script>
        function validateForm() {
            var username = document.forms["login"]["username"].value;
            var password = document.forms["login"]["password"].value;

            if (username == "" || password == "") {
                alert("Both username and password must be filled in");
                return false;
            }
        }

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

        function validateEmailFormat(email) {
            var emailInput = document.getElementById("username");
            var errorMessage = document.getElementById("emailErrorMessage");

            if (!/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(email)) {
                errorMessage.innerHTML = "Invalid email format";
                errorMessage.style.color = "red";
            } else {
                errorMessage.innerHTML = "";
            }
        }
    </script>
</head>
<style>
body{

background-image: url(img/R.jpg);
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
        margin-left: 0px;
        margin-top: 100px;
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
    color:black;
        background: white;
        font-size: 15px;
        border: 3px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 20px;
        height: 15px;
        width: calc(100% - 23px);
        margin-left: 35px;

}

label{
color: white;
font-size: 18px;
padding: 35px;
padding-top: 20px;
}

button{
    color: White;
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
padding: 5px;
width: 95%;
border-radius: 5px;
margin: 20px auto;
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
color:red;
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
</style>
<body>

<?php
  require('db_connect.php');
  session_start();

  if (isset($_POST['submit'])) {
      $username = stripslashes($_POST['username']);
      $username = mysqli_real_escape_string($con, $username);
      $password = stripslashes($_POST['password']);
      $password = mysqli_real_escape_string($con, $password);

      // Check if username and password are not empty
      if (empty($username) || empty($password)) {
          header("Location: login.php?error=Both username and password must be filled in");
          exit();
      } 
      else if($username == 'admin' && $password == 'admin'){
        $_SESSION['is_admin'] = "admin";
        header('Location: index.php');
      }
      
      
      else {
          $query = "SELECT * FROM `users` WHERE username='$username'";
          $result = mysqli_query($con, $query) or die(mysqli_connect_error());
          $row = mysqli_fetch_assoc($result);
          if ($row) {
              // Verify the password
              if (password_verify($password, $row['password'])) {
                  $_SESSION['username'] = $username;
                  $_SESSION['login_attempts'] = 0; // Reset login attempts on successful login
                  header("Location: dashboard.php");
                  exit();
              } else {
                  // Increment login attempts
                  if (!isset($_SESSION['login_attempts'])) {
                      $_SESSION['login_attempts'] = 1;
                  } else {
                      $_SESSION['login_attempts']++;
                  }

                  // Check if login attempts exceed 3
                  if ($_SESSION['login_attempts'] >= 3) {
                      header("Location: forgot_password.php");
                      exit();
                  }

                  header("Location: login.php?error=Incorrect username and password");
                  exit();
              }
          } else {
              header("Location: login.php?error=User not found");
              exit();
          }
      }
  }  else {
?>




    <form method="POST" name="login" onsubmit="return validateForm()">
        
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?> </p>
        <?php } ?>
        <label>User Name</label>
        <input type="text" class="login-input" name="username" id="username" required  placeholder="Username" onkeyup="validateEmailFormat(this.value)" autofocus="true"/>
        <!-- <p id="emailErrorMessage" style="color: red;"></p> -->
        <label>Password</label>
        <div style="position: relative;">
            <input type="password" class="login-input" name="password" id="password" required  placeholder="Password"/>
            <i id="eye-icon" class="fa fa-eye" onclick="togglePassword()" style="position: absolute; right: -25px; top: 35%; transform: translateY(-50%); cursor: pointer;"></i>
        </div>
        <button type="submit" name="submit">LOGIN</button>
        <br><br><br>
      
        <div><p class="link">Not registered yet? <a href="registration.php">Register Here!</a></p></div>
    
    </form>

<?php
    }
?>
</body>
</html>
