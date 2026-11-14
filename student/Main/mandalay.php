<?php
session_start();
// Login status စစ်ဆေးခြင်း
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "job_portal");
$username = $_SESSION['username'];

// User Profile ဆွဲထုတ်ခြင်း
$user_query = "SELECT profile_image FROM users WHERE username = '$username'";
$user_result = mysqli_query($conn, $user_query);
$user_data = mysqli_fetch_assoc($user_result);

$profile_img = ($user_data && $user_data['profile_image']) ? "uploads/" . $user_data['profile_image'] : "https://cdn-icons-png.flaticon.com/512/3135/3135715.png";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Companies in Mandalay | Job Portal</title>
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
        /* --- Mobile Responsive for Grid --- */
@media (max-width: 768px) {
    .header-banner {
        padding: 40px 5% 80px; /* Banner အမြင့်ကို လျှော့မယ် */
    }

    .header-banner h1 {
        font-size: 24px; /* ခေါင်းစဉ်ကို သေးမယ် */
    }

    .main-container {
        margin-top: -30px; /* Banner ထဲ ထပ်နေတဲ့အပိုင်းကို ညှိမယ် */
        padding: 0 5% 40px;
    }

    .company-grid {
        grid-template-columns: 1fr; /* ဖုန်းမှာ တစ်တန်းကို တစ်ခုပဲ ပြမယ် */
        gap: 20px;
    }

    .card {
        border-radius: 15px; /* ထောင့်လေးတွေကို နည်းနည်းလျှော့မယ် */
    }

    .image-container {
        height: 180px; /* ပုံအမြင့်ကို ညှိမယ် */
    }
}
    </style>
</head>
<body>
<?php include('navbar.php'); ?>
    

    <div class="header-banner">
        <h1>IT Companies in Mandalay 🏰</h1>
        <div style="margin-top: 15px;">
            <label style="font-weight: 600; margin-right: 10px;">Switch City: </label>
            <select class="city-box" onchange="location = this.value;">
                <option value="mandalay.php" selected>Mandalay</option>
                <option value="yangon.php">Yangon</option>
                <option value="meiktila.php">Meiktila</option>
                <option value="naypyitaw.php">Nay Pyi Taw</option>
                <option value="taunggyi.php">Taunggyi</option>
            </select>
        </div>
    </div>

    <div class="main-container">
        <div class="company-grid">
            
            <div class="card">
                <div class="image-container"><img src="https://images.unsplash.com/photo-1542744094-24638eff58bb?w=500" alt="T-WORK"></div>
                <div class="card-info">
                    <h3>T-WORK SYSTEM</h3>
                    <p>Innovative software development and web solutions provider located at the heart of Mandalay.</p>
                    <a href="manopen_job.php?id=twork" class="view-btn">View 6 Openings</a>
                </div>
            </div>

            <div class="card">
                <div class="image-container"><img src="https://images.unsplash.com/photo-1551434678-e076c223a692?w=500" alt="Kumo"></div>
                <div class="card-info">
                    <h3>Kumo Solutions</h3>
                    <p>Cloud services and network infrastructure experts empowering businesses through technology.</p>
                    <a href="manopen_job.php?id=kumo" class="view-btn">View 6 Openings</a>
                </div>
            </div>

            <div class="card">
                <div class="image-container"><img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=500" alt="MIT"></div>
                <div class="card-info">
                    <h3>Myanmar IT Consulting</h3>
                    <p>Strategic IT planning and digital transformation services at Mingalar Mandalay.</p>
                    <a href="manopen_job.php?id=mit" class="view-btn">View 6 Openings</a>
                </div>
            </div>

            <div class="card">
                <div class="image-container"><img src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=500" alt="CyberMissions"></div>
                <div class="card-info">
                    <h3>CyberMissions Myanmar</h3>
                    <p>Focusing on cybersecurity auditing and secure system architecture for modern enterprises.</p>
                    <a href="manopen_job.php?id=cyber" class="view-btn">View 6 Openings</a>
                </div>
            </div>

            <div class="card">
                <div class="image-container"><img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=500" alt="Amazing"></div>
                <div class="card-info">
                    <h3>Amazing Technologies</h3>
                    <p>Creative agency specializing in app development and digital marketing strategies.</p>
                    <a href="manopen_job.php?id=amazing" class="view-btn">View 6 Openings</a>
                </div>
            </div>

            <div class="card">
                <div class="image-container"><img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=500" alt="Bagan IT"></div>
                <div class="card-info">
                    <h3>Bagan IT Solutions</h3>
                    <p>Building high-performance mobile and web applications tailored for local businesses.</p>
                    <a href="manopen_job.php?id=baganit" class="view-btn">View 6 Openings</a>
                </div>
            </div>

            <div class="card">
                <div class="image-container"><img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=500" alt="Blue Ocean"></div>
                <div class="card-info">
                    <h3>Blue Ocean Operating</h3>
                    <p>Mandalay's pioneer in BPO and customer support services using advanced tech platforms.</p>
                    <a href="manopen_job.php?id=blueocean" class="view-btn">View 6 Openings</a>
                </div>
            </div>

        </div>
    </div>

    <footer>
        <p>Best of luck in your career journey! <span class="heart-icon">❤️</span></p>
        <p style="margin-top: 10px; font-size: 12px;">© 2026 IT Job Portal - Connecting Mandalay's Talent.</p>
    </footer>

</body>
</html>