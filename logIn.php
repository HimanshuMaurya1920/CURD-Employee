<?php
$sqlError = false ;
$sqlAlert = false ;

if ($_SERVER['REQUEST_METHOD']=='POST') {
  # code...
      include "./parts/_db_connect.php"  ;

      $username = $_POST['username'];
      $password = $_POST['password'];

      $sql = "select * from user123 where username = '$username' " ;
      $result = mysqli_query($conn,$sql) ;

      $numExistRow = mysqli_num_rows($result);

      if ($numExistRow ===1) {
        # code...
        while ($row = mysqli_fetch_assoc($result)) {
          # code...
          if (password_verify($password , $row['password'])) {
            # code...
              session_start() ;
              $_SESSION['username'] = $username ;
              $_SESSION['loggedin'] = true ;
              $_SESSION['name'] = $row['full_name'] ;
              $_SESSION['sNo'] = $row['sNo'] ;
              $sqlAlert = "Success" ;


          }else{
              $sqlError = "In-Correct Password , Try again" ;

          }

        }




      }else{
        $sqlError = "In-Correct USER-NAME , Try again" ;
      }



 }


 ?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log in demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body style="background-color: #414141; color: #fff;">
  <?php
        require "./parts/_nav.php" ;

        if ($sqlAlert) {
          # code...
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong>  :)
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';

          echo '<meta http-equiv="refresh" content="2;url=wellcome.php">';
            
        }

        if ($sqlError) {
          # code...
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Error!</strong> '. $sqlError .    ' :)
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>' ;
      } ;
  
  
  ?>

    <div class="container my-4">
        <form action="./logIn.php" method="post">
        <h1>Log in PAGE</h1>

                <div class="mb-3 col-md-7">
                    <label for="username" class="form-label">Email address</label>
                    <input type="email" class="form-control border border-info" id="username" name="username" aria-describedby="emailHelp">
                    
                </div>
                <div class="mb-3 col-md-7">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control border border-info" id="password" name="password" >
                </div>
                
              
                
                <button type="submit" class="btn btn-primary">Log in</button>
        </form>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>