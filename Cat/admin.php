<?php
// เชื่อมต่อฐานข้อมูล (Connect to the database)
$servername = "localhost";
$username = "its66040233126";
$password = "D1ydI8L9";
$dbname =  "its66040233126";



$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// รับค่าคำค้นหาจากฟอร์ม (Get search value from form)
$search = isset($_POST['search']) ? $_POST['search'] : '';

// สร้าง SQL query สำหรับค้นหาข้อมูล (Create SQL query to search data)
$sql = "SELECT * FROM CatBreeds WHERE (name_th LIKE '%$search%' OR name_en LIKE '%$search%') AND is_visible = 1";
$result = $conn->query($sql);

$conn->close();
?>

<?php
session_start();

// ตรวจสอบว่ามีการเข้าสู่ระบบหรือยัง
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แสดงข้อมูลสายพันธุ์แมว (Display Cat Breeds Information)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: "Arial", sans-serif;
            background-color: #f3f4f6;
            color: #333;
        }
        .navbar {
            background-color: #ec407a;
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: white !important;
            font-weight: bold;
        }
        .navbar-nav .nav-link:hover {
            background-color: #d81b60;
        }
        .search-box {
            margin-bottom: 30px;
            text-align: center;
        }
        .search-box input {
            border-radius: 10px;
            padding: 15px;
            width: 60%;
            border: 2px solid #ec407a;
        }
        h2 {
            text-align: center;
            color: #d81b60;
            margin-bottom: 40px;
        }
        .cat-card {
            background-color: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .cat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
        .cat-card img {
            width: 100%;
            border-radius: 10px;
            max-height: 200px;
            object-fit: cover;
        }
        .btn-edit, .btn-delete {
            margin: 5px;
            background-color: #ec407a;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .btn-edit:hover, .btn-delete:hover {
            background-color: #d81b60;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="admin.php">Admin Panel</a>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="add_cat.php">Add Cat</a></li>
            <li class="nav-item"><a class="nav-link" href="visible.php">Edit</a></li>
            <li class="nav-item"><a class="nav-link" href="imageList.php" target="_blank">IMG</a></li>
            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        </ul>
    </div>
</nav>

<div class="container my-5">
    <h2>สายพันธุ์แมวยอดนิยม (Popular Cat Breeds)</h2>

    <form method="POST" action="">
        <div class="search-box">
            <input type="text" class="form-control" name="search" placeholder="ค้นหาสายพันธุ์แมว..." value="<?php echo htmlspecialchars($search); ?>">
        </div>
    </form>

    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='col-md-4 mb-4'>";
                echo "<div class='cat-card'>";
                echo "<h3 style='color: #ec407a;'>" . $row['name_th'] . " (" . $row['name_en'] . ")</h3>";
                echo "<img src='" . $row['image_url'] . "' alt='Image'>";
                echo "<p><strong>คำอธิบาย:</strong> " . $row['description'] . "</p>";
                echo "<p><strong>ลักษณะทั่วไป:</strong> " . $row['characteristics'] . "</p>";
                echo "<p><strong>คำแนะนำการเลี้ยงดู:</strong> " . $row['care_instructions'] . "</p>";
                echo "<a href='edit_cat.php?id=" . $row['id'] . "' class='btn-edit'>แก้ไข (Edit)</a>";
                echo "<a href='delete_cat.php?id=" . $row['id'] . "' class='btn-delete'>ลบ (Delete)</a>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p class='text-center text-danger'>ไม่มีข้อมูลแสดง (No data to display)</p>";
        }
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>



