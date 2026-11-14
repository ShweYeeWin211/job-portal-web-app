<?php
session_start();
// Login status ကို Navbar အတွက် စစ်ဆေးရန်
$is_logged_in = isset($_SESSION['username']);
$username = $is_logged_in ? $_SESSION['username'] : "";

// PHP variables for dynamic content
$system_name = "Career Connect";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | <?php echo $system_name; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #1877f2;
            --dark-slate: #1e293b;
            --text-gray: #64748b;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f8fafc; color: #334155; line-height: 1.6; }

        /* --- 🌐 Navigation Bar --- */
        nav {
            display: flex; justify-content: space-between; align-items: center;
            padding: 15px 10%; background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            position: sticky; top: 0; z-index: 1000;
        }
        .logo { font-size: 22px; font-weight: 800; color: var(--primary-blue); text-decoration: none; display: flex; align-items: center; gap: 8px; }
        .nav-links { display: flex; list-style: none; gap: 25px; align-items: center; }
        .nav-links a { text-decoration: none; color: #65676b; font-weight: 600; font-size: 15px; transition: 0.3s; }
        .nav-links a:hover, .nav-links a.active { color: var(--primary-blue); }

        .user-section { display: flex; align-items: center; gap: 12px; padding-left: 15px; border-left: 1px solid #e4e6eb; }
        .logout-btn { color: #e74c3c; font-size: 16px; text-decoration: none; }

        /* Hero Section */
        .about-hero {
            background: linear-gradient(135deg, #1877f2 0%, #0042aa 100%);
            color: white; padding: 100px 10% 140px; text-align: center;
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0% 100%);
        }
        .about-hero h1 { font-size: 38px; font-weight: 800; margin-bottom: 15px; }
        .underline { width: 60px; height: 5px; background: #ffd700; margin: 0 auto 20px; border-radius: 10px; }

        .container { max-width: 1200px; margin: -80px auto 60px; padding: 0 20px; }

        /* Welcome Card */
        .welcome-card {
            background: white; border-radius: 20px; padding: 45px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
            display: flex; align-items: center; gap: 50px; margin-bottom: 50px;
        }
        .welcome-image img { width: 100%; border-radius: 15px; box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .welcome-content h3 { font-size: 30px; color: var(--dark-slate); margin-bottom: 15px; }

        /* Cards Section */
        .cards-container { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 30px; }
        .card {
            background: #fff; border-radius: 16px; overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            border: 1px solid #e2e8f0; transition: 0.4s ease;
            display: flex; flex-direction: column;
        }
        .card:hover { transform: translateY(-12px); box-shadow: 0 25px 40px rgba(0, 0, 0, 0.08); border-color: var(--primary-blue); }
        .card-img { width: 100%; height: 180px; object-fit: cover; }
        
        .card-icon {
            width: 65px; height: 65px; background: var(--primary-blue);
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            margin: -35px auto 15px; position: relative; color: white;
            font-size: 24px; box-shadow: 0 8px 15px rgba(24, 119, 242, 0.3);
        }

        .card-content { padding: 30px; text-align: center; flex-grow: 1; }
        .card-content h4 { font-size: 22px; color: var(--dark-slate); margin-bottom: 12px; }
        .card-content p { font-size: 15px; color: var(--text-gray); line-height: 1.8; }

        .btn-read-more {
            display: inline-block; padding: 10px 24px; background: transparent;
            color: var(--primary-blue); border: 2px solid var(--primary-blue);
            border-radius: 50px; margin-top: 20px; transition: 0.3s;
            cursor: pointer; font-weight: 700; font-size: 13px;
        }
        .btn-read-more:hover { background: var(--primary-blue); color: white; }

        /* --- Footer Style အသစ် (Categories နှင့် တူရန်) --- */
        .footer-dark { 
            background: #0f172a; 
            padding: 30px; 
            text-align: center; 
            color: rgba(255,255,255,0.6); 
            margin-top: 50px;
        }

        @media (max-width: 850px) {
            .welcome-card { flex-direction: column; text-align: center; }
        }
    </style>
</head>
<body>

    <?php include('navbar.php'); ?>

    <div class="about-hero">
        <h1>Empowering Careers, Changing Lives 🚀</h1>
        <div class="underline"></div>
        <p>"Let us help you turn your successful future journey into reality."</p>
    </div>

    <div class="container">
        <div class="welcome-card">
            <div class="welcome-image">
                <img src="https://images.unsplash.com/photo-1497215728101-856f4ea42174?auto=format&fit=crop&w=600" alt="Office Work">
            </div>
            <div class="welcome-content">
                <h3>Welcome to <?php echo $system_name; ?> ✨</h3>
                <p>Our Job Management System acts as a powerful bridge connecting employers and job seekers, delivering a fast, accurate, and seamless job search experience through modern technology.</p>
                <p>We are dedicated to building a community where talent meets opportunity, ensuring that every professional can find their perfect fit in the IT industry.</p>
            </div>
        </div>

        <div class="cards-container">
            <div class="card">
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=400" class="card-img" alt="Mission">
                <div class="card-icon"><i class="fas fa-rocket"></i></div>
                <div class="card-content">
                    <h4>Our Mission</h4>
                    <p>
                        To enable job seekers to efficiently access suitable opportunities that align with their skills.
                        <span id="dots1">...</span>
                        <span id="more1" style="display: none;">
                            We provide employers with a modern, all-in-one platform to discover qualified talent. Beyond jobs, we share valuable knowledge for professional growth.
                        </span>
                    </p>
                    <button onclick="toggleText('dots1', 'more1', 'btn1')" id="btn1" class="btn-read-more">Read More</button>
                </div>
            </div>

            <div class="card">
                <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=400" class="card-img" alt="Vision">
                <div class="card-icon"><i class="fas fa-eye"></i></div>
                <div class="card-content">
                    <h4>Our Vision</h4>
                    <p>
                        To establish the most reliable and impactful job search platform for every seeker across Myanmar.
                        <span id="dots2">...</span>
                        <span id="more2" style="display: none;">
                            Through technology, we strive to foster transparent and robust connections, uplifting social and economic well-being across the region.
                        </span>
                    </p>
                    <button onclick="toggleText('dots2', 'more2', 'btn2')" id="btn2" class="btn-read-more">Read More</button>
                </div>
            </div>

            <div class="card">
                <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=400" class="card-img" alt="Objective">
                <div class="card-icon"><i class="fas fa-bullseye"></i></div>
                <div class="card-content">
                    <h4>Our Objective</h4>
                    <p>
                        Tailored support for job seekers, linking them to skills-based opportunities and career growth.
                        <span id="dots3">...</span>
                        <span id="more3" style="display: none;">
                            We help you explore new career opportunities and offer free CV writing guidance to transform your future using our professional network.
                        </span>
                    </p>
                    <button onclick="toggleText('dots3', 'more3', 'btn3')" id="btn3" class="btn-read-more">Read More</button>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer-dark">
        <p>© 2026 IT Job Portal | Empowering Your Professional Future</p>
    </footer>

    <script>
        function toggleText(dotsId, moreId, btnId) {
            const dots = document.getElementById(dotsId);
            const moreText = document.getElementById(moreId);
            const btnText = document.getElementById(btnId);

            if (dots.style.display === "none") {
                dots.style.display = "inline";
                moreText.style.display = "none";
                btnText.innerHTML = "Read More";
            } else {
                dots.style.display = "none";
                moreText.style.display = "inline";
                btnText.innerHTML = "Read Less";
            }
        }
    </script>
</body>
</html>