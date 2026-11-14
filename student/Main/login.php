<?php
// session_start();
// $conn = mysqli_connect("localhost", "root", "", "job_portal");
session_start();
$conn = mysqli_connect("localhost", "root", "", "job_portal");

$error_msg = ""; // 🌟 ဒါလေးကို အပေါ်ဆုံးမှာ ကြိုရေးထားပေးဖို့ လိုပါတယ်

if (isset($_POST['login_btn'])) {
    // ... ကျန်တဲ့ login logic များ ...
}

if (isset($_POST['login_btn'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // ၁။ Admin Table မှာ အရင်ရှာမယ်
    // $admin_query = "SELECT * FROM admin WHERE email = '$email'";
    // $admin_result = mysqli_query($conn, $admin_query);

    // if (mysqli_num_rows($admin_result) > 0) {
    //     $row = mysqli_fetch_assoc($admin_result);
    //     // Admin က password hash မသုံးထားလို့ တိုက်ရိုက်စစ်မယ်
    //     if ($password == $row['password']) {
    //         $_SESSION['username'] = $row['name'];
    //         $_SESSION['role'] = 'admin';
    //         header("Location: ../../admin/JOBMANAGEMENT/dashboard.php"); // Admin Dashboard လမ်းကြောင်း
    //         exit();
    //     }
    // ၁။ Admin Table မှာ အရင်ရှာမယ်
    $admin_query = "SELECT * FROM admin WHERE email = '$email'";
    $admin_result = mysqli_query($conn, $admin_query);

    if (mysqli_num_rows($admin_result) > 0) {
        $row = mysqli_fetch_assoc($admin_result);
        
        if ($password == $row['password']) {
            $_SESSION['username'] = $row['name'];
            $_SESSION['role'] = 'admin';
            
            // 🌟 ဒီအပိုင်းလေးကို ထပ်ထည့်ပေးပါ (Admin ရဲ့ မြို့နယ်ကို မှတ်သားခြင်း)
            $_SESSION['admin_city'] = $row['city_name']; 
            
            header("Location: ../../admin/JOBMANAGEMENT/dashboard.php");
            exit();
        }
    }
    

    // ၂။ Admin မဟုတ်ရင် Users Table မှာ ဆက်ရှာမယ်
    $user_query = "SELECT * FROM users WHERE email = '$email'";
    $user_result = mysqli_query($conn, $user_query);

    if (mysqli_num_rows($user_result) > 0) {
        $row = mysqli_fetch_assoc($user_result);
        // User က password hash သုံးထားလို့ password_verify နဲ့စစ်မယ်
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['name'] ?? $row['username'];
            $_SESSION['role'] = $row['role']; // ဥပမာ - Jobseeker
            header("Location: companies.php"); // User Page
            exit();
        }
    }

    // ဘယ်သူမှ မဟုတ်ရင် အမှားပြမယ်
    $error_msg = "Invalid Email or Password!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | IT Job Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root {
            --primary: #1a73e8;
            --hover: #1557b0;
            --bg-light: #f8fafc;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif; }

        body { display: flex; min-height: 100vh; background-color: #fff; overflow: hidden; }

        /* --- Welcome Side (Left) --- */
        .welcome-side {
            flex: 1.2;
            background: linear-gradient(135deg, rgba(26, 115, 232, 0.95), rgba(30, 41, 59, 0.9)), 
                        url('https://images.unsplash.com/photo-1497215728101-856f4ea42174?auto=format&fit=crop&w=1200&q=80');
            background-size: cover; background-position: center;
            display: flex; flex-direction: column; justify-content: center;
            align-items: center; color: #fff; padding: 60px; text-align: center;
            position: relative;
        }

        .welcome-content {
            z-index: 2;
            animation: fadeInDown 1s ease;
        }

        .welcome-side h1 { font-size: 48px; margin-bottom: 20px; font-weight: 800; letter-spacing: -1px; }
        .welcome-side p { font-size: 18px; opacity: 0.85; max-width: 400px; line-height: 1.6; }

        /* Floating Icon Animation */
        .floating-icon {
            position: absolute; font-size: 150px; color: rgba(255,255,255,0.1);
            bottom: 50px; right: 50px; animation: float 6s ease-in-out infinite;
        }

        /* --- Form Side (Right) --- */
        .form-side { flex: 1; display: flex; justify-content: center; align-items: center; padding: 40px; background: #fff; }
        .login-box { width: 100%; max-width: 400px; animation: fadeInRight 0.8s ease; }
        .login-box h2 { font-size: 36px; color: #1e293b; margin-bottom: 10px; font-weight: 800; }
        .subtitle { color: #64748b; margin-bottom: 35px; font-size: 16px; }

        /* Error Container */
        .error-container {
            background: #fef2f2; color: #dc2626; padding: 12px 16px;
            border-radius: 12px; margin-bottom: 25px; font-size: 14px;
            border: 1px solid #fee2e2; display: <?php echo ($error_msg == "") ? "none" : "flex"; ?>;
            align-items: center; gap: 10px;
        }

        .input-group { text-align: left; margin-bottom: 20px; }
        .input-group label { display: block; margin-bottom: 8px; font-weight: 700; font-size: 14px; color: #475569; }

        .input-field {
            display: flex; align-items: center; background: #f1f5f9;
            border-radius: 12px; padding: 0 15px; border: 2px solid transparent; transition: 0.3s;
        }

        .input-field:focus-within { border-color: var(--primary); background: #fff; box-shadow: 0 4px 20px rgba(26, 115, 232, 0.1); }
        .input-field i { color: var(--primary); margin-right: 12px; font-size: 18px; }
        .input-field input { border: none; background: transparent; width: 100%; padding: 16px 0; outline: none; font-size: 15px; font-weight: 500; }

        .signin-btn {
            width: 100%; padding: 16px; background: var(--primary); color: white;
            border: none; border-radius: 12px; font-size: 16px; font-weight: 700;
            cursor: pointer; margin-top: 10px; transition: 0.3s;
            display: flex; align-items: center; justify-content: center; gap: 12px;
        }

        .signin-btn:hover { background: var(--hover); transform: translateY(-2px); box-shadow: 0 8px 25px rgba(26, 115, 232, 0.3); }

        .divider { margin: 30px 0; border-top: 1px solid #e2e8f0; position: relative; }
        .divider span { position: absolute; top: -10px; left: 50%; transform: translateX(-50%); background: #fff; padding: 0 15px; color: #94a3b8; font-size: 12px; font-weight: 600; text-transform: uppercase; }

        .create-btn-outline {
            display: flex; align-items: center; justify-content: center; gap: 10px;
            width: 100%; padding: 14px; border: 2px solid #e2e8f0; border-radius: 12px;
            color: #475569; text-decoration: none; font-weight: 700; transition: 0.3s;
        }

        .create-btn-outline:hover { border-color: var(--primary); color: var(--primary); background: #f0f7ff; }

        /* Animations */
        @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-20px); } }
        @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeInRight { from { opacity: 0; transform: translateX(20px); } to { opacity: 1; transform: translateX(0); } }

        @media (max-width: 900px) { body { flex-direction: column; overflow: auto; } .welcome-side { padding: 80px 20px; } .floating-icon { display: none; } }
    </style>
</head>
<body>

    <div class="welcome-side">
        <div class="welcome-content">
            <h1>Welcome Back</h1>
            <p>Ready to take the next step in your tech career? Sign in to explore 500+ new job openings.</p>
        </div>
        <i class="fas fa-briefcase floating-icon"></i>
    </div>

    <div class="form-side">
        <div class="login-box">
            <a href="index.php" style="text-decoration: none; color: var(--primary); font-weight: 700; font-size: 14px; display: inline-block; margin-bottom: 20px;">
                <i class="fas fa-arrow-left"></i> Back to Home
            </a>
            <h2>Sign In</h2>
            <p class="subtitle">Access your professional dashboard</p>

            <div class="error-container">
                <i class="fas fa-circle-exclamation"></i> <?php echo $error_msg; ?>
            </div>

            <form action="login.php" method="POST">
                <div class="input-group">
                    <label>Work Email</label>
                    <div class="input-field">
                        <i class="fas fa-envelope-open"></i>
                        <input type="email" name="email" placeholder="name@company.com" required>
                    </div>
                </div>

                <div class="input-group">
                    <label>Security Password</label>
                    <div class="input-field">
                        <i class="fas fa-shield-halved"></i>
                        <input type="password" name="password" placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" name="login_btn" class="signin-btn">
                    Sign In to Dashboard <i class="fas fa-arrow-right-long"></i>
                </button>
            </form>

            <div class="divider"><span>New here?</span></div>

            <a href="register.php" class="create-btn-outline">
                Join our Community <i class="fas fa-rocket"></i>
            </a>
        </div>
    </div>

</body>
</html>