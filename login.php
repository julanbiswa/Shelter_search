<?php

session_start();
include("loginconn.php");
error_reporting(0);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shelter Search</title>

    <link rel="stylesheet" href="Login.css">

</head>

<body>

<div class="logopic">
    
</div>



<div class="dpicture">
    
</div>
    <!-- Login Form -->

    <form id="loginform" action="#" name="loginform" method="POST" >

   

        <h2>Login for Shelter Search</h2>

        <p>Mangae, Search, and Streamline effortlessly</p>



        <div class="division">
            <p>-------------------------------Or---------------------------------</p>
        </div>

        <div class="formdesign">
            <label for="loginEmail">Email:</label>
            <!-- <span id="errorMessage"></span> -->
            <input type="text" name="Email" id="loginEmail" placeholder="Enter your email">
        </div>

        <div class="formdesign">
            <label for="loginPassword">Password:</label>
            <input type="password" name="Password" id="loginPassword" placeholder="Enter your password">
        </div>

        <button type="submit" onclick="validate()" name="slogin">Login</button>

        <p id="loginError" style="color: red; display: none;">Account already exists with this email.</p>

        <p class="modechange"><a href="register.php">Create an account!</a></p>

    </form>





    </div>

    
</body>

</html>


<?php

if (isset($_POST['slogin'])) {

    $lusername = $_POST["Email"];
    $lpassword = $_POST["Password"];

    $lquery = "SELECT * FROM logindata WHERE email = '$lusername' && Password = '$lpassword' ";
    $data = mysqli_query($conn, $lquery);

    $total = mysqli_num_rows($data);

    // echo $total;

    if ($total == 1) {
        // echo "<script>alert('Registration Successful!');</script>";
        $row = mysqli_fetch_assoc($data);
        $_SESSION["user_id"] = $row["id"];
        header('Location: mainbody.php');
        exit(); 
    } else {
        echo "<script>alert('Invalid Email or Password!');</script>";
        exit();
    }


}



?>