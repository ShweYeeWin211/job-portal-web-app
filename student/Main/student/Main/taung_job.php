<?php
// Database connection ချိတ်ဆက်ခြင်း
include '../../includes/db_config.php'; 

$company_id = isset($_GET['id']) ? $_GET['id'] : '';
$companies = [
    'galaxy' => ['name' => 'Galaxy Software TGI', 'address' => 'Bogyoke Road, Taunggyi'],
    'amazing' => ['name' => 'Amazing Tech TGI', 'address' => 'Shan State Capital'],
    'dynamic' => ['name' => 'Dynamicweb TGI', 'address' => 'Main Road, Taunggyi'],
    'eabc' => ['name' => 'EABC Co., Ltd', 'address' => 'East Circular Road'],
    'naungyoe' => ['name' => 'Naung Yoe Tech', 'address' => 'Cherry Street, Taunggyi'],
    'teq' => ['name' => 'TEQ Technologies', 'address' => 'Hospital Road'],
    'csc' => ['name' => 'Cyberspace II (CSC)', 'address' => 'City Center, Taunggyi'],
    'mcc' => ['name' => 'Micro Computer Center', 'address' => 'Market Area, Taunggyi']
];

$current_comp = isset($companies[$company_id]) ? $companies[$company_id] : null;
$jobs = [];

// --- (၁) Static အလုပ်များ (ရွှေရည်ရေးထားသည့်အတိုင်း) ---
if ($company_id == 'galaxy') {
    $jobs = [
        ['title' => 'Software Support', 'type' => 'Full Time', 'desc' => 'POS & ERP software installation.', 'salary' => '450,000 MMK', 'age' => '20-28'],
        ['title' => 'Trainee Developer', 'type' => 'Internship', 'desc' => 'Learn software maintenance.', 'salary' => '150,000 MMK', 'age' => '18-23'],
        ['title' => 'Sales Executive', 'type' => 'Full Time', 'desc' => 'Promote software to local firms.', 'salary' => '350,000 MMK', 'age' => '21-30'],
        ['title' => 'Data Entry Intern', 'type' => 'Internship', 'desc' => 'Assist in system data migration.', 'salary' => '120,000 MMK', 'age' => '18-22'],
        ['title' => 'Technical Support', 'type' => 'Full Time', 'desc' => 'Troubleshoot software issues.', 'salary' => '400,000 MMK', 'age' => '22-30'],
        ['title' => 'Implementation Lead', 'type' => 'Full Time', 'desc' => 'Manage software setup projects.', 'salary' => '600,000 MMK', 'age' => '25-35']
    ];
} elseif ($company_id == 'amazing') {
    $jobs = [
        ['title' => 'Web Developer', 'type' => 'Full Time', 'desc' => 'Build sites for local brands.', 'salary' => '600,000 MMK', 'age' => '22-35'],
        ['title' => 'Web Design Intern', 'type' => 'Internship', 'desc' => 'Assist in UI/UX research.', 'salary' => '180,000 MMK', 'age' => '19-24'],
        ['title' => 'Social Media Admin', 'type' => 'Full Time', 'desc' => 'Manage branch marketing pages.', 'salary' => '300,000 MMK', 'age' => '20-28'],
        ['title' => 'Graphic Intern', 'type' => 'Internship', 'desc' => 'Create local ad banners.', 'salary' => '150,000 MMK', 'age' => '18-23'],
        ['title' => 'Customer Care', 'type' => 'Full Time', 'desc' => 'Handle local client inquiries.', 'salary' => '350,000 MMK', 'age' => '20-27'],
        ['title' => 'SEO Specialist', 'type' => 'Full Time', 'desc' => 'Optimize local business sites.', 'salary' => '500,000 MMK', 'age' => '22-32']
    ];
} elseif ($company_id == 'dynamic') {
    $jobs = [
        ['title' => 'Junior PHP Dev', 'type' => 'Full Time', 'desc' => 'Maintenance of web apps.', 'salary' => '450,000 MMK', 'age' => '21-28'],
        ['title' => 'Coding Intern', 'type' => 'Internship', 'desc' => 'Learn backend programming.', 'salary' => '200,000 MMK', 'age' => '19-24'],
        ['title' => 'System Analyst', 'type' => 'Full Time', 'desc' => 'Gather project requirements.', 'salary' => '650,000 MMK', 'age' => '25-35'],
        ['title' => 'Testing Intern', 'type' => 'Internship', 'desc' => 'Perform basic bug testing.', 'salary' => '150,000 MMK', 'age' => '18-23'],
        ['title' => 'Content Writer', 'type' => 'Full Time', 'desc' => 'Write tech project docs.', 'salary' => '350,000 MMK', 'age' => '21-30'],
        ['title' => 'HR Executive', 'type' => 'Full Time', 'desc' => 'Branch recruitment tasks.', 'salary' => '400,000 MMK', 'age' => '22-30']
    ];
} elseif ($company_id == 'eabc') {
    $jobs = [
        ['title' => 'Data Consultant', 'type' => 'Full Time', 'desc' => 'Manage enterprise data systems.', 'salary' => '550,000 MMK', 'age' => '24-35'],
        ['title' => 'Data Admin Intern', 'type' => 'Internship', 'desc' => 'Basic database entry tasks.', 'salary' => '180,000 MMK', 'age' => '19-24'],
        ['title' => 'B2B Sales Rep', 'type' => 'Full Time', 'desc' => 'Sell data solutions locally.', 'salary' => '400,000 MMK', 'age' => '22-32'],
        ['title' => 'Admin Intern', 'type' => 'Internship', 'desc' => 'Help with office documentation.', 'salary' => '150,000 MMK', 'age' => '18-23'],
        ['title' => 'Network Support', 'type' => 'Full Time', 'desc' => 'Maintain branch office LAN.', 'salary' => '450,000 MMK', 'age' => '22-30'],
        ['title' => 'Field Engineer', 'type' => 'Full Time', 'desc' => 'Site visits for tech support.', 'salary' => '500,000 MMK', 'age' => '23-35']
    ];
} elseif ($company_id == 'naungyoe') {
    $jobs = [
        ['title' => 'Security Engineer', 'type' => 'Full Time', 'desc' => 'Install CCTV & IT security.', 'salary' => '500,000 MMK', 'age' => '23-35'],
        ['title' => 'Hardware Intern', 'type' => 'Internship', 'desc' => 'Learn security system setup.', 'salary' => '200,000 MMK', 'age' => '20-25'],
        ['title' => 'Sales Supervisor', 'type' => 'Full Time', 'desc' => 'Lead the sales team in TGI.', 'salary' => '600,000 MMK', 'age' => '26-40'],
        ['title' => 'Marketing Intern', 'type' => 'Internship', 'desc' => 'Local market survey tasks.', 'salary' => '150,000 MMK', 'age' => '18-23'],
        ['title' => 'CCTV Technician', 'type' => 'Full Time', 'desc' => 'Outdoor installation tasks.', 'salary' => '350,000 MMK', 'age' => '20-30'],
        ['title' => 'Inventory Clerk', 'type' => 'Full Time', 'desc' => 'Manage tech stock items.', 'salary' => '300,000 MMK', 'age' => '19-27']
    ];
} elseif ($company_id == 'teq') {
    $jobs = [
        ['title' => 'Network Admin', 'type' => 'Full Time', 'desc' => 'Manage local fiber networks.', 'salary' => '700,000 MMK', 'age' => '25-38'],
        ['title' => 'Fiber Intern', 'type' => 'Internship', 'desc' => 'Learn fiber optic splicing.', 'salary' => '250,000 MMK', 'age' => '20-25'],
        ['title' => 'Tech Support Staff', 'type' => 'Full Time', 'desc' => 'Helpdesk for ISP users.', 'salary' => '350,000 MMK', 'age' => '19-26'],
        ['title' => 'Cable Intern', 'type' => 'Internship', 'desc' => 'Assist field technicians.', 'salary' => '200,000 MMK', 'age' => '18-23'],
        ['title' => 'Accountant', 'type' => 'Full Time', 'desc' => 'Manage branch finances.', 'salary' => '400,000 MMK', 'age' => '22-30'],
        ['title' => 'Sales Executive', 'type' => 'Full Time', 'desc' => 'Promote internet packages.', 'salary' => '300,000 MMK', 'age' => '20-28']
    ];
} elseif ($company_id == 'csc') {
    $jobs = [
        ['title' => 'System Engineer', 'type' => 'Full Time', 'desc' => 'Manage local server farms.', 'salary' => '650,000 MMK', 'age' => '25-35'],
        ['title' => 'System Intern', 'type' => 'Internship', 'desc' => 'Monitor system logs.', 'salary' => '250,000 MMK', 'age' => '21-25'],
        ['title' => 'Operations Officer', 'type' => 'Full Time', 'desc' => 'Coordinate daily tech tasks.', 'salary' => '450,000 MMK', 'age' => '23-32'],
        ['title' => 'Facility Intern', 'type' => 'Internship', 'desc' => 'Learn data center cooling.', 'salary' => '200,000 MMK', 'age' => '19-24'],
        ['title' => 'Site Manager', 'type' => 'Full Time', 'desc' => 'Lead branch operations.', 'salary' => '800,000 MMK', 'age' => '30-45'],
        ['title' => 'Driver/Technician', 'type' => 'Full Time', 'desc' => 'Branch field transport.', 'salary' => '250,000 MMK', 'age' => '25-40']
    ];
} elseif ($company_id == 'mcc') {
    $jobs = [
        ['title' => 'IT Instructor', 'type' => 'Full Time', 'desc' => 'Teach basic office & coding.', 'salary' => '400,000 MMK', 'age' => '22-35'],
        ['title' => 'Teaching Intern', 'type' => 'Internship', 'desc' => 'Assist senior teachers.', 'salary' => '150,000 MMK', 'age' => '19-23'],
        ['title' => 'Service Engineer', 'type' => 'Full Time', 'desc' => 'Repair laptops & desktops.', 'salary' => '450,000 MMK', 'age' => '22-30'],
        ['title' => 'Hardware Intern', 'type' => 'Internship', 'desc' => 'Learn PC troubleshooting.', 'salary' => '150,000 MMK', 'age' => '18-22'],
        ['title' => 'Receptionist', 'type' => 'Full Time', 'desc' => 'Manage student enrollments.', 'salary' => '250,000 MMK', 'age' => '18-25'],
        ['title' => 'Librarian/Resource', 'type' => 'Full Time', 'desc' => 'Manage digital assets.', 'salary' => '280,000 MMK', 'age' => '20-28']
    ];
}

// --- (၂) Database မှ Admin အသစ်ထည့်လိုက်သော အလုပ်များကို ပေါင်းထည့်ခြင်း ---
if ($current_comp && isset($conn)) {
    $comp_name = mysqli_real_escape_string($conn, $current_comp['name']);
    $sql = "SELECT * FROM jobs WHERE company = '$comp_name' AND status = 'Approved' ORDER BY id DESC";
    $db_result = mysqli_query($conn, $sql);

    if ($db_result && mysqli_num_rows($db_result) > 0) {
        while ($row = mysqli_fetch_assoc($db_result)) {
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
    <title>Job Openings - <?php echo $current_comp ? $current_comp['name'] : 'Taunggyi'; ?></title>
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
    <nav>
        <a href="taunggyi.php" style="text-decoration:none; color:#1877f2; font-weight:600;">
            <i class="fas fa-arrow-left"></i> Back to Taunggyi
        </a>
    </nav>
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
                                <div class="job-title"><?php echo htmlspecialchars($job['title']); ?></div>
                                <span class="job-type"><?php echo htmlspecialchars($job['type']); ?></span>
                            </div>
                            <p class="job-desc"><?php echo htmlspecialchars($job['desc']); ?></p>
                            <div class="job-meta">
                                <span><i class="fas fa-money-bill-wave"></i> <?php echo htmlspecialchars($job['salary']); ?></span>
                                <span><i class="fas fa-user-clock"></i> <?php echo htmlspecialchars($job['age']); ?></span>
                            </div>
                        </div>
                        <a href="../../Project/CV.php?job=<?php echo urlencode($job['title']); ?>&comp=<?php echo urlencode($current_comp['name']); ?>" class="apply-btn">Apply Now</a>
                    </div>
                <?php endforeach; ?>
            </div>
            <p class="wish-footer">"Wishing you the best of luck with your job search!"</p>
        <?php else: ?>
            <div style="text-align:center; padding:100px;">
                <h2>Company not found!</h2>
                <a href="taunggyi.php">Back</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>