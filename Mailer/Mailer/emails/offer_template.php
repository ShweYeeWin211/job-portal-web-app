<?php
function offerTemplate($name, $company, $position) {
return "
<h2 style='color:green'>🎉 Congratulations $name!</h2>
<p>You have been selected for the position of <b>$position</b> at <b>$company</b>.</p>
<p>Please check your dashboard for next steps.</p>
<p>Best Regards,<br>$company HR Team</p>
";
}
