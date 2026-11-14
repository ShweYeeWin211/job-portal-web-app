<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$admin_id = $_SESSION['admin_id'];

// --- ၁။ General Settings နှင့် Notification သိမ်းခြင်း ---
if (isset($_POST['save_all'])) {
    $site_name = mysqli_real_escape_string($conn, $_POST['site_name']);
    $c_email = mysqli_real_escape_string($conn, $_POST['contact_email']);
    $c_phone = mysqli_real_escape_string($conn, $_POST['contact_phone']);
    
    $n_job = isset($_POST['n_job']) ? 1 : 0;
    $n_app = isset($_POST['n_app']) ? 1 : 0;
    $n_user = isset($_POST['n_user']) ? 1 : 0;

    // Data ရှိမရှိ အရင်စစ်ပြီးမှ Update သို့မဟုတ် Insert လုပ်မယ်
    $check_settings = mysqli_query($conn, "SELECT id FROM settings WHERE id=1");
    if (mysqli_num_rows($check_settings) > 0) {
        $query = "UPDATE settings SET 
            site_name='$site_name', contact_email='$c_email', contact_phone='$c_phone',
            notify_job='$n_job', notify_app='$n_app', notify_user='$n_user' WHERE id=1";
    } else {
        $query = "INSERT INTO settings (id, site_name, contact_email, contact_phone, notify_job, notify_app, notify_user) 
                  VALUES (1, '$site_name', '$c_email', '$c_phone', '$n_job', '$n_app', '$n_user')";
    }

    if (mysqli_query($conn, $query)) {
        header("Location: settings.php?msg=updated");
        exit();
    }
}

// --- ၂။ Security (Email နှင့် Password ပြောင်းခြင်း) ---
if (isset($_POST['update_security'])) {
    $admin_email = mysqli_real_escape_string($conn, $_POST['admin_email']);
    $new_pw = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_pw = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    if (!empty($new_pw)) {
        if ($new_pw === $confirm_pw) {
            // Password ကို Hash မလုပ်ထားရင် ဒီအတိုင်းသိမ်းမယ် (သို့မဟုတ် password_hash သုံးပါ)
            if (mysqli_query($conn, "UPDATE admin SET email='$admin_email', password='$new_pw' WHERE id='$admin_id'")) {
                header("Location: settings.php?msg=updated");
                exit();
            }
        } else {
            $error = "Password မတူညီပါ။";
        }
    } else {
        if (mysqli_query($conn, "UPDATE admin SET email='$admin_email' WHERE id='$admin_id'")) {
            header("Location: settings.php?msg=updated");
            exit();
        }
    }
}



// Database မှ data ပြန်ထုတ်ခြင်း (Error မတက်အောင် Default values များ သတ်မှတ်ထားခြင်း)
$st_res = mysqli_query($conn, "SELECT * FROM settings WHERE id=1");
$st = mysqli_fetch_assoc($st_res) ?: [
    'site_name' => '', 'contact_email' => '', 'contact_phone' => '',
    'notify_job' => 0, 'notify_app' => 0, 'notify_user' => 0
];

$ad_res = mysqli_query($conn, "SELECT email FROM admin WHERE id='$admin_id'");
$ad = mysqli_fetch_assoc($ad_res) ?: ['email' => ''];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .card { border: none; border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
        .form-control { border-radius: 12px; border: 1px solid #e0e0e0; padding: 10px 15px; }
        .form-switch .form-check-input { width: 45px; height: 22px; cursor: pointer; }
        .btn-primary { border-radius: 12px; background: #007bff; border: none; padding: 10px 20px; font-weight: 600; }
    @media (max-width: 992px) {
    /* Sidebar ကို ဖုန်းမှာ ဖျောက်ထားမယ် */
    .sidebar {
        position: fixed;
        left: -250px; /* ဘေးကို ကပ်ထားမယ် */
        top: 0;
        height: 100%;
        width: 250px;
        z-index: 1001;
        transition: 0.3s;
        background: white;
    }

    /* Sidebar ပွင့်လာတဲ့အခါ ပြန်ဖော်ဖို့ */
    .sidebar.active {
        left: 0;
    }

    /* Main Content ကို အပြည့်ချဲ့မယ် */
    .main-content {
        margin-left: 0 !important;
        width: 100% !important;
        padding: 15px;
    }

    /* အပေါ်က Header ပိုင်းကို ညှိမယ် */
    .admin-header {
        display: flex;
        justify-content: space-between;
        padding: 10px;
    }
}
    </style>
</head>
<body>
<?php include('nav.php'); ?>
<div class="container py-5" style="max-width: 1100px;">
    <h2 class="fw-bold mb-1">Settings</h2>
    <p class="text-muted mb-4">Manage system settings and configurations</p>

    <?php if(isset($error)): ?>
        <div class="alert alert-danger rounded-pill px-4"><?= $error ?></div>
    <?php endif; ?>

    <div class="row g-4">
        <div class="col-md-6">
            <form method="POST">
                <div class="card p-4 mb-4">
                    <h5 class="fw-bold mb-4">General Settings</h5>
                    <div class="mb-3">
                        <label class="small fw-bold mb-1">Site Name</label>
                        <input type="text" name="site_name" class="form-control" value="<?= htmlspecialchars($st['site_name']) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold mb-1">Contact Email</label>
                        <input type="email" name="contact_email" class="form-control" value="<?= htmlspecialchars($st['contact_email']) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold mb-1">Contact Phone</label>
                        <input type="text" name="contact_phone" class="form-control" value="<?= htmlspecialchars($st['contact_phone']) ?>">
                    </div>
                </div>

                <div class="card p-4">
                    <h5 class="fw-bold mb-4">Email Notifications</h5>
                    <?php 
                    $notifs = [
                        ['n_job', 'New Job Posting', 'Notify admin of new job posts', $st['notify_job']],
                        ['n_app', 'New Applications', 'Notify employers of applications', $st['notify_app']],
                        ['n_user', 'User Registration', 'Notify admin of new users', $st['notify_user']]
                    ];
                    foreach($notifs as $n): ?>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <div class="fw-bold small"><?= $n[1] ?></div>
                            <small class="text-muted"><?= $n[2] ?></small>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="<?= $n[0] ?>" <?= $n[3] ? 'checked' : '' ?>>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <button type="submit" name="save_all" class="btn btn-primary w-100 mt-2 shadow">Save Changes</button>
                </div>
            </form>
        </div>

        <div class="col-md-6">
            <div class="card p-4 mb-4">
                <h5 class="fw-bold mb-4">Security</h5>
                <form method="POST">
                    <div class="mb-4">
                        <label class="small fw-bold mb-1">Admin Account Email</label>
                        <input type="email" name="admin_email" class="form-control" value="<?= htmlspecialchars($ad['email']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold mb-1">Change Password</label>
                        <input type="password" name="new_password" class="form-control mb-2" placeholder="New password">
                        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm password">
                    </div>
                    <button type="submit" name="update_security" class="btn btn-primary w-100 shadow">Update Security</button>
                </form>
            </div>

            <div class="card p-4">
                <h5 class="fw-bold mb-4">System Information</h5>
                <div class="d-flex justify-content-between mb-3"><span class="text-muted small">Version</span><span class="fw-bold small">1.0.0</span></div>
                <div class="d-flex justify-content-between mb-3"><span class="text-muted small">Database</span><span class="text-success fw-bold small">Connected</span></div>
                <div class="d-flex justify-content-between mb-3"><span class="text-muted small">Last Backup</span><span class="fw-bold small">2026-01-20</span></div>
                <div class="d-flex justify-content-between"><span class="text-muted small">Storage Used</span><span class="fw-bold small">2.4 GB / 10 GB</span></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-body text-center p-4">
                <i class="fa-solid fa-circle-check text-success fa-3x mb-3"></i>
                <h5 class="fw-bold">Success!</h5>
                <p class="text-muted small mb-0">အချက်အလက်များကို သိမ်းဆည်းပြီးပါပြီ။</p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    window.addEventListener('DOMContentLoaded', () => {
        const params = new URLSearchParams(window.location.search);
        if (params.get('msg') === 'updated') {
            new bootstrap.Modal(document.getElementById('successModal')).show();
            setTimeout(() => { window.history.replaceState(null, null, window.location.pathname); }, 2000);
        }
    });
</script>
</body>
</html>