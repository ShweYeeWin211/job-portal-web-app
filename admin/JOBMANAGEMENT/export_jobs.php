<?php
include 'db.php';

$filename = "job_report_" . date('Y-m-d') . ".csv";

header("Content-Type: text/csv; charset=utf-8");
header("Content-Disposition: attachment; filename=$filename");

$output = fopen("php://output", "w");

// Excel ခေါင်းစဉ်များ
fputcsv($output, array('ID', 'Job Title', 'Company', 'Location', 'Type', 'Status', 'Date'));

// Database ထဲက data အားလုံးကို ဆွဲထုတ်ခြင်း
$query = "SELECT id, job_title, company, location, type, status, created_at FROM jobs ORDER BY id DESC";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, $row);
}

fclose($output);
exit();
?>