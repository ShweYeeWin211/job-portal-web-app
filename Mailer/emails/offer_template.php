<?php
function offerTemplate($name, $company, $position) {
    return "
    <div style='font-family: Arial, sans-serif; max-width: 600px; margin: auto; border: 1px solid #e1f5fe; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.05);'>
        <div style='background-color: #2d9d78; padding: 25px; text-align: center;'>
            <h1 style='color: white; margin: 0;'>🎉 Congratulations!</h1>
        </div>
        <div style='padding: 30px; line-height: 1.6; color: #444;'>
            <h3 style='color: #333;'>Dear $name, 🥳</h3>
            <p>We are absolutely thrilled to offer you the position of <b>$position</b> at <b>$company</b>! 🎊</p>
            
            <p>Out of many talented candidates, your skills and experience truly stood out to us. We believe you will be a fantastic addition to our team at $company. 🏢✨</p>
            
            <div style='background-color: #f0fdf4; padding: 20px; border-radius: 8px; border: 1px dashed #2d9d78; margin: 20px 0; text-align: center;'>
                <p style='margin: 0; color: #2d9d78; font-weight: bold;'>Role: $position</p>
                <p style='margin: 5px 0 0 0; color: #555;'>Company: $company</p>
            </div>
            
            <p>🚀 <b>Next Steps:</b> Please check your student dashboard for further instructions and to complete your onboarding process.</p>
            
            <p>We are looking forward to welcoming you aboard and achieving great things together! 🤝🌟</p>
            
            <hr style='border: 0; border-top: 1px solid #eee; margin: 25px 0;'>
            
            <p style='margin: 0;'>Best Regards, ❤️</p>
            <p style='font-weight: bold; color: #333; margin: 5px 0;'>$company HR Team</p>
        </div>
        <div style='background-color: #f8f9fa; color: #888; padding: 15px; text-align: center; font-size: 12px;'>
            &copy; " . date('Y') . " $company | Empowering Your Career 🚀
        </div>
    </div>
    ";
}
?>