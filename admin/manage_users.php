<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: ../login.php");
    exit();
}
include 'admin_header.php';
include '../db_connect.php'; // Include database connection

// Handle search query if present
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$searchCondition = '';
$params = [];

if (!empty($search)) {
    $searchCondition = " WHERE fullName LIKE ? OR email LIKE ?";
    $params = ["%$search%", "%$search%"];
}

// Determine sorting
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
$order = isset($_GET['order']) ? $_GET['order'] : 'DESC';

// Valid sort columns to prevent SQL injection
$validSortColumns = ['id', 'fullName', 'email', 'created_at'];
if (!in_array($sort, $validSortColumns)) {
    $sort = 'id';
}

$validOrders = ['ASC', 'DESC'];
if (!in_array($order, $validOrders)) {
    $order = 'DESC';
}

// Fetch users with additional stats
$query = "SELECT u.id, u.fullName, u.email, u.created_at,
          (SELECT COUNT(*) FROM skills WHERE user_id = u.id) AS skill_count
          FROM users u
          $searchCondition
          ORDER BY u.$sort $order";

$stmt = $conn->prepare($query);

if (!empty($params)) {
    $paramTypes = str_repeat('s', count($params));
    $stmt->bind_param($paramTypes, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
$users = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<div class="admin-dashboard">
    <div class="container py-4">
        <!-- Page Header -->
        <div class="admin-header d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h2 mb-1">Manage Users</h1>
                <p class="text-muted">View and manage user accounts on the platform</p>
            </div>
            <div class="admin-actions">
                <a href="export_users.php" class="btn btn-sm btn-outline-primary me-2">
                    <i class="fas fa-download me-1"></i> Export
                </a>
                <a href="add_user.php" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus me-1"></i> Add User
                </a>
            </div>
        </div>
        
        <!-- Search and Filter Bar -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form class="row g-3" action="" method="GET">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Search users by name or email..." name="search" value="<?= htmlspecialchars($search) ?>">
                            <button class="btn btn-primary" type="submit">Search</button>
                            <?php if (!empty($search)): ?>
                                <a href="manage_users.php" class="btn btn-outline-secondary">Clear</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <span class="text-muted me-2">Found <?= count($users) ?> users</span>
                        <div class="btn-group">
                            <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-sort me-1"></i> Sort by
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item <?= ($sort == 'created_at' && $order == 'DESC') ? 'active' : '' ?>" href="?sort=created_at&order=DESC<?= !empty($search) ? '&search='.$search : '' ?>">Newest first</a></li>
                                <li><a class="dropdown-item <?= ($sort == 'created_at' && $order == 'ASC') ? 'active' : '' ?>" href="?sort=created_at&order=ASC<?= !empty($search) ? '&search='.$search : '' ?>">Oldest first</a></li>
                                <li><a class="dropdown-item <?= ($sort == 'fullName' && $order == 'ASC') ? 'active' : '' ?>" href="?sort=fullName&order=ASC<?= !empty($search) ? '&search='.$search : '' ?>">Name (A-Z)</a></li>
                                <li><a class="dropdown-item <?= ($sort == 'fullName' && $order == 'DESC') ? 'active' : '' ?>" href="?sort=fullName&order=DESC<?= !empty($search) ? '&search='.$search : '' ?>">Name (Z-A)</a></li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Users Table -->
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Skills</th>
                                <th>Registered</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($users) > 0): ?>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($user['id']) ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm me-2">
                                                    <?= substr($user['fullName'], 0, 1) ?>
                                                </div>
                                                <div class="fw-medium"><?= htmlspecialchars($user['fullName']) ?></div>
                                            </div>
                                        </td>
                                        <td><?= htmlspecialchars($user['email']) ?></td>
                                        <td>
                                            <?php if ($user['skill_count'] > 0): ?>
                                                <span class="badge bg-success rounded-pill"><?= $user['skill_count'] ?> skills</span>
                                            <?php else: ?>
                                                <span class="badge bg-light text-dark rounded-pill">No skills</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= date("M d, Y", strtotime($user['created_at'])) ?></td>
                                        <td class="text-end">
                                            <div class="btn-group">
                                                <a href="view_user.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-outline-secondary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="edit_user.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="delete_user.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this user? All their skills and messages will also be deleted.');">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center p-4">
                                        <div class="py-5">
                                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                            <h5>No users found</h5>
                                            <p class="text-muted">
                                                <?= !empty($search) ? "No results matching \"" . htmlspecialchars($search) . "\"" : "There are no users in the database yet." ?>
                                            </p>
                                            <?php if (!empty($search)): ?>
                                                <a href="manage_users.php" class="btn btn-outline-primary mt-3">Clear Search</a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --admin-primary: #4e73df;
    --admin-success: #1cc88a;
    --admin-info: #36b9cc;
    --admin-warning: #f6c23e;
    --admin-danger: #e74a3b;
    --admin-light: #f8f9fc;
    --admin-dark: #5a5c69;
}

.admin-dashboard {
    background-color: #f8f9fc;
    min-height: calc(100vh - 70px);
}

.admin-header {
    padding-bottom: 1rem;
    margin-bottom: 1.5rem;
    border-bottom: 1px solid #e3e6f0;
}

.card {
    border: none;
    border-radius: 0.35rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1) !important;
}

.card-header {
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
    padding: 0.75rem 1.25rem;
}

.avatar-sm {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--admin-primary);
    color: white;
    font-weight: 600;
    font-size: 0.875rem;
}

.table th {
    font-weight: 600;
    color: #5a5c69;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.badge {
    font-weight: 500;
    text-transform: capitalize;
    padding: 0.4em 0.8em;
}

.btn-group > .btn {
    border-radius: 0.25rem;
    margin: 0 0.1rem;
}
</style>

<?php
include 'admin_footer.php';
$conn->close();
?>