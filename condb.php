<?php
$servername = "localhost";
$username = "root"; // ชื่อผู้ใช้ของคุณ
$password = "root"; // รหัสผ่านของคุณ
$dbname = "dnw"; // ชื่อฐานข้อมูล

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // กำหนดโหมดของ PDO เป็น Exception Mode
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
