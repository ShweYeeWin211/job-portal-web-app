<?php
include('db.php');
require_once dirname(__FILE__) . '/../../Mailer/send_email.php';

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = intval($_GET['id']);
    $status = mysqli_real_escape_string($conn, $_GET['status']);

    // Database ကနေ သိမ်းထားတဲ့ ကုမ္ပဏီနာမည်ကိုပါ ဆွဲထုတ်မယ်
    $query = "SELECT applicant_name, email, job_title, company_name FROM applications WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    if ($data) {
        // ကုမ္ပဏီနာမည် ရှိရင် ယူမယ်၊ မရှိမှ Our Company လို့ ပြမယ်
        $company = !empty($data['company_name']) ? $data['company_name'] : 'Our Company';

        if (mysqli_query($conn, "UPDATE applications SET status = '$status' WHERE id = $id")) {
            // Email ပို့တဲ့ Function ထဲကို နာမည်အမှန် ထည့်လိုက်ပြီ
            sendStatusEmail($data['email'], $data['applicant_name'], $status, $data['job_title'], $company);
            
            echo "<script>alert('Status Updated and Email Sent from $company!'); window.location.href='applications.php';</script>";
        }
    }
}
?>