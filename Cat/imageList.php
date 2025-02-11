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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เลือกดูรูปภาพแมว</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
        }
        .container {
            margin-top: 50px;
        }
        .img-card {
            text-align: center;
            margin-bottom: 30px;
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 15px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .img-card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }
        .img-card img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .img-card a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }
        .row {
            margin-bottom: 30px;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #ec407a;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #ec407a;">
    <div class="container-fluid">
        <a class="navbar-brand" href="admin.php">Admin Panel</a>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="add_cat.php">Add Cat</a></li>
            <li class="nav-item"><a class="nav-link" href="imageList.php">IMG</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <h2>เลือกดูรูปภาพแมว</h2>

    <div class="row">
        <?php
        // รายการรูปภาพแมว
        $imageList = [
            "Bengal1.jpg", "Bengal2.jpg", "British Shorthair1.jpg", "British Shorthair2.jpg",
            "Exotic1.jpg", "Exotic2.jpg", "Exotic3.jpg", "Main Coon1.jpg", "Main Coon2.jpg",
            "Main Coon3.jpg", "Top 10 Cats_2.jpg", "americanShorthair1.jpg", "americanShorthair2.jpg",
            "americanShorthair3.jpg", "khaomanee1.jpg", "khaomanee2.jpg", "khaomanee3.jpg",
            "korat1.jpg", "korat2.jpg", "korat3.jpg", "persia1.jpg", "persia2.jpg", "persia3.jpg",
            "scotichfold1.jpg", "scotichfold2.jpg", "scotichfold3.jpg", "shorthair1.jpg", "siamese1.jpg",
            "siamese2.jpg", "siamese3.jpg"
        ];

        $count = 0;
        foreach ($imageList as $image) {
            $imageName = pathinfo($image, PATHINFO_FILENAME);
            // ปรับ URL ตามที่ต้องการ
            $url = "https://hosting.udru.ac.th/{$username}/cat/Cat/{$image}";

            // ทุกๆ 4 รูปภาพ เริ่มแถวใหม่
            if ($count % 4 == 0 && $count != 0) {
                echo "</div><div class='row'>";
            }

            echo "<div class='col-md-3'>";
            echo "<div class='img-card'>";
            echo "<a href='{$url}' target='_blank'>";
            echo "<img src='{$url}' alt='{$imageName}'>";
            echo "<span>{$imageName}</span>";
            echo "</a>";
            echo "</div>";
            echo "</div>";

            $count++;
        }
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>

