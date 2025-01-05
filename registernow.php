<?php
session_start();
require_once('DBConnect.php');

require_once('DBConnect.php');

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['phone'])  && isset($_POST['area']) && isset($_POST['district']) && isset($_POST['country']) && isset($_POST['birthdate'])){
    $u = $_POST['username'];
    $p = $_POST['password'];
    $e = $_POST['email'];
    $ph = $_POST['phone'];
    $a = $_POST['area'];
    $d = $_POST['district'];
    $c = $_POST['country'];
    $b = $_POST['birthdate'];
    $birthDate = new DateTime($b);
    $today = new DateTime();
    $age = $today->diff($birthDate)->y;

    if ($age < 13) {
        echo "You must be at least 13 years old to register.";
    } else {

        $sql="INSERT INTO customer VALUES ('','$u','$p','$a','$d','$c','$ph','$e','$b',0)";
          //execute this query
        $result = mysqli_query($conn, $sql);
 
        if(mysqli_affected_rows($conn) > 0){

        //RAFIA FEATURE
        $customer_id = mysqli_insert_id($conn);
        $_SESSION['ID'] = $customer_id;
        //insert into session
        $sql3="INSERT INTO session(`sessionID`, `customerID`) 
        VALUES ('','$customer_id')";
        $result3 = mysqli_query($conn, $sql3);

        
        
        //echo"Welcoming our New customer!";
        header("Location:home.php?");
        
    }else{
        echo"Insertion failed";
    }
}
}

?>

