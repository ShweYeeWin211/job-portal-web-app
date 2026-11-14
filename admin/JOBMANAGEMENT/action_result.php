<?php 
include('nav.php'); 
$status = isset($_GET['status']) ? $_GET['status'] : '';
?>

<div class="container-fluid py-5 text-center" style="margin-left: 240px; width: calc(100% - 240px);">
    <div class="card p-5 border-0 shadow-sm mx-auto" style="max-width: 500px; border-radius: 20px;">
        <?php if($status == 'Approved'): ?>
            <div class="mb-4"><i class="fas fa-check-circle text-success" style="font-size: 80px;"></i></div>
            <h2 class="fw-bold text-success">Approved Successfully!</h2>
            <p class="text-muted">လျှောက်လွှာကို အောင်မြင်စွာ အတည်ပြုလိုက်ပါပြီ။</p>
        <?php elseif($status == 'Rejected'): ?>
            <div class="mb-4"><i class="fas fa-times-circle text-danger" style="font-size: 80px;"></i></div>
            <h2 class="fw-bold text-danger">Application Rejected!</h2>
            <p class="text-muted">ဤလျှောက်လွှာကို သင် ပယ်ချလိုက်ပါပြီ။</p>
        <?php endif; ?>
        
        <div class="mt-4">
            <a href="applications.php" class="btn btn-primary px-5 py-2 rounded-pill fw-bold">Back to List</a>
        </div>
    </div>
</div>