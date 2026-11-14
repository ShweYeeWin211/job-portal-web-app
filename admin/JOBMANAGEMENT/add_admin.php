<?php
session_start();
include 'db.php';

// Super Admin ပဲ အကောင့်အသစ် ဖွင့်ပေးခွင့်ရှိအောင် ကန့်သတ်ထားတာ ပိုကောင်းပါတယ်
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'super_admin') {
    echo "<script>alert('Super Admin သာလျှင် Admin အသစ်များ ထည့်သွင်းနိုင်သည်'); window.location.href='dashboard.php';</script>";
    exit();
}

if (isset($_POST['add_admin'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); 
    $city = mysqli_real_escape_string($conn, $_POST['city']);

    // Database ထဲ ထည့်မယ်
    $sql = "INSERT INTO admin (name, email, password, city_name) VALUES ('$name', '$email', '$password', '$city')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: usermanagement.php?msg=admin_added");
    } else {
        $error = "အမှားအယွင်းရှိနေပါသည်- " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4f7fe; padding: 50px; }
        .form-card { background: white; padding: 30px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); max-width: 500px; margin: auto; }
    </style>
</head>
<body>

<div class="form-card">
    <h4 class="fw-bold mb-4">Add District Admin</h4>
    
    <?php if(isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Admin Name</label>
            <input type="text" name="name" class="form-control" required placeholder="Enter name">
        </div>
        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" required placeholder="admin@example.com">
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-4">
            <label class="form-label">Assigned City (တာဝန်ကျမြို့)</label>
            <select name="city" class="form-select" required>
                <option value="">Select City</option>
                <option value="Yangon">Yangon</option>
                <option value="Mandalay">Mandalay</option>
                <option value="Naypyitaw">Naypyitaw</option>
                <option value="Taunggyi">Taunggyi</option>
                <option value="Meiktila">Meiktila</option>
                <option value="All">Super Admin (All Cities)</option>
            </select>
        </div>
        <button type="submit" name="add_admin" class="btn btn-primary w-100 py-2" style="border-radius: 10px;">Create Admin Account</button>
        <a href="dashboard.php" class="btn btn-link w-100 mt-2 text-muted text-decoration-none">Back to Dashboard</a>
    </form>
</div>

</body>
</html>