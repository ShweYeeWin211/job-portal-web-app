<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
    /* --- မူရင်း Navbar Styling (ဘာမှမပြင်ထားပါ) --- */
    nav {
        display: flex; 
        justify-content: space-between; 
        align-items: center;
        padding: 0 8%; 
        background: white;
        box-shadow: 0 2px 15px rgba(0,0,0,0.05);
        position: sticky; 
        top: 0; 
        z-index: 1000;
        height: 75px;
    }

    nav .logo { 
        font-size: 22px; 
        font-weight: 800; 
        color: #1877f2; 
        text-decoration: none; 
        display: flex; 
        align-items: center; 
        gap: 10px; 
    }

    .nav-links { 
        display: flex; 
        list-style: none; 
        gap: 25px; 
        align-items: center; 
        margin: 0; padding: 0;
    }

    .nav-links a { 
        text-decoration: none; 
        color: #64748b; 
        font-weight: 600; 
        font-size: 15px; 
        transition: 0.3s; 
    }

    .nav-links a:hover { color: #1877f2; }

    .admin-link {
        color: #ff4757 !important;
        border: 1.5px solid #ff4757;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 13px !important;
    }

    .admin-link:hover { background: #ff4757; color: white !important; }

    .user-section { 
        display: flex; 
        align-items: center; 
        gap: 12px; 
        padding-left: 15px; 
        border-left: 1px solid #e2e8f0;
    }

    .user-info { text-align: right; line-height: 1.2; }
    .user-info span { display: block; font-weight: 700; font-size: 14px; color: #0f172a; }
    .user-info small { color: #64748b; font-size: 11px; }

    .user-section img, .avatar-initial { 
        width: 38px; height: 38px; border-radius: 50%; 
        object-fit: cover; border: 2px solid #1877f2;
    }

    .avatar-initial {
        background: #1877f2; color: white;
        display: flex; align-items: center; justify-content: center;
        font-weight: 700; font-size: 16px;
    }

    .logout-btn { color: #ef4444; font-size: 18px; margin-left: 5px; transition: 0.3s; }

    /* Mobile Menu Toggle ခလုတ် (Desktop မှာ ဖျောက်ထားမယ်) */
    .user-menu-toggle {
        display: none;
        font-size: 22px;
        cursor: pointer;
        color: #64748b;
        margin-right: 15px;
    }

    /* --- 📱 Mobile View အတွက်သာ (Design မပျက်စေရ) --- */
    /* --- 📱 Mobile View (768px အောက်) အတွက်သာ သီးသန့် ပြင်ဆင်ချက် --- */
@media (max-width: 768px) {
    nav { padding: 0 15px; justify-content: space-between; }
    
    .user-menu-toggle { display: block; order: 1; } /* Hamburger ကို ဘယ်ဘက်ပို့မယ် */
    nav .logo { order: 2; margin-right: auto; padding-left: 10px; } /* Logo ကို ဘေးကပ်ပေးမယ် */
    .user-section { order: 3; }

    .nav-links {
        position: absolute; /* Fixed အစား Absolute ပြောင်းမယ် (Dashboard style အတိုင်း) */
        top: 75px;
        left: -100%;
        display: flex;
        flex-direction: column;
        background: white;
        width: 250px; /* အကျယ်ကို ကန့်သတ်လိုက်မယ် */
        height: calc(100vh - 75px);
        padding: 20px 0;
        box-shadow: 5px 0 15px rgba(0,0,0,0.1);
        transition: 0.3s;
        gap: 0; /* Gap ကို ဖြုတ်ပြီး padding နဲ့ နေရာချမယ် */
        align-items: flex-start !important; /* စာသားတွေကို ဘယ်ဘက်ကပ်မယ် */
        z-index: 999;
    }

    .nav-links.active { left: 0; }

    .nav-links li { width: 100%; }

    .nav-links a {
        display: block;
        padding: 15px 25px; /* ဘယ်ဘက်ကနေ အကွာအဝေး ပေးမယ် */
        width: 100%;
        border-bottom: 1px solid #f8fafc;
        text-align: left; /* စာသားတွေကို ဘယ်ကပ်မယ် */
    }

    /* Admin Link ကိုလည်း ဘယ်ကပ်မယ် */
    .admin-link {
        margin: 10px 25px;
        display: inline-block !important;
        width: auto !important;
    }

    .user-info { display: none; }
}
</style>

<nav>
    <div style="display: flex; align-items: center;">
        <div class="user-menu-toggle" onclick="toggleUserMenu()">
            <i class="fas fa-bars"></i>
        </div>
        
        <a href="index.php" class="logo">
            <i class="fas fa-briefcase"></i> IT PORTAL
        </a>
    </div>
    
    <ul class="nav-links" id="userNavLinks">
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="companies.php">Companies</a></li>
        <li><a href="categories.php">Categories</a></li>

        <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <li>
                <a href="../../admin/JOBMANAGEMENT/dashboard.php" class="admin-link">
                    <i class="fas fa-user-shield"></i> Admin Panel
                </a>
            </li>
        <?php endif; ?>
    </ul>

    <div class="user-section">
        <div class="user-info">
            <span><?php echo htmlspecialchars($username); ?></span>
            <small>
                <?php 
                    if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                        echo 'Administrator';
                    } else {
                        echo 'User';
                    }
                ?>
            </small>
        </div>
        
        <?php 
            $initial = !empty($username) ? strtoupper(substr($username, 0, 1)) : 'U';
            if(!empty($profile_img) && file_exists($profile_img)): 
        ?>
            <img src="<?php echo $profile_img; ?>" alt="Profile">
        <?php else: ?>
            <div class="avatar-initial"><?php echo $initial; ?></div>
        <?php endif; ?>

        <a href="logout.php" class="logout-btn" title="Logout">
            <i class="fas fa-sign-out-alt"></i>
        </a>
    </div>
</nav>

<script>
    function toggleUserMenu() {
        document.getElementById("userNavLinks").classList.toggle("active");
    }

    // Menu အပြင်ဘက်ကို နှိပ်ရင် ပြန်ပိတ်သွားအောင်
    window.addEventListener('click', function(e) {
        const navLinks = document.getElementById("userNavLinks");
        const toggleBtn = document.querySelector(".user-menu-toggle");
        if (navLinks.classList.contains("active") && !navLinks.contains(e.target) && !toggleBtn.contains(e.target)) {
            navLinks.classList.remove("active");
        }
    });
</script>