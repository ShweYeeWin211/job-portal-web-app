<?php
session_start();

// 1. Database Connection
$conn = new mysqli("localhost", "root", "", "job_portal"); 

if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
}

// 2. Check Login Session
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please login first!'); window.location.href='login.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id'];

// 3. Fetch Applications for the logged-in user
$sql = "SELECT * FROM applications WHERE user_id = '$user_id' ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Applications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body { background-color: #f8fafc; font-family: 'Inter', sans-serif; }
        .app-container { margin-top: 50px; background: white; padding: 30px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
        .table thead { background-color: #1e293b; color: white; }
        .badge-pending { background-color: #f59e0b; color: #fff; }
        .badge-approved { background-color: #10b981; color: #fff; }
        .badge-rejected { background-color: #ef4444; color: #fff; }
        .badge-draft { background-color: #64748b; color: #fff; }
    </style>
</head>
<body>
    <div class="container app-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark">My Job Applications</h2>
            <a href="cv.php" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Apply New Job</a>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Position</th>
                        <th>Township</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(mysqli_num_rows($result) > 0): ?>
                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td class="fw-semibold"><?= htmlspecialchars($row['job_title']) ?></td>
                                <td><?= htmlspecialchars($row['township']) ?></td>
                                <td>
                                    <?php 
                                        $status = $row['status'];
                                        $badge_class = 'badge-pending';
                                        if($status == 'Approved') $badge_class = 'badge-approved';
                                        if($status == 'Rejected') $badge_class = 'badge-rejected';
                                        if($status == 'Draft') $badge_class = 'badge-draft';
                                    ?>
                                    <span class="badge <?= $badge_class ?> rounded-pill px-3 py-2">
                                        <?= strtoupper($status) ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if($status == 'Draft'): ?>
                                        <a href="submit_to_admin.php?id=<?= $row['id'] ?>" class="btn btn-outline-primary btn-sm px-3">
                                            Submit to Admin
                                        </a>
                                    <?php else: ?>
                                        <span class="text-success small fw-bold"><i class="fas fa-check-circle"></i> Submitted</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">No applications found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>