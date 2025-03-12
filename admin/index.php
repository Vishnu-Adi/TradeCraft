<?php
session_start();
// Check if the admin user is logged in.
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: ../login.php"); // Redirect to the main login page
    exit();
}

include '../db_connect.php';
include 'admin_header.php';

// Get count of total users
$userQuery = $conn->query("SELECT COUNT(*) as total FROM users");
$userCount = $userQuery->fetch_assoc()['total'];

// Get count of total skills
$skillQuery = $conn->query("SELECT COUNT(*) as total FROM skills");
$skillCount = $skillQuery->fetch_assoc()['total'];

// Get count of total messages
$messageQuery = $conn->query("SELECT COUNT(*) as total FROM messages");
$messageCount = $messageQuery->fetch_assoc()['total'];

// Get recent users (5 most recent)
$recentUsersQuery = $conn->query("SELECT id, fullName, email, created_at FROM users ORDER BY created_at DESC LIMIT 5");
$recentUsers = [];
while ($user = $recentUsersQuery->fetch_assoc()) {
    $recentUsers[] = $user;
}

// Get recent skills (5 most recent)
$recentSkillsQuery = $conn->query("SELECT s.id, s.title, s.category, s.created_at, u.fullName 
                                  FROM skills s 
                                  JOIN users u ON s.user_id = u.id 
                                  ORDER BY s.created_at DESC LIMIT 5");
$recentSkills = [];
while ($skill = $recentSkillsQuery->fetch_assoc()) {
    $recentSkills[] = $skill;
}

// Get monthly data for charts - last 12 months
$currentMonth = date('m');
$currentYear = date('Y');

// Initialize arrays for chart data
$months = [];
$userCounts = [];
$skillCounts = [];
$messageCounts = [];

// Get monthly user registrations
$userMonthlyQuery = $conn->query("
    SELECT 
        MONTH(created_at) as month, 
        YEAR(created_at) as year,
        COUNT(*) as count 
    FROM users 
    WHERE created_at >= DATE_SUB(NOW(), INTERVAL 12 MONTH)
    GROUP BY YEAR(created_at), MONTH(created_at)
    ORDER BY YEAR(created_at), MONTH(created_at)
");

$monthlyUsers = [];
while ($row = $userMonthlyQuery->fetch_assoc()) {
    $monthKey = $row['year'] . '-' . str_pad($row['month'], 2, '0', STR_PAD_LEFT);
    $monthlyUsers[$monthKey] = $row['count'];
}

// Get monthly skill creations
$skillMonthlyQuery = $conn->query("
    SELECT 
        MONTH(created_at) as month, 
        YEAR(created_at) as year,
        COUNT(*) as count 
    FROM skills 
    WHERE created_at >= DATE_SUB(NOW(), INTERVAL 12 MONTH)
    GROUP BY YEAR(created_at), MONTH(created_at)
    ORDER BY YEAR(created_at), MONTH(created_at)
");

$monthlySkills = [];
while ($row = $skillMonthlyQuery->fetch_assoc()) {
    $monthKey = $row['year'] . '-' . str_pad($row['month'], 2, '0', STR_PAD_LEFT);
    $monthlySkills[$monthKey] = $row['count'];
}

// Get monthly messages
$messageMonthlyQuery = $conn->query("
    SELECT 
        MONTH(created_at) as month, 
        YEAR(created_at) as year,
        COUNT(*) as count 
    FROM messages 
    WHERE created_at >= DATE_SUB(NOW(), INTERVAL 12 MONTH)
    GROUP BY YEAR(created_at), MONTH(created_at)
    ORDER BY YEAR(created_at), MONTH(created_at)
");

$monthlyMessages = [];
while ($row = $messageMonthlyQuery->fetch_assoc()) {
    $monthKey = $row['year'] . '-' . str_pad($row['month'], 2, '0', STR_PAD_LEFT);
    $monthlyMessages[$monthKey] = $row['count'];
}

// Generate last 12 months array
for ($i = 11; $i >= 0; $i--) {
    $date = new DateTime();
    $date->modify("-$i month");
    $monthKey = $date->format('Y-m');
    $months[] = $date->format('M');
    
    // Fill in actual data or 0 if no data for that month
    $userCounts[] = isset($monthlyUsers[$monthKey]) ? $monthlyUsers[$monthKey] : 0;
    $skillCounts[] = isset($monthlySkills[$monthKey]) ? $monthlySkills[$monthKey] : 0;
    $messageCounts[] = isset($monthlyMessages[$monthKey]) ? $monthlyMessages[$monthKey] : 0;
}

// Get category distribution data
$categoryQuery = $conn->query("
    SELECT category, COUNT(*) as count
    FROM skills
    GROUP BY category
    ORDER BY count DESC
");

$categories = [];
$categoryCounts = [];

while ($row = $categoryQuery->fetch_assoc()) {
    $categories[] = ucfirst($row['category']);
    $categoryCounts[] = $row['count'];
}

// Calculate growth percentages
function calculateGrowth($data) {
    if (count($data) < 2 || ($data[count($data) - 2] == 0)) {
        return 0;
    }
    $current = $data[count($data) - 1];
    $previous = $data[count($data) - 2];
    return round(($current - $previous) / $previous * 100);
}

$userGrowth = calculateGrowth($userCounts);
$skillGrowth = calculateGrowth($skillCounts);
$messageGrowth = calculateGrowth($messageCounts);

// Ensure growth is at least 0 for display purposes
$userGrowth = max(0, $userGrowth);
$skillGrowth = max(0, $skillGrowth);
$messageGrowth = max(0, $messageGrowth);
?>

<div class="admin-dashboard">
    <div class="container py-4">
        <!-- Page Header -->
        <div class="admin-header d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h2 mb-1">Dashboard Overview</h1>
                <p class="text-muted">Monitor and manage your platform's activity</p>
            </div>
            <div class="admin-actions">
                <button class="btn btn-sm btn-outline-secondary me-2">
                    <i class="fas fa-bell me-1"></i>
                    <span class="badge bg-danger">3</span>
                </button>
                <button class="btn btn-sm btn-primary">
                    <i class="fas fa-download me-1"></i> Generate Report
                </button>
            </div>
        </div>
        
        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="stats-card bg-primary text-white">
                    <div class="stats-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stats-info">
                        <h3><?= number_format($userCount) ?></h3>
                        <p>Total Users</p>
                    </div>
                    <div class="stats-link">
                        <a href="manage_users.php" class="text-white">View Details <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card bg-success text-white">
                    <div class="stats-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="stats-info">
                        <h3><?= number_format($skillCount) ?></h3>
                        <p>Skill Posts</p>
                    </div>
                    <div class="stats-link">
                        <a href="manage_skills.php" class="text-white">View Details <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card bg-info text-white">
                    <div class="stats-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="stats-info">
                        <h3><?= number_format($messageCount) ?></h3>
                        <p>Messages</p>
                    </div>
                    <div class="stats-link">
                        <a href="manage_messages.php" class="text-white">View Details <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Admin Dashboard Widgets -->
        <div class="row mb-4">
            <div class="col-md-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Platform Overview</h5>
                        <div>
                            <button class="btn btn-sm btn-link text-muted period-selector" data-period="weekly">Weekly</button>
                            <button class="btn btn-sm btn-link text-primary period-selector" data-period="monthly">Monthly</button>
                            <button class="btn btn-sm btn-link text-muted period-selector" data-period="yearly">Yearly</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="position: relative; height:300px;">
                            <canvas id="overviewChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Category Distribution</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="position: relative; height:300px;">
                            <canvas id="categoryChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Data Tables -->
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Recent Users</h5>
                        <a href="manage_users.php" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($recentUsers) > 0): ?>
                                        <?php foreach ($recentUsers as $user): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($user['fullName']) ?></td>
                                                <td><?= htmlspecialchars($user['email']) ?></td>
                                                <td><?= date("M d, Y", strtotime($user['created_at'])) ?></td>
                                                <td>
                                                    <a href="view_user.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-link"><i class="fas fa-eye"></i></a>
                                                    <a href="edit_user.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-link"><i class="fas fa-edit"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center">No users found</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Recent Skills</h5>
                        <a href="manage_skills.php" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Posted By</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($recentSkills) > 0): ?>
                                        <?php foreach ($recentSkills as $skill): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($skill['title']) ?></td>
                                                <td><span class="badge rounded-pill bg-primary"><?= htmlspecialchars($skill['category']) ?></span></td>
                                                <td><?= htmlspecialchars($skill['fullName']) ?></td>
                                                <td>
                                                    <a href="view_skill.php?id=<?= $skill['id'] ?>" class="btn btn-sm btn-link"><i class="fas fa-eye"></i></a>
                                                    <a href="edit_skill.php?id=<?= $skill['id'] ?>" class="btn btn-sm btn-link"><i class="fas fa-edit"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center">No skills found</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quick Stats -->
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Platform Activity</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <div class="mb-3">
                                    <h6 class="text-muted">Users Growth</h6>
                                    <h3 class="mb-0">+<?= $userGrowth ?>%</h3>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: <?= min(100, $userGrowth) ?>%" aria-valuenow="<?= $userGrowth ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="mb-3">
                                    <h6 class="text-muted">Skills Added</h6>
                                    <h3 class="mb-0">+<?= $skillGrowth ?>%</h3>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: <?= min(100, $skillGrowth) ?>%" aria-valuenow="<?= $skillGrowth ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="mb-3">
                                    <h6 class="text-muted">Message Activity</h6>
                                    <h3 class="mb-0">+<?= $messageGrowth ?>%</h3>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: <?= min(100, $messageGrowth) ?>%" aria-valuenow="<?= $messageGrowth ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
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
    min-height: calc(100vh - 70px); /* Adjust based on your header height */
}

.admin-header {
    padding-bottom: 1rem;
    margin-bottom: 1.5rem;
    border-bottom: 1px solid #e3e6f0;
}

/* Stats Cards */
.stats-card {
    display: flex;
    align-items: center;
    border-radius: 0.35rem;
    padding: 1.5rem;
    position: relative;
    margin-bottom: 1rem;
    box-shadow: 0 0.15rem 1.75rem rgba(0, 0, 0, 0.15);
}

.stats-icon {
    font-size: 2rem;
    margin-right: 1rem;
}

.stats-info h3 {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
}

.stats-info p {
    margin-bottom: 0;
    opacity: 0.8;
}

.stats-link {
    position: absolute;
    bottom: 0.75rem;
    right: 1.5rem;
}

.stats-link a {
    text-decoration: none;
    font-size: 0.85rem;
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

.table {
    margin-bottom: 0;
}

.table th {
    border-top: none;
    font-weight: 600;
    color: #5a5c69;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.btn-link {
    color: var(--admin-primary);
    padding: 0.25rem;
}

.btn-link:hover {
    color: #2e59d9;
}

.progress {
    height: 0.5rem;
    border-radius: 1rem;
    background-color: #eaecf4;
    margin-bottom: 1rem;
}

.badge {
    font-weight: 500;
    text-transform: capitalize;
    padding: 0.4em 0.8em;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get real data from PHP
    const months = <?php echo json_encode($months); ?>;
    const userCounts = <?php echo json_encode($userCounts); ?>;
    const skillCounts = <?php echo json_encode($skillCounts); ?>;
    const messageCounts = <?php echo json_encode($messageCounts); ?>;
    
    const categories = <?php echo json_encode($categories); ?>;
    const categoryCounts = <?php echo json_encode($categoryCounts); ?>;

    // Platform Overview Line Chart
    const overviewCtx = document.getElementById('overviewChart').getContext('2d');
    const overviewChart = new Chart(overviewCtx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [
                {
                    label: 'Users',
                    data: userCounts,
                    borderColor: '#4e73df',
                    backgroundColor: 'rgba(78, 115, 223, 0.05)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Skills',
                    data: skillCounts,
                    borderColor: '#1cc88a',
                    backgroundColor: 'rgba(28, 200, 138, 0.05)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Messages',
                    data: messageCounts,
                    borderColor: '#36b9cc',
                    backgroundColor: 'rgba(54, 185, 204, 0.05)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        padding: 20
                    }
                },
                tooltip: {
                    backgroundColor: '#fff',
                    titleColor: '#5a5c69',
                    bodyColor: '#858796',
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    padding: 15,
                    displayColors: false,
                    caretPadding: 10
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#eaecf4',
                        drawBorder: false,
                        zeroLineColor: '#eaecf4'
                    },
                    ticks: {
                        color: '#5a5c69',
                        padding: 10
                    }
                },
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        color: '#5a5c69',
                        padding: 15
                    }
                }
            }
        }
    });

    // Category Distribution Doughnut Chart
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    const categoryChart = new Chart(categoryCtx, {
        type: 'doughnut',
        data: {
            labels: categories,
            datasets: [{
                data: categoryCounts,
                backgroundColor: [
                    '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#6f42c1', '#fd7e14', '#6610f2'
                ],
                hoverBackgroundColor: [
                    '#2e59d9', '#17a673', '#2c9faf', '#dda20a', '#be2617', '#5a3092', '#c96209', '#520dc2'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        padding: 20,
                        font: {
                            size: 11
                        }
                    }
                },
                tooltip: {
                    backgroundColor: '#fff',
                    titleColor: '#5a5c69',
                    bodyColor: '#858796',
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    padding: 15,
                    displayColors: false
                }
            },
            cutout: '70%'
        }
    });
    
    // Period selectors
    document.querySelectorAll('.period-selector').forEach(button => {
        button.addEventListener('click', function() {
            // Update UI for selected button
            document.querySelectorAll('.period-selector').forEach(btn => {
                btn.classList.remove('text-primary');
                btn.classList.add('text-muted');
            });
            this.classList.remove('text-muted');
            this.classList.add('text-primary');
            
            const period = this.dataset.period;
            
            // In a real implementation, you would fetch data for the selected period
            // For now, let's just simulate this with alerts
            alert(`You selected the ${period} view. In a complete implementation, this would load ${period} data.`);
        });
    });
});
</script>

<?php include 'admin_footer.php'; ?>