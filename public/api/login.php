<?php

// Create a connection
$connection = mysqli_connect("localhost","root","","project");

if (!$connection){
    echo "connection error";
}
// Connection successful, perform your database operations here...
$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT email, password FROM user WHERE email = '".$email."'";

$result = mysqli_query($connection, $query);

$result_data = mysqli_fetch_assoc($result);

// Close the connection
mysqli_close($connection);

if (verify_login_detailes($result_data, $email, $password)) {
    
    echo "Login successful !";
} else {
    echo "Login failed. Please try again !";
}

function verify_login_detailes($result, $email, $password) {
    return $result["email"] == $email
        && $result["password"] == $password;   
}


?>