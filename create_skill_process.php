<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['user_id'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $details = trim($_POST['details']);
    $category = $_POST['category'];
    $availability = trim($_POST['availability']);
    
    // Handle file upload for skill image (optional)
    $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "images/skills/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $fileName = basename($_FILES['image']['name']);
        $targetFile = $targetDir . time() . "_" . $fileName;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imagePath = $targetFile;
        }
    }
    
    // Insert the new skill post into the database
    $stmt = $conn->prepare("INSERT INTO skills (user_id, title, description, details, category, availability, image, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("issssss", $userId, $title, $description, $details, $category, $availability, $imagePath);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Skill post created successfully.";
        header("Location: skills.php");
        exit();
    } else {
        $_SESSION['error'] = "Failed to create skill post.";
        header("Location: create_skill.php");
        exit();
    }
    $stmt->close();
}
?>
