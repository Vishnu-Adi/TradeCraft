<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: ../login.php");
    exit();
}

include 'admin_header.php';
include '../db_connect.php';


// Fetch conversations with more details
$stmt = $conn->prepare("
    SELECT
        c.id AS conversation_id,
        GROUP_CONCAT(DISTINCT u.fullName ORDER BY u.id SEPARATOR ', ') AS participants,
        (SELECT message FROM messages WHERE conversation_id = c.id ORDER BY created_at DESC LIMIT 1) AS last_message,
        (SELECT created_at FROM messages WHERE conversation_id = c.id ORDER BY created_at DESC LIMIT 1) AS last_activity,
        (SELECT COUNT(*) FROM messages WHERE conversation_id = c.id) AS message_count
    FROM conversations c
    JOIN conversation_participants cp ON c.id = cp.conversation_id
    JOIN users u ON cp.user_id = u.id
    GROUP BY c.id
    ORDER BY last_activity DESC
");

$stmt->execute();
$result = $stmt->get_result();
$conversations = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Calculate stats
$totalMessages = 0;
$activeToday = 0;
$today = date('Y-m-d');

foreach ($conversations as $conv) {
    $totalMessages += $conv['message_count'];
    if (!empty($conv['last_activity']) && substr($conv['last_activity'], 0, 10) === $today) {
        $activeToday++;
    }
}
?>
<style> <?php include '../css/admin_style.css';?> </style>

<div class="admin-dashboard">
    <div class="container py-4">
        <!-- Page Header -->
        <div class="admin-header d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h2 mb-1">Conversation Management</h1>
                <p class="text-muted">Monitor and manage user conversations across the platform</p>
            </div>
            <div class="admin-actions">
                <a href="export_messages.php" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-download me-1"></i> Export Data
                </a>
            </div>
        </div>
        
        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="stats-card bg-info text-white">
                    <div class="stats-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <div class="stats-info">
                        <h3><?= number_format(count($conversations)) ?></h3>
                        <p>Total Conversations</p>
                    </div>
                    <div class="stats-link">
                        <a href="#" class="text-white" data-bs-toggle="tooltip" title="View details">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card bg-primary text-white">
                    <div class="stats-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="stats-info">
                        <h3><?= number_format($totalMessages) ?></h3>
                        <p>Total Messages</p>
                    </div>
                    <div class="stats-link">
                        <a href="#" class="text-white" data-bs-toggle="tooltip" title="View details">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card bg-success text-white">
                    <div class="stats-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stats-info">
                        <h3><?= number_format($activeToday) ?></h3>
                        <p>Active Today</p>
                    </div>
                    <div class="stats-link">
                        <a href="#" class="text-white" data-bs-toggle="tooltip" title="View details">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Search and Filter Section -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-3 align-items-center">
                    <div class="col-md-6">
                        <form action="" method="GET" class="d-flex">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search conversations..." 
                                    value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div class="btn-group">
                            <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-filter me-1"></i> Filter
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="?filter=today">Today's Conversations</a></li>
                                <li><a class="dropdown-item" href="?filter=week">This Week</a></li>
                                <li><a class="dropdown-item" href="?filter=inactive">Inactive (>30 days)</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="manage_messages.php">Clear Filters</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Messages Table -->
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">All Conversations</h5>
                <div>
                    <span class="badge bg-light text-dark">
                        <?= count($conversations) ?> <?= count($conversations) == 1 ? 'conversation' : 'conversations' ?> found
                    </span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%">ID</th>
                                <th style="width: 25%">Participants</th>
                                <th style="width: 35%">Last Message</th>
                                <th style="width: 10%" class="text-center">Messages</th>
                                <th style="width: 15%">Last Activity</th>
                                <th style="width: 10%" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($conversations) > 0): ?>
                                <?php foreach ($conversations as $conv): ?>
                                    <tr>
                                        <td><strong>#<?= htmlspecialchars($conv['conversation_id']) ?></strong></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-group">
                                                    <?php
                                                    $participants = explode(', ', $conv['participants']);
                                                    $displayCount = min(count($participants), 3);
                                                    for ($i = 0; $i < $displayCount; $i++): 
                                                        $initial = substr($participants[$i], 0, 1);
                                                    ?>
                                                        <div class="avatar avatar-sm" data-bs-toggle="tooltip" title="<?= htmlspecialchars($participants[$i]) ?>">
                                                            <?= htmlspecialchars($initial) ?>
                                                        </div>
                                                    <?php endfor; ?>
                                                    
                                                    <?php if (count($participants) > 3): ?>
                                                        <div class="avatar avatar-sm avatar-more">
                                                            +<?= count($participants) - 3 ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="ms-2 text-truncate" style="max-width: 150px;">
                                                    <?= htmlspecialchars($conv['participants']) ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <?php if (isset($conv['last_message']) && !empty($conv['last_message'])): ?>
                                                <div class="message-preview">
                                                    <div class="text-truncate">
                                                        <?= htmlspecialchars($conv['last_message']) ?>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <span class="text-muted fst-italic">No messages</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-primary rounded-pill fw-normal px-3 py-2">
                                                <?= number_format($conv['message_count']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if (isset($conv['last_activity']) && !empty($conv['last_activity'])): ?>
                                                <?php 
                                                $lastActivity = strtotime($conv['last_activity']);
                                                $now = time();
                                                $diff = $now - $lastActivity;
                                                
                                                if ($diff < 3600) { // Less than an hour
                                                    $timeAgo = round($diff / 60) . ' min ago';
                                                    $badgeClass = 'bg-success';
                                                } elseif ($diff < 86400) { // Less than a day
                                                    $timeAgo = round($diff / 3600) . ' hours ago';
                                                    $badgeClass = 'bg-info';
                                                } elseif ($diff < 172800) { // Less than 2 days
                                                    $timeAgo = 'Yesterday';
                                                    $badgeClass = 'bg-info';
                                                } elseif ($diff < 604800) { // Less than a week
                                                    $timeAgo = date('l', $lastActivity); // Day name
                                                    $badgeClass = 'bg-secondary';
                                                } else {
                                                    $timeAgo = date("M d, Y", $lastActivity);
                                                    $badgeClass = 'bg-secondary';
                                                }
                                                ?>
                                                <div class="d-flex align-items-center">
                                                    <div class="activity-indicator <?= $diff < 86400 ? 'active' : '' ?>"></div>
                                                    <span class="ms-2"><?= $timeAgo ?></span>
                                                </div>
                                            <?php else: ?>
                                                <span class="text-muted">N/A</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-end">
                                                <a href="view_conversation.php?id=<?= $conv['conversation_id'] ?>" class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="tooltip" title="View Conversation">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="#" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $conv['conversation_id'] ?>">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                
                                                <!-- Delete Confirmation Modal -->
                                                <div class="modal fade" id="deleteModal<?= $conv['conversation_id'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure you want to delete this conversation between <strong><?= htmlspecialchars($conv['participants']) ?></strong>?</p>
                                                                <p class="text-danger"><i class="fas fa-exclamation-triangle me-2"></i>This will permanently remove all messages and cannot be undone.</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <a href="delete_conversation.php?id=<?= $conv['conversation_id'] ?>" class="btn btn-danger">Delete Conversation</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center p-5">
                                        <div class="empty-state">
                                            <div class="empty-state-icon">
                                                <i class="fas fa-comments"></i>
                                            </div>
                                            <h4>No conversations found</h4>
                                            <p class="text-muted">There are no conversations in the database yet.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Pagination (if needed) -->
            <?php if (count($conversations) > 10): ?>
                <div class="card-footer bg-white py-3">
                    <nav aria-label="Conversation pagination">
                        <ul class="pagination pagination-sm justify-content-center mb-0">
                            <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>

</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
});
</script>

<?php include 'admin_footer.php'; ?>