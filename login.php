<?php
session_start(); // เรียกใช้ session_start() ที่ส่วนบนของไฟล์

if (isset($_SESSION['user_login'])) {
  header("Location: index.php"); // ถ้าล็อกอินอยู่แล้วให้เด้งไปที่หน้าหลักหรือหน้าอื่นที่เหมาะสม
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #dc3545;
    }
    /* เพิ่มคลาสสำหรับโลโก้ */
    .logo {
      width: 8rem; /* ขนาดความกว้างตามที่ต้องการ */
      height: auto; /* รักษาอัตราส่วนของรูป */
    }
  </style>
</head>

<body>
  <div class="flex justify-center items-center h-screen">
    <div class="w-full max-w-sm p-6 bg-white rounded-lg shadow-lg">
      <div class="flex justify-center mb-6">
        <img src="dist/img/dnw.jpg" alt="Logo" class="logo">
      </div>

      <?php if (isset($_SESSION['error'])) { ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
          <?php
          echo $_SESSION['error'];
          unset($_SESSION['error']);
          ?>
        </div>
      <?php } ?>

      <?php if (isset($_SESSION['success'])) { ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
          <?php
          echo $_SESSION['success'];
          unset($_SESSION['success']);
          ?>
        </div>
      <?php } ?>

      <?php if (isset($_SESSION['warning'])) { ?>
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
          <?php
          echo $_SESSION['warning'];
          unset($_SESSION['warning']);
          ?>
        </div>
      <?php } ?>

      <form action="login_db.php" method="post">
        <div class="mb-4">
          <label for="username" class="block text-sm font-medium">Username</label>
          <input type="text" id="username" name="user" class="w-full px-4 py-2 rounded-lg border-gray-300 focus:border-red-500 focus:outline-none">
        </div>
        <div class="mb-4">
          <label for="password" class="block text-sm font-medium">Password</label>
          <input type="password" id="password" name="password" class="w-full px-4 py-2 rounded-lg border-gray-300 focus:border-red-500 focus:outline-none" minlength="4">
        </div>
        <button type="submit" name="signin" class="w-full py-2 rounded-lg bg-red-500 text-white font-semibold hover:bg-red-600 transition duration-300">Login</button>
      </form>
    </div>
  </div>
</body>

</html>