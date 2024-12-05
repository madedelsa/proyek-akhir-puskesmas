<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "projek_puskesmas";

    $conn = mysqli_connect($hostname, $username, $password, $database);

    if($conn){
        // echo "sudah terhubung";
    } else{
        echo "gagal terhubung";
    }
?>