<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include "_dbConnect.php";
        $email = $_POST['loginEmail'];
        $pass = $_POST['loginPass'];

        $sql = "select * from `users` where user_email = '$email'";
        $result = mysqli_query($con, $sql);
        $numRows = mysqli_num_rows($result);

        if ($numRows == 1) {
           $row = mysqli_fetch_assoc($result);
            if (password_verify($pass, $row['user_pass'])){
               session_start();
               $_SESSION['loggedin'] = true;
               $_SESSION['useremail'] = $email;
               $_SESSION['sno'] = $row['sno'];
               // echo "logged in" .$email;
            }
            header('Location: /forum/_index.php?loginSuccess=true');
        } 
        header('Location: /forum/_index.php?loginSuccess=true');
  }
?>