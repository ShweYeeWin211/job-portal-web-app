<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // ၁။ Noti မှာပြဖို့ အလုပ်ခေါင်းစဉ်ကို အရင်ဆွဲထုတ်ယူမယ်
    $res = mysqli_query($conn, "SELECT job_title FROM jobs WHERE id = $id");
    $job = mysqli_fetch_assoc($res);
    $title = $job['job_title'] ?? "Job";

    // ၂။ Status ကို Rejected ပြောင်းမယ်
    $sql = "UPDATE jobs SET status='Rejected' WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        
        // ၃။ ✅ အောင်မြင်ရင် Notification သိမ်းမယ်
        // Rejected ဖြစ်တဲ့အတွက် Noti type ကို ပိုသတိထားမိအောင် 'password' သို့မဟုတ် 'security' type နဲ့ ပြလို့ရပါတယ်
        $noti_msg = "Admin rejected the job post: $title";
        addNoti($conn, $noti_msg, "job"); 

        header("Location: jobmanagement.php?msg=rejected");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: jobmanagement.php");
}
?>