<?php
// Page ရဲ့ အပေါ်ဆုံးမှာ ဘာစာသားမှ မရှိစေနဲ့နော်
session_start();

// Database connection ကို လှမ်းချိတ်ပါတယ်
include '../../includes/db_config.php'; 

// URL ကလာတဲ့ id ကို ယူမယ်
$company_id = isset($_GET['id']) ? $_GET['id'] : '';

// ကုမ္ပဏီ ဒေတာများ
$companies = [
    'met' => ['name' => 'Myanmar Net', 'address' => 'Meiktila Branch'],
    'kbz' => ['name' => 'KBZ Bank', 'address' => 'Main Road, Meiktila'],
    'deedee' => ['name' => 'Ko Dee Dee Mobile & Laptops', 'address' => 'Market Area, Meiktila'],
    'cb' => ['name' => 'CB Bank', 'address' => 'City Center, Meiktila'],
    'kmd' => ['name' => 'KMD Computer Center', 'address' => 'University Road, Meiktila'],
    'mcc' => ['name' => 'Shadow Hotel', 'address' => 'Lake Side, Meiktila']
];

$current_comp = isset($companies[$company_id]) ? $companies[$company_id] : null;
$jobs = [];

// --- (၁) Static အလုပ်များ ---
if ($company_id == 'met') {
    $jobs = [
        ['title' => 'Outdoor Sales Staff', 'type' => 'Full Time', 'desc' => 'Promote internet services to local areas.', 'salary' => '250,000 MMK', 'age' => '18-30'],
        ['title' => 'Installation Technician', 'type' => 'Full Time', 'desc' => 'Home internet setup and maintenance.', 'salary' => '400,000 MMK', 'age' => '20-35'],
        ['title' => 'Customer Support', 'type' => 'Full Time', 'desc' => 'Handle user inquiries and complaints.', 'salary' => '300,000 MMK', 'age' => '20-28'],
        ['title' => 'Store Keeper', 'type' => 'Full Time', 'desc' => 'Manage equipment and inventory stocks.', 'salary' => '280,000 MMK', 'age' => '20-30'],
        ['title' => 'Network Monitor', 'type' => 'Internship', 'desc' => 'Monitor system uptime and signals.', 'salary' => '150,000 MMK', 'age' => '19-24'],
        ['title' => 'Marketing Intern', 'type' => 'Internship', 'desc' => 'Assist in local branding activities.', 'salary' => '120,000 MMK', 'age' => '18-23']
    ];
} elseif ($company_id == 'kbz') {
    $jobs = [
        ['title' => 'Bank Teller', 'type' => 'Full Time', 'desc' => 'Handle cash and account transactions.', 'salary' => '400,000 MMK', 'age' => '20-26'],
        ['title' => 'Marketing Executive', 'type' => 'Full Time', 'desc' => 'Develop bank product strategies.', 'salary' => '400,000 MMK', 'age' => '22-35'],
        ['title' => 'Relationship Officer', 'type' => 'Full Time', 'desc' => 'Manage high-profile client accounts.', 'salary' => '600,000 MMK', 'age' => '25-40'],
        ['title' => 'Business Analyst', 'type' => 'Full Time', 'desc' => 'Analyze market and growth data.', 'salary' => '800,000 MMK', 'age' => '25-40'],
        ['title' => 'Cyber Fraud Analyst', 'type' => 'Full Time', 'desc' => 'Secure transactions and monitor fraud.', 'salary' => '1,200,000 MMK', 'age' => '25-40'],
        ['title' => 'Branch Trainee', 'type' => 'Internship', 'desc' => 'Learn overall banking operations.', 'salary' => '180,000 MMK', 'age' => '19-23']
    ];
} elseif ($company_id == 'deedee') {
    $jobs = [
        ['title' => 'Sales Assistant', 'type' => 'Full Time', 'desc' => 'Assist in smartphone and laptop sales.', 'salary' => '300,000 MMK', 'age' => '18-25'],
        ['title' => 'Cashier', 'type' => 'Full Time', 'desc' => 'Manage counter payments and billing.', 'salary' => '300,000 MMK', 'age' => '18-28'],
        ['title' => 'Mobile Technician', 'type' => 'Full Time', 'desc' => 'Smartphone hardware and OS repair.', 'salary' => '550,000 MMK', 'age' => '20-45'],
        ['title' => 'Promotion Staff', 'type' => 'Full Time', 'desc' => 'Plan and host in-store tech events.', 'salary' => '350,000 MMK', 'age' => '20-30'],
        ['title' => 'Stock Keeper', 'type' => 'Full Time', 'desc' => 'Control inventory of gadgets/parts.', 'salary' => '300,000 MMK', 'age' => '20-35'],
        ['title' => 'Laptop Repair Intern', 'type' => 'Internship', 'desc' => 'Learn basic laptop troubleshooting.', 'salary' => '150,000 MMK', 'age' => '18-22']
    ];
} elseif ($company_id == 'cb') {
    $jobs = [
        ['title' => 'Civil Engineer', 'type' => 'Full Time', 'desc' => 'Oversee branch construction/repairs.', 'salary' => '800,000 MMK', 'age' => '25-40'],
        ['title' => 'Customer Service', 'type' => 'Full Time', 'desc' => 'Assist walk-in bank customers.', 'salary' => '350,000 MMK', 'age' => '20-28'],
        ['title' => 'Branch Manager', 'type' => 'Full Time', 'desc' => 'Lead bank branch operations.', 'salary' => '1,500,000 MMK', 'age' => '30-45'],
        ['title' => 'Procurement Lead', 'type' => 'Full Time', 'desc' => 'Manage office supply sourcing.', 'salary' => '700,000 MMK', 'age' => '28-40'],
        ['title' => 'Content Writer', 'type' => 'Full Time', 'desc' => 'Write digital marketing contents.', 'salary' => '450,000 MMK', 'age' => '22-30'],
        ['title' => 'Data Entry Clerk', 'type' => 'Full Time', 'desc' => 'Update customer information records.', 'salary' => '250,000 MMK', 'age' => '18-25']
    ];
} elseif ($company_id == 'kmd') {
    $jobs = [
        ['title' => 'Security Installer', 'type' => 'Full Time', 'desc' => 'CCTV and security alarm setup.', 'salary' => '450,000 MMK', 'age' => '20-35'],
        ['title' => 'Graphic Designer', 'type' => 'Full Time', 'desc' => 'Create ads and shop banners.', 'salary' => '500,000 MMK', 'age' => '20-30'],
        ['title' => 'Junior Technician', 'type' => 'Internship', 'desc' => 'Learn PC assembly and repair.', 'salary' => '350,000 MMK', 'age' => '18-26'],
        ['title' => 'Software Support', 'type' => 'Full Time', 'desc' => 'Assist in OS and App installations.', 'salary' => '600,000 MMK', 'age' => '22-32'],
        ['title' => 'Sales Consultant', 'type' => 'Full Time', 'desc' => 'Consult clients on IT solutions.', 'salary' => '400,000 MMK', 'age' => '22-35'],
        ['title' => 'Quality Controller', 'type' => 'Full Time', 'desc' => 'Inspect IT hardware for defects.', 'salary' => '400,000 MMK', 'age' => '23-35']
    ];
} elseif ($company_id == 'mcc') {
    $jobs = [
        ['title' => 'System Admin', 'type' => 'Full Time', 'desc' => 'Manage hotel servers and Wi-Fi.', 'salary' => '1,000,000 MMK', 'age' => '25-40'],
        ['title' => 'IT Support', 'type' => 'Full Time', 'desc' => 'Fix office PCs and hotel systems.', 'salary' => '450,000 MMK', 'age' => '22-30'],
        ['title' => 'Cybersecurity Rep', 'type' => 'Full Time', 'desc' => 'Protect hotel guest data/networks.', 'salary' => '1,200,000 MMK', 'age' => '25-45'],
        ['title' => 'IT Manager', 'type' => 'Full Time', 'desc' => 'Manage the entire IT department.', 'salary' => '1,500,000 MMK', 'age' => '30-50'],
        ['title' => 'Web Admin', 'type' => 'Full Time', 'desc' => 'Manage hotel booking website.', 'salary' => '500,000 MMK', 'age' => '23-35'],
        ['title' => 'CCTV Technician', 'type' => 'Full Time', 'desc' => 'Monitor and fix camera feeds.', 'salary' => '350,000 MMK', 'age' => '20-35']
    ];
}

// --- (၂) Database မှ Admin အသစ်ထည့်သော အလုပ်များ ---
if ($current_comp && isset($conn)) {
    $comp_name = mysqli_real_escape_string($conn, $current_comp['name']);
    $sql = "SELECT * FROM jobs WHERE company = '$comp_name' AND status = 'Approved' ORDER BY id DESC";
    $db_result = mysqli_query($conn, $sql);

    if ($db_result && mysqli_num_rows($db_result) > 0) {
        while ($row = mysqli_fetch_assoc($db_result)) {
            $jobs[] = [
                'id'     => $row['id'], // ✅ ID ကို ထည့်သိမ်းလိုက်ပါပြီ
                'title'  => $row['job_title'],
                'type'   => (!empty($row['type'])) ? $row['type'] : 'Full Time',
                'desc'   => "New opportunity in " . $row['location'],
                'salary' => $row['salary'] . " MMK",
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
    <title>Job Openings - <?php echo htmlspecialchars($current_comp ? $current_comp['name'] : 'Meiktila'); ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { background-color: #f8f9fa; color: #333; }
        nav { padding: 15px 10%; background: #fff; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 1000; }
        .container { padding: 40px 10%; max-width: 1200px; margin: 0 auto; }
        .header-section { margin-bottom: 30px; }
        .job-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 20px; margin-top: 20px; }
        .job-card { background: #fff; border-radius: 12px; padding: 25px; border: 1px solid #e1e4e8; transition: 0.3s; display: flex; flex-direction: column; justify-content: space-between; }
        .job-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05); border-color: #1877f2; }
        .job-title { font-size: 18px; font-weight: 700; color: #1c1e21; }
        .job-type { background: #e7f3ff; color: #1877f2; padding: 4px 10px; border-radius: 4px; font-size: 11px; font-weight: 700; }
        .job-desc { color: #4b4f56; font-size: 14px; margin: 15px 0; min-height: 40px; }
        .job-meta { display: flex; gap: 20px; color: #65676b; font-size: 13px; font-weight: 600; margin-bottom: 20px; }
        .apply-btn { display: block; width: 100%; text-align: center; background: #1877f2; color: white; padding: 12px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: background 0.3s; }
        .apply-btn:hover { background: #166fe5; }
        .wish-footer { text-align: center; margin-top: 50px; font-style: italic; color: #1877f2; font-weight: 600; }
    </style>
</head>

<body>
    <nav>
        <a href="meiktila.php" style="text-decoration:none; color:#1877f2; font-weight:600;">
            <i class="fas fa-arrow-left"></i> Back to Meiktila
        </a>
    </nav>

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
                            
                            <a href="../../Project/CV.php?id=<?php echo isset($job['id']) ? $job['id'] : ''; ?>&job=<?php echo urlencode($job['title']); ?>&comp=<?php echo urlencode($current_comp['name']); ?>" class="apply-btn">
                                Apply Now
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No job openings found for this company.</p>
                <?php endif; ?>
            </div>

            <p class="wish-footer">"Wishing you the best of luck with your job search!"</p>
            
        <?php else: ?>
            <div style="text-align:center; padding:100px;">
                <h2>Please select a valid company from the Meiktila list.</h2>
                <br><a href="meiktila.php" style="color:#1877f2;">Go Back</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>