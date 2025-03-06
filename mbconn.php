<?php

$servername = "localhost";   
$username = "root";   
$password = "";   
$dbname = "userdata";

$conn = mysqli_connect($servername, $username,$password,$dbname);

if($conn){
//    echo "Connection success";
}else{
    echo "Connection error!";
}

?>