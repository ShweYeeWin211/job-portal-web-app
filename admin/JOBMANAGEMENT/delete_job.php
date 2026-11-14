<?php
include('db.php');

if(isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = mysqli_query($conn, "DELETE FROM jobs WHERE id = $id");

    if($query) {
        // ဖျက်ပြီးသွားရင် SweetAlert ပြဖို့အတွက် Script ရေးပါမယ်
        echo "
        <html>
        <head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    title: 'Deleted!',
                    text: 'Your file has been deleted.',
                    icon: 'success',
                    confirmButtonColor: '#1e3a8a'
                }).then(() => {
                    window.location.href = 'jobmanagement.php';
                });
            </script>
        </body>
        </html>";
    }
}
?>