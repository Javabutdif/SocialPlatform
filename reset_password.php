<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="reset_password.css" />
    <title>Reset Password</title>

    <?php
    session_start(); // Start the session

    require('db_connect.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $password = $_POST['password'];
        $confirm_password = $_POST['confirmPassword'];

        // Validate passwords
        if ($password != $confirm_password) {
            echo "Passwords do not match.";
        } else {
            // Reset the user's password in the database
            if (isset($_SESSION['reset_email'])) {
                $email = $_SESSION['reset_email'];
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $query = "UPDATE users SET password='$hashed_password' WHERE email='$email'";

                if (mysqli_query($con, $query)) {
                    // Clear session variables
                    unset($_SESSION['reset_email']);
                    unset($_SESSION['reset_otp']);

                    echo "Password reset successfully. You can now <a href='login.php'>login</a> with your new password.";
                    exit();
                } else {
                    echo "Error updating password: " . mysqli_error($con);
                }
            } else {
                echo "Reset email not found in session.";
            }
        }
    }
    ?>

    


       


</head>
<style>
     
</style>

<body>

    <form method="post">
        <h2>Reset Password</h2>
        <label>New Password:</label>
        <br>
        <input type="password" class="login-input" name="password" id="password" placeholder="Password" onkeyup="suggestStrongPassword()" onfocus="suggestStrongPassword()" required />
        <div class="border">
            <div id="password-strength-meter"></div>
        </div>
        <br>
        <p id="passwordStrengthMessage" style="color: red;"></p><br>
        <label class="label1">Confirm Password:</label>
        <br>
        <input type="password" class="login-input" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password" onkeyup="checkPasswordMatch()" required />
        <div id="confirmMessage"></div>
        <div class="form-group">
            <input type="submit" value="Sign Up" name="signup" id="submit" class="btn btn-block">
        </div>
    </form>

</body>

</html>