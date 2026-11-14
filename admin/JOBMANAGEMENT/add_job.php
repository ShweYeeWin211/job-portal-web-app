<?php
session_start();
// Database connection လမ်းကြောင်းမှန်အောင် ချိတ်ဆက်ထားပါတယ်
include '../../includes/db_config.php'; 

if(isset($_POST['add_job'])){
    // Form ကနေ ပို့လိုက်တဲ့ Data တွေကို လက်ခံပြီး SQL Injection မဖြစ်အောင် ကာကွယ်ပါတယ်
    $job_title = mysqli_real_escape_string($conn, $_POST['job_title']);
    $company   = mysqli_real_escape_string($conn, $_POST['company']);
    $location  = mysqli_real_escape_string($conn, $_POST['location']);
    
    // ✅ Type ကို သေချာဖမ်းပြီး variable ထဲ ထည့်ပါတယ်
    $type      = mysqli_real_escape_string($conn, $_POST['type']); 
    
    $salary    = mysqli_real_escape_string($conn, $_POST['salary']);
    $age       = mysqli_real_escape_string($conn, $_POST['age']);

    // ✅ INSERT Query ထဲမှာ $type ကို သေချာထည့်သွင်းထားပါတယ်
    $sql = "INSERT INTO jobs (job_title, company, location, type, salary, age, status, created_at) 
            VALUES ('$job_title', '$company', '$location', '$type', '$salary', '$age', 'Approved', NOW())";

    if(mysqli_query($conn, $sql)){
        // အောင်မြင်ရင် Management Page ကို ပြန်သွားမယ်
        header("Location: jobmanagement.php");
        exit();
    } else {
        // Error ရှိရင် ပြပေးမယ်
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Job</title>
    <style>
        body { 
            font-family: 'Segoe UI', sans-serif; 
            background: #f4f6f9; 
            padding: 50px; 
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .card { 
            background: #fff; 
            padding: 30px; 
            border-radius: 12px; 
            width: 100%;
            max-width: 500px; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.1); 
        }
        h2 { 
            text-align: center; 
            color: #1c1e21; 
            margin-bottom: 25px; 
        }
        label { 
            font-weight: 600; 
            color: #4b4f56; 
            display: block; 
            margin-top: 10px; 
        }
        input, select { 
            width: 100%; 
            padding: 12px; 
            margin: 8px 0 18px 0; 
            border: 1px solid #ddd; 
            border-radius: 8px; 
            box-sizing: border-box; /* padding ကြောင့် size မပြောင်းအောင် */
            font-size: 14px;
        }
        input:focus, select:focus {
            outline: none;
            border-color: #1877f2;
            box-shadow: 0 0 5px rgba(24, 119, 242, 0.2);
        }
        .btn { 
            width: 100%; 
            padding: 14px; 
            background: #1877f2; 
            color: #fff; 
            border: none; 
            border-radius: 8px; 
            cursor: pointer; 
            font-weight: 700; 
            font-size: 16px;
            transition: background 0.3s;
        }
        .btn:hover { 
            background: #166fe5; 
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Add New Job</h2>
    <form method="POST">
        <label>Job Title</label>
        <input type="text" name="job_title" placeholder="e.g. Junior Web Developer" required>
        
        <label>Company</label>
        <input type="text" name="company" placeholder="e.g. Cyber King Co., Ltd." required>
        
        <label>Location</label>
        <input type="text" name="location" placeholder="e.g. Yangon" required>
        
        <label>Salary</label>
        <input type="text" name="salary" placeholder="e.g. 500,000 MMK" required>
        
        <label>Age Range</label>
        <input type="text" name="age" placeholder="e.g. 20-25" required>
        
        <label>Job Type</label>
        <select name="type" required>
            <option value="" disabled selected>-- Select Type --</option>
            <option value="Full Time">Full Time</option>
            <option value="Internship">Internship</option>
            <option value="Part-time">Part-time</option>
        </select>
        
        <button type="submit" name="add_job" class="btn">Add Job Now</button>
    </form>
</div>

</body>
</html>