<?php

session_start();

if(@$_GET['user_id']==true)
{
    unset($_SESSION['username']);
    echo "<script>alert('Logout Successfully');window.location.replace('./index.php');</script>";
}


?>