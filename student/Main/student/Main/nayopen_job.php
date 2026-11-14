<?php
// Database connection ကို includes folder ထဲကနေ လှမ်းချိတ်ပါတယ်
include '../../includes/db_config.php'; 

$company_id = isset($_GET['id']) ? $_GET['id'] : '';
$companies = [
    'linn' => ['name' => 'Linn IT Solution', 'address' => 'Zabu Thiri, Nay Pyi Taw'],
    'infosys' => ['name' => 'Info Sys (Myanmar)', 'address' => 'Ottara Thiri, Nay Pyi Taw'],
    'galaxy' => ['name' => 'Galaxy Software NPT', 'address' => 'Dekkhina Thiri, Nay Pyi Taw'],
    'novel' => ['name' => 'Novel Idea NPT', 'address' => 'Pobbathiri, Nay Pyi Taw'],
    'global' => ['name' => 'Global Technology', 'address' => 'Zabu Thiri, Nay Pyi Taw'],
    'naungyoe' => ['name' => 'Naung Yoe Tech', 'address' => 'Oattara Thiri, Nay Pyi Taw'],
    'mcci' => ['name' => 'MCC.i Campus', 'address' => 'Pyinmana, Nay Pyi Taw'],
    'ace' => ['name' => 'Ace Data Systems', 'address' => 'Hotel Zone, Nay Pyi Taw']
];

$current_comp = isset($companies[$company_id]) ? $companies[$company_id] : null;
$jobs = [];

// --- (၁) ရွှေရည် ထည့်ထားသမျှ Static အလုပ်များ (Nay Pyi Taw Data) ---

if ($company_id == 'linn') {
    $jobs = [
        ['title' => 'Senior Network Engineer', 'type' => 'Full Time', 'desc' => 'Manage government network nodes.', 'salary' => '800,000 MMK', 'age' => '25-40'],
        ['title' => 'IT Trainer', 'type' => 'Full Time', 'desc' => 'Teach IT courses to government staff.', 'salary' => '450,000 MMK', 'age' => '22-35'],
        ['title' => 'Technical Support', 'type' => 'Full Time', 'desc' => 'On-site hardware troubleshooting.', 'salary' => '350,000 MMK', 'age' => '20-28'],
        ['title' => 'Server Admin Intern', 'type' => 'Internship', 'desc' => 'Assist in server maintenance.', 'salary' => '200,000 MMK', 'age' => '19-24'],
        ['title' => 'Sales & Marketing', 'type' => 'Full Time', 'desc' => 'Promote IT services locally.', 'salary' => '300,000 MMK', 'age' => '21-30'],
        ['title' => 'Customer Care', 'type' => 'Full Time', 'desc' => 'Handle student & client queries.', 'salary' => '250,000 MMK', 'age' => '18-25']
    ];
} elseif ($company_id == 'infosys') {
    $jobs = [
        ['title' => 'Software Support', 'type' => 'Full Time', 'desc' => 'Helpdesk for accounting software.', 'salary' => '400,000 MMK', 'age' => '21-30'],
        ['title' => 'VB.NET Developer', 'type' => 'Full Time', 'desc' => 'Develop Windows-based applications.', 'salary' => '700,000 MMK', 'age' => '24-35'],
        ['title' => 'DB Administrator', 'type' => 'Full Time', 'desc' => 'Manage SQL server databases.', 'salary' => '600,000 MMK', 'age' => '25-40'],
        ['title' => 'Junior Web Dev', 'type' => 'Internship', 'desc' => 'Learn PHP and HTML/CSS basics.', 'salary' => '200,000 MMK', 'age' => '19-24'],
        ['title' => 'System Analyst', 'type' => 'Full Time', 'desc' => 'Gather local project requirements.', 'salary' => '500,000 MMK', 'age' => '24-35'],
        ['title' => 'Document Controller', 'type' => 'Full Time', 'desc' => 'Manage project documentation.', 'salary' => '300,000 MMK', 'age' => '20-28']
    ];
} elseif ($company_id == 'galaxy') {
    $jobs = [
        ['title' => 'ERP Support Specialist', 'type' => 'Full Time', 'desc' => 'Install ERP for local departments.', 'salary' => '500,000 MMK', 'age' => '23-32'],
        ['title' => 'Sales Executive', 'type' => 'Full Time', 'desc' => 'Business software sales in NPT.', 'salary' => '400,000 MMK', 'age' => '21-35'],
        ['title' => 'Implementation Intern', 'type' => 'Internship', 'desc' => 'Learn ERP implementation steps.', 'salary' => '180,000 MMK', 'age' => '19-24'],
        ['title' => 'Technical Writer', 'type' => 'Full Time', 'desc' => 'Prepare software manuals.', 'salary' => '350,000 MMK', 'age' => '22-30'],
        ['title' => 'Accountant', 'type' => 'Full Time', 'desc' => 'Handle branch finances.', 'salary' => '400,000 MMK', 'age' => '23-35'],
        ['title' => 'Office Assistant', 'type' => 'Full Time', 'desc' => 'General branch support.', 'salary' => '250,000 MMK', 'age' => '18-25']
    ];
} elseif ($company_id == 'novel') {
    $jobs = [
        ['title' => 'Graphic Designer', 'type' => 'Full Time', 'desc' => 'Social media assets for clients.', 'salary' => '450,000 MMK', 'age' => '20-30'],
        ['title' => 'Content Creator', 'type' => 'Full Time', 'desc' => 'Write posts for digital marketing.', 'salary' => '350,000 MMK', 'age' => '21-28'],
        ['title' => 'Video Editor Intern', 'type' => 'Internship', 'desc' => 'Learn video editing for ads.', 'salary' => '180,000 MMK', 'age' => '19-23'],
        ['title' => 'Junior Web Designer', 'type' => 'Internship', 'desc' => 'Assist in UI/UX wireframing.', 'salary' => '200,000 MMK', 'age' => '19-24'],
        ['title' => 'Account Executive', 'type' => 'Full Time', 'desc' => 'Handle client project cycles.', 'salary' => '400,000 MMK', 'age' => '23-32'],
        ['title' => 'Media Intern', 'type' => 'Internship', 'desc' => 'Assist in outdoor shoots.', 'salary' => '150,000 MMK', 'age' => '18-22']
    ];
} elseif ($company_id == 'global') {
    $jobs = [
        ['title' => 'Cloud Engineer', 'type' => 'Full Time', 'desc' => 'Manage data center cloud ops.', 'salary' => '900,000 MMK', 'age' => '26-40'],
        ['title' => 'Helpdesk Support', 'type' => 'Full Time', 'desc' => 'ISP support for local users.', 'salary' => '350,000 MMK', 'age' => '19-27'],
        ['title' => 'Fiber Technician', 'type' => 'Full Time', 'desc' => 'Fiber optic field works.', 'salary' => '380,000 MMK', 'age' => '22-35'],
        ['title' => 'Network Intern', 'type' => 'Internship', 'desc' => 'Basic IP configuration aid.', 'salary' => '200,000 MMK', 'age' => '20-25'],
        ['title' => 'Solution Consultant', 'type' => 'Full Time', 'desc' => 'Explain cloud solutions to B2B.', 'salary' => '650,000 MMK', 'age' => '25-38'],
        ['title' => 'Billing Clerk', 'type' => 'Full Time', 'desc' => 'Handle ISP client bills.', 'salary' => '280,000 MMK', 'age' => '19-30']
    ];
} elseif ($company_id == 'naungyoe') {
    $jobs = [
        ['title' => 'CCTV Technician', 'type' => 'Full Time', 'desc' => 'Installation in government zones.', 'salary' => '400,000 MMK', 'age' => '22-35'],
        ['title' => 'Sales Supervisor', 'type' => 'Full Time', 'desc' => 'Lead NPT security sales team.', 'salary' => '600,000 MMK', 'age' => '27-40'],
        ['title' => 'Hardware Specialist', 'type' => 'Full Time', 'desc' => 'Configure firewalls & routers.', 'salary' => '500,000 MMK', 'age' => '24-35'],
        ['title' => 'Security Intern', 'type' => 'Internship', 'desc' => 'Learn security system setup.', 'salary' => '220,000 MMK', 'age' => '20-25'],
        ['title' => 'Admin Officer', 'type' => 'Full Time', 'desc' => 'Manage branch operations.', 'salary' => '350,000 MMK', 'age' => '22-32'],
        ['title' => 'Logistic Staff', 'type' => 'Full Time', 'desc' => 'Monitor security stock items.', 'salary' => '280,000 MMK', 'age' => '20-30']
    ];
} elseif ($company_id == 'mcci') {
    $jobs = [
        ['title' => 'Computing Teacher', 'type' => 'Full Time', 'desc' => 'Teach NCC UK curriculum.', 'salary' => '500,000 MMK', 'age' => '24-40'],
        ['title' => 'Academic Intern', 'type' => 'Internship', 'desc' => 'Assist in classroom management.', 'salary' => '180,000 MMK', 'age' => '21-25'],
        ['title' => 'IT Admin', 'type' => 'Full Time', 'desc' => 'Maintain campus computer labs.', 'salary' => '400,000 MMK', 'age' => '22-30'],
        ['title' => 'Registration Desk', 'type' => 'Full Time', 'desc' => 'Handle student enrollments.', 'salary' => '250,000 MMK', 'age' => '18-25'],
        ['title' => 'Librarian', 'type' => 'Full Time', 'desc' => 'Manage campus digital library.', 'salary' => '280,000 MMK', 'age' => '20-30'],
        ['title' => 'Cleaner/Helper', 'type' => 'Full Time', 'desc' => 'Office and lab maintenance.', 'salary' => '180,000 MMK', 'age' => '25-45']
    ];
} elseif ($company_id == 'ace') {
    $jobs = [
        ['title' => 'Banking Support', 'type' => 'Full Time', 'desc' => 'Support banking software users.', 'salary' => '500,000 MMK', 'age' => '23-35'],
        ['title' => 'Software Intern', 'type' => 'Internship', 'desc' => 'Bug reporting for banking app.', 'salary' => '250,000 MMK', 'age' => '21-25'],
        ['title' => 'Project Manager', 'type' => 'Full Time', 'desc' => 'Lead banking system rollout.', 'salary' => '1,000,000 MMK', 'age' => '28-45'],
        ['title' => 'QA Tester', 'type' => 'Full Time', 'desc' => 'Software quality assurance tasks.', 'salary' => '450,000 MMK', 'age' => '22-32'],
        ['title' => 'Senior Dev (Delphi)', 'type' => 'Full Time', 'desc' => 'Maintain core banking legacy.', 'salary' => '900,000 MMK', 'age' => '26-45'],
        ['title' => 'Communication Officer', 'type' => 'Full Time', 'desc' => 'Client liaison for banks.', 'salary' => '400,000 MMK', 'age' => '22-30']
    ];
}

// --- (၂) Database မှ အသစ်ထည့်သော အလုပ်များ (Yangon ကုဒ်အတိုင်း ပြန်ပြင်ပေးထားပါတယ်) ---
if ($current_comp && isset($conn)) {
    $comp_name = mysqli_real_escape_string($conn, $current_comp['name']);
    $sql = "SELECT * FROM jobs WHERE company = '$comp_name' AND status = 'Approved' ORDER BY id DESC";
    $db_result = mysqli_query($conn, $sql);

    if ($db_result && mysqli_num_rows($db_result) > 0) {
        while ($row = mysqli_fetch_assoc($db_result)) {
            // ✅ ဒီနေရာမှာ Yangon ကုဒ်အတိုင်း $row['type'] လို့ ပြန်ပြင်ထားပါတယ်
            $jobs[] = [
                'title'  => $row['job_title'],
                'type'   => $row['type'], 
                'desc'   => "New opportunity in " . $row['location'],
                'salary' => $row['salary'], 
                'age'    => $row['age']      
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
    <title>Job Openings - <?php echo $current_comp ? $current_comp['name'] : 'Nay Pyi Taw'; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { background-color: #f8f9fa; color: #333; }
        nav { padding: 15px 10%; background: #fff; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 1000; }
        .container { padding: 40px 10%; max-width: 1200px; margin: 0 auto; }
        .header-section { margin-bottom: 30px; }
        .job-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(400px, 1fr)); gap: 20px; }
        .job-card { background: #fff; border-radius: 12px; padding: 25px; border: 1px solid #e1e4e8; transition: 0.3s; display: flex; flex-direction: column; justify-content: space-between; }
        .job-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05); border-color: #1877f2; }
        .job-title { font-size: 18px; font-weight: 700; color: #1c1e21; }
        .job-type { background: #e7f3ff; color: #1877f2; padding: 4px 10px; border-radius: 4px; font-size: 11px; font-weight: 700; }
        .job-desc { color: #4b4f56; font-size: 14px; margin: 15px 0; min-height: 40px; }
        .job-meta { display: flex; gap: 20px; color: #65676b; font-size: 13px; font-weight: 600; margin-bottom: 20px; }
        .apply-btn { display: block; width: 100%; text-align: center; background: #1877f2; color: white; padding: 12px; border-radius: 8px; text-decoration: none; font-weight: 600; }
        .wish-footer { text-align: center; margin-top: 50px; font-style: italic; color: #1877f2; }
    </style>
</head>
<body>
    <nav><a href="naypyitaw.php" style="text-decoration:none; color:#1877f2; font-weight:600;"><i class="fas fa-arrow-left"></i> Back to Nay Pyi Taw</a></nav>
    <div class="container">
        <?php if ($current_comp): ?>
            <div class="header-section">
                <h1>Jobs at <?php echo $current_comp['name']; ?></h1>
                <p><i class="fas fa-map-marker-alt"></i> <?php echo $current_comp['address']; ?></p>
            </div>
            
            <div class="job-grid">
                <?php foreach ($jobs as $job): ?>
                    <div class="job-card">
                        <div>
                            <div style="display:flex; justify-content:space-between; align-items:flex-start;">
                                <div class="job-title"><?php echo $job['title']; ?></div>
                                <span class="job-type"><?php echo $job['type']; ?></span>
                            </div>
                            <p class="job-desc"><?php echo $job['desc']; ?></p>
                            <div class="job-meta">
                                <span><i class="fas fa-money-bill-wave"></i> <?php echo $job['salary']; ?></span>
                                <span><i class="fas fa-user-clock"></i> <?php echo $job['age']; ?></span>
                            </div>
                        </div>
                        <a href="../../Project/CV.php?job=<?php echo urlencode($job['title']); ?>&comp=<?php echo urlencode($current_comp['name']); ?>" class="apply-btn">Apply Now</a>
                    </div>
                <?php endforeach; ?>
            </div>
            <p class="wish-footer">"Wishing you the best of luck with your job search!"</p>
        <?php else: ?>
            <div style="text-align:center; padding:100px;">
                <h2>Company not found!</h2><a href="naypyitaw.php">Back</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>