<?php
session_start();
require_once('DBConnect.php');

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['phone_number'])  && isset($_POST['area']) && isset($_POST['district']) && isset($_POST['country']) && isset($_POST['birthdate'])){
    $u = $_POST['username'];
    $p = $_POST['password'];
    $e = $_POST['email'];
    $ph = $_POST['phone_number'];
    $a = $_POST['area'];
    $d = $_POST['district'];
    $c = $_POST['country'];
    $b = $_POST['birthdate'];


    $sql="INSERT INTO customer VALUES ('','$u','$p','$a','$d','$c','$ph','$e','$b',0)";

   


    


    $result = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) > 0){

        //
        $customer_id = mysqli_insert_id($conn);
        $_SESSION['ID'] = $customer_id;

        
        
        //echo"Welcoming our New customer!";
        header("Location:home.php?");
        
    }else{
        echo"Insertion failed";
    }
}

?>
