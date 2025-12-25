<?php
    $host = 'localhost';
    $db   = 'user_db';
    $user = 'root';
    $pass = '';

    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        die("koneksi gagal wok!!: " . $conn->connect_error);
    } else {
        echo ("koneksi berhasil wok!!");
    }
?>