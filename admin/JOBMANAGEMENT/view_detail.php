<?php 
include('db.php'); 

if(isset($_GET['id'])) {
    $id = intval($_GET['id']);
    // ဒေတာအားလုံးကို ဆွဲထုတ်ခြင်း
    $sql = "SELECT * FROM applications WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if(!$row) {
        die("<div class='alert alert-danger text-center mt-5'>Data not found!</div>");
    }
} else {
    header("Location: applications.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Review - <?php echo htmlspecialchars($row['applicant_name']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root { --primary: #0062ff; --dark: #1e293b; --text-muted: #64748b; --bg: #f8fafc; }
        body { background-color: var(--bg); font-family: 'Inter', sans-serif; color: var(--dark); }
        
        .main-wrapper { margin-left: 230px; padding: 30px; }
        
        /* Profile Card Design */
        .cv-card { background: white; border-radius: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.04); overflow: hidden; border: none; }
        
        /* Left Sidebar Info */
        .cv-sidebar { background: #f1f5f9; padding: 40px 30px; height: 100%; border-right: 1px solid #e2e8f0; }
        .profile-img-box { width: 150px; height: 150px; background: white; border-radius: 20px; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; overflow: hidden; box-shadow: 0 8px 20px rgba(0,0,0,0.08); }
        .profile-img-box img { width: 100%; height: 100%; object-fit: cover; }
        .profile-img-box i { font-size: 80px; color: #cbd5e1; }

        /* Content Labels */
        .section-tag { display: inline-block; background: rgba(0, 98, 255, 0.1); color: var(--primary); padding: 5px 15px; border-radius: 8px; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 20px; }
        .info-label { font-size: 11px; text-transform: uppercase; font-weight: 700; color: var(--text-muted); margin-bottom: 5px; }
        .info-value { font-size: 15px; font-weight: 600; margin-bottom: 25px; color: var(--dark); }
        .info-value i { margin-right: 10px; color: var(--primary); width: 20px; }

        /* Experience Box */
        .content-box { background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 20px; margin-bottom: 25px; line-height: 1.6; }

        /* Status Badges */
        .badge-status { padding: 8px 20px; border-radius: 10px; font-weight: 700; font-size: 12px; }
        
        .btn-action { border-radius: 12px; padding: 12px 25px; font-weight: 700; transition: 0.3s; }

        @media (max-width: 992px) { .main-wrapper { margin-left: 0; padding: 15px; } .cv-sidebar { border-right: none; border-bottom: 1px solid #e2e8f0; } }
    </style>
</head>
<body>

<div class="main-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold"><i class="fas fa-file-invoice me-2"></i> Application Detail</h3>
        <a href="applications.php" class="btn btn-light border rounded-pill px-4"><i class="fas fa-arrow-left me-2"></i> Back</a>
    </div>

    <div class="cv-card">
        <div class="row g-0">
            <div class="col-lg-4">
                <div class="cv-sidebar text-center text-lg-start">
                    <div class="profile-img-box">
    <?php 
    // ပုံနာမည် ရှိမရှိနဲ့ ဖိုင်တကယ်ရှိမရှိ စစ်မယ်
    $imagePath = "../../Project/uploads/" . $row['cv_file'];
    if(!empty($row['cv_file']) && file_exists($imagePath)): 
    ?>
        <img src="<?php echo $imagePath; ?>" alt="Profile">
    <?php else: ?>
        <i class="fas fa-user-tie" style="font-size: 70px; color: #cbd5e1;"></i>
    <?php endif; ?>
</div>
                    
                    <h4 class="fw-bold mb-1"><?php echo htmlspecialchars($row['applicant_name']); ?></h4>
                    <p class="text-primary fw-semibold mb-4"><?php echo htmlspecialchars($row['job_title']); ?></p>

                    <hr class="my-4 opacity-50">

                    <div class="info-label">Email Address</div>
                    <div class="info-value"><i class="fas fa-envelope"></i> <?php echo htmlspecialchars($row['email']); ?></div>

                    <div class="info-label">Phone Number</div>
                    <div class="info-value"><i class="fas fa-phone-alt"></i> <?php echo htmlspecialchars($row['phone']); ?></div>

                    <div class="info-label">Location</div>
                    <div class="info-value"><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($row['address']); ?>, <?php echo htmlspecialchars($row['township']); ?></div>
                    
                    <div class="info-label">Company Applied</div>
                    <div class="info-value"><i class="fas fa-building"></i> <?php echo htmlspecialchars($row['company_name']); ?></div>
                </div>
            </div>

            <div class="col-lg-8 p-4 p-md-5">
                <span class="section-tag">Academic Background</span>
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="info-label">University</div>
                        <div class="info-value"><?php echo htmlspecialchars($row['university'] ?: 'N/A'); ?></div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-label">Degree</div>
                        <div class="info-value"><?php echo htmlspecialchars($row['bachelor'] ?: 'N/A'); ?></div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-label">Major</div>
                        <div class="info-value"><?php echo htmlspecialchars($row['major'] ?: 'N/A'); ?></div>
                    </div>
                </div>

                <span class="section-tag">Professional Experience</span>
                <div class="content-box">
                    <?php echo nl2br(htmlspecialchars($row['experience'])); ?>
                </div>

                <span class="section-tag">Technical Skills</span>
                <div class="content-box">
                    <?php echo nl2br(htmlspecialchars($row['skills'] ?: 'No skills listed.')); ?>
                </div>

                <span class="section-tag">About Me</span>
                <div class="content-box">
                    <?php echo nl2br(htmlspecialchars($row['about_me'])); ?>
                </div>

                <div class="mt-5 p-4 bg-light rounded-4 d-flex flex-wrap justify-content-between align-items-center">
                    <div>
                        <div class="info-label">Application Status</div>
                        <?php 
                        $st = $row['status'];
                        $cls = ($st == 'Approved') ? 'bg-success text-white' : (($st == 'Rejected') ? 'bg-danger text-white' : 'bg-warning text-dark');
                        ?>
                        <span class="badge-status <?php echo $cls; ?>"><?php echo strtoupper($st); ?></span>
                    </div>

                    <?php if($st == 'Pending'): ?>
                    <div class="d-flex gap-2 mt-3 mt-md-0">
                        <a href="process_status.php?id=<?php echo $id; ?>&status=Approved" class="btn btn-success btn-action shadow-sm">
                            <i class="fas fa-check me-2"></i> Approve Application
                        </a>
                        <a href="process_status.php?id=<?php echo $id; ?>&status=Rejected" class="btn btn-outline-danger btn-action">
                            <i class="fas fa-times me-2"></i> Reject
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>