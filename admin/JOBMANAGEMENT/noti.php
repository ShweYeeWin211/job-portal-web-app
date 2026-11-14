<?php
// ၁။ Database ချိတ်ဆက်ခြင်း
include_once 'db.php';

// --- ၂။ LOGIC အပိုင်း (REDIRECT လုပ်မည့်ကုဒ်များကို HTML မတိုင်ခင် အရင်ထားရပါမည်) ---

// Notification တစ်ခုချင်းစီကို ဖျက်ခြင်း
if (isset($_GET['delete_id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['delete_id']);
    mysqli_query($conn, "DELETE FROM notifications WHERE id = '$id'");
    
    // Header Redirect ကို ဘာ HTML မှ မပို့ခင် ဒီမှာ လုပ်ဆောင်ပါသည်
    header("Location: noti.php");
    exit(); 
}

// Notification အားလုံးကို တစ်ခါတည်းဖျက်ခြင်း
if (isset($_POST['clear_all'])) {
    mysqli_query($conn, "DELETE FROM notifications");
    header("Location: noti.php");
    exit();
}

// --- ၃။ DISPLAY အပိုင်း (LOGIC များပြီးမှ nav.php ကို include လုပ်ပါ) ---


// ပြသရန် Noti အားလုံးကို ဆွဲထုတ်ခြင်း
$all_notis = mysqli_query($conn, "SELECT * FROM notifications ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Activity Logs | Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .page-container { padding: 30px; }
        .log-card { 
            border: none; 
            border-radius: 15px; 
            box-shadow: 0 4px 20px rgba(0,0,0,0.05); 
            background: white; 
            overflow: hidden;
        }
        .log-item { 
            padding: 20px; 
            border-bottom: 1px solid #f1f5f9; 
            display: flex; 
            align-items: center; 
            justify-content: space-between;
            transition: 0.2s;
        }
        .log-item:hover { background: #f8fafc; }
        .log-icon { 
            width: 45px; height: 45px; 
            border-radius: 12px; 
            display: flex; align-items: center; 
            justify-content: center; 
            margin-right: 15px; 
            background: #eff6ff; 
            color: #3b82f6;
        }
        .time-text { font-size: 11px; color: #94a3b8; margin-top: 4px; }
        .msg-text { font-size: 14px; color: #1e293b; font-weight: 500; }
        .empty-state { padding: 80px 0; text-align: center; color: #94a3b8; }
    </style>
</head>
<body>
<?php include('nav.php'); ?>

<div class="page-container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Activity Logs</h4>
            <p class="text-muted small mb-0">System-wide updates and admin actions.</p>
        </div>
        
        <?php if(mysqli_num_rows($all_notis) > 0): ?>
            <form method="POST" onsubmit="return confirm('နိုတီအားလုံးကို ဖျက်ရန် သေချာပါသလား?');">
                <button type="submit" name="clear_all" class="btn btn-outline-danger btn-sm rounded-pill px-4">
                    <i class="fa-solid fa-trash-can me-1"></i> Clear All
                </button>
            </form>
        <?php endif; ?>
    </div>

    <div class="card log-card">
        <?php if(mysqli_num_rows($all_notis) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($all_notis)): ?>
                <div class="log-item">
                    <div class="d-flex align-items-center">
                        <div class="log-icon">
                            <i class="fa-solid fa-circle-info"></i>
                        </div>
                        <div>
                            <div class="msg-text"><?= htmlspecialchars($row['message']) ?></div>
                            <div class="time-text">
                                <i class="fa-regular fa-clock me-1"></i>
                                <?= date('d M Y, h:i A', strtotime($row['created_at'])) ?>
                            </div>
                        </div>
                    </div>
                    
                    <a href="noti.php?delete_id=<?= $row['id'] ?>" 
                       class="btn btn-link text-danger p-0" 
                       onclick="return confirm('ဒီ Log ကို ဖျက်မှာလား?');">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="empty-state">
                <i class="fa-regular fa-bell-slash fa-3x mb-3" style="opacity: 0.2;"></i>
                <p>No activity logs found at the moment.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>