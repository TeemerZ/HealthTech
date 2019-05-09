<!-- The page displayPatient.php was made by Pierre Beaufils | EFREI student -->

<?php
session_start();
include("DBConn.php");
include("createTable.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <title>
    Display patients
  </title>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <!--
  <link rel="stylesheet" type="text/css" href="../css/datatables.css">
  <script type="text/javascript" charset="utf8" src="../js/datatables.js"></script>
  -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="icon" type="image/png" href="../ressources/icones/logo.png" />

</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<a class="navbar-brand" href="#"> <img class="logo" src="../ressources/icones/logo.png" height="40"> LOGO</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar1" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbar1">
    <ul class="navbar-nav ml-auto"> 

<li class="nav-item active">
<a class="nav-link" href="http://localhost/ProjetV1.1/Projet/files/menu.php">Home <span class="sr-only">(current)</span></a>
</li>

<li class="nav-item"><a class="nav-link" href="http://localhost/ProjetV1.1/Projet/files/displayPatient.php"> Display patient </a></li>

<li class="nav-item dropdown">
	<a class="nav-link  dropdown-toggle" href="#" data-toggle="dropdown">  Future_function  </a>
    <ul class="dropdown-menu">
	  <li><a class="dropdown-item" href="#"> Function_1</a></li>
	  <li><a class="dropdown-item" href="#"> Function_1 </a></li>
    </ul>
</li>
<li class="nav-item">
<a class="btn ml-2 btn-warning" href="../controller/logout.php">Logout</a></li>
    </ul>
  </div>
</nav>

<br />
<br />
<br />


<!-- Display all the patients if you are an admin -->

<?php 
    if ($_SESSION['Status'] == "admin" || $_SESSION['Status'] == "matron")
    {
        $sql="SELECT * FROM tbl_patient";
        if($result = mysqli_query($DBConnect, $sql))
        {
            if(mysqli_num_rows($result) > 0)
            {
?>

<div class="table-responsive">

  <!--Table-->
  <table id="example" class="display" style="width:100%"> 

    <!--Table head-->
    <thead>
      <tr>
        <th>#</th>
        <th class="th-lg">Name</th>
        <th class="th-lg">Surname</th>
        <th class="th-lg">Room number</th>
        <th class="th-lg">Photo</th>
      </tr>
    </thead>
    <!--Table head-->

    <!--Table body-->
    <tbody>
        
<?php
    while($row = mysqli_fetch_array($result)){
?>

      <tr>
        <th scope="row"> <?php echo $row['ID'] ?> </th>
        <td><?php echo $row['FName'] ?></td>
        <td><?php echo $row['LName'] ?></td>
        <td><?php echo $row['Roomno'] ?></td>
        <td>
        <button class="btn" data-toggle="modal" data-target="#myModalRemarks<?php echo $row['ID'];?>"><i class="fa fa-camera"></i></button>
        </td>
      </tr>

      <div class="modal fade" id="myModalRemarks<?php echo $row['ID'];?>"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Picture of <?php echo $row['FName'] . " ";  echo $row['LName'] ?> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                <img <?php echo "<img src=../ressources/Images/".$row['patientImage'].">"; ?>>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<?php
    }
?>
    </tbody>
    <!--Table body-->

  </table>
  <!--Table-->

</div>


<?php
            }
        }
    }

    if ($_SESSION['Status'] == "user")
    {
        $email = $_SESSION['email'];
        $sql="SELECT * 
              FROM tbl_patient TP, tbl_user TU
              WHERE TP.NextOfKinID = TU.ID
              AND TU.Email = '$email'";

        if($result = mysqli_query($DBConnect, $sql))
        {
            if(mysqli_num_rows($result) > 0)
            {

?>

<div class="table-responsive">

  <!--Table-->
  <table class="table">

    <!--Table head-->
    <thead>
      <tr>
        <th>#</th>
        <th class="th-lg">Name</th>
        <th class="th-lg">Surname</th>
        <th class="th-lg">Room number</th>
        <th class="th-lg">Photo</th>
      </tr>
    </thead>
    <!--Table head-->

    <!--Table body-->
    <tbody>
        
<?php
    while($row = mysqli_fetch_array($result)){
?>

      <tr>
        <th scope="row"> <?php echo $row['ID'] ?> </th>
        <td><?php echo $row['FName'] ?></td>
        <td><?php echo $row['LName'] ?></td>
        <td><?php echo $row['Roomno'] ?></td>
        <td>
        <button class="btn" data-toggle="modal" data-target="#myModalRemarks<?php echo $row['ID'];?>"><i class="fa fa-camera"></i></button>
        </td>
      </tr>

      <div class="modal fade" id="myModalRemarks<?php echo $row['ID'];?>"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Picture of <?php echo $row['FName'] . " ";  echo $row['LName'] ?> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                <img <?php echo "<img src=../ressources/Images/".$row['patientImage'].">"; ?>>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<?php
    }
?>
    </tbody>
    <!--Table body-->

  </table>
  <!--Table-->

</div>

<?php
            }
            else { echo "You don't have a patient into this hospital, maybe try to refresh the page?"; }
        }
    }
?>

</body>

<footer>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="../js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</footer>

</html>


<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>