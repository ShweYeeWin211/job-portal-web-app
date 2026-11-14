

<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { background-color: #f4f7f6; font-family: 'Inter', sans-serif; }
        .header-section { margin-top: 50px; margin-bottom: 30px; }
        .add-btn { background-color: #2b3bb1; color: white; border-radius: 8px; border: none; padding: 10px 20px; }
        .add-btn:hover { background-color: #1e2a8a; color: white; }
        
        .cat-card {
            background: #fff;
            border-radius: 12px;
            border: none;
            padding: 30px 20px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            position: relative;
        }
        .icon-wrapper {
            font-size: 35px;
            margin-bottom: 15px;
            display: block;
        }
        /* ပုံထဲကလို အရောင်လေးတွေဖြစ်အောင် icon အလိုက် အရောင်ခွဲပေးခြင်း */
        .fa-laptop { color: #555; }
        .fa-mobile-screen { color: #3a86ff; }
        .fa-palette { color: #fb8500; }
        .fa-sack-dollar { color: #ffb703; }
        
        .cat-title { font-weight: 600; color: #333; margin-bottom: 5px; }
        .active-jobs { color: #999; font-size: 14px; margin-bottom: 20px; }
        
        .action-links { display: flex; justify-content: space-around; border-top: 1px solid #eee; pt-3; }
        .action-links a { text-decoration: none; font-size: 14px; margin-top: 15px; }
        .edit-text { color: #4361ee; }
        .delete-text { color: #ef4444; }
        
        /* dots icon အတွက် */
        .more-options { position: absolute; top: 15px; right: 15px; color: #ccc; cursor: pointer; }
    </style>
</head>
<body>
<?php include('nav.php'); ?>
<div class="container">
    <div class="header-section d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold">Job Categories</h2>
            <p class="text-muted">Manage job categories and industries</p>
        </div>
        <a href="add.php" class="add-btn fw-bold" style="text-decoration: none;">+ Add Category</a>
    </div>

    <div class="row g-4">
        <?php
        $query = "SELECT * FROM categories ORDER BY id DESC";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <div class="col-12 col-md-6 col-lg-3">
                
                <div class="cat-card searchable">

                    <i class="fas fa-ellipsis-vertical more-options"></i>
                    <span class="icon-wrapper">
                        <i class="fas <?php echo $row['icon_class']; ?>"></i>
                    </span>
                    <h5 class="cat-title"><?php echo $row['name']; ?></h5>
                    <p class="active-jobs"><?php echo $row['active_jobs']; ?> active jobs</p>
                    
                    <div class="action-links">
                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="edit-text fw-bold">Edit</a>
                        <a href="javascript:void(0)" 
                         onclick="confirmDelete(<?php echo $row['id']; ?>)" 
                         class="delete-text fw-bold">Delete</a>
                    </div>
                </div>
            </div>
        <?php 
            }
        } else {
            echo "<p class='text-center'>No categories found.</p>";
        }
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // အကယ်၍ Yes နှိပ်ခဲ့ရင် delete.php ကို ID နဲ့တကွ ပို့ပေးမည်
            window.location.href = 'delete.php?id=' + id;
        }
    })
}
</script>
</body>
</html>