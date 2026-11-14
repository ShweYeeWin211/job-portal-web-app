<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // ၁။ Noti မှာ ပြချင်လို့ ဖျက်မယ့် User ရဲ့ နာမည်ကို အရင်ဆွဲထုတ်မယ်
    $user_query = mysqli_query($conn, "SELECT name FROM users WHERE id = '$id'");
    $user_data = mysqli_fetch_assoc($user_query);
    $user_name = $user_data['name'] ?? "Unknown User";

    // ၂။ User ကို Database ထဲမှ ဖျက်မယ်
    if (mysqli_query($conn, "DELETE FROM users WHERE id = '$id'")) {
        
        // ၃။ ✅ အောင်မြင်စွာ ဖျက်ပြီးပါက Notification သိမ်းမယ်
        $noti_msg = "Admin deleted a user: $user_name (ID: $id)";
        addNoti($conn, $noti_msg, "user");

        header("Location: usermanagement.php?msg=deleted");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    header("Location: usermanagement.php");
}
?>