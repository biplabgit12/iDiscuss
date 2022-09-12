<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDiscuss - coding forums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<style>
#ques {
    min-height: 433px;
}
</style>

<body>
    <?php require "partials/_dbConnect.php"?>
    <?php require "partials/_header.php"?>
    <?php
       $id = $_GET['thradeid'];
       $sql = "SELECT * FROM `thrades` WHERE thrade_id = $id";  
       $result = mysqli_query($con,$sql);
       while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['thrade_title'];
        $desc = $row['thrade_desc'];
        $thrade_user_id = $row['thrade_user_id'];

        $sql2 = "SELECT user_email FROM `users` WHERE sno='$thrade_user_id'";  
        $result2 = mysqli_query($con, $sql2);
        $row2 = mysqli_fetch_assoc($result2);  
        $posted_by = $row2['user_email'];
       }
     ?>


    <?php
       $showAlert = false;
       $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST') {
            //Insert into comments db
           $comment = $_POST['comment'];
           $comment = str_replace("<","&lt","$comment");
           $comment = str_replace(">","&gt","$comment");

           $sno = $_SESSION['sno'];
           $sql = "INSERT INTO `comments` (`comment_content`, `thrade_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$sno', current_timestamp())";  
           $result = mysqli_query($con,$sql);

           $showAlert = true;
            if ($showAlert) {
               echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
               <strong>Success!</strong> Your comment has been added! Please wait for community to respond
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
         </div>';
            }

        }
   
     ?>



    <!-- Thrade container starts here -->
    <div class="container my-3 col-7">
        <div class="jumbotron" style="padding: 1rem 2rem;">
            <h3 class="display-6"> <?php echo $title ?> </h3>
            <p class="lead"> <?php echo $desc ?> </p>
            <hr class="my-4">
            <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do not
                post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post
                questions. Remain respectful of other members at all times.</p>
            <p>Posted by : <em><?php echo $posted_by ?> </em></p>
        </div>
    </div>



    <?php
 if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  echo '<div class="container">
          <h3 class="my-4">Post a Comment</h3>
            <form action="' . $_SERVER["REQUEST_URI"] . '" method="post">
                <div class="form-group">
                    <label for="comment">Type your Comment</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                </div>
                <input type="hidden" id="sno" name="' . $_SESSION["sno"]. '">
                <button type="submit" class="btn btn-success">post Comment</button>
            </form>
        </div>';
  }
else {
echo '<div class="container">
        <h3 class="my-4">Start a Discussion</h3>
        <p>You are not logged in. Please login to be able to start a comment.</p>
    </div>';
  }
 ?>


    <div class="container" id="ques">
        <h3 class="my-4" style="padding-top:25px;">Discussions</h3>

        <?php
            $id = $_GET['thradeid'];
            $sql = "SELECT * FROM `comments` WHERE thrade_id = $id";  
            $result = mysqli_query($con,$sql);
            $noResult = true;
            while ($row = mysqli_fetch_assoc($result)) {
                $noResult = false;
                $id = $row['comment_id'];
                $content = $row['comment_content'];
                $comment_time = $row['comment_time'];
                $comment_by = $row['comment_by']; 

                $sql2 = "SELECT user_email FROM `users` WHERE sno='$comment_by'";  
               $result2 = mysqli_query($con, $sql2);
               $row2 = mysqli_fetch_assoc($result2);        


                echo '<div class="media mb-4">
                <img src="img/userdefault.png" width="40px" class="mr-3" alt="...">
                <div class="media-body">
                  <p class="font-weight-bold my-0">' .$row2['user_email']. ' at ' .  $comment_time . '</p>
                    <p class="my-0">'.$content.'</p>
                    </div>
                </div>';
            }

            //    echo var_dump($noResult);
            if ($noResult) {
                echo '<div class="jumbotron jumbotron-fluid" style="padding:1rem 2rem;">
                <div class="container">
                <h1 class="display-4">No Comment Found</h1>
                <p class="lead">Be the first person to ask a question</p>
                </div>
            </div>';
            }            
       ?>

    </div>



    <?php require "partials/_footer.php"?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
        integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
    </script>

    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

</body>

</html>