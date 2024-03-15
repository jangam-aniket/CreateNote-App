<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        CreateNote App!
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- datatables css cdn included -->
    <link href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.min.css" rel="stylesheet">
  
  <!-- jquery cdn included -->
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>
  
  <!-- datatable js cdn included -->
  <script src="https://cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>

  <!-- datatables function run in table  -->
  <script>
    $(document).ready( function () {
    $('#myTable').DataTable();
      } );
  </script>
  <link rel="stylesheet" href="style.css">
 
  </head>
  <body>

<!-- Edit Modal when user clicked on edit button it will be shown -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit Modal
</button> -->

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editModalLabel">Edit Notes</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <form action="/crudApp/CreateNote-App/note.php" method="post" id="form1">
          <input type="hidden" name="snoEdit" id="snoEdit">
              <div class="mt-3 mb-3">
              <label for="Note Title" class="form-label">Note Title</label>
            <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
            <div id="noteHelp" class="form-text">The title for your note!</div>
          </div>
            <div class="mb-3">
            <label for="Note Description" class="form-label">Note Description</label>
            <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="5"></textarea>
              </div>
              <button type="submit" id="submitButton" class="btn btn-warning mb-5">Update Note!</button>
         </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

  <!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg fixed-top mb-5" id="nav-content">
  <div class="container-fluid">
    <a class="navbar-brand me-5 txt" href="#"><b>CreateNote</b></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item me-5">
          <a class="nav-link active" aria-current="page" href="#"><b class="txt">Home</b></a>
        </li>

        <li class="nav-item me-5">
          <a class="nav-link active" aria-current="page" href="#"><b class="txt">About Us</b></a>
        </li>

        <li class="nav-item me-5">
          <a class="nav-link active" aria-current="page" href="#table-content"><b class="txt">Your Notes</b></a>
        </li>
       
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-warning" type="submit"><b>Search</b></button>
      </form>
    </div>
  </div>
</nav>

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
           if(isset($_GET['delete']))
          {
            $sno=$_GET['delete'];
            // echo $sno;
            echo "<br>";
            $sql="DELETE FROM `notes` WHERE `notes`.`sno` = $sno";
            $results=mysqli_query($conn,$sql);
            if($results)
                {
                    echo '<div class="alert alert-info mt-5 alert-dismissible fade show" role="alert">
                    <strong>Successfully!</strong> deleted data from the database
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        
                }
                else{
                    echo '<div class="alert alert-info mt-5 alert-dismissible fade show" role="alert">
                    <strong>Failed!</strong>to delete data from the database
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
          }
        
            if($_SERVER['REQUEST_METHOD']=='POST')
            {
              if(isset($_POST['snoEdit']))
              {
                // echo"yes";
                $sno=$_POST["snoEdit"];
                $title=$_POST["titleEdit"];
                $description=$_POST["descriptionEdit"];

                // $sql="UPDATE `notes` SET `title` = $title, `description` = $description, WHERE `notes`.`sno` = $sno";
                $sql="UPDATE `notes` SET `title` = '$title', `description` = '$description' WHERE `notes`.`sno` = '$sno'";
                $results=mysqli_query($conn,$sql);
                if($results)
                {
                    echo '<div class="alert alert-info mt-5 alert-dismissible fade show" role="alert">
                    <strong>Successfully!</strong> updated data in the database
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        
                }
                else{
                    echo '<div class="alert alert-info mt-5 alert-dismissible fade show" role="alert">
                    <strong>Failed!</strong>to update data in the database
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
              }

              else
              { 
                $title=$_POST['title'];
                $description=$_POST['desc'];
                
                $sql="INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$description')";

                $results=mysqli_query($conn,$sql);
                if($results)
                {
                    echo '<div class="alert alert-warning mt-5 alert-dismissible fade show" role="alert">
                    <strong>Successfully!</strong> inserted data in the database
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        
                }
                else{
                    echo '<div class="alert alert-warning mt-5 alert-dismissible fade show" role="alert">
                    <strong>Failed!</strong>to insert data in the database
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
              
              }
            }
            
?>

<!-- All form contents -->
<div class="container mt-5 mb-5" id="form-content">
    <h2>CreateNote -<small>Add your sticky notes</small></h2>
    <form action="/crudApp/CreateNote-App/note.php" method="post" id="form1">
  <div class="mt-3 mb-3">
    <label for="Note Title" class="form-label"><b>Note Title</b></label>
    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
    <div id="noteHelp" class="form-text">The title for your note!</div>
  </div>
  <div class="mb-3">
  <label for="Note Description" class="form-label"><b>Note Description</b></label>
  <textarea class="form-control" id="desc" name="desc" rows="5"></textarea>
    </div>
     <button type="submit" id="submitButton" class="btn btn-warning mb-5"><b>Add Note!</b></button>
    </form>
</div>

<!--fetch all rows information -->
<div class="container mt-5 mb-5" id="table-content">
    <table class="table" id="myTable">
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
             <td><button type='button' class='edit btn btn-warning' id=".$row['sno'].">Edit</button> <button type='button' class='delete btn btn-warning' id=d".$row['sno'].">Delete</button></td>
            </tr>";
            $sno++;
        }
    ?>
    
    </tbody>
    </table>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  
    
     <script>

      //  added for edit functionality

    let edits=document.getElementsByClassName('edit');
      Array.from(edits).forEach((elements)=>{
        elements.addEventListener("click",(e)=>{
          console.log("edit",);
          tr=e.target.parentNode.parentNode;
          title=tr.getElementsByTagName("td")[0].innerText;
          description=tr.getElementsByTagName("td")[1].innerText;
          console.log(title,description);
          snoEdit.value=e.target.id;
          console.log(e.target.id);
          titleEdit.value=title;
          descriptionEdit.value=description;
          $('#editModal').modal('toggle');
        });
      });

      //  added for delete functionality 

      let deletes=document.getElementsByClassName('delete');
      Array.from(deletes).forEach((elements)=>{
        elements.addEventListener("click",(e)=>{
          console.log("delete",);
          sno=e.target.id.substr(1,);
          if(confirm("Do you want to delete this note?")){
            console.log("yes");
            window.location=`/crudApp/CreateNote-App/note.php?delete=${sno}`;
          }
          else{
            console.log("no");
          }
        });
      });

 </script>
  
  </body>
</html>