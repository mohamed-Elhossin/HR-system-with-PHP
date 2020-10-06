<?php
include '../genral/configDatabBase.php';
include '../genral/nav.php';
    


error_reporting(0);
$select = "SELECT * FROM  `employees` "; // query 
$select =  mysqli_query($conn, $select); // run qury 


if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $delete = "DELETE FROM `employees` WHERE id = $id "; // query 
    $delete =  mysqli_query($conn, $delete); // run qury 
  if($delete){
header('location: listemp.php ');
  }else{
      echo "error";
  }
}



if($_SESSION['admin'] || $_SESSION['HR']){

}else{
     header('location:/start/hrSytem/admin/login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

</head>

<body>

    <div class="container col-md-6 mt-5">
        <table class="table table-dark">
            <tr>
                <th>#ID </th>
                <th>Name </th>
                <th>Salary</th>
                <th>#Depart</th>
                <th>Action</th>
            </tr>
            <?php foreach ($select as $data) { ?>
                <tr>
                    <td><?php echo $data['id'] ?> </td>
                    <td><?php echo $data['name'] ?></td>
                    <td><?php echo $data['salary'] ?></td>
                    <td> <img width="200" src="../upload/<?php echo $data['img']?>"> </td>
                    <td><?php echo $data['depart'] ?></td>

                    <td>
                    <a href="add.php?edit=<?php echo $data['id'] ?>"
                    class="btn btn-info">Edit</a>
                    <a href="listemp.php?delete=<?php echo $data['id'] ?>"
                    onclick="return confirm('are you sure')"
                    class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>


</body>

</html>