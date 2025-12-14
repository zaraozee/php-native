// session_start();
// session_destroy();
// header("Location: login.php");
// exit;



<?php
session_start();
session_unset(); // hapus semua data session
session_destroy(); // destroy session

header("Location: ../auth/login.php");
exit;
?>