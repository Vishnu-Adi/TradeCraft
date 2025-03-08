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
    $userId = $_SESSION['user_id'];

    // Basic input validation
    if (empty($title) || empty($description)) {
        $_SESSION['error'] = "Title and short description are required.";
        header("Location: edit_skill.php?id=" . $skillId);
        exit();
    }

     // Verify ownership before updating
    $checkStmt = $conn->prepare("SELECT id FROM skills WHERE id = ? AND user_id = ?");
    $checkStmt->bind_param("ii", $skillId, $userId);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows !== 1) {
        $_SESSION['error'] = "You do not have permission to edit this skill.";
        $checkStmt->close();
        header("Location: my_skills.php");
        exit();
    }
      $checkStmt->close();

    // Handle file upload for a new image (optional)
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
        } else {
              $_SESSION['error'] = "Sorry, there was an error uploading your file.";
              header("Location: edit_skill.php?id=" . $skillId);
              exit();
        }
    }

    // Update query based on whether an image was uploaded (using prepared statements)
    if ($imagePath) {
        $stmt = $conn->prepare("UPDATE skills SET title = ?, description = ?, details = ?, category = ?, availability = ?, image = ? WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ssssssii", $title, $description, $details, $category, $availability, $imagePath, $skillId, $userId);
    } else {
        $stmt = $conn->prepare("UPDATE skills SET title = ?, description = ?, details = ?, category = ?, availability = ? WHERE id = ? AND user_id = ?");
        $stmt->bind_param("sssssii", $title, $description, $details, $category, $availability, $skillId, $userId);
    }

    if ($stmt->execute()) {
        $_SESSION['message'] = "Skill post updated successfully.";
        header("Location: my_skills.php"); // redirect to my skills
        exit();
    } else {
        $_SESSION['error'] = "Failed to update skill post. " . $stmt->error; // detailed error message
        header("Location: edit_skill.php?id=" . $skillId);
        exit();
    }
    $stmt->close();
}else{
   header("Location: edit_skill.php?id=" . $skillId); // prevent direct access
   exit();
}
$conn->close();
?>