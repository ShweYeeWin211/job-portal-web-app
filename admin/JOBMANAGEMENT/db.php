<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "job_portal";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function ထပ်နေခြင်း (Redeclare Error) ကို ကာကွယ်ရန်
if (!function_exists('addNoti')) {
    function addNoti($conn, $msg, $type = 'info') {
        $msg = mysqli_real_escape_string($conn, $msg);
        $type = mysqli_real_escape_string($conn, $type);
        $sql = "INSERT INTO notifications (message, type) VALUES ('$msg', '$type')";
        mysqli_query($conn, $sql);
    }
}
?>