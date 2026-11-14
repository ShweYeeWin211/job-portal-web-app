<?php
session_start(); // 🌟 Session ကို အပေါ်ဆုံးမှာ တစ်ခါပဲ ထားရပါမယ်

// Navbar အတွက် လိုအပ်တဲ့ variable များ
$username = $_SESSION['username'] ?? 'Guest'; 
$profile_img = $_SESSION['profile_img'] ?? 'https://cdn-icons-png.flaticon.com/512/3135/3135715.png';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Job Portal | Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root {
            --primary: #0062ff;
            --dark: #0f172a;
            --light: #f8fafc;
            --glass: rgba(255, 255, 255, 0.9);
        }

        * {
            margin: 0; padding: 0; box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif;
            scroll-behavior: smooth;
        }

        body { background-color: var(--light); color: var(--dark); overflow-x: hidden; }

        /* --- Modern Navigation (Original Design) --- */
        nav {
            display: flex; justify-content: space-between; align-items: center;
            padding: 20px 8%; background: var(--glass);
            backdrop-filter: blur(10px); position: sticky; top: 0; z-index: 1000;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .logo {
            font-size: 24px; font-weight: 800; color: var(--primary);
            text-decoration: none; display: flex; align-items: center; gap: 10px;
        }

        nav ul { display: flex; list-style: none; gap: 35px; }
        nav ul li a {
            text-decoration: none; color: #64748b; font-weight: 600;
            font-size: 15px; transition: 0.3s;
        }
        nav ul li a:hover { color: var(--primary); }

        .nav-btns { display: flex; align-items: center; gap: 20px; }
        .login-nav {
            background: var(--primary); color: white; text-decoration: none;
            padding: 10px 28px; border-radius: 50px; font-weight: 600;
            box-shadow: 0 4px 15px rgba(0, 98, 255, 0.3); transition: 0.3s;
        }
        .login-nav:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0, 98, 255, 0.4); }

        /* --- Hero Section --- */
        .hero {
            padding: 100px 8% 150px;
            background: radial-gradient(circle at top right, #e0eaff, transparent),
                        radial-gradient(circle at bottom left, #f0f7ff, transparent);
            display: grid; grid-template-columns: 1.2fr 1fr; align-items: center; gap: 50px;
        }

        .hero-text h1 {
            font-size: 64px; font-weight: 800; line-height: 1.1;
            margin-bottom: 25px; color: var(--dark);
        }
        .hero-text h1 span { color: var(--primary); }
        .hero-text p { font-size: 18px; color: #64748b; margin-bottom: 40px; line-height: 1.6; }

        .btn-main {
            background: var(--dark); color: white; padding: 18px 45px;
            border-radius: 50px; text-decoration: none; font-weight: 700;
            display: inline-block; transition: 0.3s;
        }
        .btn-main:hover { transform: scale(1.05); background: #000; }

        /* --- Feature Grid --- */
        .hero-grid {
            display: grid; grid-template-columns: 1fr 1fr; gap: 20px;
        }
        .feature-box {
            background: white; padding: 30px; border-radius: 24px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.04);
            transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .feature-box:hover { transform: translateY(-15px); }
        .feature-box i {
            font-size: 30px; color: var(--primary); margin-bottom: 15px;
            background: #f0f7ff; width: 60px; height: 60px;
            display: flex; align-items: center; justify-content: center; border-radius: 15px;
        }
        .feature-box h3 { font-size: 18px; margin-bottom: 8px; }
        .feature-box p { font-size: 14px; color: #94a3b8; }

        /* --- Categories --- */
        .categories { padding: 100px 8%; text-align: center; background: white; }
        .categories h2 { font-size: 38px; font-weight: 800; margin-bottom: 50px; }
        
        .cat-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 25px;
        }
        .cat-card {
            padding: 40px; border-radius: 24px; border: 1px solid #f1f5f9;
            background: #fff; transition: 0.3s; text-decoration: none; color: inherit;
        }
        .cat-card:hover {
            border-color: var(--primary); background: #f8faff; transform: translateY(-5px);
        }
        .cat-card i { font-size: 40px; color: var(--primary); margin-bottom: 20px; }

        footer {
            padding: 50px; background: var(--dark); color: #94a3b8;
            text-align: center; font-weight: 500;
        }
    </style>
</head>
<body>

    <?php include 'navbar.php'; ?>

    <header class="hero">
        <div class="hero-text">
            <h1>Elevate Your <br><span>IT Career</span> Today</h1>
            <p>Connect with top tech companies in Myanmar. Discover roles that match your passion and skills.</p>
            <a href="register.php" class="btn-main">Get Started Now <i class="fas fa-arrow-right ms-2"></i></a>
        </div>

        <div class="hero-grid">
            <div class="feature-box">
                <i class="fas fa-bolt"></i>
                <h3>Quick Apply</h3>
                <p>Apply with one click.</p>
            </div>
            <div class="feature-box" style="margin-top: 30px;">
                <i class="fas fa-shield-halved"></i>
                <h3>Verified</h3>
                <p>100% Legit jobs.</p>
            </div>
            <div class="feature-box">
                <i class="fas fa-chart-line"></i>
                <h3>Growth</h3>
                <p>Career paths.</p>
            </div>
            <div class="feature-box" style="margin-top: 30px;">
                <i class="fas fa-location-dot"></i>
                <h3>Remote</h3>
                <p>Work anywhere.</p>
            </div>
        </div>
    </header>

    <section class="categories">
        <h2>Trending Categories</h2>
        <div class="cat-grid">
            <a href="categories.php?type=software" class="cat-card">
                <i class="fas fa-code"></i>
                <h3>Software Dev</h3>
                <p class="small text-muted">120+ Vacancies</p>
            </a>
            <a href="categories.php?type=networking" class="cat-card">
                <i class="fas fa-network-wired"></i>
                <h3>Networking</h3>
                <p class="small text-muted">45+ Vacancies</p>
            </a>
            <a href="categories.php?type=data" class="cat-card">
                <i class="fas fa-database"></i>
                <h3>Data Science</h3>
                <p class="small text-muted">32+ Vacancies</p>
            </a>
            <a href="categories.php?type=security" class="cat-card">
                <i class="fas fa-shield-alt"></i>
                <h3>Cyber Security</h3>
                <p class="small text-muted">18+ Vacancies</p>
            </a>
        </div>
    </section>

    <footer>
        <p>© 2026 IT Job Portal | Empowering Your Professional Future</p>
    </footer>

</body>
</html>