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

    // Handle file upload if a file was submitted
    $profileImage = null;
    if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] == 0) {
        $targetDir = "images/profiles/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $fileName = basename($_FILES['profileImage']['name']);
        $targetFile = $targetDir . time() . "_" . $fileName;
        if (move_uploaded_file($_FILES['profileImage']['tmp_name'], $targetFile)) {
            $profileImage = $targetFile;
        }
    }

    // Update query based on whether an image was uploaded
    if ($profileImage) {
        $stmt = $conn->prepare("UPDATE users SET fullName = ?, bio = ?, profile_image = ? WHERE id = ?");
        $stmt->bind_param("sssi", $fullName, $bio, $profileImage, $userId);
    } else {
        $stmt = $conn->prepare("UPDATE users SET fullName = ?, bio = ? WHERE id = ?");
        $stmt->bind_param("ssi", $fullName, $bio, $userId);
    }

    if ($stmt->execute()) {
        $_SESSION['user_name'] = $fullName;
        $_SESSION['message'] = "Profile updated successfully.";
        header("Location: profile.php");
        exit();
    } else {
        $_SESSION['error'] = "Profile update failed. Please try again.";
        header("Location: profile.php");
        exit();
    }
    $stmt->close();
}
?>
