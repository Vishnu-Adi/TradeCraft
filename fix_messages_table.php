<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
include 'db_connect.php';

echo "<h2>Messages Table Fix</h2>";

// Check if is_read column exists
$result = $conn->query("SHOW COLUMNS FROM messages LIKE 'is_read'");

if ($result->num_rows === 0) {
    echo "<p>The 'is_read' column is missing from the messages table. Attempting to add it now...</p>";
    
    // Alter table to add is_read column
    $alter_query = "ALTER TABLE messages 
                    ADD COLUMN is_read TINYINT(1) NOT NULL DEFAULT 0 AFTER message,
                    ADD COLUMN read_at DATETIME DEFAULT NULL AFTER is_read";
    
    if ($conn->query($alter_query)) {
        echo "<div style='color: green; margin: 20px 0;'>✅ Successfully added 'is_read' and 'read_at' columns to the messages table!</div>";
        
        // Update all existing messages from other users as read
        $update_query = "UPDATE messages SET is_read = 1, read_at = NOW()";
        if ($conn->query($update_query)) {
            echo "<div style='color: green;'>✅ All existing messages marked as read.</div>";
        } else {
            echo "<div style='color: red;'>Error updating existing messages: " . $conn->error . "</div>";
        }
    } else {
        echo "<div style='color: red;'>Error adding columns: " . $conn->error . "</div>";
    }
} else {
    echo "<div style='color: green;'>✅ The 'is_read' column already exists in the messages table.</div>";
}

echo "<p style='margin-top: 20px;'><a href='messages.php' class='btn btn-primary'>Go to Messages</a></p>";

$conn->close();
?>