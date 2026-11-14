<?php
session_start();
include 'db.php';

// --- ✅ Admin Login စစ်ဆေးခြင်း ---
if (!isset($_SESSION['admin_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Login ဖိုင်နဲ့ ကိုက်ညီအောင် admin_township ကို ယူပါမယ်
$admin_city = isset($_SESSION['admin_township']) ? $_SESSION['admin_township'] : 'All';

// Admin Role အလိုက် Job တွေ ဆွဲထုတ်ခြင်း
if ($admin_city == 'All') {
    $sql = "SELECT * FROM jobs ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM jobs WHERE location = '$admin_city' ORDER BY id DESC";
}
$recent_jobs = mysqli_query($conn, $sql . " LIMIT 2");

// --- 📊 Stats တွက်ချက်ခြင်း ---
function getCount($conn, $query) {
    $result = mysqli_query($conn, $query);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['t'];
    }
    return 0;
}

if ($admin_city == 'All') {
    $total_jobs = getCount($conn, "SELECT COUNT(*) as t FROM jobs");
    $pending_jobs = getCount($conn, "SELECT COUNT(*) as t FROM jobs WHERE status='Pending'");
    $total_apps = getCount($conn, "SELECT COUNT(*) as t FROM applications"); 
    
    // User Stats (All)
    $total_users = getCount($conn, "SELECT COUNT(*) as t FROM users");
    $active_employers = getCount($conn, "SELECT COUNT(*) as t FROM users WHERE role='Employer'");
    $job_seekers = getCount($conn, "SELECT COUNT(*) as t FROM users WHERE role='Jobseeker'");
} else {
    // မြို့နယ်အလိုက် Stats များ
    $total_jobs = getCount($conn, "SELECT COUNT(*) as t FROM jobs WHERE location = '$admin_city'");
    $pending_jobs = getCount($conn, "SELECT COUNT(*) as t FROM jobs WHERE status='Pending' AND location = '$admin_city'");
    $total_apps = getCount($conn, "SELECT COUNT(*) as t FROM applications WHERE township = '$admin_city'");

    // User Breakdown ကိုပါ မြို့နယ်အလိုက် ခွဲပြရန်
    $total_users = getCount($conn, "SELECT COUNT(*) as t FROM users WHERE township = '$admin_city'");
    $active_employers = getCount($conn, "SELECT COUNT(*) as t FROM users WHERE role='Employer' AND township = '$admin_city'");
    $job_seekers = getCount($conn, "SELECT COUNT(*) as t FROM users WHERE role='Jobseeker' AND township = '$admin_city'");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Overview</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f1f3f7; font-family: 'Inter', sans-serif; }
        .wrapper { display: flex; }
        .main-content { flex: 1; padding: 30px; margin-left: 20px; }
        .header-area { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .live-site-btn { text-decoration: none; color: #64748b; font-weight: 600; transition: 0.3s; }
        .live-site-btn:hover { color: #0d6efd; }
        .stat-card { background: white; border-radius: 20px; padding: 25px; border: none; box-shadow: 0 2px 15px rgba(0,0,0,0.03); position: relative; transition: 0.3s; }
        .stat-card:hover { transform: translateY(-5px); }
        .stat-icon { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 20px; }
        .icon-blue { background: #eff6ff; color: #3b82f6; }
        .icon-orange { background: #fffcf0; color: #f59e0b; }
        .icon-purple { background: #f8f7ff; color: #8b5cf6; }
        .icon-green { background: #f0fdf4; color: #22c55e; }
        .stat-label { color: #64748b; font-size: 0.9rem; font-weight: 600; }
        .stat-value { font-size: 1.8rem; font-weight: 700; color: #0f172a; }
        .job-item { background: white; border-radius: 15px; padding: 20px; margin-bottom: 15px; display: flex; align-items: center; justify-content: space-between; border: 1px solid transparent; transition: 0.3s; }
        .job-item:hover { border-color: #0d6efd; box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
        .status-pill { font-size: 0.75rem; font-weight: 700; padding: 6px 15px; border-radius: 8px; }
        .st-approved { background: #dcfce7; color: #15803d; }
        .st-pending { background: #fef3c7; color: #b45309; }
        .user-card { background: white; border-radius: 20px; padding: 25px; box-shadow: 0 2px 15px rgba(0,0,0,0.03); }
        .admin-badge { background: #e0e7ff; color: #4338ca; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; margin-left: 10px; }
    </style>
</head>
<body>

<div class="wrapper">
    <?php include('nav.php'); ?>

    <div class="main-content">
        <div class="header-area">
            <div>
                <a href="../../student/Main/index.php" target="_blank" class="live-site-btn mb-2 d-inline-block">
                    <i class="fas fa-external-link-alt"></i> View Live Site
                </a>
                <h2 class="fw-bold">
                    Dashboard Overview 
                    <span class="admin-badge">Region: <?= htmlspecialchars($admin_city) ?></span>
                </h2>
                <p class="text-muted small">Hello, <?php echo $_SESSION['username']; ?>! Here's the latest update for <strong><?= $admin_city == 'All' ? 'All Regions' : $admin_city ?></strong>.</p>
            </div>
            <a href="export_jobs.php" class="btn btn-primary px-4 py-2" style="border-radius: 10px;">
                <i class="fa fa-download me-2"></i> Export Report
            </a>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon icon-blue"><i class="fa fa-briefcase"></i></div>
                    <div class="stat-label">Total Jobs (<?= $admin_city ?>)</div>
                    <div class="stat-value"><?= $total_jobs ?></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon icon-orange"><i class="fa fa-clock"></i></div>
                    <div class="stat-label">Pending Approval</div>
                    <div class="stat-value"><?= $pending_jobs ?></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon icon-purple"><i class="fa fa-file-alt"></i></div>
                    <div class="stat-label">Applications</div>
                    <div class="stat-value"><?= $total_apps ?></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon icon-green"><i class="fa fa-users"></i></div>
                    <div class="stat-label">Total Users</div>
                    <div class="stat-value"><?= $total_users ?></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">Recent Job Posts (<?= $admin_city ?>)</h5>
                    <a href="jobmanagement.php" class="text-primary text-decoration-none fw-bold small">View All →</a>
                </div>

                <?php if(mysqli_num_rows($recent_jobs) > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($recent_jobs)): ?>
                    <div class="job-item shadow-sm">
                        <div class="d-flex align-items-center">
                            <div class="bg-light p-3 rounded-3"><i class="fa fa-building text-secondary"></i></div>
                            <div class="ms-3">
                                <div class="fw-bold"><?= htmlspecialchars($row['job_title']) ?></div>
                                <div class="text-muted small"><?= htmlspecialchars($row['company']) ?> • <?= htmlspecialchars($row['location']) ?></div>
                            </div>
                        </div>
                        <div class="text-end">
                            
                            <div class="text-muted small mt-2" style="font-size: 0.7rem;">Created: <?= date('M d, Y', strtotime($row['created_at'])) ?></div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="alert alert-light text-center border-dashed">No recent jobs found for <?= $admin_city ?>.</div>
                <?php endif; ?>
            </div>

            <div class="col-md-4">
                <h5 class="fw-bold mb-4">User Breakdown</h5>
                <div class="user-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary-subtle text-primary p-2 rounded-3 me-3"><i class="fa fa-user-tie"></i></div>
                            <div class="fw-bold text-secondary small">Active Employers</div>
                        </div>
                        <div class="fw-bold h5 mb-0"><?= $active_employers ?></div> 
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="bg-success-subtle text-success p-2 rounded-3 me-3"><i class="fa fa-user-graduate"></i></div>
                            <div class="fw-bold text-secondary small">Job Seekers</div>
                        </div>
                        <div class="fw-bold h5 mb-0"><?= $job_seekers ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>