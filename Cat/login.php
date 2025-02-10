<?php
session_start();

// ตรวจสอบว่ามีการส่งข้อมูลมาหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // เช็ค username และ password
    if ($username === "66040233103" && $password === "beem25472547m") {
        $_SESSION["admin_logged_in"] = true; // ตั้งค่าสถานะ login
        header("Location: admin.php"); // ไปที่หน้า admin
        exit();
    } else {
        $error = "Username หรือ Password ไม่ถูกต้อง!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 400px;
            margin-top: 100px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #ec407a;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-primary {
            width: 100%;
            padding: 10px;
            background-color: #ec407a;
            border-color: #ec407a;
        }
        .btn-primary:hover {
            background-color: #d81b60;
            border-color: #d81b60;
        }
        .alert {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>เข้าสู่ระบบ Admin</h2>

        <!-- การแสดงข้อความ error ถ้ามี -->
        <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>

