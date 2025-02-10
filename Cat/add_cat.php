<?php
// การเชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "its66040233126";
$password = "D1ydI8L9";
$dbname =  "its66040233126";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $name_th = $_POST['name_th'];
    $name_en = $_POST['name_en'];
    $description = $_POST['description'];
    $characteristics = $_POST['characteristics'];
    $care_instructions = $_POST['care_instructions'];
    $image_url = $_POST['image_url'];
    $is_visible = isset($_POST['is_visible']) ? 1 : 0;

    // คำสั่งเตรียมเพื่อหลีกเลี่ยงการโจมตี SQL injection
    $stmt = $conn->prepare("INSERT INTO CatBreeds (name_th, name_en, description, characteristics, care_instructions, image_url, is_visible) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssi", $name_th, $name_en, $description, $characteristics, $care_instructions, $image_url, $is_visible);

    if ($stmt->execute()) {
        echo "<script>alert('เพิ่มข้อมูลสำเร็จ'); window.location.href = 'admin.php';</script>";
    } else {
        echo "ข้อผิดพลาด: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลสายพันธุ์แมว</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
        }
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #ec407a;
        }
        .form-group label {
            font-weight: bold;
            color: #d81b60;
        }
        .form-group input, .form-group textarea {
            border-radius: 10px;
            border: 2px solid #ec407a;
        }
        .form-group input:focus, .form-group textarea:focus {
            border-color: #d81b60;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #ec407a;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #d81b60;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #ec407a;">
    <div class="container-fluid">
        <a class="navbar-brand" href="admin.php">Admin Panel</a>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="add_cat.php">Add Cat</a></li>
            <li class="nav-item"><a class="nav-link" href="imageList.php" target="_blank">IMG</a></li>
        </ul>
    </div>
</nav>

<div class="container form-container">
    <h2>เพิ่มข้อมูลสายพันธุ์แมว</h2>

    <form action="add_cat.php" method="post">
        <div class="form-group mb-3">
            <label for="name_th">ชื่อสายพันธุ์ (ไทย):</label>
            <input type="text" class="form-control" id="name_th" name="name_th" required>
        </div>

        <div class="form-group mb-3">
            <label for="name_en">ชื่อสายพันธุ์ (อังกฤษ):</label>
            <input type="text" class="form-control" id="name_en" name="name_en" required>
        </div>

        <div class="form-group mb-3">
            <label for="description">คำอธิบาย:</label>
            <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="characteristics">ลักษณะทั่วไป:</label>
            <textarea class="form-control" id="characteristics" name="characteristics" rows="3"></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="care_instructions">คำแนะนำการเลี้ยงดู:</label>
            <textarea class="form-control" id="care_instructions" name="care_instructions" rows="3"></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="image_url">URL ของรูปภาพ:</label>
            <input type="text" class="form-control" id="image_url" name="image_url">
        </div>

        <div class="form-group mb-3">
            <label for="is_visible">แสดงผลในเว็บไซต์:</label>
            <input type="checkbox" id="is_visible" name="is_visible" checked>
        </div>

        <button type="submit" name="submit" class="btn btn-primary w-100">เพิ่มข้อมูล</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>

