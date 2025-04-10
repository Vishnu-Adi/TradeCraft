# Messaging Feature Setup

This document explains how to properly set up the messaging feature in the Community Skill Exchange application.

## Database Setup

The messaging system requires three tables in your database:
1. `conversations` - Stores conversation metadata
2. `conversation_participants` - Links users to conversations
3. `messages` - Stores the actual messages

### Steps to set up the database:

1. Open your database management tool (phpMyAdmin)
2. Select your database (`community_skill_exchange`)
3. Import the SQL file `database_messaging_setup.sql` provided with this project
   - You can also copy and paste the SQL code if direct import isn't working

### Checking if tables already exist:

Before importing, you can check if these tables already exist with these SQL queries:

```sql
SHOW TABLES LIKE 'conversations';
SHOW TABLES LIKE 'conversation_participants';
SHOW TABLES LIKE 'messages';
```

If any are missing, run the setup script to create them.

## Troubleshooting Common Issues

### "Cannot start a conversation" error:
- Make sure your database has all three required tables
- Check that the `conversations` table has a `created_at` column

### "Message not sending" issue:
- Ensure the `is_read` column exists in the `messages` table 
- Verify that the user has permissions to write to the database

### "Contact button not working" problem:
- Check that the URL in skill_detail.php correctly points to messages.php with a recipient_id parameter
- Ensure you're logged in before trying to contact someone

## UI Features

The messaging interface includes:
- Real-time message status indicators (sent/read)
- Mobile responsive design with sidebar navigation
- Message search functionality
- Unread message badges

## Styling and Images

The user interface depends on:
- FontAwesome icons (already included in the header)
- The message-illustration.svg image (located in the images folder)

If any UI elements look incorrect, check that these dependencies are properly loaded.