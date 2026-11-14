<?php
session_start();
// Login status စစ်ဆေးခြင်း
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "job_portal");
$username = $_SESSION['username'];

// User Profile ဆွဲထုတ်ခြင်း (Navbar မှာ သုံးဖို့)
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
    <title>IT Companies | All Cities</title>
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

        /* --- ✨ Header Banner (ရွှေရည်ကြိုက်တဲ့ Blue Design) --- */
        .header-banner {
            padding: 60px 8% 120px; text-align: center;
            background: linear-gradient(135deg, #1877f2 0%, #0056b3 100%);
            color: white; clip-path: polygon(0 0, 100% 0, 100% 85%, 0% 100%);
            position: relative;
        }

        .header-banner h1 { font-size: 34px; font-weight: 800; margin-bottom: 20px; }
        
        /* 🏙️ City Select Box */
        .city-box {
            padding: 10px 25px; border-radius: 50px; border: 2px solid rgba(255,255,255,0.4);
            background: rgba(255,255,255,0.2); color: white;
            font-weight: 700; outline: none; cursor: pointer; transition: 0.3s;
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
        .city-tag { font-size: 11px; font-weight: 800; color: var(--primary); background: #e7f3ff; padding: 4px 12px; border-radius: 50px; text-transform: uppercase; }
        .card-info h3 { font-size: 20px; margin: 12px 0 8px; font-weight: 800; color: var(--dark-navy); }
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
        <h1>Explore All IT Companies 🏛️</h1>
        <div style="margin-top: 10px;">
            <label style="margin-right: 10px;"><i class="fas fa-map-marker-alt"></i> Select City to View: </label>
            <select class="city-box" onchange="location = this.value;">
                <option value="" disabled selected>-- Select a City --</option>
                <option value="yangon.php">Yangon</option>
                <option value="mandalay.php">Mandalay</option>
                <option value="naypyitaw.php">Nay Pyi Taw</option>
                <option value="meiktila.php">Meiktila</option>
                <option value="taunggyi.php">Taunggyi</option>
            </select>
        </div>
    </div>

    <div class="main-container">
        <div class="company-grid">
            
            <div class="card">
                <div class="image-container"><img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=500" alt="Ace Data"></div>
                <div class="card-info">
                    <span class="city-tag">Yangon</span>
                    <h3>Ace Data Systems</h3>
                    <p>Myanmar's leading software company since 1992. Specializing in banking and ERP solutions.</p>
                    <a href="yangon.php" class="view-btn">Go to Yangon Page</a>
                </div>
            </div>

            <div class="card">
                <div class="image-container"><img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=500" alt="T-Work"></div>
                <div class="card-info">
                    <span class="city-tag">Mandalay</span>
                    <h3>T-WORK SYSTEM</h3>
                    <p>Advanced integrated IT solutions and software development tailored for enterprise growth.</p>
                    <a href="mandalay.php" class="view-btn">Go to Mandalay Page</a>
                </div>
            </div>

            <div class="card">
                <div class="image-container"><img src="https://images.unsplash.com/photo-1551434678-e076c223a692?w=500" alt="Linn IT"></div>
                <div class="card-info">
                    <span class="city-tag">Nay Pyi Taw</span>
                    <h3>Linn IT Solution</h3>
                    <p>Professional IT hardware, networking, and security services located in the capital city.</p>
                    <a href="naypyitaw.php" class="view-btn">Go to NPT Page</a>
                </div>
            </div>

            <div class="card">
                <div class="image-container"><img src="meikimg/mn.jpg" alt="Myanmar Net"></div>
                <div class="card-info">
                    <span class="city-tag">Meiktila</span>
                    <h3>Myanmar Net</h3>
                    <p>Leading ISP providing high-speed internet and innovative software solutions in Meiktila.</p>
                    <a href="meiktila.php" class="view-btn">Go to Meiktila Page</a>
                </div>
            </div>

            <div class="card">
                <div class="image-container"><img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=500" alt="KMD"></div>
                <div class="card-info">
                    <span class="city-tag">Taunggyi</span>
                    <h3>Dynamicweb TGI</h3>
                    <p>The premier destination for IT education and tech retail services in the Shan State.</p>
                    <a href="taunggyi.php" class="view-btn">Go to Taunggyi Page</a>
                </div>
            </div>

        </div>
    </div>

    <footer>
        <p>© 2026 IT Job Portal | Empowering Your Professional Future</p>
    </footer>

</body>
</html>