<?php
function rejectionTemplate($name, $company) {
    return "
    <div style='font-family: Arial, sans-serif; max-width: 600px; margin: auto; border: 1px solid #eee; border-radius: 10px; overflow: hidden;'>
        <div style='background-color: #f8f9fa; padding: 20px; text-align: center; border-bottom: 2px solid #e44d61;'>
            <h2 style='color: #333; margin: 0;'>📩 Application Update</h2>
        </div>
        <div style='padding: 30px; line-height: 1.6; color: #555;'>
            <h3 style='color: #333;'>Dear $name, 👋</h3>
            <p>Thank you for giving us the opportunity to review your application for the position at <b>$company</b>. 🏢</p>
            
            <p>After careful consideration, we regret to inform you that we will not be moving forward with your application at this time. ✉️</p>
            
            <p style='background-color: #fff5f6; padding: 15px; border-left: 4px solid #e44d61; font-style: italic;'>
                \"Our selection process was very difficult due to the many high-quality applications we received.\" ✨
            </p>
            
            <p>We truly appreciate your interest in working with us and will keep your profile in our talent pool for future opportunities. 🤝</p>
            
            <p>We wish you the very best of luck with your job search and your future professional endeavors! 🍀✨</p>
            
            <hr style='border: 0; border-top: 1px solid #eee; margin: 20px 0;'>
            
            <p style='margin: 0;'>Best Regards, ❤️</p>
            <p style='font-weight: bold; color: #333; margin: 5px 0;'>The Hiring Team</p>
            <p style='font-size: 12px; color: #888;'>$company</p>
        </div>
        <div style='background-color: #333; color: white; padding: 10px; text-align: center; font-size: 12px;'>
            &copy; " . date('Y') . " $company. All rights reserved. 💻
        </div>
    </div>
    ";
}
?>