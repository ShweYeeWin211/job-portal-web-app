<?php
session_start();
// Login ဝင်ထားခြင်း ရှိမရှိ စစ်ဆေးခြင်း
$is_logged_in = isset($_SESSION['username']);
$username = $is_logged_in ? $_SESSION['username'] : "";

// Database Connection
$conn = mysqli_connect("localhost", "root", "", "job_portal");
$profile_img = "https://cdn-icons-png.flaticon.com/512/3135/3135715.png"; // Default image

if ($is_logged_in) {
    $safe_username = mysqli_real_escape_string($conn, $username);
    $user_query = "SELECT profile_image FROM users WHERE username = '$safe_username'";
    $user_result = mysqli_query($conn, $user_query);
    if ($user_data = mysqli_fetch_assoc($user_result)) {
        if (!empty($user_data['profile_image'])) {
            $profile_img = "uploads/" . $user_data['profile_image'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Companies in Taunggyi | IT Job Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0062ff;
            --dark-navy: #0f172a;
            --light-bg: #f8fafc;
            --transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: var(--light-bg); color: #1e293b; }

        /* --- 🌐 Navigation Bar --- */
        nav {
            display: flex; justify-content: space-between; align-items: center;
            padding: 15px 8%; background: white;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            position: sticky; top: 0; z-index: 1000;
        }
        .logo { font-size: 22px; font-weight: 800; color: var(--primary-color); text-decoration: none; display: flex; align-items: center; gap: 10px; }
        
        .nav-links { display: flex; list-style: none; gap: 25px; align-items: center; }
        .nav-links a { text-decoration: none; color: #64748b; font-weight: 600; font-size: 15px; transition: var(--transition); }
        .nav-links a:hover, .nav-links a.active { color: var(--primary-color); }

        .user-section { display: flex; align-items: center; gap: 12px; padding-left: 20px; border-left: 1px solid #e2e8f0; }
        .user-section img { width: 38px; height: 38px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary-color); }
        .logout-btn { color: #ef4444; font-size: 18px; transition: 0.3s; }

        /* --- Header Section --- */
        .header-banner {
            padding: 60px 8% 100px; text-align: center;
            background: linear-gradient(135deg, #0062ff 0%, #0042aa 100%);
            color: white; clip-path: polygon(0 0, 100% 0, 100% 85%, 0% 100%);
        }
        .header-banner h1 { font-size: 34px; font-weight: 800; margin-bottom: 20px; }

        .city-box {
            padding: 10px 25px; border-radius: 50px; border: 2px solid rgba(255,255,255,0.3);
            background: rgba(255,255,255,0.2); color: white;
            font-weight: 700; outline: none; cursor: pointer; transition: 0.3s;
        }
        .city-box option { color: #333; }

        /* --- Grid System --- */
        .main-container { padding: 0 8% 60px; margin-top: -40px; }
        .company-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px; }

        /* --- Card Design --- */
        .card { background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: var(--transition); border: 1px solid #f1f5f9; display: flex; flex-direction: column; }
        .card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
        .image-container { width: 100%; height: 210px; overflow: hidden; }
        .image-container img { width: 100%; height: 100%; object-fit: cover; transition: 0.5s; }
        .card:hover img { transform: scale(1.1); }

        .card-info { padding: 25px; flex-grow: 1; display: flex; flex-direction: column; }
        .card-info h3 { font-size: 20px; margin-bottom: 12px; font-weight: 800; color: var(--dark-navy); }
        .card-info p { color: #64748b; font-size: 14.5px; margin-bottom: 20px; line-height: 1.6; flex-grow: 1; }

        .view-btn { display: block; text-align: center; padding: 12px; background: #f1f5f9; color: var(--primary-color); text-decoration: none; font-weight: 700; border-radius: 12px; transition: 0.3s; }
        .view-btn:hover { background: var(--primary-color); color: white; }

        footer { background: var(--dark-navy); padding: 50px 8%; text-align: center; color: white; }
        .heart-icon { color: #ff4d4d; animation: pound 0.8s infinite alternate; display: inline-block; }
        @keyframes pound { from { transform: scale(1); } to { transform: scale(1.3); } }
    </style>
</head>
<body>

    <?php include('navbar.php'); ?>

    <div class="header-banner">
        <h1>IT Companies in Taunggyi ⛰️</h1>
        <div style="margin-top: 15px;">
            <label style="font-weight: 600; margin-right: 10px;"><i class="fas fa-map-marker-alt"></i> Select City: </label>
            <select class="city-box" onchange="location = this.value;">
                <option value="taunggyi.php" selected>Taunggyi</option>
                <option value="meiktila.php">Meiktila</option>
                <option value="yangon.php">Yangon</option>
                <option value="companies.php">Mandalay</option>
                <option value="naypyitaw.php">Nay Pyi Taw</option>
            </select>
        </div>
    </div>

    <div class="main-container">
        <div class="company-grid">
            <div class="card">
                <div class="image-container"><img src="https://images.pexels.com/photos/1181671/pexels-photo-1181671.jpeg?w=500"></div>
                <div class="card-info">
                    <h3>Galaxy Software TGI</h3>
                    <p>Professional Software products and enterprise services tailored for Shan State's business ecosystem.</p>
                    <a href="taung_job.php?id=galaxy" class="view-btn">View Openings <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="card">
                <div class="image-container"><img src="https://images.pexels.com/photos/3182812/pexels-photo-3182812.jpeg?w=500"></div>
                <div class="card-info">
                    <h3>Amazing Tech TGI</h3>
                    <p>Local IT solutions provider focused on innovative mobile and web development initiatives.</p>
                    <a href="taung_job.php?id=amazing" class="view-btn">View Openings <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="card">
                <div class="image-container"><img src="https://images.pexels.com/photos/3183150/pexels-photo-3183150.jpeg?w=500"></div>
                <div class="card-info">
                    <h3>Dynamicweb TGI</h3>
                    <p>Leading provider of enterprise tech solutions and scalable cloud infrastructure in the region.</p>
                    <a href="taung_job.php?id=dynamic" class="view-btn">View Openings <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            
            </div>
    </div>

    <footer>
        
        <div class="copyright">© 2026 Job Portal - Empowering Professional Futures in Taunggyi.</div>
    </footer>
</body>
</html>