<?php 
$servername="localhost";
$username= "root";
$password= "";
$dbname= "musicstore";

//create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//check connection
if ($conn->connect_error) {
    die("Connection failed". $conn->connect_error);
}else{
    //echo"Connected successfully";
    mysqli_select_db($conn, $dbname);
}
?>