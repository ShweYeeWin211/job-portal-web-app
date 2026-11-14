<?php
include 'db.php';

if(!isset($_GET['id'])){
    header("Location: jobmanagement.php");
    exit();
}

$id = intval($_GET['id']);

// Fetch job info (Salary နဲ့ Age ပါ တစ်ခါတည်း ဆွဲထုတ်ထားပါတယ်)
$query = mysqli_query($conn, "SELECT * FROM jobs WHERE id = $id");
$job = mysqli_fetch_assoc($query);

if(!$job){
    die("Job not found!");
}

// Handle form submit
if(isset($_POST['update_job'])){
    $job_title = mysqli_real_escape_string($conn, $_POST['job_title']);
    $company   = mysqli_real_escape_string($conn, $_POST['company']);
    $location  = mysqli_real_escape_string($conn, $_POST['location']);
    $type      = mysqli_real_escape_string($conn, $_POST['type']);
    $salary    = mysqli_real_escape_string($conn, $_POST['salary']); // ✅ Salary လက်ခံရန်
    $age       = mysqli_real_escape_string($conn, $_POST['age']);    // ✅ Age လက်ခံရန်
    $status    = mysqli_real_escape_string($conn, $_POST['status']);

    // UPDATE Query ထဲမှာ Salary နဲ့ Age ကိုပါ ထည့်ပေးထားပါတယ်
    $update_query = "UPDATE jobs SET 
                        job_title='$job_title', 
                        company='$company', 
                        location='$location', 
                        type='$type', 
                        salary='$salary', 
                        age='$age', 
                        status='$status' 
                     WHERE id='$id'";

    if(mysqli_query($conn, $update_query)){
        
        // --- ✅ Notification ထည့်ရန် ---
        // addNoti function ရှိခဲ့ရင် သုံးပါ၊ မရှိရင် ဒီ line ကို ခဏပိတ်ထားလို့ရပါတယ်
        if(function_exists('addNoti')){
            $noti_msg = "Admin updated job details: $job_title ($company)";
            addNoti($conn, $noti_msg, "job"); 
        }
        // -------------------------

        header("Location: jobmanagement.php?msg=success");
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
<title>Edit Job - <?= htmlspecialchars($job['job_title']) ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
body { background-color: #f4f7f6; font-family: 'Inter', sans-serif; }
.card { border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: none; }
.form-label { font-weight: 600; color: #555; }
.title-underline { width: 50px; height: 3px; background-color: #0d6efd; margin: 8px auto 0; border-radius: 5px; }
</style>
</head>
<body>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card p-4">
                
                <div class="text-center mb-4">
                    <h4 class="fw-bold mb-0">Edit Job Posting</h4>
                    <div class="title-underline"></div>
                </div>

                <?php if(isset($error)): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>

                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Job Title</label>
                        <input type="text" name="job_title" class="form-control" value="<?= htmlspecialchars($job['job_title']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Company Name</label>
                        <input type="text" name="company" class="form-control" value="<?= htmlspecialchars($job['company']) ?>" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Location</label>
                            <input type="text" name="location" class="form-control" value="<?= htmlspecialchars($job['location']) ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Job Type</label>
                            <select name="type" class="form-select">
                                <option value="Full Time" <?= $job['type']=='Full Time'?'selected':'' ?>>Full Time</option>
                                <option value="Part-time" <?= $job['type']=='Part-time'?'selected':'' ?>>Part-time</option>
                                <option value="Internship" <?= $job['type']=='Internship'?'selected':'' ?>>Internship</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Salary</label>
                            <input type="text" name="salary" class="form-control" value="<?= htmlspecialchars($job['salary']) ?>" placeholder="e.g. 500,000 MMK" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Age Range</label>
                            <input type="text" name="age" class="form-control" value="<?= htmlspecialchars($job['age']) ?>" placeholder="e.g. 20-30" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="Pending" <?= $job['status']=='Pending'?'selected':'' ?>>Pending</option>
                            <option value="Approved" <?= $job['status']=='Approved'?'selected':'' ?>>Approved</option>
                        </select>
                    </div>

                    <div class="mt-4 d-grid gap-2">
                        <button type="submit" name="update_job" class="btn btn-primary btn-lg rounded-pill">
                            <i class="fa fa-save me-2"></i> Save Changes
                        </button>
                        <a href="jobmanagement.php" class="btn btn-outline-secondary rounded-pill">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>