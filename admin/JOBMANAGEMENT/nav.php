<?php
// လက်ရှိရောက်နေတဲ့ Page နာမည်
$current_page = basename($_SERVER['PHP_SELF']);
include_once 'db.php'; 

// Database မှ Activity ၂၀ ဆွဲထုတ်ခြင်း
$noti_query = mysqli_query($conn, "SELECT * FROM notifications ORDER BY id DESC LIMIT 20");
$display_notis = [];
if($noti_query) {
    while($row = mysqli_fetch_assoc($noti_query)){
        $display_notis[] = $row['message'];
    }
}
$noti_count = count($display_notis);
?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
    body { margin: 0; font-family: 'Inter', sans-serif; background-color: #f4f7fe; }
    
    .sidebar {
        width: 260px; height: 100vh; position: fixed;
        background: #fff; border-right: 1px solid #e2e8f0;
        padding: 25px 20px; z-index: 1001; transition: 0.3s;
    }
    
    .logo-section { display: flex; gap: 12px; margin-bottom: 30px; align-items: center; }
    .logo-icon { width: 42px; height: 42px; border-radius: 12px; background: #3b82f6; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 20px; }
    
    .nav-link { display: flex; align-items: center; gap: 14px; padding: 12px 15px; text-decoration: none; color: #64748b; border-radius: 12px; margin-bottom: 6px; font-size: 14px; transition: 0.3s; }
    .nav-link:hover, .nav-link.active { background: #eff6ff; color: #3b82f6; font-weight: 600; }
    .logout-btn { margin-top: 20px; color: #ef4444 !important; }
    
    .navbar {
        height: 75px; background: #fff; border-bottom: 1px solid #e2e8f0;
        display: flex; align-items: center; justify-content: space-between;
        padding: 0 40px; position: sticky; top: 0; z-index: 1000;
    }
    
    .search-box {
        background: #f1f5f9; padding: 10px 18px; border-radius: 20px;
        display: flex; gap: 10px; width: 400px; align-items: center;
    }
    .search-box input { border: none; background: none; outline: none; width: 100%; font-size: 14px; }
    
    /* Noti Dropdown Styles */
    .noti-btn { position: relative; font-size: 20px; cursor: pointer; color: #64748b; }
    .noti-dot { width: 10px; height: 10px; background: #ef4444; border-radius: 50%; position: absolute; top: -2px; right: -2px; border: 2px solid #fff; }
    .noti-dropdown {
        position: absolute; right: 0; top: 45px; width: 300px; background: #fff;
        border: 1px solid #e2e8f0; border-radius: 15px; display: none;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1); overflow: hidden;
    }
    .noti-dropdown.show { display: block; animation: fadeIn 0.3s ease; }
    .noti-header { padding: 15px; font-weight: bold; border-bottom: 1px solid #f1f5f9; font-size: 14px; }
    .noti-item { padding: 12px 15px; font-size: 13px; color: #475569; border-bottom: 1px solid #f8fafc; display: flex; align-items: flex-start; gap: 10px; }
    .noti-footer { padding: 12px; text-align: center; background: #f8fafc; }
    .noti-footer a { text-decoration: none; color: #3b82f6; font-size: 12px; font-weight: 600; }

    /* Mobile Responsive ညှိချက် (ဒီဇိုင်း မပျက်စေရ) */
    @media (max-width: 992px) {
        .sidebar { left: -260px; }
        .sidebar.active { left: 0; }
        .main-content { margin-left: 0 !important; width: 100% !important; }
        .navbar { padding: 0 20px; }
        .search-box { width: 150px !important; }
        .menu-toggle { display: block !important; }
    }

    .menu-toggle { display: none; font-size: 20px; cursor: pointer; color: #64748b; margin-right: 15px; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
</style>

<aside class="sidebar">
    <div class="logo-section">
        <div class="logo-icon"><i class="fa fa-briefcase"></i></div>
        <div>
            <strong style="font-size: 18px; color: #1e293b;">JobPortal</strong><br>
            <small class="text-muted">Admin Panel</small>
        </div>
    </div>
    <nav>
        <a href="dashboard.php" class="nav-link <?= $current_page=='dashboard.php'?'active':'' ?>"><i class="fa fa-th-large"></i> Dashboard</a>
        <a href="jobmanagement.php" class="nav-link <?= $current_page=='jobmanagement.php'?'active':'' ?>"><i class="fa fa-briefcase"></i> Jobs Management</a>
        <a href="usermanagement.php" class="nav-link <?= $current_page=='usermanagement.php'?'active':'' ?>"><i class="fa fa-users"></i> Users Management</a>
        <a href="applications.php" class="nav-link <?= $current_page=='applications.php'?'active':'' ?>"><i class="fa fa-file-alt"></i> Applications</a>
        <a href="categories.php" class="nav-link <?= $current_page=='categories.php'?'active':'' ?>"><i class="fa fa-tags"></i> Categories</a>
        <a href="settings.php" class="nav-link <?= $current_page=='settings.php'?'active':'' ?>"><i class="fa fa-cog"></i> Settings</a>
        <a href="logout.php" class="nav-link logout-btn"><i class="fa fa-sign-out-alt"></i> Logout</a>
    </nav>
</aside>

<div class="main-content" style="margin-left: 260px;">
    <header class="navbar">
        <div style="display: flex; align-items: center;">
            <div class="menu-toggle" onclick="toggleSidebar()">
                <i class="fa fa-bars"></i>
            </div>
            <div class="search-box">
                <i class="fa fa-search text-muted"></i>
                <input type="text" id="pageSearch" placeholder="Search in this page..." onkeyup="searchFunction()">
            </div>
        </div>

        <div class="noti-btn" onclick="toggleNoti(event)">
            <i class="fa-regular fa-bell"></i>
            <?php if($noti_count > 0): ?><div class="noti-dot"></div><?php endif; ?>

            <div class="noti-dropdown" id="notiBox" onclick="event.stopPropagation()">
                <div class="noti-header">Recent Activities</div>
                <div style="max-height: 350px; overflow-y: auto;">
                    <?php if($noti_count > 0): ?>
                        <?php foreach($display_notis as $n): ?>
                            <div class="noti-item">
                                <i class="fa-solid fa-circle-check text-success" style="margin-top: 3px;"></i>
                                <span><?= htmlspecialchars($n) ?></span>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="noti-item text-muted text-center py-4">No new notifications</div>
                    <?php endif; ?>
                </div>
                <div class="noti-footer"><a href="noti.php">VIEW ALL NOTIFICATIONS</a></div>
            </div>
        </div>
    </header>

<script>
    function searchFunction(){
        let input = document.getElementById("pageSearch").value.toLowerCase();
        let rows = document.getElementsByClassName("searchable");
        for(let r of rows){
            r.style.display = r.innerText.toLowerCase().includes(input) ? "" : "none";
        }
    }
    function toggleNoti(e){
        e.stopPropagation();
        document.getElementById("notiBox").classList.toggle("show");
    }
    function toggleSidebar() {
        document.querySelector(".sidebar").classList.toggle("active");
    }
    window.onclick = function(e){
        const box = document.getElementById("notiBox");
        if(box && box.classList.contains("show")){ box.classList.remove("show"); }
        
        const sidebar = document.querySelector(".sidebar");
        const menuBtn = document.querySelector(".menu-toggle");
        if (sidebar.classList.contains("active") && !sidebar.contains(e.target) && !menuBtn.contains(e.target)) {
            sidebar.classList.remove("active");
        }
    }
</script>