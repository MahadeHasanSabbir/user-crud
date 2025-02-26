<?php

$mysqli = mysqli_connect("localhost", "root", "", "user_crud");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

?>