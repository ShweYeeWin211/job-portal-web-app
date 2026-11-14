<?php
$conn = mysqli_connect("localhost", "root", "", "job_portal");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['register_btn'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    // ✅ မြို့နယ်ကို Form ကနေ ယူမယ်
    $township = mysqli_real_escape_string($conn, $_POST['township']);
    
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $image_name = time() . '_' . $_FILES['profileImage']['name'];
    $target_dir = "uploads/";

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $target_file = $target_dir . $image_name;

    // ✅ SQL Query မှာ township column ပါအောင် ထည့်လိုက်ပါပြီ
    if (move_uploaded_file($_FILES['profileImage']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO users (username, name, email, password, township, profile_image, role, status) 
                VALUES ('$username', '$username', '$email', '$hashed_password', '$township', '$image_name', 'Jobseeker', 1)";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Account created successfully!'); window.location='login.php';</script>";
        }
    } else {
        $default_img = "default.png";
        $sql = "INSERT INTO users (username, name, email, password, township, profile_image, role, status) 
                VALUES ('$username', '$username', '$email', '$hashed_password', '$township', '$default_img', 'Jobseeker', 1)";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Account created with default profile!'); window.location='login.php';</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account | Job Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root { --primary: #1a73e8; --dark: #1e293b; --soft-bg: #f8fafc; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { display: flex; min-height: 100vh; background-color: #fff; overflow-x: hidden; }
        .welcome-side { flex: 1; background: linear-gradient(135deg, rgba(26, 115, 232, 0.9), rgba(15, 23, 42, 0.9)), url('https://images.unsplash.com/photo-1521737711867-e3b97375f902?auto=format&fit=crop&w=1200'); background-size: cover; background-position: center; display: flex; flex-direction: column; justify-content: center; align-items: center; color: white; padding: 60px; text-align: center; }
        .welcome-side h1 { font-size: 42px; font-weight: 800; margin-bottom: 20px; animation: fadeInUp 0.8s ease; }
        .form-side { flex: 1.2; display: flex; justify-content: center; align-items: center; padding: 40px; background: var(--soft-bg); }
        .register-box { width: 100%; max-width: 450px; background: white; padding: 40px; border-radius: 24px; box-shadow: 0 20px 40px rgba(0,0,0,0.05); animation: fadeInRight 0.8s ease; }
        .profile-img-container { width: 100px; height: 100px; margin: 0 auto 20px; position: relative; }
        .profile-img-container img { width: 100%; height: 100%; border-radius: 50%; border: 4px solid #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.1); object-fit: cover; }
        .cam-icon { position: absolute; bottom: 0; right: 0; background: var(--primary); color: white; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; border: 3px solid white; }
        .input-group { margin-bottom: 15px; }
        .input-group label { display: block; margin-bottom: 5px; font-weight: 700; font-size: 13px; color: #475569; }
        .input-field { display: flex; align-items: center; background: #f1f5f9; border-radius: 12px; padding: 0 15px; border: 2px solid transparent; }
        .input-field i { color: var(--primary); margin-right: 12px; }
        .input-field input, .input-field select { border: none; background: transparent; width: 100%; padding: 12px 0; outline: none; font-size: 14px; }
        .create-btn { width: 100%; padding: 14px; background: var(--primary); color: white; border: none; border-radius: 12px; font-weight: 700; cursor: pointer; margin-top: 10px; }
        .error-text { color: #e11d48; font-size: 12px; display: none; margin-top: 5px; }
        .login-link { margin-top: 20px; text-align: center; color: #64748b; font-size: 14px; }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeInRight { from { opacity: 0; transform: translateX(30px); } to { opacity: 1; transform: translateX(0); } }
    </style>
</head>
<body>

    <div class="welcome-side">
        <h1>Start Your Career</h1>
        <p>Join over 10,000+ professionals and find your dream job in Myanmar.</p>
    </div>

    <div class="form-side">
        <div class="register-box">
            <h2 style="font-weight:800; color:var(--dark);">Create Account</h2>
            <p style="color:#64748b; font-size:14px; margin-bottom:20px;">Please fill in the details below</p>

            <form id="regForm" action="register.php" method="POST" enctype="multipart/form-data">
                
                <div class="profile-img-container">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" id="profileDisplay" alt="Profile">
                    <label for="profileImage" class="cam-icon"><i class="fas fa-camera"></i></label>
                    <input type="file" id="profileImage" name="profileImage" accept="image/*" style="display: none;" onchange="displayImage(this)">
                </div>

                <div class="input-group">
                    <label>Full Name</label>
                    <div class="input-field"><i class="fas fa-user"></i><input type="text" name="username" placeholder="" required></div>
                </div>

                <div class="input-group">
                    <label>Email Address</label>
                    <div class="input-field"><i class="fas fa-envelope"></i><input type="email" name="email" placeholder="example@gmail.com" required></div>
                </div>

                <div class="input-group">
                    <label>Township</label>
                    <div class="input-field">
                        <i class="fas fa-map-marker-alt"></i>
                        <select name="township" required>
                            <option value="">Choose Your Township</option>
                            <option value="Yangon">Yangon</option>
                            <option value="Mandalay">Mandalay</option>
                            <option value="Meiktila">Meiktila</option>
                            <option value="Naypyitaw">Naypyitaw</option>
                            <option value="Taunggyi">Taunggyi</option>
                        </select>
                    </div>
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <div class="input-field"><i class="fas fa-key"></i><input type="password" id="password" name="password" placeholder="Min 8 characters" required></div>
                    <p id="weak-pass-error" class="error-text">Weak! Need A-Z, 0-9 & symbols.</p>
                </div>

                <div class="input-group">
                    <label>Confirm Password</label>
                    <div class="input-field"><i class="fas fa-lock"></i><input type="password" id="confirm_password" required></div>
                    <p id="match-error" class="error-text">Passwords do not match!</p>
                </div>

                <button type="submit" name="register_btn" class="create-btn">Get Started</button>
            </form>

            <div class="login-link">
                Already have an account? <a href="login.php" style="color:var(--primary); font-weight:700; text-decoration:none;">Sign In</a>
            </div>
        </div>
    </div>

    <script>
        function displayImage(e) {
            if (e.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(e.files[0]);
            }
        }

        const form = document.getElementById('regForm');
        const passInput = document.getElementById('password');
        const confirmInput = document.getElementById('confirm_password');
        const weakError = document.getElementById('weak-pass-error');
        const matchError = document.getElementById('match-error');

        const strongRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]).{8,}$/;

        form.addEventListener('submit', function(e) {
            let isError = false;
            if (!strongRegex.test(passInput.value)) {
                weakError.style.display = 'block';
                isError = true;
            }
            if (passInput.value !== confirmInput.value) {
                matchError.style.display = 'block';
                isError = true;
            }
            if (isError) e.preventDefault();
        });

        passInput.addEventListener('input', () => weakError.style.display = 'none');
        confirmInput.addEventListener('input', () => matchError.style.display = 'none');
    </script>
</body>
</html>