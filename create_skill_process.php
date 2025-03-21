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

    // Basic input validation
    if (empty($title) || empty($description)) {
        $_SESSION['error'] = "Title and short description are required.";
        header("Location: create_skill.php");
        exit();
    }

    // Handle file upload for skill image (optional)
    $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "images/skills/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true); // Create directory if it doesn't exist
        }
        $fileName = basename($_FILES['image']['name']);
        $targetFile = $targetDir . time() . "_" . $fileName;

          // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check === false) {
          $_SESSION['error'] = "File is not an image.";
           header("Location: create_skill.php");
           exit();
        }

        // Check file size  (5MB limit)
         if ($_FILES["image"]["size"] > 5000000) {
          $_SESSION['error'] = "Sorry, your file is too large.";
          header("Location: create_skill.php");
          exit();
         }

        // Allow certain file formats
        $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
             $_SESSION['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
              header("Location: create_skill.php");
               exit();
        }

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imagePath = $targetFile;
        } else {
            $_SESSION['error'] = "Sorry, there was an error uploading your file.";
              header("Location: create_skill.php");
              exit();
        }
    }

    // Insert the new skill post into the database (using prepared statements)
    $stmt = $conn->prepare("INSERT INTO skills (user_id, title, description, details, category, availability, image, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("issssss", $userId, $title, $description, $details, $category, $availability, $imagePath);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Skill post created successfully.";
        header("Location: my_skills.php"); // Redirect to the user's skills page
        exit();
    } else {
        $_SESSION['error'] = "Failed to create skill post. " . $stmt->error;  // Include detailed error
        header("Location: create_skill.php");
        exit();
    }
    $stmt->close();
} else{
   header("Location: create_skill.php"); // prevent direct access
   exit;
}
$conn->close();