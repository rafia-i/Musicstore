<?php
require_once('DBConnect.php');

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql="SELECT * FROM admin WHERE name='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)> 0){
        //echo"welcomee";
        header("Location: adnminhome.php");
    }else{
        echo"Wrong username or password";
    }
}

?>