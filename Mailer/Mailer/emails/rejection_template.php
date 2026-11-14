<?php
function rejectionTemplate($name, $company) {
return "
<h3>Hello $name,</h3>
<p>Thank you for applying to <b>$company</b>.</p>
<p>We regret to inform you that you were not selected at this time.</p>
<p>We wish you all the best for your future.</p>
";
}
