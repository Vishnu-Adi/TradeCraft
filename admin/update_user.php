<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: ../login.php");
    exit();
}

include '../db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = intval($_POST['id']);
    $fullName = trim($_POST['fullName']);
    $email = trim($_POST['email']);
    $bio = trim($_POST['bio']);

    // Basic Input Validation
     if (empty($fullName) || empty($email)) {
        $_SESSION['error'] = "Full name and Email are required.";
        header("Location: edit_user.php?id=" . $userId);
        exit();
    }

     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
         header("Location: edit_user.php?id=" . $userId);
        exit();
    }

    // Handle file upload (if a new image was provided)
     $profileImage = null;
    if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] == 0) {
       $targetDir = "../images/profiles/"; // Note: Relative path from admin directory
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true); // Create directory if it doesn't exist
        }
        $fileName = basename($_FILES['profileImage']['name']);
        $targetFile = $targetDir . time() . "_" . $fileName;

          // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["profileImage"]["tmp_name"]);
        if($check === false) {
          $_SESSION['error'] = "File is not an image.";
            header("Location: edit_user.php?id=" . $userId);
           exit();
        }

        // Check file size  (5MB limit)
         if ($_FILES["profileImage"]["size"] > 5000000) {
          $_SESSION['error'] = "Sorry, your file is too large.";
            header("Location: edit_user.php?id=" . $userId);
           exit();
         }

        // Allow certain file formats
        $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
             $_SESSION['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            header("Location: edit_user.php?id=" . $userId);
               exit();
        }

        if (move_uploaded_file($_FILES['profileImage']['tmp_name'], $targetFile)) {
            $profileImage = $targetFile;
        }else{
          $_SESSION['error'] = "Sorry, there was an error uploading your file.";
            header("Location: edit_user.php?id=" . $userId);
           exit();
        }
    }

    // Update query (using prepared statements)
    if($profileImage){
        $stmt = $conn->prepare("UPDATE users SET fullName = ?, email = ?, bio = ?, profile_image = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $fullName, $email, $bio, $profileImage, $userId);
    } else {
        $stmt = $conn->prepare("UPDATE users SET fullName = ?, email = ?, bio = ? WHERE id = ?");
        $stmt->bind_param("sssi", $fullName, $email, $bio, $userId);
    }


    if ($stmt->execute()) {
        $_SESSION['message'] = "User updated successfully.";
        header("Location: manage_users.php"); // Redirect back to user list
        exit();
    } else {
        $_SESSION['error'] = "Failed to update user: " . $stmt->error;
         header("Location: edit_user.php?id=" . $userId); // stay on edit page with error
        exit();
    }
    $stmt->close();
} else {
     header("Location: manage_users.php"); // prevent direct access
    exit();
}
$conn->close();
?>