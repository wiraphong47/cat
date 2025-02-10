<?php
// เชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "its66040233103";
$password = "K9qlX1L3";
$dbname =  "its66040233103";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตรวจสอบว่ามีการเปลี่ยนแปลงสถานะการแสดงภาพ
if (isset($_GET['toggle_visibility']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $toggle = $_GET['toggle_visibility'] == '1' ? 0 : 1; // เปลี่ยนสถานะจาก 1 เป็น 0 หรือจาก 0 เป็น 1

    // อัปเดตสถานะ is_visible ในฐานข้อมูล
    $sql = "UPDATE CatBreeds SET is_visible = $toggle WHERE id = $id";
    $conn->query($sql);
    header("Location: visible.php"); // รีเฟรชหน้าเมื่อทำการอัปเดตแล้ว
    exit();
}

// ดึงข้อมูลจากฐานข้อมูล
$sql = "SELECT * FROM CatBreeds";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลสายพันธุ์แมว</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        h2 {
            text-align: center;
            color: #ec407a;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .btn-warning, .btn-success, .btn-danger {
            width: 100%;
            padding: 10px;
            text-align: center;
        }
        .btn-warning {
            background-color: #ff9800;
            border-color: #ff9800;
        }
        .btn-warning:hover {
            background-color: #f57c00;
            border-color: #f57c00;
        }
        .btn-success {
            background-color: #4caf50;
            border-color: #4caf50;
        }
        .btn-success:hover {
            background-color: #388e3c;
            border-color: #388e3c;
        }
        .btn-danger {
            background-color: #f44336;
            border-color: #f44336;
        }
        .btn-danger:hover {
            background-color: #d32f2f;
            border-color: #d32f2f;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Admin Dashboard</a>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="admin.php">Home Admin</a></li>
            <li class="nav-item"><a class="nav-link" href="add_cat.php">Add Cat</a></li>
            <li class="nav-item"><a class="nav-link" href="imageList.php" target="_blank">IMG</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <h2>ข้อมูลสายพันธุ์แมว</h2>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ชื่อสายพันธุ์</th>
                <th>คำอธิบาย</th>
                <th>ลักษณะ</th>
                <th>คำแนะนำการเลี้ยงดู</th>
                <th>แสดงผล</th>
                <th>จัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['name_th']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['characteristics']; ?></td>
                    <td><?php echo $row['care_instructions']; ?></td>
                    <td>
                        <?php if ($row['is_visible'] == 1) { ?>
                            <span class="badge bg-success">แสดง</span>
                        <?php } else { ?>
                            <span class="badge bg-secondary">ซ่อน</span>
                        <?php } ?>
                    </td>
                    <td>
                        <a href="edit_cat.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">แก้ไข</a>
                        <a href="?toggle_visibility=<?php echo $row['is_visible']; ?>&id=<?php echo $row['id']; ?>" class="btn btn-<?php echo ($row['is_visible'] == 1) ? 'danger' : 'success'; ?>">
                            <?php echo ($row['is_visible'] == 1) ? 'ซ่อนรูป' : 'แสดงรูป'; ?>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>



