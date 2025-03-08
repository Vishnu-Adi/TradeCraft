<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $skillId = intval($_POST['id']);
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $details = trim($_POST['details']);
    $category = $_POST['category'];
    $availability = trim($_POST['availability']);
    
    // Handle file upload for a new image (optional)
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
    
    if ($imagePath) {
        $stmt = $conn->prepare("UPDATE skills SET title = ?, description = ?, details = ?, category = ?, availability = ?, image = ? WHERE id = ?");
        $stmt->bind_param("ssssssi", $title, $description, $details, $category, $availability, $imagePath, $skillId);
    } else {
        $stmt = $conn->prepare("UPDATE skills SET title = ?, description = ?, details = ?, category = ?, availability = ? WHERE id = ?");
        $stmt->bind_param("sssssi", $title, $description, $details, $category, $availability, $skillId);
    }
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Skill post updated successfully.";
        header("Location: skill_detail.php?id=" . $skillId);
        exit();
    } else {
        $_SESSION['error'] = "Failed to update skill post.";
        header("Location: edit_skill.php?id=" . $skillId);
        exit();
    }
    $stmt->close();
}
?>
