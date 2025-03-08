<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: ../login.php");
    exit();
}

include '../db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $skillId = intval($_POST['id']);
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $details = trim($_POST['details']);
    $category = $_POST['category'];
    $availability = trim($_POST['availability']);

    // Basic Input Validation
     if (empty($title) || empty($description)) {
        $_SESSION['error'] = "Title and short description are required.";
        header("Location: edit_skill.php?id=" . $skillId);
        exit();
    }

    // Handle Image Upload (if provided)
     $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
       $targetDir = "../images/skills/"; // Note: Relative path from admin directory
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true); // Create directory if it doesn't exist
        }
        $fileName = basename($_FILES['image']['name']);
        $targetFile = $targetDir . time() . "_" . $fileName;

          // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check === false) {
          $_SESSION['error'] = "File is not an image.";
            header("Location: edit_skill.php?id=" . $skillId);
           exit();
        }

        // Check file size  (5MB limit)
         if ($_FILES["image"]["size"] > 5000000) {
          $_SESSION['error'] = "Sorry, your file is too large.";
            header("Location: edit_skill.php?id=" . $skillId);
           exit();
         }

        // Allow certain file formats
        $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
             $_SESSION['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            header("Location: edit_skill.php?id=" . $skillId);
               exit();
        }
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imagePath = $targetFile;
        }else{
            $_SESSION['error'] = "Sorry, there was an error uploading your file.";
            header("Location: edit_skill.php?id=" . $skillId);
           exit();
        }
    }

    // Update query
    if($imagePath){
        $stmt = $conn->prepare("UPDATE skills SET title = ?, description = ?, details = ?, category = ?, availability = ?, image = ? WHERE id = ?");
        $stmt->bind_param("ssssssi", $title, $description, $details, $category, $availability, $imagePath, $skillId);
    } else {
        $stmt = $conn->prepare("UPDATE skills SET title = ?, description = ?, details = ?, category = ?, availability = ? WHERE id = ?");
        $stmt->bind_param("sssssi", $title, $description, $details, $category, $availability, $skillId);
    }


    if ($stmt->execute()) {
        $_SESSION['message'] = "Skill updated successfully.";
        header("Location: manage_skills.php");
        exit();
    } else {
        $_SESSION['error'] = "Failed to update skill: " . $stmt->error;
        header("Location: edit_skill.php?id=" . $skillId); // Stay on the edit page
        exit();
    }
    $stmt->close();

} else {
    header("Location: manage_skills.php"); // prevent direct access
    exit();
}

$conn->close();
?>