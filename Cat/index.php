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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แสดงข้อมูลสายพันธุ์แมว (Display Cat Breeds Information)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }
        .navbar {
            margin-bottom: 30px;
        }
        .cat-card {
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            background-color: white;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .cat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        }
        .cat-card img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .container {
            margin-top: 50px;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #ec407a;
        }
        .btn-edit, .btn-delete {
            margin: 5px;
        }
        .search-box {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #ec407a;">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Home</a>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="admin.php">Login</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <h2>สายพันธุ์แมวยอดนิยม (Popular Cat Breeds)</h2>

    <!-- ฟอร์มค้นหาข้อมูล (Search form) -->
    <form method="POST" action="">
        <div class="search-box">
            <input type="text" class="form-control" name="search" placeholder="ค้นหาสายพันธุ์แมว... (Search for cat breeds...)" value="<?php echo htmlspecialchars($search); ?>">
        </div>
    </form>

    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='col-md-4'>";
                echo "<div class='cat-card'>";
                echo "<h3>" . $row['name_th'] . " (" . $row['name_en'] . ")</h3>";
                echo "<img src='" . $row['image_url'] . "' alt='Image'>";
                echo "<p><strong>คำอธิบาย:</strong> " . $row['description'] . "</p>";
                echo "<p><strong>ลักษณะทั่วไป:</strong> " . $row['characteristics'] . "</p>";
                echo "<p><strong>คำแนะนำการเลี้ยงดู:</strong> " . $row['care_instructions'] . "</p>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>ไม่มีข้อมูลแสดง (No data to display)</p>";
        }
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>

