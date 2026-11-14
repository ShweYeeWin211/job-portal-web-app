<?php
require_once dirname(__FILE__) . '/config/mail_config.php';
require_once dirname(__FILE__) . '/emails/offer_template.php';
require_once dirname(__FILE__) . '/emails/rejection_template.php';

// $company ဆိုတဲ့ parameter ကို ထပ်တိုးထားပါတယ်
function sendStatusEmail($studentEmail, $studentName, $status, $position, $company) {
    $mail = mailConfig(); // PHPMailer setting တွေကို ယူမယ်

    try {
        // CV form မှာ ထည့်ခဲ့တဲ့ ကျောင်းသား Email ကို လက်ခံသူအဖြစ် သတ်မှတ်မယ်
        $mail->addAddress($studentEmail, $studentName); 

        if ($status === 'Approved') {
            // အောင်မြင်တဲ့အခါ ပို့မယ့် Subject နဲ့ Body
            $mail->Subject = "Job Offer from $company";
            $mail->Body    = offerTemplate($studentName, $company, $position);
        } else {
            // ငြင်းပယ်ခံရတဲ့အခါ ပို့မယ့် Subject နဲ့ Body
            $mail->Subject = "Application Update from $company";
            $mail->Body    = rejectionTemplate($studentName, $company);
        }

        $mail->send();
        return true;
    } catch (Exception $e) {
        // Error ဖြစ်ခဲ့ရင် log ထုတ်ကြည့်လို့ရအောင် ပြင်ဆင်နိုင်ပါတယ်
        error_log("Email sending failed: " . $mail->ErrorInfo);
        return false;
    }
}
?>