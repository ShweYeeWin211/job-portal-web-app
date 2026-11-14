<?php
require_once dirname(__FILE__) . '/config/mail_config.php';
require_once dirname(__FILE__) . '/emails/offer_template.php';
require_once dirname(__FILE__) . '/emails/rejection_template.php';

function sendStatusEmail($studentEmail, $studentName, $status, $position, $company) {
    $mail = mailConfig(); 
    try {
        $mail->addAddress($studentEmail, $studentName); 
        if ($status === 'Approved') {
            $mail->Subject = "Job Offer from $company";
            $mail->Body    = offerTemplate($studentName, $company, $position);
        } else {
            $mail->Subject = "Application Update from $company";
            $mail->Body    = rejectionTemplate($studentName, $company);
        }
        $mail->send();
        return true;
    } catch (Exception $e) { return false; }
}
?>