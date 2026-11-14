<?php
session_start(); // Session ကို စတင်မယ်

// Session variable အားလုံးကို ဖျက်မယ်
session_unset();

// Session ကို အပြီးတိုင် ဖျက်ဆီးမယ်
session_destroy();

// Login page ကို ပြန်ပို့မယ်
header("Location: login.php");
exit();
?>