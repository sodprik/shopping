<?php
session_start();
require_once('condb.php');

if (isset($_POST['signin'])) {
    $user = $_POST['user'];
    $password = $_POST['password'];

    if (empty($user) || empty($password)) {
        $_SESSION['error'] = 'Please enter both username and password!';
        header("location: login.php");
        exit();
    } else {
        try {
            $check_data = $conn->prepare("SELECT * FROM users WHERE user = :user");
            $check_data->bindParam(":user", $user);
            $check_data->execute();
            $row = $check_data->fetch(PDO::FETCH_ASSOC);

            if ($check_data->rowCount() > 0) {
                if (password_verify($password, $row['password'])) {
                    if ($row['urole'] == 'admin') {
                        $_SESSION['admin_login'] = $row['user_id'];
                        header("location: admin/index.php");
                        exit();
                    } else {
                        $_SESSION['user_login'] = $row['user_id'];
                        header("location: index.php");
                        exit();
                    }
                } else {
                    $_SESSION['error'] = "Password is incorrect!";
                    header("location: login.php");
                    exit();
                }
            } else {
                $_SESSION['error'] = "Username is incorrect!";
                header("location: login.php");
                exit();
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
