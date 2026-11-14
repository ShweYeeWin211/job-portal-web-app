<?php
include('db.php');

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // ၁။ Noti မှာ ပြချင်လို့ ဖျက်မယ့် Category နာမည်ကို အရင်ယူထားမယ် (Optional)
    $get_cat = mysqli_query($conn, "SELECT name FROM categories WHERE id = $id");
    $cat_data = mysqli_fetch_assoc($get_cat);
    $cat_name = $cat_data['name'] ?? "Unknown Category";

    // ၂။ Category ကို ဖျက်မယ်
    $sql = "DELETE FROM categories WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        
        // ၃။ ✅ အောင်မြင်စွာ ဖျက်ပြီးပါက Notification သိမ်းမယ်
        $noti_msg = "Admin deleted a category: $cat_name";
        addNoti($conn, $noti_msg, "category");

        header("Location: categories.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
?>