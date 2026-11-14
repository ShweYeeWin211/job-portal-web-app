<?php
$conn = mysqli_connect("localhost", "root", "", "Localjob");
if(isset($_GET['id']) && isset($_GET['s'])) {
    $id = (int)$_GET['id'];
    $status = mysqli_real_escape_string($conn, $_GET['s']);
    mysqli_query($conn, "UPDATE jobs SET status='$status' WHERE id=$id");
}
header("Location: Dashboard.php");
?>