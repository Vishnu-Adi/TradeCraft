<?php
// This is a simple test page to verify that basic site functionality is working
include 'db_connect.php'; 
include 'header.php';
?>

<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="card-title">Site Status Check</h2>
                    
                    <div class="mb-4">
                        <h5>Basic PHP Check</h5>
                        <div class="alert alert-success">
                            PHP is working correctly!
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h5>Database Connection Check</h5>
                        <?php if ($conn && $conn->ping()): ?>
                            <div class="alert alert-success">
                                Database connection is successful.
                            </div>
                        <?php else: ?>
                            <div class="alert alert-danger">
                                Database connection failed. Please check your db_connect.php file.
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="mb-4">
                        <h5>Header/Footer Components</h5>
                        <div class="alert alert-success">
                            Header is displaying correctly if you can see the navigation menu above.
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <a href="index.php" class="btn btn-primary">Go to Homepage</a>
                        <a href="messages.php" class="btn btn-secondary ms-2">Go to Messages</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>