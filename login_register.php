<?php

session_start();

$file = "users.json";
$users = json_decode(file_get_contents($file), true);

// === REGISTER ===
if (isset($_POST['regiser'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // cek email sudah terdaftar apa belum
    foreach ($users as $user) {
        if ($user['email'] === $email) {
            $_SESSION['error'] = "Email is already registered.";
            header("Location: index.php");
            exit();
        }
    }

    // simpan data user baru
    $users[] = [
        'name' => $name,
        'email' => $email,
        'password' => $password
    ];

    file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));
    $_SESSION['success'] = "Registration successful. Please login.";
    header("Location: index.php");
    exit();
}

// === LOGIN ===
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // cari user berdasarkan email
    foreach ($users as $user) {
        if ($user['email'] === $email) {
            // verifikasi password
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                header("Location: dashboard.php");
                exit();
            } else {
                $_SESSION['error'] = "Incorrect password.";
                header("Location: index.php");
                exit();
            }
        }
    }

    // email tidak ditemukan
    $_SESSION['error'] = "Email not found, please register first!";
    header("Location: index.php");
    exit();
}

?>