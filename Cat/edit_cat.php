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

// ตรวจสอบว่ามีการส่ง id มาหรือไม่ (Check if id is sent)
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // ดึงข้อมูลที่จะแก้ไข (Fetch data to edit)
    $sql = "SELECT * FROM CatBreeds WHERE id = $id";
    $result = $conn->query($sql);
    $cat = $result->fetch_assoc();
}

// ตรวจสอบว่า submit form หรือไม่ (Check if form is submitted)
if (isset($_POST['submit'])) {
    // รับข้อมูลจากฟอร์ม (Get data from form)
    $name_th = $_POST['name_th'];
    $name_en = $_POST['name_en'];
    $description = $_POST['description'];
    $characteristics = $_POST['characteristics'];
    $care_instructions = $_POST['care_instructions'];
    $image_url = $_POST['image_url'];
    $is_visible = isset($_POST['is_visible']) ? 1 : 0;
    
    // สร้าง SQL query สำหรับการอัปเดตข้อมูล (Create SQL query to update data)
    $sql = "UPDATE CatBreeds SET 
            name_th = '$name_th', 
            name_en = '$name_en', 
            description = '$description', 
            characteristics = '$characteristics', 
            care_instructions = '$care_instructions', 
            image_url = '$image_url', 
            is_visible = '$is_visible' 
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('แก้ไขข้อมูลสำเร็จ'); window.location.href = 'index.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลสายพันธุ์แมว (Edit Cat Breed Information)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }
        .navbar {
            margin-bottom: 30px;
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            background-color: white;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #ec407a;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn-primary {
            width: 100%;
        }
        .navbar-nav .nav-link {
            color: white !important;
        }
        .navbar-nav .nav-link:hover {
            color: #ec407a !important;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #ec407a;">
    <div class="container-fluid">
        <a class="navbar-brand" href="admin.php">Home Admin</a>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="add_cat.php">Add Cat</a></li>
            <li class="nav-item"><a class="nav-link" href="imageList.php" target="_blank">IMG</a></li>
        </ul>
    </div>
</nav>

<div class="container form-container">
    <h2>แก้ไขข้อมูลสายพันธุ์แมว (Edit Cat Breed Information)</h2>

    <form action="edit_cat.php?id=<?php echo $cat['id']; ?>" method="post">
        <div class="form-group">
            <label for="name_th">ชื่อสายพันธุ์ (ไทย): (Breed Name (Thai))</label>
            <input type="text" class="form-control" id="name_th" name="name_th" value="<?php echo $cat['name_th']; ?>" required>
        </div>

        <div class="form-group">
            <label for="name_en">ชื่อสายพันธุ์ (อังกฤษ): (Breed Name (English))</label>
            <input type="text" class="form-control" id="name_en" name="name_en" value="<?php echo $cat['name_en']; ?>" required>
        </div>

        <div class="form-group">
            <label for="description">คำอธิบาย: (Description)</label>
            <textarea class="form-control" id="description" name="description" rows="5" required><?php echo $cat['description']; ?></textarea>
        </div>

        <div class="form-group">
            <label for="characteristics">ลักษณะทั่วไป: (Characteristics)</label>
            <textarea class="form-control" id="characteristics" name="characteristics" rows="3"><?php echo $cat['characteristics']; ?></textarea>
        </div>

        <div class="form-group">
            <label for="care_instructions">คำแนะนำการเลี้ยงดู: (Care Instructions)</label>
            <textarea class="form-control" id="care_instructions" name="care_instructions" rows="3"><?php echo $cat['care_instructions']; ?></textarea>
        </div>

        <div class="form-group">
            <label for="image_url">URL ของรูปภาพ: (Image URL)</label>
            <input type="text" class="form-control" id="image_url" name="image_url" value="<?php echo $cat['image_url']; ?>">
        </div>

        <div class="form-group">
            <label for="is_visible">แสดงผล: (Visible)</label>
            <input type="checkbox" id="is_visible" name="is_visible" <?php echo ($cat['is_visible'] == 1) ? 'checked' : ''; ?>>
        </div>

        <button type="submit" class="btn btn-primary" name="submit">แก้ไขข้อมูล (Edit Information)</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>

