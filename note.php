<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        CreateNote App!
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>



  <!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg bg-warning">
  <div class="container-fluid">
    <a class="navbar-brand me-5" href="#">CreateNote</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item me-5">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>

        <li class="nav-item me-5">
          <a class="nav-link active" aria-current="page" href="#">About Us</a>
        </li>

        <li class="nav-item me-5">
          <a class="nav-link active" aria-current="page" href="#">Contact US</a>
        </li>
       
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<!-- All form contents -->
<div class="container mt-3">
    <h1>Add a Note in CreateNote</h1>
    <form action="/crudApp/note.php" method="post">
  <div class="mb-3">
    <label for="Note Title" class="form-label">Note Title</label>
    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
    <div id="noteHelp" class="form-text">The title for your note!</div>
  </div>
  <div class="mb-3">
  <label for="Note Description" class="form-label">Note Description</label>
  <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
    </div>
     <button type="submit" class="btn btn-warning">Add Note!</button>
    </form>
</div>

  <!-- Database connection established here -->
<?php
        // echo "Welcome to MySql Database connection!<br>";
    
        $servername="localhost";
        $username="user";
        $password="";
        $database="notesdata";
        // database name=notesdata and table name=notes
        // connection with mysql database

        $conn=mysqli_connect($servername,$username,$password,$database);
        if(!$conn)
        {
            die("Sorry!..Connection was failed".mysqli_connect_error($conn));
        }
        else
        {
            // echo 'Connection was successful!';
            if($_SERVER['REQUEST_METHOD']=='POST')
            {
                $title=$_POST['title'];
                $description=$_POST['desc'];

                $sql="INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$description')";

                $results=mysqli_query($conn,$sql);
                if($results)
                {
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Successfully!</strong> inserted data in the database
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        
                }
                else{
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Failed!</strong>to insert data in the database
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
            }
        }
?>

<!--fetch all rows information -->
<div class="container mt-3">
    <table class="table table-danger">
  <thead>
    <tr>
      <th scope="col">S.no</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $sql="SELECT * FROM `notes`";
        $results=mysqli_query($conn,$sql);
        $sno=1;
        while($row=mysqli_fetch_assoc($results))
        {
         echo "<tr>
             <th scope='row'>".$sno."</th>
             <td>".$row['title']."</td>
            <td>".$row['description']."</td>
             <td>Actions</td>
            </tr>";
            $sno++;
        }
    ?>
    
    </tbody>
    </table>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>