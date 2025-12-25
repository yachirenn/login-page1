<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'config.php';

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $_SESSION['register_error'] = "Email already registered!";
        $_SESSION['active_form'] = 'register';
    } else {
        $conn->query("INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')");
    }

    header('Location: index.php');
    exit();
}

if (empty($name) || empty($email) || empty($password)) {
    $_SESSION['register_error'] = "Please fill in all fields!";
    $_SESSION['active_form'] = 'register';
    header('Location: index.php');
    exit();
}


if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email = '$email'");
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];

            if ($user['role'] === 'admin') {
                header('Location: admin_dashboard.php');
            } else {
                header('Location: user_page.php');
            }

            exit();
        }
    }

    $_SESSION['login_error'] = "Invalid email or password!";
    $_SESSION['active_form'] = 'login';

    header('Location: index.php');
    exit();
}

?>