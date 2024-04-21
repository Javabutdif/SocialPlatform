<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send OTP</title>
</head>

<body>
    <form action="send_otp.php" method="post">
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email"><br>
        <input type="submit" name="submit" value="Send OTP">
    </form>

    <?php
session_start();
require('db_connect.php');

function sendOTP($email) {
    // Generate OTP
    $otp = mt_rand(100000, 999999);

    // Store OTP in session for verification
    $_SESSION['otp'] = $otp;

    // Send OTP to the user's email address
    $to = $email;
    $subject = 'OTP for login';
    $message = 'Your OTP is: ' . $otp;
    $headers = 'From: njeanllanto@gmail.com' . "\r\n" .
        'Reply-To: njeanllanto@gmail.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    if (mail($to, $subject, $message, $headers)) {
        echo "<div class='form'>
                    <script>alert('OTP sent to your email.');</script>;
                    <script>window.location.href ='verify_otp.php?email=$email'</script>;
                </div>";
        exit();
    } else {
        echo "Failed to send OTP. Please try again later.";
        exit();
    }
}

if (isset($_POST['submit'])) { 
    $email = $_POST['email'];
    // Validate email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit();
    }

    // Call the sendOTP function
    sendOTP($email);

}
?>
</body>
</html>
