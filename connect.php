<?php

$host = 'localhost';
$user = 'root';
$password = 'Put1n4yl4k';
$dbname = 'kp';

$conn = mysqli_connect($host, $user, $password) or die("koneksi gagal");
mysqli_select_db($conn, $dbname) or die('database not found');
