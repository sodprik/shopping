<?php
session_start();

// ทำลาย session ทั้งหมด
session_destroy();

// ส่งผู้ใช้กลับไปยังหน้า login
header("Location: login.php");
exit();
