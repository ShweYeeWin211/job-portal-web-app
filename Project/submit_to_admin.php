<?php
$conn = new mysqli("localhost", "root", "", "job_portal");
include 'db.php';
$id = $_GET['id'];

// Status ကို Draft ကနေ Pending ပြောင်းလိုက်ပြီ
// အဲဒီတော့မှ Admin Dashboard ရဲ့ Pending စာရင်းမှာ သွားပေါ်မှာပါ
$sql = "UPDATE applications SET status = 'Pending' WHERE id = '$id'";

if(mysqli_query($conn, $sql)) {
    echo "<script>alert('Admin ထံသို့ ပို့ဆောင်ပြီးပါပြီ။'); window.location.href='my_applications.php';</script>";
}
?>