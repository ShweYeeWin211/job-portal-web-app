<?php 
include('db.php'); 

// ၁။ ပြင်ဆင်မည့် Category ရဲ့ ID ကို URL ကနေ ဖမ်းယူခြင်း
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $result = mysqli_query($conn, "SELECT * FROM categories WHERE id = $id");
    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        die("Category not found.");
    }
}

// ၂။ Update Button နှိပ်လိုက်တဲ့အခါ Database မှာ သိမ်းခြင်း
if (isset($_POST['update'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $jobs = (int)$_POST['active_jobs'];
    $icon = mysqli_real_escape_string($conn, $_POST['icon_class']);

    $update_query = "UPDATE categories SET name='$name', active_jobs=$jobs, icon_class='$icon' WHERE id=$id";

    if (mysqli_query($conn, $update_query)) {
        
        // --- ✅ Notification ထည့်ရန် ကုဒ်အသစ် ---
        $noti_msg = "Admin updated the category: " . $name;
        addNoti($conn, $noti_msg, "category");
        // ------------------------------------

        header("Location: categories.php"); 
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; padding-top: 50px; }
        .form-container { background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); max-width: 500px; margin: auto; }
        .btn-update { background-color: #2b3bb1; color: white; }
    </style>
</head>
<body>

<div class="container">
    <div class="form-container">
        <h3 class="mb-4 text-center">Edit Category</h3>
        
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Category Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $data['name']; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Active Jobs Count</label>
                <input type="number" name="active_jobs" class="form-control" value="<?php echo $data['active_jobs']; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Icon Class (FontAwesome)</label>
                <select name="icon_class" class="form-select">
                    <option value="fa-laptop" <?php if($data['icon_class'] == 'fa-laptop') echo 'selected'; ?>>Technology (Laptop)</option>
                    <option value="fa-mobile-screen" <?php if($data['icon_class'] == 'fa-mobile-screen') echo 'selected'; ?>>Marketing (Mobile)</option>
                    <option value="fa-palette" <?php if($data['icon_class'] == 'fa-palette') echo 'selected'; ?>>Design (Palette)</option>
                    <option value="fa-sack-dollar" <?php if($data['icon_class'] == 'fa-sack-dollar') echo 'selected'; ?>>Finance (Money)</option>
                    <option value="fa-chart-simple" <?php if($data['icon_class'] == 'fa-chart-simple') echo 'selected'; ?>>Sales (Chart)</option>
                    <option value="fa-hospital" <?php if($data['icon_class'] == 'fa-hospital') echo 'selected'; ?>>Healthcare (Hospital)</option>
                    <option value="fa-book-bookmark" <?php if($data['icon_class'] == 'fa-book-bookmark') echo 'selected'; ?>>Education (Book)</option>
                    <option value="fa-gear" <?php if($data['icon_class'] == 'fa-gear') echo 'selected'; ?>>Engineering (Gear)</option>
                </select>
                <small class="text-muted">Select an icon for the category.</small>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" name="update" class="btn btn-update">Update Category</button>
                <a href="categories.php" class="btn btn-light">Cancel</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>