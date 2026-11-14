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
    <title>Companies in Meiktila | IT Job Portal</title>
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

        /* --- ✨ Navigation Bar --- */
        nav {
            display: flex; justify-content: space-between; align-items: center;
            padding: 15px 8%; background: white;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            position: sticky; top: 0; z-index: 1000;
        }

        .logo { font-size: 22px; font-weight: 800; color: var(--primary); text-decoration: none; display: flex; align-items: center; gap: 10px; }
        .nav-links { display: flex; list-style: none; gap: 30px; align-items: center; }
        .nav-links a { text-decoration: none; color: #64748b; font-weight: 600; font-size: 15px; transition: var(--transition); }
        .nav-links a:hover, .nav-links a.active { color: var(--primary); }

        .user-section { display: flex; align-items: center; gap: 15px; padding-left: 20px; border-left: 1px solid #e2e8f0; }
        .user-info { text-align: right; line-height: 1.2; }
        .user-info span { display: block; font-size: 13px; font-weight: 700; color: var(--dark-navy); }
        .user-section img { width: 38px; height: 38px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary); }
        .logout-btn { color: #ef4444; font-size: 18px; transition: 0.3s; margin-left: 10px; }

        /* --- Header Section --- */
        .header-banner {
            padding: 60px 8% 120px; text-align: center;
            background: linear-gradient(135deg, #1877f2 0%, #0056b3 100%);
            color: white; clip-path: polygon(0 0, 100% 0, 100% 85%, 0% 100%);
            position: relative;
        }

        .header-banner h1 { font-size: 34px; font-weight: 800; margin-bottom: 20px; }
        
        /* 🏙️ City Box Fix */
        .city-box {
            padding: 10px 25px; border-radius: 50px; border: 2px solid rgba(255,255,255,0.4);
            background: rgba(255,255,255,0.2); color: white;
            font-weight: 700; outline: none; cursor: pointer; transition: 0.3s;
            position: relative; z-index: 1100; /* Dropdown ကို အပေါ်ဆုံးပို့ရန် */
        }
        .city-box option { color: #333; background: white; }

        /* --- Grid Layout --- */
        .main-container { padding: 0 8% 60px; margin-top: -60px; position: relative; z-index: 10; }
        .company-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px; }

        /* --- Card Design --- */
        .card { background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: 0.4s; border: 1px solid #f1f5f9; display: flex; flex-direction: column; }
        .card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
        
        .image-container { width: 100%; height: 200px; overflow: hidden; background: #eee; }
        .image-container img { width: 100%; height: 100%; object-fit: cover; transition: 0.5s; }
        .card:hover img { transform: scale(1.1); }

        .card-info { padding: 25px; flex-grow: 1; }
        .card-info h3 { font-size: 20px; margin-bottom: 10px; font-weight: 800; color: var(--dark-navy); }
        .card-info p { color: #64748b; font-size: 14px; margin-bottom: 20px; line-height: 1.6; }

        .view-btn {
            display: block; text-align: center; padding: 12px;
            background: #f1f5f9; color: var(--primary);
            text-decoration: none; font-weight: 700; border-radius: 12px; transition: 0.3s;
        }
        .view-btn:hover { background: var(--primary); color: white; }

        footer { background: var(--dark-navy); padding: 40px; text-align: center; color: rgba(255,255,255,0.6); font-size: 14px; }
    </style>
</head>
<body>

   <?php include('navbar.php'); ?>

    <div class="header-banner">
        <h1>IT Companies in Meiktila 🏢</h1>
        <div style="margin-top: 10px; position: relative;">
            <label style="margin-right: 10px;"><i class="fas fa-map-marker-alt"></i> City: </label>
            <select class="city-box" onchange="location = this.value;">
                <option value="meiktila.php" selected>Meiktila</option>
                <option value="yangon.php">Yangon</option>
                <option value="mandalay.php">Mandalay</option>
                <option value= "naypyitaw.php"> Naypyitaw</option>
                <option value= " taunggyi.php">Taunggyi</option>
            </select>
        </div>
    </div>

    <div class="main-container">
        <div class="company-grid">
            <div class="card">
                <div class="image-container"><img src="meikimg/mn.jpg" alt="Myanmar Net"></div>
                <div class="card-info">
                    <h3>Myanmar Net</h3>
                    <p>Leading ISP providing high-speed internet and innovative software solutions in Meiktila region.</p>
                    <a href="meikopen_job.php?id=met" class="view-btn">View 6 Openings</a>
                </div>
            </div>

            <div class="card">
                <div class="image-container"><img src="meikimg/kbz.jpg" alt="KBZ Bank"></div>
                <div class="card-info">
                    <h3>KBZ Bank</h3>
                    <p>Building the future of digital banking. Explore professional careers in fintech and financial services.</p>
                    <a href="meikopen_job.php?id=kbz" class="view-btn">View 6 Openings</a>
                </div>
            </div>

            <div class="card">
                <div class="image-container"><img src="meikimg/kdd.jpg" alt="Ko Dee Dee"></div>
                <div class="card-info">
                    <h3>Ko Dee Dee Mobile & Laptops</h3>
                    <p>Premier tech shop and service center. Join our team of hardware and software experts.</p>
                    <a href="meikopen_job.php?id=deedee" class="view-btn">View 6 Openings</a>
                </div>
            </div>

            <div class="card">
                <div class="image-container"><img src="meikimg/cb.jpg" alt="CB Bank"></div>
                <div class="card-info">
                    <h3>CB Bank</h3>
                    <p>Empowering individuals and businesses. Join a dynamic team in modern banking and technology.</p>
                    <a href="meikopen_job.php?id=cb" class="view-btn">View 6 Openings</a>
                </div>
            </div>

            <div class="card">
                <div class="image-container"><img src="meikimg/kmd.jpg" alt="KMD Center"></div>
                <div class="card-info">
                    <h3>KMD Computer Center</h3>
                    <p>Myanmar's pioneer in IT education and services. Join a legacy of computer training excellence.</p>
                    <a href="meikopen_job.php?id=kmd" class="view-btn">View 6 Openings</a>
                </div>
            </div>

            <div class="card">
                <div class="image-container"><img src="meikimg/shadow.jpg" alt="Shadow Hotel"></div>
                <div class="card-info">
                    <h3>Shadow Hotel</h3>
                    <p>Providing premium hospitality with smart IT systems. Explore roles in system admin and tech support.</p>
                    <a href="meikopen_job.php?id=mcc" class="view-btn">View 6 Openings</a>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>© 2026 IT Job Portal - Connecting Talent with Opportunity.</p>
    </footer>

</body>
</html>