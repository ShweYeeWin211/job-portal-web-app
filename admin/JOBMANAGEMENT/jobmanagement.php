<?php
session_start();
include 'db.php';

$admin_township = $_SESSION['admin_township']; 

$search = trim($_GET['search'] ?? '');
$type   = trim($_GET['type'] ?? '');

// SQL Logic
if ($admin_township == 'All') {
    $sql = "SELECT jobs.*, (SELECT COUNT(*) FROM applications WHERE applications.job_id = jobs.id) AS app_count FROM jobs WHERE 1=1";
} else {
    $sql = "SELECT jobs.*, (SELECT COUNT(*) FROM applications WHERE applications.job_id = jobs.id) AS app_count FROM jobs WHERE location = '$admin_township'";
}

if ($search !== '') {
    $search_safe = mysqli_real_escape_string($conn, $search);
    $sql .= " AND job_title LIKE '%$search_safe%'";
}
if ($type !== '') {
    $type_safe = mysqli_real_escape_string($conn, $type);
    $sql .= " AND type = '$type_safe'";
}

$sql .= " ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jobs Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7fe; font-family: 'Inter', sans-serif; }
        .table-container { background: white; border-radius: 20px; padding: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.02); }
        .btn-action { width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; transition: 0.2s; text-decoration: none; }
        .btn-view { background: #eef2ff; color: #4f46e5; }
        .btn-edit { background: #f1f5f9; color: #64748b; }
        .btn-delete { background: #fff1f2; color: #e11d48; }
        .app-count-badge { background: #4f46e5; color: white; padding: 2px 8px; border-radius: 6px; font-size: 12px; }
    </style>
</head>
<body>

<?php include('nav.php'); ?>

<div class="container-fluid mt-4" style="padding: 0 30px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark">Jobs Management</h2>
            <p class="text-muted small">Region: <?= htmlspecialchars($admin_township) ?> | Total: <?= mysqli_num_rows($result) ?> Posts</p>
        </div>
        </div>

    <div class="card border-0 shadow-sm p-3 mb-4" style="border-radius: 15px;">
        <form method="get" class="row g-3">
            <div class="col-md-5">
                <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" class="form-control" placeholder="Search job title...">
            </div>
            <div class="col-md-4">
                <select name="type" class="form-select" onchange="this.form.submit()">
                    <option value="">All Job Types</option>
                    <option value="Full-time" <?= ($type=='Full-time')?'selected':'' ?>>Full-time</option>
                    <option value="Part-time" <?= ($type=='Part-time')?'selected':'' ?>>Part-time</option>
                    <option value="Internship" <?= ($type=='Internship')?'selected':'' ?>>Internship</option>
                </select>
            </div>
            <div class="col-md-3">
                <a href="add_job.php" class="btn btn-primary w-100 shadow-sm" style="border-radius: 8px;">
                    <i class="fa fa-plus me-2"></i> Add Job
                </a>
            </div>
        </form>
    </div>

    <div class="table-container">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Company</th>
                    <th>Location</th>
                    <th class="text-center">Applicants</th> 
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(mysqli_num_rows($result) > 0): while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td class="fw-bold"><?= htmlspecialchars($row['job_title']) ?></td>
                    <td><?= htmlspecialchars($row['company']) ?></td>
                    <td><small><i class="fa fa-location-dot me-1"></i><?= htmlspecialchars($row['location']) ?></small></td>
                    <td class="text-center">
                        <span class="app-count-badge"><?= $row['app_count'] ?> Applied</span>
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-1">
                            <a href="view_job.php?id=<?= $row['id'] ?>" class="btn-action btn-view" title="View Detail"><i class="fa fa-eye"></i></a>
                            <a href="edit_job.php?id=<?= $row['id'] ?>" class="btn-action btn-edit" title="Edit Job"><i class="fa fa-pen"></i></a>
                            <a href="javascript:void(0)" onclick="deleteJob(<?= $row['id'] ?>)" class="btn-action btn-delete" title="Delete Job"><i class="fa fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
                <?php endwhile; else: ?>
                    <tr><td colspan="5" class="text-center py-5">No jobs found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function deleteJob(id){
    Swal.fire({
        title: 'Delete this job post?',
        text: "All related applications might be affected.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e11d48',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) { window.location.href = "delete_job.php?id=" + id; }
    });
}
</script>
</body>
</html>