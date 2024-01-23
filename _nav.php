<?php


echo '

<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">CURD</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./wellcome.php">Home</a>
        </li>';

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true ) {
        echo '
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./logOut.php">Log out</a>
        </li>';
        }else{

        echo '
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./logIn.php">Log in</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./signUp.php">Sign UP</a>
        </li> ' ;
        }
        
      echo '  
      </ul>

      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav> '

?>