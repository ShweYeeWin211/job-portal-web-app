<?php 
include('db.php'); 

if (isset($_POST['save'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $jobs = mysqli_real_escape_string($conn, $_POST['active_jobs']);
    $icon = mysqli_real_escape_string($conn, $_POST['icon_class']);

    $insert_query = "INSERT INTO categories (name, active_jobs, icon_class) VALUES ('$name', '$jobs', '$icon')";

    // --- ဒီနေရာကစပြီး ကြည့်ပါ ---
    if (mysqli_query($conn, $insert_query)) {
        
        // Success ဖြစ်တဲ့နေရာ (header redirect မလုပ်ခင်) မှာ ထည့်ပါ
        $noti_message = "Admin added a new category: " . $name;
        addNoti($conn, $noti_message, "category"); 

        header("Location: categories.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; padding-top: 50px; }
        .form-container { background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); max-width: 500px; margin: auto; }
        .btn-save { background-color: #2b3bb1; color: white; }
    </style>
</head>
<body>

<div class="container">
    <div class="form-container">
        <h3 class="mb-4 text-center">Add New Category</h3>
        
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Category Name</label>
                <input type="text" name="name" class="form-control" placeholder="e.g. Technology" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Active Jobs Count</label>
                <input type="number" name="active_jobs" class="form-control" value="0" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Select Icon</label>
                <select name="icon_class" class="form-select">
                    <option value="fa-laptop">Technology (Laptop)</option>
                    <option value="fa-mobile-screen">Marketing (Mobile)</option>
                    <option value="fa-palette">Design (Palette)</option>
                    <option value="fa-sack-dollar">Finance (Money)</option>
                    <option value="fa-chart-simple">Sales (Chart)</option>
                    <option value="fa-hospital">Healthcare (Hospital)</option>
                    <option value="fa-book-bookmark">Education (Book)</option>
                    <option value="fa-gear">Engineering (Gear)</option>
                </select>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" name="save" class="btn btn-save">Save Category</button>
                <a href="categories.php" class="btn btn-light">Back</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>