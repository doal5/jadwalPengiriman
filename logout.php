<?php
session_start();
$_SESSION['level'] = '';
unset($_SESSION['level']);
unset($_SESSION['namakurir']);
unset($_SESSION['nama']);
session_unset();
session_destroy();
?>
<script>
    location.href = 'login.php';
</script>