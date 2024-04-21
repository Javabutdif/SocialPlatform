<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication</title>
</head>
<body style="text-align:center">
    <h1>OTP</h1>
    <form action="authentication.php" method="POST">
    <input type="text" name="otpp" placeholder="Enter One time pin">
</form>
</body>
</html>
<?php


if(isset($_POST["otpp"])){
    $con = mysqli_connect('localhost', 'root', '', 'pc3211');
    $enteredOtp = $_POST['otpp'];

    $first_Name= $_SESSION['firstname'];
    $last_Name =$_SESSION['lastname'] ;
    $passWord=$_SESSION['password']  ;
    $email=$_SESSION['email'];
    $contact=$_SESSION['contact'];
    $role=$_SESSION['role'];

    if($_SESSION['otp'] ==$enteredOtp ){
    $sql1 = "INSERT INTO `user` (`lastname` , `firstname`, `contact`, `email`, `password`, `role`)
     VALUES ('$last_Name','$first_Name','$contact','$email','$passWord','$role' )";
 

// insert in database 
if (mysqli_query($con, $sql1)  ) {
    echo '<script>alert(" Email Registered!");</script>';
    session_destroy();
    header('Location: Login.php');
}   
    }
    else{
        echo '<script>alert(" OTP Incorrect!");</script>';
    }
}
?>