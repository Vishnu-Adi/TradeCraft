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
    $searchCondition = " WHERE title LIKE ? OR category LIKE ?";
    $params = ["%$search%", "%$search%"];
}

// Determine sorting
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
$order = isset($_GET['order']) ? $_GET['order'] : 'DESC';

// Valid sort columns to prevent SQL injection
$validSortColumns = ['id', 'title', 'category', 'created_at'];
if (!in_array($sort, $validSortColumns)) {
    $sort = 'id';
}

$validOrders = ['ASC', 'DESC'];
if (!in_array($order, $validOrders)) {
    $order = 'DESC';
}

// Fetch skills with user information
$query = "SELECT s.id, s.title, s.category, s.created_at, u.fullName AS user_name 
          FROM skills s
          JOIN users u ON s.user_id = u.id
          $searchCondition
          ORDER BY s.$sort $order";

$stmt = $conn->prepare($query);

if (!empty($params)) {
    $paramTypes = str_repeat('s', count($params));
    $stmt->bind_param($paramTypes, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
$skills = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<div class="admin-dashboard">
    <div class="container py-4">
        <!-- Page Header -->
        <div class="admin-header d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h2 mb-1">Manage Skills</h1>
                <p class="text-muted">Oversee and manage all skill posts on the platform</p>
            </div>
            <div class="admin-actions">
                <a href="export_skills.php" class="btn btn-sm btn-outline-primary me-2">
                    <i class="fas fa-download me-1"></i> Export
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
                            <input type="text" class="form-control" placeholder="Search skills by title or category..." name="search" value="<?= htmlspecialchars($search) ?>">
                            <button class="btn btn-primary" type="submit">Search</button>
                            <?php if (!empty($search)): ?>
                                <a href="manage_skills.php" class="btn btn-outline-secondary">Clear</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <span class="text-muted me-2">Found <?= count($skills) ?> skills</span>
                        <div class="btn-group">
                            <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-sort me-1"></i> Sort by
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item <?= ($sort == 'created_at' && $order == 'DESC') ? 'active' : '' ?>" href="?sort=created_at&order=DESC<?= !empty($search) ? '&search='.$search : '' ?>">Newest first</a></li>
                                <li><a class="dropdown-item <?= ($sort == 'created_at' && $order == 'ASC') ? 'active' : '' ?>" href="?sort=created_at&order=ASC<?= !empty($search) ? '&search='.$search : '' ?>">Oldest first</a></li>
                                <li><a class="dropdown-item <?= ($sort == 'title' && $order == 'ASC') ? 'active' : '' ?>" href="?sort=title&order=ASC<?= !empty($search) ? '&search='.$search : '' ?>">Title (A-Z)</a></li>
                                <li><a class="dropdown-item <?= ($sort == 'title' && $order == 'DESC') ? 'active' : '' ?>" href="?sort=title&order=DESC<?= !empty($search) ? '&search='.$search : '' ?>">Title (Z-A)</a></li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Skills Table -->
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Posted By</th>
                                <th>Created</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($skills) > 0): ?>
                                <?php foreach ($skills as $skill): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($skill['id']) ?></td>
                                        <td>
                                            <div class="fw-medium"><?= htmlspecialchars($skill['title']) ?></div>
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill bg-primary"><?= htmlspecialchars($skill['category']) ?></span>
                                        </td>
                                        <td><?= htmlspecialchars($skill['user_name']) ?></td>
                                        <td><?= date("M d, Y", strtotime($skill['created_at'])) ?></td>
                                        <td class="text-end">
                                            <div class="btn-group">
                                                <a href="../skill_detail.php?id=<?= $skill['id'] ?>" target="_blank" class="btn btn-sm btn-outline-secondary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="edit_skill.php?id=<?= $skill['id'] ?>" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="delete_skill.php?id=<?= $skill['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this skill post?');">
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
                                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                                            <h5>No skills found</h5>
                                            <p class="text-muted">
                                                <?= !empty($search) ? "No results matching \"" . htmlspecialchars($search) . "\"" : "There are no skills in the database yet." ?>
                                            </p>
                                            <?php if (!empty($search)): ?>
                                                <a href="manage_skills.php" class="btn btn-outline-primary mt-3">Clear Search</a>
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