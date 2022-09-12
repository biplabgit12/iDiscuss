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
    <style>
    #maincontainer{
        min-height:86vh;
    }
    </style>
</head>

<body>
    <?php require "partials/_dbConnect.php"?>
    <?php require "partials/_header.php"?>

    
      <div class="container" id="maincontainer">
           <h3>Search results for "<em><?php echo $_GET['searchQuery'] ?></em>"</h3>
         <?php
               $noResult = true;
            $query = $_GET["searchQuery"];
            $sql = "select * from thrades where match (thrade_title, thrade_desc) against ('$query')";   
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $noResult = false;
                $title = $row['thrade_title'];
                $desc = $row['thrade_desc'];
                $thrade_id = $row['thrade_id'];

                $url = 'thrade.php?thradeid='. $thrade_id;

                echo '<div class="result">
                        <a href="' .$url. '" class="text-dark"><h5>' .$title. '</h5></a>
                        <p>' .$desc. '</p>
                    </div>';

            }

              if ($noResult) {
                echo '<div class="jumbotron jumbotron-fluid" style="padding:1rem 2rem;">
                <div class="container">
                <h2 class="display-6">No results Found</h2>
                <p class="lead"> Suggestions: 
                     <ul>
                        <li>Make sure that all words are spelled correctly.</li>
                        <li>Try different keywords.</li>
                        <li>Try more general keywords. </li>
                     </ul>
                </p>
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