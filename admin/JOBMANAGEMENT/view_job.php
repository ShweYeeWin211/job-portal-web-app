<?php
include 'db.php';

// ၁။ ID ပါမပါ စစ်ဆေးခြင်း
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: jobmanagement.php");
    exit();
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

// ၂။ SQL Query (Salary နဲ့ Age column တွေပါ အကုန်ဆွဲထုတ်မယ်)
$sql = "SELECT jobs.*, 
        (SELECT COUNT(*) FROM application WHERE application.job_id = jobs.id) AS applications_count 
        FROM jobs 
        WHERE id = '$id'";

$result = mysqli_query($conn, $sql);
$job = mysqli_fetch_assoc($result);

// Job မရှိလျှင် ပြန်လွှတ်မည်
if (!$job) {
    echo "Job not found.";
    exit();
}

// ၃။ ဒေတာသတ်မှတ်ခြင်း
$category = $job['category'] ?? 'General';
$app_count = $job['applications_count'] ?? 0;
// Salary နဲ့ Age အတွက် default value သတ်မှတ်ခြင်း
$salary = $job['salary'] ?? 'Not Mentioned';
$age = $job['age'] ?? 'Not Mentioned';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Job Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f0f2f5; font-family: 'Inter', sans-serif; }
        .detail-card { border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); background: white; overflow: hidden; }
        .card-header-custom { background: #4361ee; color: white; padding: 20px; }
        .info-label { color: #6c757d; font-size: 0.9rem; font-weight: 600; text-transform: uppercase; margin-bottom: 5px; }
        .info-value { color: #2d3436; font-size: 1.1rem; font-weight: 500; margin-bottom: 20px; }
        .status-badge { padding: 8px 16px; border-radius: 30px; font-weight: 600; }
        .bg-approved { background: #e8f5e9; color: #2e7d32; }
        .bg-pending { background: #fff3e0; color: #ef6c00; }
        
        @media (max-width: 992px) {
            .sidebar { position: fixed; left: -250px; top: 0; height: 100%; width: 250px; z-index: 1001; transition: 0.3s; background: white; }
            .sidebar.active { left: 0; }
            .main-content { margin-left: 0 !important; width: 100% !important; padding: 15px; }
        }
    </style>
</head>
<body>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="detail-card">
                <div class="card-header-custom d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Job Information</h4>
                    <span class="small opacity-75">Full details of this job posting</span>
                </div>

                <div class="p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-label">Job Title & Category</div>
                            <div class="info-value">
                                <?= htmlspecialchars($job['job_title']) ?> 
                                <span class="text-muted small ms-2">(<?= htmlspecialchars($category) ?>)</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-label">Company Name</div>
                            <div class="info-value"><i class="fa fa-building text-primary me-2"></i><?= htmlspecialchars($job['company']) ?></div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-label">Location</div>
                            <div class="info-value"><i class="fa fa-location-dot text-danger me-2"></i><?= htmlspecialchars($job['location']) ?></div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-label">Employment Type</div>
                            <div class="info-value"><span class="badge bg-light text-dark border"><?= htmlspecialchars($job['type']) ?></span></div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-label">Salary Range</div>
                            <div class="info-value"><i class="fa fa-money-bill-wave text-success me-2"></i><?= htmlspecialchars($salary) ?></div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-label">Age Requirement</div>
                            <div class="info-value"><i class="fa fa-user-clock text-info me-2"></i><?= htmlspecialchars($age) ?> Years</div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-label">Total Applications</div>
                            <div class="info-value">
                                <span class="fw-bold text-primary"><?= $app_count ?></span> Candidates
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-label">Current Status</div>
                            <div class="info-value">
                                <?php if($job['status'] == 'Approved'): ?>
                                    <span class="status-badge bg-approved"><i class="fa fa-check-circle me-1"></i> Approved</span>
                                <?php else: ?>
                                    <span class="status-badge bg-pending"><i class="fa fa-clock me-1"></i> Pending</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4 opacity-25">

                    <div class="d-flex justify-content-between">
                        <a href="jobmanagement.php" class="btn btn-outline-secondary px-4 rounded-pill">
                            <i class="fa fa-arrow-left me-2"></i> Back to List
                        </a>
                        <div>
                            <a href="edit_job.php?id=<?= $job['id'] ?>" class="btn btn-dark px-4 rounded-pill me-2">
                                <i class="fa fa-edit me-2"></i> Edit Job
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>