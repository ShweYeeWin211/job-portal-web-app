<?php
session_start();
include 'db.php'; // addNoti သုံးနိုင်ဖို့ db.php ကို ခေါ်ရပါမယ်

if (isset($_SESSION['admin_id'])) {
    // ၁။ Logout မလုပ်ခင် Activity Log အနေနဲ့ Noti သိမ်းမယ်
    // ဘယ်သူထွက်သွားလဲ သိချင်ရင် session ထဲက နာမည်ကို ယူသုံးလို့ရပါတယ်
    $admin_name = $_SESSION['admin_name'] ?? "Admin"; 
    
    addNoti($conn, "$admin_name has logged out of the system", "info");
}

// ၂။ Session ကို ဖျက်ပြီး Login page သို့ ပြန်ပို့မယ်
session_unset();
session_destroy();

header("Location: login.php");
exit();
?>