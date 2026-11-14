<?php
session_start();
include 'db.php'; // Database connection file လမ်းကြောင်း မှန်ပါစေ

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Database မှာ တိုက်စစ်ခြင်း
    $query = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $admin = mysqli_fetch_assoc($result);
        
        // --- ✅ Session ထဲမှာ Role ကိုပါ တစ်ခါတည်း သိမ်းမယ် ---
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['username'] = $admin['name']; // ဒါက navbar မှာ ပြဖို့
        $_SESSION['admin_township'] = $admin['township'];
        $_SESSION['role'] = 'admin'; // 🌟 ဒါက Student နဲ့ ခွဲဖို့ အရေးကြီးဆုံးပဲ

        
        // --- ✅ Notification သိမ်းမယ် (addNoti function ရှိရင်) ---
        if(function_exists('addNoti')){
            $admin_name = $admin['name'];
            addNoti($conn, "$admin_name has logged into the admin panel", "info");
        }
        
        // Admin Dashboard ကို ပို့မယ်
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Email သို့မဟုတ် Password မှားယွင်းနေပါသည်။";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f4f7f6; height: 100vh; display: flex; align-items: center; justify-content: center; font-family: 'Inter', sans-serif; }
        .login-card { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); width: 100%; max-width: 400px; padding: 40px; background: white; }
        .form-control { border-radius: 50px; padding: 12px 25px; border: 1px solid #eee; }
        .btn-login { border-radius: 50px; padding: 12px; font-weight: 600; background: #0d6efd; color: white; border: none; transition: 0.3s; }
        .btn-login:hover { background: #0056b3; }
        .lock-icon { width: 60px; height: 60px; background: #eef2ff; color: #4f46e5; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; }
    </style>
</head>
<body>

<div class="login-card">
    <div class="text-center mb-4">
        <div class="lock-icon"><i class="fa fa-lock-open fa-2x"></i></div>
        <h4 class="fw-bold">Admin Login</h4>
        <p class="text-muted small">Access Admin Dashboard</p>
    </div>

    <?php if(isset($error)): ?>
        <div class="alert alert-danger py-2 small text-center border-0 mb-3" style="border-radius: 50px;">
            <i class="fa fa-exclamation-triangle me-1"></i> <?= $error ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="small fw-bold mb-1 ms-2">Email</label>
            <input type="email" name="email" class="form-control" placeholder="admin@example.com" required>
        </div>
        <div class="mb-4">
            <label class="small fw-bold mb-1 ms-2">Password</label>
            <input type="password" name="password" class="form-control" placeholder="" required>
        </div>
        <button type="submit" name="login" class="btn btn-login w-100 shadow-sm">Sign In</button>
    </form>
</div>

</body>
</html>