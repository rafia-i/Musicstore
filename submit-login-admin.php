<!--Shreya-->
<?php
require_once('DBconnect.php');
if(isset($_POST['adminID']) && isset($_POST['password'])) {
    $u=$_POST['adminID'];
    $p=$_POST['password'];
    $sql="SELECT * FROM admin where ID='$u' AND password='$p'";
    $result =mysqli_query($conn,$sql);
    if (mysqli_num_rows($result)!=0) {

        header(header:"location:home-admin.php");
        echo("<script> alert('User Successfull Added')</script>");


    }
    else {

        header(header:"location:new.php");

    }
}
?>