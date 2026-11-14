<?php
session_start();
include 'db.php';

// ၁။ Admin ရဲ့ မြို့နယ်ကို Session ကနေ ယူမယ်
$admin_township = $_SESSION['admin_township'] ?? 'All';

// ၂။ SQL Query ကို Admin Township ပေါ်မူတည်ပြီး ပြင်မယ်
if ($admin_township == 'All') {
    // Super Admin ဆိုရင် အကုန်ပြမယ်
    $total_users_query = "SELECT COUNT(*) as t FROM users";
    $employers_query = "SELECT COUNT(*) as t FROM users WHERE role='Employer'";
    $seekers_query = "SELECT COUNT(*) as t FROM users WHERE role='Jobseeker'";
    $users_sql = "SELECT * FROM users ORDER BY id DESC";
} else {
    // Township Admin ဆိုရင် အဲဒီမြို့နယ်က User တွေကိုပဲ ပြမယ်
    // မှတ်ချက်- users table ထဲမှာ township ဆိုတဲ့ column ရှိရပါမယ်
    $total_users_query = "SELECT COUNT(*) as t FROM users WHERE township = '$admin_township'";
    $employers_query = "SELECT COUNT(*) as t FROM users WHERE role='Employer' AND township = '$admin_township'";
    $seekers_query = "SELECT COUNT(*) as t FROM users WHERE role='Jobseeker' AND township = '$admin_township'";
    $users_sql = "SELECT * FROM users WHERE township = '$admin_township' ORDER BY id DESC";
}

$total_users = mysqli_fetch_assoc(mysqli_query($conn, $total_users_query))['t'];
$total_employers = mysqli_fetch_assoc(mysqli_query($conn, $employers_query))['t'];
$total_seekers = mysqli_fetch_assoc(mysqli_query($conn, $seekers_query))['t'];

$users = mysqli_query($conn, $users_sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { background-color: #f8fafc; }
        .stat-card { border: none; border-radius: 20px; padding: 20px; background: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.03); }
        .table-container { background: white; border-radius: 20px; padding: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.02); margin-top: 20px; }
        .role-badge { padding: 5px 12px; border-radius: 8px; font-size: 11px; font-weight: 600; }
        .badge-employer { background-color: #eff6ff; color: #3b82f6; }
        .badge-seeker { background-color: #f0fdf4; color: #16a34a; }
        .btn-action { width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; text-decoration: none; margin: 0 2px; border: none; }
        .btn-view { background: #eef2ff; color: #4f46e5; }
        .btn-edit { background: #f1f5f9; color: #64748b; }
        .btn-delete { background: #fff1f2; color: #e11d48; }
    </style>
</head>
<body>

<?php include('nav.php'); ?>

<div style="padding: 30px;"> 
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Users Management</h2>
            <p class="text-muted small">Managing users in: <strong class="text-primary"><?= htmlspecialchars($admin_township) ?></strong></p>
        </div>
        <a href="add_user.php" class="btn btn-primary px-4 py-2" style="border-radius: 12px; font-weight: 600;">
            <i class="fa fa-plus me-2"></i> Add New User
        </a>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4"><div class="stat-card border-start border-primary border-4"><h6>Employers</h6><h3 class="text-primary"><?= $total_employers ?></h3></div></div>
        <div class="col-md-4"><div class="stat-card border-start border-success border-4"><h6>Job Seekers</h6><h3 class="text-success"><?= $total_seekers ?></h3></div></div>
        <div class="col-md-4"><div class="stat-card border-start border-dark border-4"><h6>Total Users</h6><h3><?= $total_users ?></h3></div></div>
    </div>

    <div class="table-container">
        <div class="mb-3">
            <input type="text" id="pageSearch" onkeyup="searchFunction()" class="form-control" placeholder="Search by name, email or role..." style="border-radius: 10px;">
        </div>

        <table class="table align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>TOWNSHIP</th>
                    <th>ROLE</th>
                    <th class="text-center">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php if(mysqli_num_rows($users) > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($users)): ?>
                    <tr class="searchable">
                        <td class="fw-bold"><?= htmlspecialchars($row['username']) ?></td>
                        <td class="text-muted"><?= htmlspecialchars($row['email']) ?></td>
                        <td><small class="text-secondary"><?= htmlspecialchars($row['township'] ?? 'N/A') ?></small></td>
                        <td><span class="role-badge <?= ($row['role']=='Employer')?'badge-employer':'badge-seeker' ?>"><?= $row['role'] ?></span></td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center">
                                <a href="view_user.php?id=<?= $row['id'] ?>" class="btn-action btn-view" title="View"><i class="fa fa-eye"></i></a>
                                <a href="edit_user.php?id=<?= $row['id'] ?>" class="btn-action btn-edit" title="Edit"><i class="fa fa-pen"></i></a>
                                <button onclick="deleteUser(<?= $row['id'] ?>)" class="btn-action btn-delete" title="Delete"><i class="fa fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="5" class="text-center py-4 text-muted">No users found in this township.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
// အရင်က searchFunction ကုဒ်ဟောင်းကိုပဲ ပြန်သုံးထားပါတယ်
function searchFunction(){
    let input = document.getElementById("pageSearch").value.toLowerCase();
    let rows = document.getElementsByClassName("searchable");
    for(let r of rows){
        r.style.display = r.innerText.toLowerCase().includes(input) ? "" : "none";
    }
}

function deleteUser(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "ဤအသုံးပြုသူကို ဖျက်ပစ်ရန် သေချာပါသလား?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e11d48',
        confirmButtonText: 'Delete'
    }).then((result) => {
        if (result.isConfirmed) { window.location.href = "delete_user.php?id=" + id; }
    });
}
</script>
</body>
</html>