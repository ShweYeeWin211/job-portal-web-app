<?php
// Database connection ကို ချိတ်ဆက်ခြင်း
include '../../includes/db_config.php'; 

$company_id = isset($_GET['id']) ? $_GET['id'] : '';
$companies = [
    'twork' => ['name' => 'T-WORK SYSTEM', 'address' => '73rd Street, Mandalay'],
    'kumo' => ['name' => 'Kumo Solutions', 'address' => '78th Street, Mandalay'],
    'mit' => ['name' => 'Myanmar IT Consulting', 'address' => 'Mingalar Mandalay, 73rd St.'],
    'cyber' => ['name' => 'CyberMissions Myanmar', 'address' => '35th Street, Mandalay'],
    'amazing' => ['name' => 'Amazing Technologies', 'address' => '62nd Street, Mandalay'],
    'baganit' => ['name' => 'Bagan IT Solutions', 'address' => 'Manawhari Road, Mandalay'],
    'blueocean' => ['name' => 'Blue Ocean Operating', 'address' => 'Theik Pan Road, Mandalay'],
    'cybertech' => ['name' => 'Bagan Cyber Tech', 'address' => 'Yadanarpon Cyber City']
];

$current_comp = isset($companies[$company_id]) ? $companies[$company_id] : null;
$jobs = [];

// ၁။ Static Jobs (ရွှေရည် အရင်ထည့်ထားတဲ့ အလုပ်များ)
if ($company_id == 'twork') {
    $jobs = [
        ['id' => 0, 'title' => 'Junior PHP Developer', 'type' => 'Full Time', 'desc' => 'Work on local web projects.', 'salary' => '500,000 MMK', 'age' => '20-27'],
        ['id' => 0, 'title' => 'Web Design Intern', 'type' => 'Internship', 'desc' => 'Learn UI/UX and Figma.', 'salary' => '200,000 MMK', 'age' => '18-22']
    ];
} elseif ($company_id == 'kumo') {
    $jobs = [
        ['id' => 0, 'title' => 'System Admin', 'type' => 'Full Time', 'desc' => 'Server & Network maintenance.', 'salary' => '800,000 MMK', 'age' => '24-35'],
        ['id' => 0, 'title' => 'IT Support Intern', 'type' => 'Internship', 'desc' => 'Hardware setup training.', 'salary' => '200,000 MMK', 'age' => '18-24']
    ];
}
// (မှတ်ချက် - ကျန်တဲ့ elseif တွေထဲမှာလည်း ရွှေရည်ရဲ့ static data တွေ ဆက်ရှိနေပါမယ်)

// ၂။ Database မှ Admin ထည့်ထားသော Dynamic Jobs များကို ဆွဲထုတ်ခြင်း (ရန်ကုန်လိုမျိုး)
if ($current_comp && isset($conn)) {
    $comp_name = mysqli_real_escape_string($conn, $current_comp['name']);
    
    // SQL: အလုပ်တွေနဲ့အတူ လျှောက်ထားသူအရေအတွက်ပါ တွက်ယူမယ်
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
                'salary' => $row['salary'], 
                'age'    => $row['age'],
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
    <title>Job Openings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { background-color: #f8f9fa; color: #333; }
        nav { padding: 15px 10%; background: #fff; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 1000; }
        .back-link { text-decoration: none; color: #1877f2; font-weight: 600; display: flex; align-items: center; gap: 5px; }
        .container { padding: 40px 10%; max-width: 1200px; margin: 0 auto; }
        .header-section { margin-bottom: 30px; }
        .header-section h1 { color: #1c1e21; font-size: 26px; }
        .job-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(400px, 1fr)); gap: 20px; }
        .job-card { background: #fff; border-radius: 12px; padding: 25px; border: 1px solid #e1e4e8; transition: 0.3s; display: flex; flex-direction: column; justify-content: space-between; position: relative; }
        .job-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05); border-color: #1877f2; }
        .job-title { font-size: 18px; font-weight: 700; color: #1c1e21; }
        .job-type { background: #e7f3ff; color: #1877f2; padding: 4px 10px; border-radius: 4px; font-size: 11px; font-weight: 700; text-transform: uppercase; }
        
        /* အရေအတွက်ပြ Badge */
        .applicant-badge { position: absolute; top: 15px; right: 15px; background: #ff4757; color: white; padding: 3px 8px; border-radius: 20px; font-size: 11px; font-weight: bold; }
        
        .job-desc { color: #4b4f56; font-size: 14px; margin: 15px 0; min-height: 40px; }
        .job-meta { display: flex; gap: 20px; color: #65676b; font-size: 13px; font-weight: 600; margin-bottom: 20px; }
        .apply-btn { display: block; width: 100%; text-align: center; background: #1877f2; color: white; padding: 12px; border-radius: 8px; text-decoration: none; font-weight: 600; }
        .apply-btn:hover { background: #145dbf; }
        .wish-footer { text-align: center; margin-top: 50px; font-style: italic; color: #1877f2; font-weight: 500; }
        @media (max-width: 768px) { .job-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <nav>
        <a href="companies.php" class="back-link"><i class="fas fa-arrow-left"></i> Back to Companies</a>
        <span style="font-weight:bold; color:#1877f2;">Mandalay IT Careers</span>
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
                        <?php if(isset($job['count']) && $job['count'] > 0): ?>
                            <span class="applicant-badge"><i class="fas fa-users"></i> <?php echo $job['count']; ?> Applied</span>
                        <?php endif; ?>

                        <div>
                            <div style="display:flex; justify-content:space-between; align-items:flex-start;">
                                <div class="job-title"><?php echo $job['title']; ?></div>
                                <span class="job-type"><?php echo $job['type']; ?></span>
                            </div>
                            <p class="job-desc"><?php echo $job['desc']; ?></p>
                            <div class="job-meta">
                                <span><i class="fas fa-money-bill-wave"></i> <?php echo $job['salary']; ?></span>
                                <span><i class="fas fa-user-clock"></i> Age: <?php echo $job['age']; ?></span>
                            </div>
                        </div>
                        
                        <a href="../../Project/CV.php?id=<?php echo $job['id']; ?>&job=<?php echo urlencode($job['title']); ?>&comp=<?php echo urlencode($current_comp['name']); ?>" class="apply-btn">
                            Apply Now
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <p class="wish-footer">"Wishing you the best of luck with your job search!"</p>
        <?php else: ?>
            <div style="text-align:center; padding:100px;">
                <h2>Company not found!</h2><br><a href="companies.php" class="apply-btn" style="display:inline-block; width:auto;">Go Back</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>