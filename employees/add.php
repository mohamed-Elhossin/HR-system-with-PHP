<?php
include '../genral/configDatabBase.php';
include '../genral/nav.php';
function pmessage($mess)
{
    echo "<div class='alert alert-primary' role='alert'>" .
        $mess
        . "</div>";
}
if (isset($_POST['send'])) {
    $name = $_POST['name'];
    $salary = $_POST['salary'];
    $depart = $_POST['deprtment'];


// image code 
$image_type = $_FILES['image']['type'] ;
$image_name = $_FILES['image']['name']; 
$tmp_name = $_FILES['image']['tmp_name'];
$location = '../upload/';


  if(move_uploaded_file($tmp_name , $location . $image_name )){
    pmessage('image uploaded done'); 
  }else{
    pmessage('image uploaded faild'); 

  }




    $insert = "INSERT INTO `employees` VALUES (NULL , '$name', $salary,'$image_name' ,$depart )";
    $query =  mysqli_query($conn, $insert); // run qury 
    if ($query) {
        pmessage("done insert to database");
        // header("location: crud.php");
    } else {
        echo "faild insert to datbase";
    }
}
$name = "";
$salary = "";
$update = "false";
if (isset($_GET['edit'])) {
    $update = "true";
    $id = $_GET['edit'];
    $select = "SELECT * FROM `employees` WHERE id = $id "; // query 
    $select =  mysqli_query($conn, $select); // run qury  
    $row = mysqli_fetch_assoc($select);
    $name = $row['name'];
    $salary = $row['salary'];
    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $salary = $_POST['salary'];
        $depart = $_POST['deprtment'];
        $update = "UPDATE `employees` SET name ='$name' , salary = $salary , depart = $depart WHERE id =$id ";
        $query =  mysqli_query($conn, $update); // run qury 
        if ($query) {
            pmessage("done update to database");
            // header("location: crud.php");
        } else {
            echo "faild update to datbase";
        }
    }
}


if($_SESSION['admin']){

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
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" name="name" value="<?php echo $name ?>" class="form-control" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Salary</label>
                <input type="number" name="salary" value="<?php echo $salary ?>" class="form-control" placeholder="Salary">
            </div>
           
            <div class="form-group">
                <label for="exampleInputPassword1">Image</label>
                <input type="file" name="image" class="form-control" placeholder="Image ">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Department</label>
                <br>
                <select name="deprtment">
                    <?php
                    $department = "SELECT * FROM  `department` "; // query 
                    $department =  mysqli_query($conn, $department); // run qury 

                    foreach ($department as $depart) { ?>
                        <option value="<?php echo $depart['id'] ?>">
                            <?php echo $depart['name'] ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <?php if ($update == "false") : ?>
                <button type="submit" name="send" class="btn btn-primary btn-lg btn-block">Save</button>
            <?php else : ?>
                <button name="update" class="btn btn-info btn-lg btn-block">Update</button>
            <?php endif; ?>

        </form>
    </div>
</body>

</html>