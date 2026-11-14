<?php
// Database connection ကို includes folder ထဲကနေ လှမ်းချိတ်ပါတယ်
include '../../includes/db_config.php'; 

$company_id = isset($_GET['id']) ? $_GET['id'] : '';
$companies = [
    'ntt' => ['name' => 'NTT DATA Myanmar', 'address' => 'MICT Park, Hlaing'],
    'gnw' => ['name' => 'Global New Wave', 'address' => 'Hledan, Yangon'],
    'qhrm' => ['name' => 'QHRM HR Software', 'address' => 'Mayangone, Yangon'],
    'cyberking' => ['name' => 'Cyber King Co., Ltd.', 'address' => 'Sanchaung, Yangon'],
    'ultimate' => ['name' => 'Ultimate Solutions', 'address' => 'Tech Park, Yangon'],
    'dirace' => ['name' => 'DIR-ACE Tech', 'address' => 'Yankin, Yangon'],
    'mit' => ['name' => 'MIT Innovation Hub', 'address' => 'Thuwanna, Yangon'],
    'yma' => ['name' => 'Yangon Mobile Apps', 'address' => 'Kamayut, Yangon']
];

$current_comp = isset($companies[$company_id]) ? $companies[$company_id] : null;
$jobs = [];

// --- (၁) Static Jobs (ရွှေရည် ထည့်ထားသမျှ အလုပ်များ အားလုံး) ---

if ($company_id == 'ntt') {
    $jobs = [
        ['id' => 0, 'title' => 'Java Enterprise Dev', 'type' => 'Full Time', 'desc' => 'Develop banking software systems.', 'salary' => '950,000 MMK', 'age' => '24-35'],
        ['id' => 0, 'title' => 'System Admin Intern', 'type' => 'Internship', 'desc' => 'Learn server & cloud ops.', 'salary' => '250,000 MMK', 'age' => '19-24'],
        ['id' => 0, 'title' => 'Cloud Architect', 'type' => 'Full Time', 'desc' => 'AWS/Azure infrastructure.', 'salary' => '1,300,000 MMK', 'age' => '28-40'],
        ['id' => 0, 'title' => 'Network Intern', 'type' => 'Internship', 'desc' => 'Basic networking & security.', 'salary' => '220,000 MMK', 'age' => '18-23'],
        ['id' => 0, 'title' => 'QA Specialist', 'type' => 'Full Time', 'desc' => 'Automation testing with Selenium.', 'salary' => '700,000 MMK', 'age' => '22-30'],
        ['id' => 0, 'title' => 'Technical Lead', 'type' => 'Full Time', 'desc' => 'Lead offshore development team.', 'salary' => '1,500,000 MMK', 'age' => '30-45']
    ];
} elseif ($company_id == 'gnw') {
    $jobs = [
        ['id' => 0, 'title' => 'Flutter Developer', 'type' => 'Full Time', 'desc' => 'Mobile cross-platform apps.', 'salary' => '850,000 MMK', 'age' => '23-32'],
        ['id' => 0, 'title' => 'Mobile Intern', 'type' => 'Internship', 'desc' => 'UI design for mobile apps.', 'salary' => '200,000 MMK', 'age' => '18-22'],
        ['id' => 0, 'title' => 'Backend Node.js', 'type' => 'Full Time', 'desc' => 'Scalable backend API services.', 'salary' => '900,000 MMK', 'age' => '24-35'],
        ['id' => 0, 'title' => 'Frontend Intern', 'type' => 'Internship', 'desc' => 'React and UI components.', 'salary' => '250,000 MMK', 'age' => '19-23'],
        ['id' => 0, 'title' => 'DB Administrator', 'type' => 'Full Time', 'desc' => 'Optimize Postgres databases.', 'salary' => '750,000 MMK', 'age' => '25-35'],
        ['id' => 0, 'title' => 'Scrum Master', 'type' => 'Full Time', 'desc' => 'Manage agile workflows.', 'salary' => '1,000,000 MMK', 'age' => '26-40']
    ];
} elseif ($company_id == 'qhrm') {
    $jobs = [
        ['id' => 0, 'title' => 'PHP Laravel Dev', 'type' => 'Full Time', 'desc' => 'Build HR & payroll solutions.', 'salary' => '800,000 MMK', 'age' => '22-30'],
        ['id' => 0, 'title' => 'UX Design Intern', 'type' => 'Internship', 'desc' => 'User experience research.', 'salary' => '280,000 MMK', 'age' => '20-24'],
        ['id' => 0, 'title' => 'Software Sales', 'type' => 'Full Time', 'desc' => 'Promote B2B HR systems.', 'salary' => '500,000 MMK', 'age' => '21-28'],
        ['id' => 0, 'title' => 'Marketing Intern', 'type' => 'Internship', 'desc' => 'Assist digital marketing.', 'salary' => '180,000 MMK', 'age' => '18-23'],
        ['id' => 0, 'title' => 'Product Support', 'type' => 'Full Time', 'desc' => 'Technical user helpdesk.', 'salary' => '450,000 MMK', 'age' => '20-28'],
        ['id' => 0, 'title' => 'Data Analyst', 'type' => 'Full Time', 'desc' => 'Analyze workforce data.', 'salary' => '700,000 MMK', 'age' => '23-32']
    ];
} elseif ($company_id == 'cyberking') {
    $jobs = [
        ['id' => 0, 'title' => 'Security Analyst', 'type' => 'Full Time', 'desc' => 'Monitor network security.', 'salary' => '900,000 MMK', 'age' => '24-35'],
        ['id' => 0, 'title' => 'Cyber Intern', 'type' => 'Internship', 'desc' => 'Penetration testing basics.', 'salary' => '300,000 MMK', 'age' => '20-25'],
        ['id' => 0, 'title' => 'Desktop Support', 'type' => 'Full Time', 'desc' => 'Enterprise IT support.', 'salary' => '400,000 MMK', 'age' => '19-27'],
        ['id' => 0, 'title' => 'Security Intern', 'type' => 'Internship', 'desc' => 'Firewall configuration training.', 'salary' => '220,000 MMK', 'age' => '18-23'],
        ['id' => 0, 'title' => 'Network Engineer', 'type' => 'Full Time', 'desc' => 'Enterprise WAN management.', 'salary' => '850,000 MMK', 'age' => '25-38'],
        ['id' => 0, 'title' => 'Admin Officer', 'type' => 'Full Time', 'desc' => 'Office administration.', 'salary' => '450,000 MMK', 'age' => '22-30']
    ];
} elseif ($company_id == 'ultimate') {
    $jobs = [
        ['id' => 0, 'title' => 'ERP Consultant', 'type' => 'Full Time', 'desc' => 'Odoo implementation specialist.', 'salary' => '1,100,000 MMK', 'age' => '26-38'],
        ['id' => 0, 'title' => 'ERP Intern', 'type' => 'Internship', 'desc' => 'Learn business workflows.', 'salary' => '300,000 MMK', 'age' => '20-25'],
        ['id' => 0, 'title' => 'Python Developer', 'type' => 'Full Time', 'desc' => 'Backend scripts for ERP.', 'salary' => '850,000 MMK', 'age' => '23-32'],
        ['id' => 0, 'title' => 'QA Junior Tester', 'type' => 'Internship', 'desc' => 'Manual testing projects.', 'salary' => '200,000 MMK', 'age' => '18-23'],
        ['id' => 0, 'title' => 'Solutions Sales', 'type' => 'Full Time', 'desc' => 'Sell technical solutions.', 'salary' => '700,000 MMK', 'age' => '24-35'],
        ['id' => 0, 'title' => 'HR Coordinator', 'type' => 'Full Time', 'desc' => 'Internal HR operations.', 'salary' => '500,000 MMK', 'age' => '22-30']
    ];
} elseif ($company_id == 'dirace') {
    $jobs = [
        ['id' => 0, 'title' => 'React Native Dev', 'type' => 'Full Time', 'desc' => 'Offshore mobile app projects.', 'salary' => '900,000 MMK', 'age' => '24-33'],
        ['id' => 0, 'title' => 'Frontend Intern', 'type' => 'Internship', 'desc' => 'HTML/CSS/JS training.', 'salary' => '250,000 MMK', 'age' => '19-24'],
        ['id' => 0, 'title' => 'MERN Stack Dev', 'type' => 'Full Time', 'desc' => 'Web application development.', 'salary' => '1,200,000 MMK', 'age' => '26-40'],
        ['id' => 0, 'title' => 'UI/UX Intern', 'type' => 'Internship', 'desc' => 'Design user interfaces.', 'salary' => '200,000 MMK', 'age' => '18-23'],
        ['id' => 0, 'title' => 'Project Manager', 'type' => 'Full Time', 'desc' => 'Manage foreign clients.', 'salary' => '1,400,000 MMK', 'age' => '28-45'],
        ['id' => 0, 'title' => 'Comms Officer', 'type' => 'Full Time', 'desc' => 'Bridge team & clients.', 'salary' => '600,000 MMK', 'age' => '21-30']
    ];
} elseif ($company_id == 'mit') {
    $jobs = [
        ['id' => 0, 'title' => 'AI Specialist', 'type' => 'Full Time', 'desc' => 'Work on ML and Data models.', 'salary' => '1,500,000 MMK', 'age' => '25-40'],
        ['id' => 0, 'title' => 'Data Sci Intern', 'type' => 'Internship', 'desc' => 'Assist data processing.', 'salary' => '350,000 MMK', 'age' => '21-26'],
        ['id' => 0, 'title' => 'Full Stack Lead', 'type' => 'Full Time', 'desc' => 'Manage portal ecosystem.', 'salary' => '1,200,000 MMK', 'age' => '27-40'],
        ['id' => 0, 'title' => 'Coding Intern', 'type' => 'Internship', 'desc' => 'Backend testing aid.', 'salary' => '250,000 MMK', 'age' => '19-24'],
        ['id' => 0, 'title' => 'DevOps Specialist', 'type' => 'Full Time', 'desc' => 'CI/CD and Dockerization.', 'salary' => '1,300,000 MMK', 'age' => '26-40'],
        ['id' => 0, 'title' => 'Technical Blogger', 'type' => 'Full Time', 'desc' => 'Write tech articles.', 'salary' => '500,000 MMK', 'age' => '21-28']
    ];
} elseif ($company_id == 'yma') {
    $jobs = [
        ['id' => 0, 'title' => 'Android Kotlin Dev', 'type' => 'Full Time', 'desc' => 'Native Android apps.', 'salary' => '800,000 MMK', 'age' => '22-32'],
        ['id' => 0, 'title' => 'Swift Intern', 'type' => 'Internship', 'desc' => 'iOS app development help.', 'salary' => '300,000 MMK', 'age' => '20-25'],
        ['id' => 0, 'title' => 'Graphic Designer', 'type' => 'Full Time', 'desc' => 'Creative assets for apps.', 'salary' => '550,000 MMK', 'age' => '21-28'],
        ['id' => 0, 'title' => 'App Sales Intern', 'type' => 'Internship', 'desc' => 'Promote mobile products.', 'salary' => '200,000 MMK', 'age' => '18-23'],
        ['id' => 0, 'title' => 'App Support', 'type' => 'Full Time', 'desc' => 'Troubleshooting user issues.', 'salary' => '350,000 MMK', 'age' => '18-25'],
        ['id' => 0, 'title' => 'Video Designer', 'type' => 'Full Time', 'desc' => 'App marketing videos.', 'salary' => '500,000 MMK', 'age' => '20-30']
    ];
}

// --- (၂) Database မှ Data များကို ဆွဲထုတ်ခြင်း (Type နှင့် Applicant Count ပါဝင်သည်) ---
if ($current_comp && isset($conn)) {
    $comp_name = mysqli_real_escape_string($conn, $current_comp['name']);
    
    // SQL query မှာ type ရော လျှောက်ထားသူအရေအတွက် (count) ပါ တွက်ထုတ်ထားပါတယ်
    $sql = "SELECT j.*, 
            (SELECT COUNT(*) FROM applications WHERE applications.job_id = j.id) as total_applicants 
            FROM jobs j 
            WHERE j.company = '$comp_name' AND j.status = 'Approved' 
            ORDER BY j.id DESC";
            
    $db_result = mysqli_query($conn, $sql);

    if ($db_result && mysqli_num_rows($db_result) > 0) {
        while ($row = mysqli_fetch_assoc($db_result)) {
            $jobs[] = [
                'id'     => $row['id'],
                'title'  => $row['job_title'],
                'type'   => $row['type'], 
                'desc'   => "New opportunity in " . $row['location'],
                'salary' => !empty($row['salary']) ? $row['salary'] : 'Negotiable', 
                'age'    => !empty($row['age']) ? $row['age'] : 'N/A',
                'count'  => $row['total_applicants'] 
            ];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Openings - <?php echo $current_comp ? $current_comp['name'] : 'Yangon'; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { background-color: #f8f9fa; color: #333; }
        nav { padding: 15px 10%; background: #fff; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 1000; }
        .container { padding: 40px 10%; max-width: 1200px; margin: 0 auto; }
        .header-section { margin-bottom: 30px; }
        .job-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(400px, 1fr)); gap: 20px; }
        .job-card { background: #fff; border-radius: 12px; padding: 25px; border: 1px solid #e1e4e8; transition: 0.3s; display: flex; flex-direction: column; justify-content: space-between; position: relative; }
        .job-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05); border-color: #1877f2; }
        .job-title { font-size: 18px; font-weight: 700; color: #1c1e21; }
        .job-type { background: #e7f3ff; color: #1877f2; padding: 4px 10px; border-radius: 4px; font-size: 11px; font-weight: 700; text-transform: uppercase; }
        
        /* လျှောက်ထားသူဦးရေပြ badge */
        .applicant-badge { position: absolute; top: 15px; right: 15px; background: #ff4757; color: white; padding: 3px 8px; border-radius: 20px; font-size: 10px; font-weight: bold; }

        .job-desc { color: #4b4f56; font-size: 14px; margin: 15px 0; min-height: 40px; }
        .job-meta { display: flex; gap: 20px; color: #65676b; font-size: 13px; font-weight: 600; margin-bottom: 20px; }
        .apply-btn { display: block; width: 100%; text-align: center; background: #1877f2; color: white; padding: 12px; border-radius: 8px; text-decoration: none; font-weight: 600; }
        .wish-footer { text-align: center; margin-top: 50px; font-style: italic; color: #1877f2; }
    </style>
</head>
<body>
    <nav><a href="yangon.php" style="text-decoration:none; color:#1877f2; font-weight:600;"><i class="fas fa-arrow-left"></i> Back to Yangon</a></nav>
    <div class="container">
        <?php if ($current_comp): ?>
            <div class="header-section">
                <h1>Jobs at <?php echo htmlspecialchars($current_comp['name']); ?></h1>
                <p><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($current_comp['address']); ?></p>
            </div>
            
            <div class="job-grid">
                <?php if (!empty($jobs)): ?>
                    <?php foreach ($jobs as $job): ?>
                        <div class="job-card">
                            <?php if(isset($job['count']) && $job['count'] > 0): ?>
                                <span class="applicant-badge"><i class="fas fa-users"></i> <?php echo $job['count']; ?> Applied</span>
                            <?php endif; ?>

                            <div>
                                <div style="display:flex; justify-content:space-between; align-items:flex-start;">
                                    <div class="job-title"><?php echo htmlspecialchars($job['title']); ?></div>
                                    <span class="job-type"><?php echo htmlspecialchars($job['type']); ?></span>
                                </div>
                                <p class="job-desc"><?php echo htmlspecialchars($job['desc']); ?></p>
                                <div class="job-meta">
                                    <span><i class="fas fa-money-bill-wave"></i> <?php echo htmlspecialchars($job['salary']); ?></span>
                                    <span><i class="fas fa-user-clock"></i> <?php echo htmlspecialchars($job['age']); ?></span>
                                </div>
                            </div>
                            <a href="../../Project/CV.php?id=<?php echo isset($job['id']) ? $job['id'] : ''; ?>&job=<?php echo urlencode($job['title']); ?>&comp=<?php echo urlencode($current_comp['name']); ?>" class="apply-btn">Apply Now</a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No jobs available at the moment.</p>
                <?php endif; ?>
            </div>
            <p class="wish-footer">"Wishing you the best of luck with your job search!"</p>
        <?php else: ?>
            <div style="text-align:center; padding:100px;">
                <h2>Company not found!</h2><a href="yangon.php">Back</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>