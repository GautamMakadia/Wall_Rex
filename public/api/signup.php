<?php

$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$conf_password = $_POST['conf_password'];

// if is_user_exist("") returns true it means that provided 
// user is already signedup, just show user already exist or use other email address.
if (is_user_exist($email)) {
    //is_user_exist() == true
    echo "User Already Exsists";
    /** 
     * user is available in database.So, no need to add it again.
     * show apropriate message.
    */
} else {
    // upper condition is false.
    /**
     * user is not vailable in database.
     * in other words, it has not been signedup previously.
     * So, we get the user entered form data and insert into the database.
     */
    $connection = mysqli_connect("localhost","root","","project");
    $query = "INSERT INTO user (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
    if (!mysqli_query($connection, $query)) {
        echo "insert failed.";
    }
    else{
        echo "Insert Succesfully";
    }
     // create connection
     // create insert query
     // execute insert query with if (!mysqli_query($con, $query)) {echo "insert failed."}.
     // redirect user to login page.
}

function is_user_exist($email) {
    try {
        $connection = mysqli_connect("localhost","root","","project");
        $query = "SELECT email FROM user WHERE email = '".$email."'";
        $result = mysqli_query($connection, $query);
	    $result_data = mysqli_fetch_assoc($result);
        mysqli_close($connection);
        if(isset($result_data['email']) && $email == $result_data['email'])
        {
            return true;
		}  else {
			return false;
		}
    }
    catch(mysqli_sql_exception $e)
    {
        echo "SQL Error";
         return false;
    }
        // check whether user ($email) exist in database or not
        // if yes the return true else false
}
?>