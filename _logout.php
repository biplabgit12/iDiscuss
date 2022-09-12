<?php
  session_start();
  echo "Logging you out. Please wait...";
   
  session_destroy();
  header("Location: /forum/_index.php?logoutSuccess=true");
 
?>