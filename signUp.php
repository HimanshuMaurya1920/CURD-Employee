<?php
function len($str) {
    return mb_strlen($str, 'UTF-8');
}

$sqlError = false ;
$sqlAlert = false ;
if ($_SERVER['REQUEST_METHOD']== 'POST') {
    # code...
    include "./parts/_db_connect.php" ;

    $eId = $_POST['eId'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if ($password === $cpassword) {
        # code...
        if (len($password) > 8 || len($password) < 4) {
            # code...
            $sqlError = "Password must be between 4-8 characters" ;

        }else{
      
        $sql = "select * from user123 where username = '$username' ";
        $result = mysqli_query($conn , $sql) ;

        $numRowExist = mysqli_num_rows($result) ;
        
        if ($numRowExist >0) {
            # code...
            $sqlError = "User-name already exist please try new user-name";

        }else{
                $hash = password_hash($password , PASSWORD_DEFAULT) ;
                $sql = "INSERT INTO `user123` ( `Employee_id`,`full_name`,`username`, `password`, `dt`) VALUES
                ( '$eId','$name','$username', '$hash', current_timestamp());";
                $result = mysqli_query($conn , $sql);
                    if ($result) {
                        # code...
                        $sqlAlert = "User-id is created , you can login now";                    
                    }
        }

    }

    }else{
        $sqlError = "Password and Confirm-Password should be same";
    }
}




?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign up demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body style="background-color: #414141; color: #fff;">
    <?php require "./parts/_nav.php" ;
    
    if ($sqlError) {
        # code...
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $sqlError .    ' :)
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>' ;
    } ;

    if ($sqlAlert) {
        # code...
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> '. $sqlAlert .    ' :)
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
              
        echo '<meta http-equiv="refresh" content="2;url=logIn.php">';
        
    
    }



    
    
    ?>

    <div class="container my-4">
        <form action="./signUp.php" method="post">
            <h1>Sign Up PAGE</h1>
        <div class="mb-3 col-md-7">
                    <label for="eId" class="form-label">Employee-id</label>
                    <input type="number" class="form-control border border-info" id="eId" name="eId" >
                </div>
                <div class="mb-3 col-md-7">
                    <label for="name" class="form-label">Full NAME</label>
                    <input type="text" class="form-control border border-info" id="name" name="name" >
                </div>
                <div class="mb-3 col-md-7">
                    <label for="username" class="form-label">Email address</label>
                    <input type="email" class="form-control border border-info" id="username" name="username" aria-describedby="emailHelp">
                    
                </div>
                <div class="mb-3 col-md-7">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control border border-info" id="password" name="password" >
                </div>
                <div class="mb-3 col-md-7">
                    <label for="cpassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control border border-info" id="cpassword" name="cpassword" >
                    <div id="emailHelp" style="color: #fff;" class="form-text">We'll never share your email with anyone else.</div>
                </div>
              
                
                <button type="submit" class="btn btn-primary">Sign UP</button>
        </form>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>