<?php
include '../genral/configDatabBase.php';

include '../genral/nav.php';

if (isset($_POST['adminLogin'])) {
    $name = $_POST['name'];
    $pass = $_POST['pass'];
    $select = "SELECT * FROM  `admin` WHERE name = '$name'  and password = '$pass' ";  // query 
    $select =  mysqli_query($conn, $select); // run qury 

    $q = mysqli_num_rows($select);

    if ($q > 0) {
        $_SESSION['admin'] = $name;
        header('location:/start/hrSytem/employees/listdata.php');
    } else {
        echo "not admin";
    }
}


if (isset($_POST['HRlogin'])) {
    $name = $_POST['name'];
    $id = $_POST['id'];
    // $select = "SELECT * FROM  `employees`";  // query 
    // query "
    $select = "SELECT * , department.name as Dname  FROM  department JOIN employees ON 
      department.id = employees.depart WHERE employees.id = $id and employees.name = '$name' ";
      
    $select =  mysqli_query($conn, $select); // run qury 
    $row = mysqli_fetch_assoc($select);
    $q = mysqli_num_rows($select);
    if ($q > 0) {
        if ($row['Dname'] == 'HR') {
            $_SESSION['HR'] = $name;
            header('location:/start/hrSytem/employees/listdata.php');
        }
    } else {
        echo "you are not HR member";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<body>

    <div class="container col-md-6 text-center mt-5">
        <nav style="margin:auto ;width:50%">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Admin</a>
                <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">HR employee</a>
            </div>
        </nav>
        <div class="tab-content mt-5" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <form method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">User Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="password" name="pass" class="form-control" placeholder="Password">
                    </div>
                    <button name="adminLogin" class="btn btn-info btn-lg btn-block">Admin Login </button>
                </form>

            </div>



            <div class="tab-pane fade mt-5" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <form method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">User Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">ID</label>
                        <input type="text" name="id" class="form-control" placeholder="Employee ID">
                    </div>
                    <button name="HRlogin" class="btn btn-primary btn-lg btn-block">HR Login </button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>