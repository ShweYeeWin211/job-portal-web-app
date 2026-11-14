<?php
session_start();
// Login ဝင်ထားခြင်း ရှိမရှိ စစ်ဆေးခြင်း
$is_logged_in = isset($_SESSION['username']);
$username = $is_logged_in ? $_SESSION['username'] : "";

// Database Connection
$conn = mysqli_connect("localhost", "root", "", "job_portal");
$profile_img = "https://cdn-icons-png.flaticon.com/512/3135/3135715.png"; // Default image

if ($is_logged_in) {
    // SQL Injection ကာကွယ်ရန် escape string သုံးခြင်း
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
    <title>IT Companies in Nay Pyi Taw | Job Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1877f2;
            --dark-navy: #0f172a;
            --light-bg: #f8fafc;
            --transition: all 0.3s ease;
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
        .logo { font-size: 22px; font-weight: 800; color: var(--primary); text-decoration: none; display: flex; align-items: center; gap: 10px; }
        
        .nav-links { display: flex; list-style: none; gap: 25px; align-items: center; }
        .nav-links a { text-decoration: none; color: #64748b; font-weight: 600; font-size: 15px; transition: var(--transition); }
        .nav-links a:hover, .nav-links a.active { color: var(--primary); }

        .user-section { display: flex; align-items: center; gap: 12px; padding-left: 20px; border-left: 1px solid #e2e8f0; }
        .user-section img { width: 38px; height: 38px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary); }
        .logout-btn { color: #ef4444; font-size: 18px; transition: 0.3s; }
        .logout-btn:hover { transform: scale(1.1); }

        /* --- Header Section --- */
        .header-banner {
            padding: 60px 8% 100px; text-align: center;
            background: linear-gradient(135deg, #1877f2 0%, #0056b3 100%);
            color: white; clip-path: polygon(0 0, 100% 0, 100% 85%, 0% 100%);
        }
        .header-banner h1 { font-size: 34px; font-weight: 800; margin-bottom: 20px; }

        .city-box {
            padding: 10px 25px; border-radius: 50px; border: 2px solid rgba(255,255,255,0.3);
            background: rgba(255,255,255,0.2); color: white;
            font-weight: 700; outline: none; cursor: pointer; transition: 0.3s;
        }
        .city-box option { color: #333; }
        .city-box:hover { background: rgba(255,255,255,0.3); }

        /* --- Grid System --- */
        .main-container { padding: 0 8% 60px; margin-top: -40px; }
        .company-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px; }

        /* --- Card Design --- */
        .card { background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: 0.4s; border: 1px solid #f1f5f9; display: flex; flex-direction: column; }
        .card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
        .image-container { width: 100%; height: 200px; overflow: hidden; background: #eee; }
        .image-container img { width: 100%; height: 100%; object-fit: cover; transition: 0.5s; }
        .card:hover img { transform: scale(1.1); }

        .card-info { padding: 25px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between; }
        .card-info h3 { font-size: 20px; margin-bottom: 10px; font-weight: 800; color: var(--dark-navy); }
        .card-info p { color: #64748b; font-size: 14px; margin-bottom: 20px; line-height: 1.6; }

        .view-btn { display: block; text-align: center; padding: 12px; background: #f1f5f9; color: var(--primary); text-decoration: none; font-weight: 700; border-radius: 12px; transition: 0.3s; }
        .view-btn:hover { background: var(--primary); color: white; }

        footer { background: var(--dark-navy); padding: 40px; text-align: center; color: rgba(255,255,255,0.6); font-size: 14px; }
        .heart-icon { color: #ef4444; display: inline-block; animation: heartBeat 1.2s infinite; }
        @keyframes heartBeat { 0% { transform: scale(1); } 50% { transform: scale(1.2); } 100% { transform: scale(1); } }
    </style>
</head>
<body>

    <?php include('navbar.php'); ?>

    <div class="header-banner">
        <h1>IT Companies in Nay Pyi Taw 🏛️</h1>
        <div style="margin-top: 15px;">
            <label style="font-weight: 600; margin-right: 10px;">Switch City: </label>
            <select class="city-box" onchange="location = this.value;">
                <option value="naypyitaw.php" selected>Nay Pyi Taw</option>
                <option value="meiktila.php">Meiktila</option>
                <option value="yangon.php">Yangon</option>
                <option value="mandalay.php">Mandalay</option>
                <option value="taunggyi.php">Taunggyi</option>
            </select>
        </div>
    </div>

    <div class="main-container">
        <div class="company-grid">
            
            <div class="card">
                <div class="image-container">
                    <img src="https://images.pexels.com/photos/3183150/pexels-photo-3183150.jpeg?w=500" alt="Linn IT Solution">
                </div>
                <div class="card-info">
                    <h3>Linn IT Solution</h3>
                    <p>Expertise in Networking, Hardware maintenance, and Professional Systems Integration for government and private sectors in NPT.</p>
                    <a href="nayopen_job.php?id=linn" class="view-btn">View 6 Openings</a>
                </div>
            </div>
            
            <div class="card">
                <div class="image-container">
                    <img src="https://images.pexels.com/photos/3861958/pexels-photo-3861958.jpeg?w=500" alt="Info Sys">
                </div>
                <div class="card-info">
                    <h3>Info Sys (Myanmar)</h3>
                    <p>Providing high-quality software development, custom applications, and project documentation services in Ottara Thiri.</p>
                    <a href="nayopen_job.php?id=infosys" class="view-btn">View 6 Openings</a>
                </div>
            </div>

            <div class="card">
                <div class="image-container">
                    <img src="https://images.pexels.com/photos/3182812/pexels-photo-3182812.jpeg?w=500" alt="Galaxy Software">
                </div>
                <div class="card-info">
                    <h3>Galaxy Software NPT</h3>
                    <p>The leading provider of ERP solutions, accounting software, and implementation services for local departments.</p>
                    <a href="nayopen_job.php?id=galaxy" class="view-btn">View 6 Openings</a>
                </div>
            </div>

            <div class="card">
                <div class="image-container">
                    <img src="https://images.pexels.com/photos/3182762/pexels-photo-3182762.jpeg?w=500" alt="Novel Idea">
                </div>
                <div class="card-info">
                    <h3>Novel Idea NPT</h3>
                    <p>Creative agency focusing on Graphic Design, Content Creation, and UI/UX wireframing for digital marketing.</p>
                    <a href="nayopen_job.php?id=novel" class="view-btn">View 6 Openings</a>
                </div>
            </div>

            <div class="card">
                <div class="image-container">
                    <img src="https://images.pexels.com/photos/1181244/pexels-photo-1181244.jpeg?w=500" alt="Global Technology">
                </div>
                <div class="card-info">
                    <h3>Global Technology</h3>
                    <p>Specializing in enterprise ISP infrastructure, fiber optic installation, and secure cloud computing solutions.</p>
                    <a href="nayopen_job.php?id=global" class="view-btn">View 6 Openings</a>
                </div>
            </div>

            <div class="card">
                <div class="image-container">
                    <img src="https://images.pexels.com/photos/3183183/pexels-photo-3183183.jpeg?w=500" alt="Naung Yoe Tech">
                </div>
                <div class="card-info">
                    <h3>Naung Yoe Tech</h3>
                    <p>Leading security system provider specializing in CCTV installation and hardware firewall configurations.</p>
                    <a href="nayopen_job.php?id=naungyoe" class="view-btn">View 6 Openings</a>
                </div>
            </div>

            <div class="card">
                <div class="image-container">
                    <img src="https://images.pexels.com/photos/267511/pexels-photo-267511.jpeg?w=500" alt="MCCI">
                </div>
                <div class="card-info">
                    <h3>MCC.i Campus</h3>
                    <p>Premier IT education center in Pyinmana, teaching NCC UK curriculum and managing digital campus resources.</p>
                    <a href="nayopen_job.php?id=mcci" class="view-btn">View 6 Openings</a>
                </div>
            </div>

            

        </div>
    </div>

    <footer>
        <p>Best of luck in your career journey! <span class="heart-icon">❤️</span></p>
        <p style="margin-top: 10px; font-size: 12px;">© 2026 IT Job Portal - Nay Pyi Taw Tech Hub.</p>
    </footer>

</body>
</html>