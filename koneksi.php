<?php
$servername = "localhost";
$database = "db_kartu";
$username = "root";
$password = "";

//koneksi untuk mengambil  database diatas
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("koneksi gagal : " . mysqli_connect_error());
} else {
    echo "";
}
?>