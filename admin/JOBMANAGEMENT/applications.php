<?php 
session_start();
include('db.php'); 
require_once dirname(__FILE__) . '/../../Mailer/send_email.php';

// ၁။ Admin ရဲ့ မြို့နယ်ကို Session ကနေယူမယ်
$admin_township = $_SESSION['admin_township'] ?? 'All';

// ၂။ Stats အတွက် Count တွေကို မြို့နယ်အလိုက် စစ်မယ်
if ($admin_township == 'All') {
    $total_sql = "SELECT COUNT(*) as total FROM applications";
    $pending_sql = "SELECT COUNT(*) as total FROM applications WHERE status = 'Pending'";
    $approved_sql = "SELECT COUNT(*) as total FROM applications WHERE status = 'Approved'";
    $sql = "SELECT * FROM applications ORDER BY id DESC";
} else {
    $total_sql = "SELECT COUNT(*) as total FROM applications WHERE township = '$admin_township'";
    $pending_sql = "SELECT COUNT(*) as total FROM applications WHERE status = 'Pending' AND township = '$admin_township'";
    $approved_sql = "SELECT COUNT(*) as total FROM applications WHERE status = 'Approved' AND township = '$admin_township'";
    $sql = "SELECT * FROM applications WHERE township = '$admin_township' ORDER BY id DESC";
}

$total_count = mysqli_fetch_assoc(mysqli_query($conn, $total_sql))['total'];
$pending_count = mysqli_fetch_assoc(mysqli_query($conn, $pending_sql))['total'];
$approved_count = mysqli_fetch_assoc(mysqli_query($conn, $approved_sql))['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root {
            --primary: #0062ff;
            --success: #2d9d78;
            --warning: #f39c12;
            --danger: #e44d61;
        }
        body { background-color: #f8fafc; font-family: 'Inter', sans-serif; }
        .main-wrapper { padding: 40px; }
        .stat-card {
            background: white; padding: 25px; border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            border: 1px solid #edf2f7; transition: 0.3s;
        }
        .stat-card:hover { transform: translateY(-5px); }
        .stat-icon {
            width: 50px; height: 50px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center; font-size: 24px;
        }
        .content-card { 
            background: white; border-radius: 16px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: none; overflow: hidden;
            margin-top: 30px;
        }
        .table thead { background-color: #f8fafc; }
        .table thead th { 
            text-transform: uppercase; font-size: 11px; letter-spacing: 1px; 
            font-weight: 700; color: #64748b; border-bottom: none; padding: 20px 15px;
        }
        .table tbody td { padding: 20px 15px; vertical-align: middle; border-bottom: 1px solid #f1f5f9; }
        .badge-pill { padding: 6px 14px; border-radius: 8px; font-weight: 600; font-size: 11px; }
        .status-pending { background-color: #fff7ed; color: #c2410c; }
        .status-approved { background-color: #f0fdf4; color: #166534; }
        .status-rejected { background-color: #fef2f2; color: #991b1b; }
        .action-btn {
            width: 35px; height: 35px; border-radius: 8px;
            display: inline-flex; align-items: center; justify-content: center;
            transition: 0.2s; border: 1px solid #e2e8f0; text-decoration: none;
        }
        .action-btn:hover { background-color: #f8fafc; transform: scale(1.1); }
        /* Township Badge Style */
        .township-badge { font-size: 10px; background: #f1f5f9; color: #475569; padding: 2px 8px; border-radius: 4px; display: inline-block; margin-top: 5px; }
    </style>
</head>
<body>
<?php include('nav.php'); ?>
<div class="main-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark">Applications Management</h2>
            <p class="text-muted small mb-0">Region: <strong><?php echo htmlspecialchars($admin_township); ?></strong></p>
        </div>
        <span class="text-muted small"><?php echo date('D, M d, Y'); ?></span>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="stat-card d-flex align-items-center gap-3">
                <div class="stat-icon" style="background: #e0eaff; color: var(--primary);"><i class="fas fa-users"></i></div>
                <div>
                    <div class="text-muted small fw-medium">Total Applied</div>
                    <h3 class="mb-0 fw-bold"><?php echo $total_count; ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card d-flex align-items-center gap-3">
                <div class="stat-icon" style="background: #fff4e5; color: var(--warning);"><i class="fas fa-clock"></i></div>
                <div>
                    <div class="text-muted small fw-medium">Pending Review</div>
                    <h3 class="mb-0 fw-bold"><?php echo $pending_count; ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card d-flex align-items-center gap-3">
                <div class="stat-icon" style="background: #e6f6f1; color: var(--success);"><i class="fas fa-check-double"></i></div>
                <div>
                    <div class="text-muted small fw-medium">Approved</div>
                    <h3 class="mb-0 fw-bold"><?php echo $approved_count; ?></h3>
                </div>
            </div>
        </div>
    </div>

    <div class="content-card">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Applicant Profile</th>
                        <th>Position & Company</th>
                        <th>Applied Date</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
            <?php
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0):
                while($row = mysqli_fetch_assoc($result)):
                    $status = $row['status'];
                    $badge = ($status == 'Approved') ? 'status-approved' : (($status == 'Rejected') ? 'status-rejected' : 'status-pending');
            ?>
            <tr>
                <td class="ps-4">
                    <div class="fw-bold text-dark"><?php echo htmlspecialchars($row['applicant_name']); ?></div>
                    <div class="small text-muted"><i class="far fa-envelope me-1"></i><?php echo htmlspecialchars($row['email']); ?></div>
                </td>
                <td>
                    <div class="fw-medium"><?php echo htmlspecialchars($row['job_title']); ?></div>
                    <div class="small fw-bold" style="color: var(--primary);"><i class="far fa-building me-1"></i><?php echo htmlspecialchars($row['company_name']); ?></div>
                    <div class="township-badge"><i class="fas fa-location-dot me-1"></i><?php echo htmlspecialchars($row['township']); ?></div>
                </td>
                <td class="text-muted small"><?php echo date('M d, Y', strtotime($row['applied_date'])); ?></td>
                <td class="text-center">
                    <span class="badge badge-pill <?php echo $badge; ?>"><?php echo $status; ?></span>
                </td>
                <td class="text-center">
                    <div class="d-flex justify-content-center gap-2">
                        <?php if($status == 'Pending'): ?>
                            <a href="process_status.php?id=<?php echo $row['id']; ?>&status=Approved" class="action-btn text-success" title="Approve">
                                <i class="fas fa-check"></i>
                            </a>
                            <a href="process_status.php?id=<?php echo $row['id']; ?>&status=Rejected" class="action-btn text-danger" title="Reject">
                                <i class="fas fa-times"></i>
                            </a>
                        <?php endif; ?>
                        <a href="view_detail.php?id=<?php echo $row['id']; ?>" class="action-btn text-primary" title="View Details">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </td>
            </tr>
            <?php endwhile; 
            else: ?>
                <tr><td colspan="5" class="text-center py-5 text-muted">No applications found.</td></tr>
            <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>