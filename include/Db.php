<?php

//$servername = "192.168.1.184";
$servername = "localhost";
//$username = "SVAUser";
$username = "root";
//$password = "SV@H0ldings";
$password = "root1234";


$mysqlconnect = mysqli_connect($servername, $username, $password, "assets_management_db");
if (!$mysqlconnect) {
    die("Connection Failed" . mysqli_connect_error());
}
