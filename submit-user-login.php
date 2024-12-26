<?php
//test
session_start(); // Start session at the beginning of the script
//
require_once('DBConnect.php');

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql="SELECT * FROM CUSTOMER WHERE name='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)> 0){
        //test
        // Get the ID (the primary key)
        $row = mysqli_fetch_assoc($result);
        $ID = $row['ID']; 
        // Store userID in session
        $_SESSION['ID'] = $ID;
        


        //echo"customer id: $ID";
        header("Location:home.php");
    }else{
        echo"Wrong username or password";
    }
}

?>