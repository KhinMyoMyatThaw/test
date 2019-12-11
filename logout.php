<?php
session_start();
// Destroying All Sessions
session_destroy();
header("Location: signin.php");
?>