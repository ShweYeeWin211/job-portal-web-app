<?php
include 'db.php';

if(isset($_POST['save_user'])){
    // Form ကလာတဲ့ ဒေတာတွေကို လက်ခံမယ်
    $name    = mysqli_real_escape_string($conn, $_POST['name']);
    $email   = mysqli_real_escape_string($conn, $_POST['email']);
    $phone   = mysqli_real_escape_string($conn, $_POST['phone']);
    $role    = $_POST['role'];
    $company = mysqli_real_escape_string($conn, $_POST['company']);
    
    // --- 🌟 အရေးကြီးတဲ့ ပြင်ဆင်ချက် 🌟 ---
    // Database ထဲမှာ username ရော name ရောရှိနေလို့ နှစ်ခုလုံးကို $name ပဲ ထည့်ပေးလိုက်မယ်
    // Township က သတ်သတ်မှတ်မှတ် မပါသေးလို့ Default အနေနဲ့ 'Yangon' လို့ ပေးထားမယ်
    // Password ကိုလည်း Default '123456' (hashed) ပေးထားမှ login ဝင်လို့ရမှာပါ
    $default_password = password_hash('123456', PASSWORD_DEFAULT);
    $default_img = "default.png";
    $default_township = "Yangon"; 

    // SQL Query ကို ပုံထဲက Column နာမည်တွေအတိုင်း အကုန်ဖြည့်လိုက်ပါပြီ
    $sql = "INSERT INTO users (username, name, email, phone, password, role, company, profile_image, township, status) 
            VALUES ('$name', '$name', '$email', '$phone', '$default_password', '$role', '$company', '$default_img', '$default_township', 1)";

    if(mysqli_query($conn, $sql)){
        // --- Noti စာသား သိမ်းဆည်းခြင်း ---
        if (function_exists('addNoti')) {
            $noti_msg = "Admin added a new user: $name ($role)";
            addNoti($conn, $noti_msg, "user"); 
        }

        header("Location: usermanagement.php?msg=added");
        exit();
    } else {
        // Error ရှိရင် သိရအောင် (Developer အတွက်)
        die("Error: " . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; }
        .card { border-radius: 15px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
        .title-underline { width: 50px; height: 3px; background-color: #0d6efd; margin: 8px auto 0; }
        /* ဒီဇိုင်းပိုင်းကို မူရင်းအတိုင်း ထားရှိပါတယ် */
    </style>
</head>
<body>
<div class="container mt-5 row justify-content-center">
    <div class="col-md-6 card p-4">
        <div class="text-center mb-4">
            <h4 class="fw-bold mb-0">Add New User</h4>
            <div class="title-underline"></div>
        </div>
        
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control rounded-pill" placeholder="Enter full name" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control rounded-pill" placeholder="example@gmail.com" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone" class="form-control rounded-pill" placeholder="09xxxxxxxxx" required>
            </div>
            
            <div class="row">
                <div class="col-6 mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select rounded-pill">
                        <option value="Employer">Employer</option>
                        <option value="Jobseeker">Jobseeker</option>
                    </select>
                </div>
                <div class="col-6 mb-3">
                    <label class="form-label">Company (Optional)</label>
                    <input type="text" name="company" class="form-control rounded-pill" placeholder="Company name">
                </div>
            </div>
            
            <div class="text-center mt-4">
                <button type="submit" name="save_user" class="btn btn-primary rounded-pill px-4">Save User</button>
                <a href="usermanagement.php" class="btn btn-light rounded-pill px-4 ms-2">Back</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>