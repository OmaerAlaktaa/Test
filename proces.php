<?php

session_start();
$id = 0;
$name = '';
$location = '';
$updat = false;

$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));

if (isset($_POST['save'])) {
    //echo "Hi from Save";
    $name = $_POST['name'];
    $location = $_POST['location'];

    $_SESSION['msg'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    $mysqli->query("INSERT INTO data (name, location) VALUES('$name', '$location')")
     or die($mysqli->error);

    header("location: index.php");
}

if (isset($_GET['delete'])) {
    //echo "Hi from Delete";
    $id = $_GET['delete'];

    $mysqli->query("DELETE FROM data WHERE id=$id") or die(mysqli_error($mysqli));

    $_SESSION['msg'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    //header("location: index.php");

}

if (isset($_GET['edit'])) {
    //echo "Hi from Edit";
    $id = $_GET['edit'];
    $updat = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id = $id")
     or die(mysqli_error($mysqli));
    if (mysqli_num_rows($result) == 1) {
        $row = $result->fetch_array();
        $name = $row['name'];
        $location = $row['location'];
    }
}

if (isset($_POST['update'])) {
    //echo "Hi from Update";
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("UPDATE data SET name ='$name', location = '$location' WHERE id =$id") 
    or die(mysqli_error($mysqli));

    $_SESSION['msg'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";

    header("location: index.php");
}
