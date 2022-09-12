<?php
   session_start();
    
    echo ' <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container-fluid">
    <a class="navbar-brand" href="/forum/_index.php">iDiscuss</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/forum/_index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/forum/_about.php">About</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
           Top Categories
            </a>
            <ul class="dropdown-menu">';

              $sql = "SELECT category_name,category_id FROM `categories` LIMIT 4";  
              $result = mysqli_query($con,$sql);
              while ($row = mysqli_fetch_assoc($result)) {
                echo '<li><a class="dropdown-item" href="thradelist.php?catid=' .$row["category_id"]. '">' .$row["category_name"]. '</a></li>';
              }

          echo '</ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/forum/_contact.php">Contact</a>
        </li>
        </ul>
    </div>';

    
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        echo '<form class="d-flex" role="search" action="search.php" method="get">
                  <input class="form-control me-2" type="search" name="searchQuery" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit">Search</button>
              </form>';
         echo '<p class="mb-0 text-light ml-2">Welcome ' .$_SESSION      ['useremail'].   '</p>
          <a href= "partials/_logout.php" role="button" class="btn btn-success mx-2">logout</a>';
     } else {
        echo '<form class="d-flex" role="search" action="search.php" method="get">
                <input class="form-control me-2" type="search" name="searchQuery" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>';
        echo '<div class="mx-2">      
                <button class="btn btn-success mx-2" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
              </div>'; 
    }
    
    echo '</div>
    </nav>';


    include "partials/_signupModal.php";
    include "partials/_loginModal.php";

    if (isset($_GET['signupSuccess']) && $_GET['signupSuccess'] == 'true'){
        echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
        <strong>Success!</strong> You can now login.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
    if (isset($_GET['signupSuccess']) && $_GET['signupSuccess'] == 'false'){
        echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
        <strong>Error!</strong> You can not login.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }


    
  
  if (isset($_GET['logoutSuccess']) && $_GET['logoutSuccess'] == 'true') {
    echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
      <strong>Success!</strong> You have been logout.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
    </div>';
   }

   if (isset($_GET['loginSuccess']) && $_GET['loginSuccess'] == 'true') {
    echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
  <strong>Success!</strong> You have been loggedin.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

?>