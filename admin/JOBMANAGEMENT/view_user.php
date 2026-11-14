<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");
    $user = mysqli_fetch_assoc($query);

    if (!$user) {
        header("Location: usermanagement.php");
        exit();
    }
} else {
    header("Location: usermanagement.php");
    exit();
}

// Township တစ်ခုပဲ ကျန်ပါမယ်
$township = !empty($user['township']) ? $user['township'] : 'Not Provided';

// နာမည်အစစာလုံး ထုတ်ယူခြင်း
$initial = strtoupper(substr($user['username'], 0, 1));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f0f2f5; font-family: 'Inter', sans-serif; }
        .profile-card { border: none; border-radius: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); overflow: hidden; background: white; }
        .profile-header { background: linear-gradient(135deg, #0d6efd, #004085); height: 120px; position: relative; }
        
        .avatar-box { 
            width: 110px; height: 110px; 
            background-color: #ffffff; 
            border-radius: 50%; 
            position: absolute; bottom: -55px; left: 50%; transform: translateX(-50%);
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15); border: 5px solid white;
        }
        .initial-text {
            font-size: 45px;
            color: #0d6efd;
            font-weight: 800;
            user-select: none;
        }

        .info-label { font-size: 11px; color: #6c757d; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
        .info-value { font-size: 15px; color: #212529; font-weight: 500; margin-bottom: 20px; }
    </style>
</head>
<body>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card profile-card">
                <div class="profile-header">
                    <div class="avatar-box">
                        <span class="initial-text"><?= $initial ?></span>
                    </div>
                </div>

                <div class="card-body text-center mt-5 p-4">
                    <h4 class="fw-bold mb-1"><?= htmlspecialchars($user['username']) ?></h4>
                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill mb-4">
                        <i class="fa fa-user-tag me-1"></i> <?= htmlspecialchars($user['role']) ?>
                    </span>

                    <div class="text-start mt-3 px-2">
                        <div class="row g-3">
                            <div class="col-12 border-bottom pb-2">
                                <p class="info-label mb-1"><i class="fa fa-envelope me-1"></i> Email Address</p>
                                <p class="info-value"><?= htmlspecialchars($user['email']) ?></p>
                            </div>

                            <div class="col-12 border-bottom pb-2">
                                <p class="info-label mb-1"><i class="fa fa-map-marker-alt me-1"></i> Township</p>
                                <p class="info-value"><?= htmlspecialchars($township) ?></p>
                            </div>

                            <div class="col-12">
                                <p class="info-label mb-1"><i class="fa fa-info-circle me-1"></i> Status</p>
                                <p class="info-value">
                                    <span class="badge <?= $user['status'] == 1 ? 'bg-success' : 'bg-danger' ?>">
                                        <?= $user['status'] == 1 ? 'Active Account' : 'Inactive' ?>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-2 d-flex justify-content-center gap-2">
                        <a href="edit_user.php?id=<?= $user['id'] ?>" class="btn btn-primary rounded-pill px-4">
                            <i class="fa fa-edit me-1"></i> Edit Profile
                        </a>
                        <a href="usermanagement.php" class="btn btn-outline-secondary rounded-pill px-4">
                            Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>