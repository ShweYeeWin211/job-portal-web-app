<?php
session_start();
// Login status နှင့် Navbar အတွက် လိုအပ်သည်များ
$is_logged_in = isset($_SESSION['username']);
$username = $is_logged_in ? $_SESSION['username'] : "Guest";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Categories - IT Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1877f2;
            --dark-navy: #0f172a;
            --light-bg: #f8fafc;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: var(--light-bg); color: #1e293b; }

        /* --- Header Section --- */
        .page-title {
            padding: 80px 8% 40px;
            text-align: center;
        }
        .page-title h1 { font-size: 40px; font-weight: 800; color: var(--dark-navy); margin-bottom: 10px; }
        .page-title p { color: #64748b; font-size: 18px; }

        /* --- Category Grid (Index Style) --- */
        .category-container {
            padding: 0 8% 80px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .cat-card {
            background: white;
            padding: 40px 30px;
            border-radius: 24px;
            text-align: center;
            text-decoration: none;
            border: 1px solid #e2e8f0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .cat-card:hover {
            transform: translateY(-10px);
            border-color: var(--primary);
            box-shadow: 0 20px 40px rgba(0,0,0,0.05);
        }

        .cat-card i {
            font-size: 45px;
            color: var(--primary);
            margin-bottom: 25px;
            transition: 0.3s;
        }

        .cat-card:hover i {
            transform: scale(1.1);
        }

        .cat-card h3 {
            font-size: 20px;
            color: var(--dark-navy);
            font-weight: 800;
            margin-bottom: 8px;
        }

        .cat-card span {
            color: #64748b;
            font-size: 14px;
            font-weight: 600;
        }

        footer { background: var(--dark-navy); padding: 30px; text-align: center; color: rgba(255,255,255,0.6); }
    </style>
</head>
<body>

    <?php include('navbar.php'); ?>

    <div class="page-title">
        <h1>Trending Categories 🚀</h1>
        <p>Choose your expertise and find the best career opportunities.</p>
    </div>

    <div class="category-container">
        <a href="jobs.php?type=software" class="cat-card">
            <i class="fas fa-code"></i>
            <h3>Software Dev</h3>
            <span>120+ Vacancies</span>
        </a>

        <a href="jobs.php?type=networking" class="cat-card">
            <i class="fas fa-network-wired"></i>
            <h3>Networking</h3>
            <span>45+ Vacancies</span>
        </a>

        <a href="jobs.php?type=data" class="cat-card">
            <i class="fas fa-database"></i>
            <h3>Data Science</h3>
            <span>32+ Vacancies</span>
        </a>

        <a href="jobs.php?type=security" class="cat-card">
            <i class="fas fa-shield-alt"></i>
            <h3>Cyber Security</h3>
            <span>18+ Vacancies</span>
        </a>
    </div>

    <footer>
        <p>© 2026 IT Job Portal | Empowering Your Professional Future</p>
    </footer>

</body>
</html>