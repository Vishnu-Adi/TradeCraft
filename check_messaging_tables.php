<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
include 'db_connect.php';

echo "<h2>Messaging Database Check</h2>";

// Check if tables exist
$tables = ['conversations', 'conversation_participants', 'messages'];
$missing_tables = [];

foreach ($tables as $table) {
    $result = $conn->query("SHOW TABLES LIKE '$table'");
    if ($result->num_rows === 0) {
        $missing_tables[] = $table;
    }
}

if (count($missing_tables) > 0) {
    echo "<div style='color: red; font-weight: bold;'>Missing tables: " . implode(', ', $missing_tables) . "</div>";
    echo "<p>Please run the SQL script in <code>database_messaging_setup.sql</code> to create the missing tables.</p>";
    
    // Show a button to run the SQL script
    echo '<form action="" method="post">';
    echo '<input type="submit" name="create_tables" value="Create Missing Tables">';
    echo '</form>';
    
    // Handle creating tables if button is pressed
    if (isset($_POST['create_tables'])) {
        try {
            // Read SQL file
            $sql = file_get_contents('database_messaging_setup.sql');
            
            // Execute queries
            if ($conn->multi_query($sql)) {
                echo "<div style='color: green;'>Tables created successfully! Please <a href='messages.php'>go back to messages</a>.</div>";
            }
        } catch (Exception $e) {
            echo "<div style='color: red;'>Error creating tables: " . $e->getMessage() . "</div>";
        }
    }
} else {
    echo "<div style='color: green;'>✓ All required tables exist.</div>";
    
    // Check columns in messages table
    $result = $conn->query("SHOW COLUMNS FROM messages LIKE 'is_read'");
    if ($result->num_rows === 0) {
        echo "<div style='color: red;'>The 'is_read' column is missing from the messages table!</div>";
    } else {
        echo "<div style='color: green;'>✓ 'is_read' column exists in the messages table.</div>";
    }
    
    // Table structures look good, check for other possible issues
    echo "<h3>Other Checks:</h3>";
    
    // Check if there are any conversations
    $result = $conn->query("SELECT COUNT(*) as count FROM conversations");
    $count = $result->fetch_assoc()['count'];
    echo "<div>Number of conversations in database: $count</div>";
    
    // Check message count
    $result = $conn->query("SELECT COUNT(*) as count FROM messages");
    $count = $result->fetch_assoc()['count'];
    echo "<div>Number of messages in database: $count</div>";
    
    echo "<p>If you're still having problems with the messages page loading blank, try the following:</p>";
    echo "<ol>";
    echo "<li>Check if the <code>conversations</code> query in messages.php is causing errors</li>";
    echo "<li>Make sure you have the proper permissions for the SQL user</li>";
    echo "<li>Verify that all foreign key references are correct</li>";
    echo "</ol>";
    
    echo "<a href='messages.php'>Return to Messages</a>";
}

$conn->close();
?>