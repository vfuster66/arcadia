<?php
session_start();
session_destroy();
header("Location: /arcadia/views/connexion.php");
exit();
?>
