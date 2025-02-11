<?php
// เชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "its66040233126";
$password = "D1ydI8L9";
$dbname = "its66040233126";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// รับค่าคำค้นหาจากฟอร์ม
$search = isset($_POST['search']) ? $_POST['search'] : '';

// คิวรี่ข้อมูลแมว
$sql = "SELECT * FROM CatBreeds WHERE (name_th LIKE '%$search%' OR name_en LIKE '%$search%') AND is_visible = 1";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แสดงข้อมูลสายพันธุ์แมว</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: "Arial", sans-serif; background-color: #f3f4f6; color: #333; }
        .navbar { background-color: #ec407a; }
        .navbar-brand, .navbar-nav .nav-link { color: white !important; font-weight: bold; }
        .navbar-nav .nav-link:hover { background-color: #d81b60; }
        .search-box { text-align: center; margin-bottom: 30px; }
        .search-box input { border-radius: 10px; padding: 15px; width: 60%; border: 2px solid #ec407a; }
        h2 { text-align: center; color: #d81b60; margin-bottom: 40px; }
        .cat-card {
            background-color: white; border-radius: 15px; padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            min-height: 100%; display: flex; flex-direction: column;
        }
        .cat-card:hover { transform: translateY(-10px); box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); }
        .cat-card img { width: 100%; border-radius: 10px; max-height: 200px; object-fit: cover; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Home</a>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="admin.php">Login</a></li>
        </ul>
    </div>
</nav>

<div class="container my-5">
    <h2>สายพันธุ์แมวยอดนิยม</h2>

    <!-- ฟอร์มค้นหา -->
    <form method="POST" action="">
        <div class="search-box">
            <input type="text" class="form-control form-control-lg" name="search" placeholder="ค้นหาสายพันธุ์แมว..." value="<?php echo htmlspecialchars($search); ?>">
        </div>
    </form>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='col'>";
                echo "<div class='cat-card h-100 d-flex flex-column'>";
                echo "<h3 class='text-center' style='color: #ec407a;'>" . $row['name_th'] . " (" . $row['name_en'] . ")</h3>";
                echo "<img src='" . $row['image_url'] . "' alt='Image'>";
                echo "<p><strong>คำอธิบาย:</strong> " . $row['description'] . "</p>";
                echo "<p><strong>ลักษณะทั่วไป:</strong> " . $row['characteristics'] . "</p>";
                echo "<p><strong>คำแนะนำการเลี้ยงดู:</strong> " . $row['care_instructions'] . "</p>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p class='text-center text-danger'>ไม่มีข้อมูลแสดง</p>";
        }
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>

<?php $conn->close(); ?>
