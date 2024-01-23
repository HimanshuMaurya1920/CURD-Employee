<?php
      include "./parts/_db_connect.php"  ;

$alertDelete = false ;
$showWellcome = false ;
$dontshowWellcome = false ;
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true ) {
  # code...
        $showWellcome = true ;
        $sno = $_SESSION['sNo'] ;


}else{
    $dontshowWellcome = true ;

}

if ($_SERVER['REQUEST_METHOD']=='POST') {


  if (isset($_POST['snoEdit'])) {
    # code...
    // echo "yes";
    $title = $_POST['titleEdit'];
    $desc = $_POST['descEdit'];
    $snoEdit = $_POST['snoEdit'];

    $sql = "UPDATE `to_do` SET `title` = '$title', `desc` = '$desc' WHERE `No` = $snoEdit;";

    $result = mysqli_query($conn,$sql) ;

   
  }else{


    $title = $_POST['title'] ;
    $desc = $_POST['desc'] ;
    // $file = $_POST['file'] ;

     // Handling file upload
     $file_name = $_FILES['file1']['name'];
     $file_tmp = $_FILES['file1']['tmp_name'];
     $file_data = addslashes(file_get_contents($file_tmp));

    
  



    // Using prepared statement to insert data into the database
    $sql = "INSERT INTO `to_do` (`sNo`, `title`, `desc`, `file`) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "isss", $sno, $title, $desc, $file_data);
    
    if (mysqli_stmt_execute($stmt)) {
        // echo "done";
    } else {
        echo "Not Done: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);

  }

}

// for delete

if (isset($_GET["delete"])) {
  # code...
  $del = $_GET["delete"] ;
  echo "<script>";
echo "if (confirm('Are you sure')) {";
echo "    window.location.href = './wellcome.php?del=".$del."';";
echo "}";
echo "</script>";
}

if (isset($_GET["del"])) {
  $del = $_GET["del"] ;

  $sql = "DELETE FROM to_do WHERE No =$del ;";
  $result = mysqli_query($conn , $sql) ;
  if ($result) {
    # code...
    $alertDelete = "Row has been deleted" ;

  }

}




?>


<!doctype html>
<html lang="en" data-bs-theme="dark">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>wellcome demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body >
    <?php require "./parts/_nav.php" ;

    if ($alertDelete) {
      # code...
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Sucess!</strong> '.$alertDelete   .'
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }

      if ($showWellcome) {
        # code...
        echo '<div class="alert alert-success " role="alert">
        <h4 class="alert-heading">Wellcome! Mr '. $_SESSION['name'] .  '</h4>
        <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
        <hr>
        <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
      </div>';
      }

      if ($dontshowWellcome) {
        # code...
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>First LOG-IN , MY BOY!</strong>  :)
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>' ;

        echo '<meta http-equiv="refresh" content="2;url=logIn.php">';

      }
    
    
    
    ?>

      



<!-- modal For Edit start -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editModalLabel">Edit this TO-DO</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>


      <!-- inner form start -->

      <form action="./wellcome.php" method="post">
              <div class="modal-body">

                    <input type="hidden" name="snoEdit" id="snoEdit">
                    <div class="mb-3">
                        <label for="note_title" class="form-label">Edit Title</label>
                        <input type="text" class="border border-dark form-control" id="titleEdit" name="titleEdit" aria-describedby="Note Title" required>
                        
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Edit description</label>
                        <textarea class="form-control border border-dark" id="descEdit" name="descEdit" rows="3"></textarea>
                    </div>
                    
                    <!-- <button type="submit" class="btn btn-primary">Change Note</button> -->
                    
                    
                    
                  </div>
                  <div class="modal-footer d-flex ">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <div class="ms-auto"></div>
                </div>
        </form>
      <!-- inner form -->


    </div>
  </div>
</div>
<!-- modal end -->


















    <div class="container my-5">
    <form action="./wellcome.php" method="post" enctype="multipart/form-data">
      <h1>Employee to do</h1>
      <br>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Today's Task</label>
    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" required>
  </div>
  <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Task desc</label>
        <textarea class="form-control" id="desc" name="desc" rows="3" required></textarea>
  </div>
  <div class="mb-3">
    <label for="file" class="form-label">Excel file</label>
    <input type="file" class="form-control" id="file" name="file1" accept=".xls, .xlsx" required>
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    </div>




    <div class="container my-4">

    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">DESC</th>
      <th scope="col">Time</th>
      <th scope="col">File</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>


  <?php
    
    
    $select = "select * from to_do where sNo = $sno order by dt desc";
    $result = mysqli_query($conn , $select);

    if ($result) {
      # code...
      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['sNo'];
        $No = $row['No'];
        $title = $row['title'];
        $desc = $row['desc'] ;
        $file_data = $row['file'];
        $dt = $row['dt'];


        // Do something with the data
        // For example, you might want to create a link to download the Excel file

        echo '<tr>
        <th scope="row">1</th>
        <td>'. $title  .'</td>
        <td>'. $desc  .'</td>
        <td>'. $dt  .'</td>
        <td><a href="download.php?id=' . $id . '">Download Excel File</a></td>
        <td> <a href="./wellcome.php?edit='.$No  .'" id="'.$No  .'" class="edit btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#editModal">Edit</a>
         <a href="./wellcome.php?delete='.$No  .'" id="'.$No  .'" class="delete btn btn-primary">Delet</a>
        
        </td>
        </tr>';





        echo "<p>ID: $id, Title: $title</p>";
        echo '';
    }
    }
  
  
  
  ?>









    











 
  </tbody>
</table>

  


    </div>


    <script>
      edits =document.getElementsByClassName('edit')
            Array.from(edits).forEach((element)=>{
                element.addEventListener("click",(e)=>{
                    tr = e.target.parentNode.parentNode ;
                    title = tr.getElementsByTagName("td")[0].innerText ;
                    desc = tr.getElementsByTagName("td")[1].innerText ;
                    titleEdit.value = title ; 
                    descEdit.value = desc ; 
                    snoEdit.value = e.target.id ;                  
                })
            })
    </script>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>