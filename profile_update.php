<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['user_id'];
    $fullName = trim($_POST['fullName']);
    $bio = trim($_POST['bio']);

    // Basic input validation
    if (empty($fullName)) {
        $_SESSION['error'] = "Full name is required.";
        header("Location: profile.php");
        exit();
    }

    // Handle file upload if a file was submitted
    $profileImage = null;
    if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] == 0) {
       $targetDir = "images/profiles/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true); // Create directory if it doesn't exist
        }
        $fileName = basename($_FILES['profileImage']['name']);
        $targetFile = $targetDir . time() . "_" . $fileName;

          // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["profileImage"]["tmp_name"]);
        if($check === false) {
          $_SESSION['error'] = "File is not an image.";
           header("Location: profile.php");
           exit();
        }

        // Check file size  (5MB limit)
         if ($_FILES["profileImage"]["size"] > 5000000) {
          $_SESSION['error'] = "Sorry, your file is too large.";
           header("Location: profile.php");
           exit();
         }

        // Allow certain file formats
        $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
             $_SESSION['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
              header("Location: profile.php");
               exit();
        }

        if (move_uploaded_file($_FILES['profileImage']['tmp_name'], $targetFile)) {
            $profileImage = $targetFile;
        }else{
           $_SESSION['error'] = "Sorry, there was an error uploading your file.";
           header("Location: profile.php");
           exit();
        }
    }

    // Update query based on whether an image was uploaded (using prepared statements)
    if ($profileImage) {
        $stmt = $conn->prepare("UPDATE users SET fullName = ?, bio = ?, profile_image = ? WHERE id = ?");
        $stmt->bind_param("sssi", $fullName, $bio, $profileImage, $userId);
    } else {
        $stmt = $conn->prepare("UPDATE users SET fullName = ?, bio = ? WHERE id = ?");
        $stmt->bind_param("ssi", $fullName, $bio, $userId);
    }

    if ($stmt->execute()) {
        $_SESSION['user_name'] = $fullName;  // Update the session with the new name
        $_SESSION['message'] = "Profile updated successfully.";
        header("Location: profile.php");
        exit();
    } else {
        $_SESSION['error'] = "Profile update failed. Please try again. " . $stmt->error;
        header("Location: profile.php");
        exit();
    }
    $stmt->close();
} else {
    header("Location: profile.php"); // Prevent direct access
    exit();
}
$conn->close();
?>