<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    // Basic validation (you should add more robust validation)
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: contact.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
        header("Location: contact.php");
        exit();
    }

    // In a real application, you'd send an email here.  For this example, we'll just set a success message.
    $to = "support@skillxchange.com"; // Replace with your email
    $email_subject = "New Contact Form Submission: $subject";
    $email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email\n\nSubject: $subject\n\nMessage:\n$message";
    $headers = "From: noreply@yourdomain.com\n"; // Replace with a valid "From" address
    $headers .= "Reply-To: $email";

     if(mail($to,$email_subject,$email_body,$headers)){
        $_SESSION['message'] = "Thank you for contacting us! We will get back to you shortly.";
     } else {
        $_SESSION['error'] = "Failed to send message. Try again Later";
     }


    header("Location: contact.php");
    exit();
} else {
    // If someone tries to access this page directly, redirect them.
    header("Location: contact.php");
    exit();
}
?>