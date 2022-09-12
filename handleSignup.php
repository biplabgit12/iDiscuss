<?php
  $showError = false;
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include "_dbConnect.php";
        $user_email = $_POST['signupEmail'];
        $pass = $_POST['signupPassword'];
        $cpass = $_POST['signupCpassword'];

        //Check wheather this email exist
        $existSql = "select * from `users` where user_email = '$user_email'";
        $result = mysqli_query($con, $existSql);
        $numRows = mysqli_num_rows($result);

        if ($numRows > 0) {
            echo "Email already in use";
        } else {
            if ($pass == $cpass) {
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users` (`user_email`, `user_pass`, `timestamp`) VALUES ('$user_email', '$hash', current_timestamp())";
                $result = mysqli_query($con, $sql);
                if ($result) {
                  $showAlert = true;
                  header("Location: /forum/_index.php?signupSuccess=true");
                  exit();
                }
            } else {
                $showError ='password can not match';
            }            
        }
     header("Location: /forum/_index.php?signupSuccess=false&error=$showError"); 
  }

?>