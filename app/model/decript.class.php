<?php

echo "Decriptografando JWT  <br> \n ";

session_start();
$jwt = $_SESSION['jwt'];

include("../../assets/jwt/decript.php");

echo $json_decoded;