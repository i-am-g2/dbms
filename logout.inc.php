<?php
session_start();
session_unset();
session_destroy();
header("Location: index.php?success=true&message=Logout_Successful");
?>
