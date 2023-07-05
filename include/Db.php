<?php


$servername = "localhost";

$username = "root";

$password = "root1234";


$mysqlconnect = mysqli_connect($servername, $username, $password, "assets_management_db");
if (!$mysqlconnect) {
    die("Connection Failed" . mysqli_connect_error());
}
