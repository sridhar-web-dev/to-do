<?php

$server_name = 'localhost';
$username = 'root';
$password = '';
$database = 'to_do';

$con = mysqli_connect($server_name, $username, $password, $database);

if(!$con)
{
    echo "Database not connected";
}
?>