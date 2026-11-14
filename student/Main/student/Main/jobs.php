<?php
session_start();
if (!isset($_SESSION['username'])) {
    // အကယ်၍ session ထဲမှာ username မရှိရင် (အကောင့်မဝင်ထားရင်) Login page ကို ပို့မယ်
    header("Location: login.php"); // မင်းရဲ့ login file နာမည်က login.php မဟုတ်ရင် အဲဒီနာမည် ပြောင်းပေးပါ
    exit();
}
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Member';

$cat_type = isset($_GET['type']) ? $_GET['type'] : 'software';

$cat_titles = [
    'software' => 'Software Development',
    'networking' => 'Network Engineering',
    'data' => 'Data Science & Analytics',
    'security' => 'Cyber Security'
];

// --- ဒေတာများ (မြို့အမည်ကို ရွှေရည် file နာမည်တွေနဲ့ ကိုက်အောင် သုံးထားတယ်) ---
$all_jobs = [
    'software' => [
        ['id' => 'twork', 'city' => 'mandalay', 'title' => 'Junior PHP Developer', 'comp' => 'T-WORK SYSTEM', 'salary' => '500,000 MMK', 'type' => 'Full Time', 'age' => '20-27'],
        ['id' => 'amazing', 'city' => 'mandalay', 'title' => 'Full Stack Dev', 'comp' => 'Amazing Technologies', 'salary' => '900,000 MMK', 'type' => 'Full Time', 'age' => '25-35'],
        ['id' => 'mcc', 'city' => 'meiktila', 'title' => 'Web Admin', 'comp' => 'Shadow Hotel', 'salary' => '500,000 MMK', 'type' => 'Full Time', 'age' => '23-35'],
        ['id' => 'kmd', 'city' => 'meiktila', 'title' => 'Software Support', 'comp' => 'KMD Computer', 'salary' => '600,000 MMK', 'type' => 'Full Time', 'age' => '22-32'],
        ['id' => 'infosys', 'city' => 'npt', 'title' => 'VB.NET Developer', 'comp' => 'Info Sys (Myanmar)', 'salary' => '700,000 MMK', 'type' => 'Full Time', 'age' => '24-35'],
        ['id' => 'ace', 'city' => 'npt', 'title' => 'Software Engineer', 'comp' => 'Ace Data Systems', 'salary' => '900,000 MMK', 'type' => 'Full Time', 'age' => '25-38']
    ],
    'networking' => [
        ['id' => 'kumo', 'city' => 'mandalay', 'title' => 'Network Engineer', 'comp' => 'Kumo Solutions', 'salary' => '900,000 MMK', 'type' => 'Full Time', 'age' => '25-38'],
        ['id' => 'met', 'city' => 'meiktila', 'title' => 'Installation Technician', 'comp' => 'Myanmar Net', 'salary' => '400,000 MMK', 'type' => 'Full Time', 'age' => '20-35'],
        ['id' => 'linn', 'city' => 'npt', 'title' => 'Senior Network Engineer', 'comp' => 'Linn IT Solution', 'salary' => '800,000 MMK', 'type' => 'Full Time', 'age' => '25-40']
    ],
    'data' => [
        ['id' => 'mit', 'city' => 'mandalay', 'title' => 'Data Analyst Intern', 'comp' => 'Myanmar IT Consulting', 'salary' => '280,000 MMK', 'type' => 'Internship', 'age' => '20-24'],
        ['id' => 'kbz', 'city' => 'meiktila', 'title' => 'Business Analyst', 'comp' => 'KBZ Bank', 'salary' => '800,000 MMK', 'type' => 'Full Time', 'age' => '25-40']
    ],
    'security' => [
        ['id' => 'cyber', 'city' => 'mandalay', 'title' => 'Ethical Hacker', 'comp' => 'CyberMissions Myanmar', 'salary' => '1,000,000 MMK', 'type' => 'Full Time', 'age' => '23-30'],
        ['id' => 'kbz', 'city' => 'meiktila', 'title' => 'Cyber Fraud Analyst', 'comp' => 'KBZ Bank', 'salary' => '1,200,000 MMK', 'type' => 'Full Time', 'age' => '25-40'],
        ['id' => 'naungyoe', 'city' => 'npt', 'title' => 'CCTV Technician', 'comp' => 'Naung Yoe Tech', 'salary' => '400,000 MMK', 'type' => 'Full Time', 'age' => '20-35']
    ]
];

$display_jobs = $all_jobs[$cat_type] ?? [];
$current_title = $cat_titles[$cat_type] ?? 'IT Job Openings';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($current_title); ?> - Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root { --primary: #0062ff; --dark: #0f172a; --light: #f8fafc; }
        body { font-family: 'Segoe UI', sans-serif; background: var(--light); margin: 0; }
        .container { padding: 40px 8%; max-width: 1200px; margin: 0 auto; }
        .back-link { text-decoration: none; color: var(--primary); font-weight: 600; margin-bottom: 25px; display: inline-block; }
        .page-header { margin-bottom: 35px; border-left: 5px solid var(--primary); padding-left: 20px; }
        .page-header h1 { font-size: 30px; color: var(--dark); margin: 0; }
        .job-list { display: flex; flex-direction: column; gap: 15px; }
        .job-card {
            background: white; padding: 25px; border-radius: 16px; border: 1px solid #e2e8f0;
            display: grid; grid-template-columns: 2.2fr 1fr 1fr 0.8fr; align-items: center; transition: 0.3s;
        }
        .job-card:hover { transform: translateY(-4px); border-color: var(--primary); box-shadow: 0 12px 24px rgba(0,0,0,0.06); }
        .job-info h3 { font-size: 19px; color: var(--dark); margin: 0 0 6px 0; }
        .city-badge { background: #f1f5f9; color: #475569; padding: 2px 8px; border-radius: 4px; font-weight: 600; font-size: 11px; text-transform: uppercase; }
        .job-status { justify-self: center; background: #eef6ff; color: var(--primary); padding: 6px 14px; border-radius: 50px; font-size: 12px; font-weight: 700; }
        .job-price { text-align: center; font-weight: 700; color: #1e293b; font-size: 16px; }
        .view-link { justify-self: end; background: var(--dark); color: white; padding: 12px 20px; border-radius: 10px; text-decoration: none; font-size: 14px; font-weight: 600; transition: 0.3s; }
        .view-link:hover { background: var(--primary); }
    </style>
</head>
<body>

<?php include('navbar.php'); ?>

<div class="container">
    <a href="categories.php" class="back-link"><i class="fas fa-arrow-left"></i> Back to Categories</a>
    
    <div class="page-header">
        <h1><?php echo htmlspecialchars($current_title); ?></h1>
        <p>Browse <?php echo count($display_jobs); ?> jobs across all regions.</p>
    </div>

    <div class="job-list">
        <?php if (!empty($display_jobs)): ?>
            <?php foreach ($display_jobs as $job): 
                // မြို့အလိုက် File နာမည်ကို သတ်မှတ်ခြင်း
                $target_file = 'manopen_job.php'; // default
                if ($job['city'] == 'meiktila') {
                    $target_file = 'meikopen_job.php';
                } elseif ($job['city'] == 'npt') {
                    $target_file = 'nayopen_job.php';
                }
            ?>
                <div class="job-card">
                    <div class="job-info">
                        <h3><?php echo htmlspecialchars($job['title']); ?></h3>
                        <div style="font-size: 13px; color: #64748b;">
                            <span><i class="fas fa-building"></i> <?php echo htmlspecialchars($job['comp']); ?></span>
                            <span class="city-badge"><?php echo htmlspecialchars($job['city']); ?></span>
                        </div>
                    </div>

                    <div class="job-status"><?php echo htmlspecialchars($job['type']); ?></div>
                    <div class="job-price"><?php echo htmlspecialchars($job['salary']); ?></div>

                    <a href="<?php echo $target_file; ?>?id=<?php echo urlencode($job['id']); ?>" class="view-link">
                        View Company
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div style="text-align:center; padding: 80px;">
                <p>No jobs found.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>