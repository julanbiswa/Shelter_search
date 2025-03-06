<?php

include("conn.php");
error_reporting(0);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shelter Search</title>

    <link rel="stylesheet" href="register.css">

</head>
<body>

<div class="logopic">
    
</div>


    <!-- Registration Form -->

        <form id="registerForm" name="registerform" method="POST" autocomplete="off"  onsubmit="return validate()" >

            <h2>Register for Shelter Search</h2>

            <div class="formdesign" >
                <label for="registerEmail">Email:</label> 
                <!-- <span id="errorMessage"></span> -->
                <input type="text" name="regEmail" id="registerEmail" placeholder="Enter your email">
            </div>

            <div class="formdesign">
                <label for="registerPassword">Password:</label>
                <input type="password" name="password" id="registerPassword" placeholder="Create your password">
                
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" name="cpassword" id="confirmPassword" placeholder="Re-type your password">
                
            </div>

            <button type="submit" name="submit" >Register</button>

            <p id="registerError" style="color: red; display: none;">Account already exists with this email.</p>

            <p><a href="login.php">Already have an account? Login</a></p>

        </form>


    </div>


    <script type="text/javascript">

        
function validate() {

    var email = document.getElementById("registerEmail").value;
            var password = document.getElementById("registerPassword").value;
            var confirmPassword = document.getElementById("confirmPassword").value;

            // Email validation regex
            var emailRegex = /^([a-zA-Z0-9._-]+)@([a-zA-Z0-9-]+)\.([a-z]{2,20})(\.[a-z]{2,20})?$/;


            if (email=="" && password == "" && confirmPassword == "")
            {
                alert("Please inter the Credential!");
                return false;
            }

            // Email validation
            if (!emailRegex.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

            // Password length validation
            if (password.length < 6) {
                alert("Password must be at least 6 characters long.");
                return false;
            }

            // // Confirm password validation
            // if (password !== confirmPassword) {
            //     alert("Passwords do not match. Please try again.");
            //     return false;
            return true;
            }




       
    </script>

    
    </body>
</html>



<?php

if (isset($_POST['submit'])) {
    $uemail = $_POST['regEmail'];
    $upassword = $_POST['password'];
    $ucpassword = $_POST['cpassword'];

    // Validate fields
    if (!empty($uemail) && !empty($upassword) && !empty($ucpassword)) {
        // Check if passwords match
        if ($upassword === $ucpassword) {
            $query = "INSERT INTO logindata (email, password) VALUES ('$uemail', '$upassword')";
            $data = mysqli_query($conn, $query);

            if ($data) {
                echo "<script>alert('Registration Successful!');</script>";
                echo "<script>window.location.href = 'login.php';</script>";
                exit();
            } else {
                echo "Error inserting data: " . mysqli_error($conn);
            }
        } else {
            echo "<script>alert('Passwords do not match.');</script>";
        }
    } else {
        echo "<script>alert('All fields are required.');</script>";
    }
}

?>
    