<?php
include 'db.php';

// URL ကနေ ID ကို ဖတ်ခြင်း
if (!isset($_GET['id'])) {
    header("Location: usermanagement.php");
    exit();
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

// လက်ရှိ User ရဲ့ အချက်အလက်ကို Database ကနေ ဆွဲထုတ်ခြင်း (Column name များကို username ဟု ပြင်ထားသည်)
$user_query = mysqli_query($conn, "SELECT * FROM users WHERE id='$id'");
$user = mysqli_fetch_assoc($user_query);

if (!$user) {
    die("User not found!");
}

// Update ခလုတ်ကို နှိပ်လိုက်လျှင်
if(isset($_POST['update'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $phone    = mysqli_real_escape_string($conn, $_POST['phone']); 
    $township = mysqli_real_escape_string($conn, $_POST['township']);
    $company  = mysqli_real_escape_string($conn, $_POST['company']);
    $role     = $_POST['role'];

    // Database ထဲမှာ အချက်အလက်ပြင်ဆင်ခြင်း (Column names များကို ညှိထားသည်)
    $update_sql = "UPDATE users SET 
                    username='$username', 
                    email='$email', 
                    phone='$phone', 
                    township='$township',
                    company='$company',
                    role='$role' 
                   WHERE id='$id'";
    
    if(mysqli_query($conn, $update_sql)){
        
        // --- ✅ Notification ထည့်ရန် ကုဒ် ---
        if(function_exists('addNoti')){
            $noti_msg = "Admin updated details for user: $username ($role)";
            addNoti($conn, $noti_msg, "user");
        }
        // ------------------------------------

        header("Location: usermanagement.php?msg=updated");
        exit();
    } else {
        $error = "Update failed: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - <?= htmlspecialchars($user['username']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; font-family: 'Inter', sans-serif; }
        .card { border-radius: 20px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
        .form-control, .form-select { padding: 10px 20px; border-radius: 50px; }
        .btn-update { background-color: #0d6efd; color: white; border-radius: 50px; padding: 10px; font-weight: 600; border: none; }
        .btn-update:hover { background-color: #0b5ed7; }
        .form-label { margin-left: 15px; font-weight: 600; color: #555; }
    </style>
</head>
<body>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <h4 class="fw-bold text-center mb-4">Edit User Details</h4>
                
                <?php if(isset($error)): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>

                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label small">Username</label>
                        <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small">Email Address</label>
                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small">Phone Number</label>
                            <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($user['phone']) ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small">Township</label>
                            <input type="text" name="township" class="form-control" value="<?= htmlspecialchars($user['township']) ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small">Company / Organization</label>
                        <input type="text" name="company" class="form-control" value="<?= htmlspecialchars($user['company']) ?>">
                    </div>

                    <div class="mb-4">
                        <label class="form-label small">User Role</label>
                        <select name="role" class="form-select">
                            <option value="Employer" <?= ($user['role'] == 'Employer') ? 'selected' : '' ?>>Employer</option>
                            <option value="Jobseeker" <?= ($user['role'] == 'Jobseeker') ? 'selected' : '' ?>>Jobseeker</option>
                        </select>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" name="update" class="btn btn-update">
                            <i class="fa fa-save me-1"></i> Save Changes
                        </button>
                        <a href="usermanagement.php" class="btn btn-light rounded-pill border">Cancel</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

</body>
</html>