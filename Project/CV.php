<?php
session_start(); 

// ၁။ Database ချိတ်ဆက်ခြင်း
$conn = new mysqli("localhost", "root", "", "job_portal");
if ($conn->connect_error) { 
    die("Database error: " . $conn->connect_error); 
}

// ၂။ Form တင်လိုက်တဲ့အခါ
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
    
    // Job ID ကို သေချာစစ်ဆေးခြင်း (NULL ဖြစ်နိုင်ခြေကိုပါ တွက်ထားပါသည်)
    $raw_job_id = $_POST['job_id'];
    $job_id = (!empty($raw_job_id) && $raw_job_id != '0') ? "'" . mysqli_real_escape_string($conn, $raw_job_id) . "'" : "NULL";

    // Form မှ data များအားလုံးကို Clean လုပ်ခြင်း
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $job = mysqli_real_escape_string($conn, $_POST['job']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $about = mysqli_real_escape_string($conn, $_POST['about']);
    $experience = mysqli_real_escape_string($conn, $_POST['experience']);
    $company_name = mysqli_real_escape_string($conn, $_POST['company_name']); 
    $township = mysqli_real_escape_string($conn, $_POST['township']);
    $university = mysqli_real_escape_string($conn, $_POST['university']);
    $degree_data = mysqli_real_escape_string($conn, $_POST['bachelor']); // B.C.Sc စသည်
    $major = mysqli_real_escape_string($conn, $_POST['major']);
    $skills = mysqli_real_escape_string($conn, $_POST['skills']);
    
    // ဓာတ်ပုံတင်ခြင်း လုပ်ငန်းစဉ်
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) { 
        mkdir($target_dir, 0777, true); 
    }
    
    $file_name = time() . "_" . basename($_FILES["profile_img"]["name"]);
    $target_file = $target_dir . $file_name;
    
    if (move_uploaded_file($_FILES["profile_img"]["tmp_name"], $target_file)) {
        
        // ✅ ရွှေရည်ရဲ့ Database Column နာမည်များ (bachelor, degree, etc.) နှင့် အတိအကျ ညှိထားသော SQL Query
        $sql = "INSERT INTO applications (
                    job_id, user_id, township, applicant_name, email, phone, address, 
                    about_me, cv_file, job_title, company_name, experience, 
                    university, bachelor, major, skills, applied_date, status
                ) 
                VALUES (
                    $job_id, '$user_id', '$township', '$name', '$email', '$phone', '$address', 
                    '$about', '$file_name', '$job', '$company_name', '$experience', 
                    '$university', '$degree_data', '$major', '$skills', NOW(), 'Pending'
                )";
        
        if ($conn->query($sql) === TRUE) {
            
            // Email မရှိသေးလျှင် User အသစ်အဖြစ် Register လုပ်ပေးခြင်း
            $check_user = mysqli_query($conn, "SELECT id FROM users WHERE email = '$email'");
            if (mysqli_num_rows($check_user) == 0) {
                $temp_pass = password_hash($phone, PASSWORD_DEFAULT); 
                mysqli_query($conn, "INSERT INTO users (username, email, password, role, township, profile_image, status) 
                                    VALUES ('$name', '$email', '$temp_pass', 'Jobseeker', '$township', 'default.png', 1)");
            }

            echo "<script>
                    alert('လျှောက်လွှာတင်ခြင်း အောင်မြင်ပါသည်။ Admin မှ စစ်ဆေးပေးပါမည်။'); 
                    window.location.href='../student/Main/companies.php';
                  </script>";
        } else {
            // Error တစ်ခုခုရှိခဲ့လျှင် မြင်နိုင်ရန်
            die("Database Error: " . $conn->error . "<br>Query: " . $sql);
        }
    } else {
        echo "<script>alert('ပုံတင်ရာတွင် အခက်အခဲရှိနေပါသည်။ Folder Permission ကို စစ်ဆေးပါ။');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="my">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern CV Application</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root { --primary: #4361ee; --bg: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); }
        body { background: var(--bg); min-height: 100vh; display: flex; justify-content: center; align-items: center; padding: 40px 20px; font-family: 'Plus Jakarta Sans', sans-serif; margin: 0; }
        .cv-container { width: 100%; max-width: 900px; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 24px; box-shadow: 0 20px 50px rgba(0,0,0,0.1); overflow: hidden; }
        .form-header { background: var(--primary); color: white; padding: 25px; text-align: center; }
        .cv-body { display: grid; grid-template-columns: 35% 65%; padding: 20px; }
        .sidebar { background: #f8faff; padding: 30px; border-radius: 20px; margin-right: 15px; }
        .photo-upload { text-align: center; margin-bottom: 25px; }
        .profile-preview-wrapper { width: 140px; height: 140px; margin: 0 auto 15px; border-radius: 50%; border: 4px solid white; box-shadow: 0 5px 15px rgba(0,0,0,0.1); overflow: hidden; background: #eef2f7; display: flex; align-items: center; justify-content: center; }
        .profile-preview-wrapper i { font-size: 60px; color: #cbd5e1; }
        .profile-preview-wrapper img { width: 100%; height: 100%; object-fit: cover; display: none; }
        .file-label { background: var(--primary); color: white; padding: 8px 15px; border-radius: 20px; font-size: 12px; cursor: pointer; }
        .input-group { margin-bottom: 15px; }
        .input-group label { display: block; font-weight: 600; font-size: 13px; color: #475569; margin-bottom: 5px; }
        input, textarea, select { width: 100%; padding: 12px; border: 1.5px solid #e2e8f0; border-radius: 10px; font-size: 14px; box-sizing: border-box; }
        .section-title { font-size: 15px; font-weight: 700; color: var(--primary); margin: 20px 0 10px; border-bottom: 2px solid #eef2f7; padding-bottom: 5px; }
        .form-footer { padding: 25px; background: #f8faff; text-align: center; }
        .submit-btn { background: var(--primary); color: white; border: none; padding: 15px 40px; border-radius: 12px; font-weight: 700; cursor: pointer; transition: 0.3s; }
        .submit-btn:hover { background: #3046bc; transform: translateY(-2px); }
    </style>
</head>
<body>

<div class="cv-container">
    <div class="form-header"><h2>CV APPLICATION FORM</h2></div>
    <form action="cv.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="job_id" value="<?php echo htmlspecialchars($_GET['id'] ?? '0'); ?>">
        <input type="hidden" name="company_name" value="<?php echo htmlspecialchars($_GET['comp'] ?? ''); ?>">
        
        <div class="cv-body">
            <div class="sidebar">
                <div class="photo-upload">
                    <div class="profile-preview-wrapper">
                        <i class="fas fa-user" id="icon-placeholder"></i>
                        <img id="image-preview" src="">
                    </div>
                    <label for="imgInput" class="file-label"><i class="fas fa-camera"></i> Choose Photo</label>
                    <input type="file" name="profile_img" id="imgInput" style="display:none;" onchange="previewImage(event)" required>
                </div>
                
                <div class="section-title">Personal Info</div>
                <div class="input-group"><input type="text" name="name" placeholder="Full Name" required></div>
                <div class="input-group"><input type="text" name="job" value="<?php echo htmlspecialchars($_GET['job'] ?? ''); ?>" placeholder="Applied Position" required></div>
                
                <div class="input-group">
                    <label>Township</label>
                    <select name="township" required>
                        <option value="All City">All City</option>
                        <option value="Yangon">Yangon</option>
                        <option value="Mandalay">Mandalay</option>
                        <option value="Meiktila">Meiktila</option>
                        <option value="Naypyitaw">Naypyitaw</option>
                        <option value="Taunggyi">Taunggyi</option>
                    </select>
                </div>

                <div class="section-title">Contact</div>
                <div class="input-group"><input type="text" name="phone" placeholder="Phone Number" required></div>
                <div class="input-group"><input type="email" name="email" placeholder="Email Address" required></div>
                <div class="input-group"><textarea name="address" placeholder="Current Address" rows="2"></textarea></div>
            </div>

            <div class="main-content">
                <div class="section-title">Education Details</div>
                <div class="input-group">
                    <label>University</label>
                    <select name="university">
                        <option value="">-- Select University --</option>
                        <option value="UCSMTLA">UCS Meiktila</option>
                        <option value="UCSM">UCS Mandalay</option>
                        <option value="UCSY">UCS Yangon</option>

                        <option value="UIT">UIT</option>
                    </select>
                </div>
                
                <div style="display: flex; gap: 10px;">
                    <div class="input-group" style="flex: 1;">
                        <label>Degree</label>
                        <select name="bachelor">
                            <option value="">-- Degree --</option>
                            <option value="B.C.Sc">B.C.Sc</option>
                            <option value="B.C.Tech">B.C.Tech</option>
                            <option value="B.I.S">B.I.S</option>
                        </select>
                    </div>
                    <div class="input-group" style="flex: 1;">
                        <label>Major</label>
                        <input type="text" name="major" placeholder="e.g. Computer Science">
                    </div>
                </div>

                <div class="section-title">Work Experience</div>
                <textarea name="experience" placeholder="Describe your history..." rows="5"></textarea>
                
                <div class="section-title">Skills & About Me</div>
                <div class="input-group">
                    <textarea name="skills" placeholder="e.g. PHP, HTML, CSS, Leadership..." rows="3" style="margin-bottom:10px;"></textarea>
                </div>
                <div class="input-group">
                    <textarea name="about" placeholder="Tell us about yourself..." rows="3"></textarea>
                </div>
            </div>
        </div>

        <div class="form-footer">
            <button type="submit" class="submit-btn">SUBMIT CV <i class="fas fa-paper-plane"></i></button>
        </div>
    </form>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('image-preview');
            const icon = document.getElementById('icon-placeholder');
            output.src = reader.result;
            output.style.display = 'block';
            icon.style.display = 'none';
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
</body>
</html>