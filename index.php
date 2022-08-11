<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<div class="continer-fluid ">
    <nav class="navbar navbar-expand-lg navbar-dark bg-black ">
        <div class="container-fluid">
            <div class="collapse navbar-collapse  id=" navbarSupportedContent>
                <ul class="navbar-nav me-auto mb-2 mb-lg-2 ">
                    <a class="navbar-brand" href="#">Office Zone Admin Dashboard</a>
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Tables
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#" onclick="">Another action </a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
</div>

<body>

    <?php require_once 'proces.php'; ?>

    <?php
    if (isset($_SESSION['msg'])) : ?>
        <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
            <?php
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
            ?>
        </div>
    <?php endif; ?>

    <div class="container">
        <?php
        $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM data") or die(mysqli_error($mysqli));
        ?>

        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <?php
                while ($row = $result->fetch_assoc()) : ?>
                    <tbody>
                        <tr>
                            <td><?php echo $row['name']; ?> </td>
                            <td><?php echo $row['location']; ?> </td>
                            <td>
                                <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                                <a href="index.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
            </table>
        </div>

        <?php
        if ($updat == true) :
        ?>
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#myModal">Click here to Update details</button>
            <div class="modal" id="myModal">
            <?php else : ?>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Add</button>
                <div class="modal" id="myModal">
                <?php endif; ?>

                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Dialog</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form action="proces.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <div class="mb-3">
                                    <Label>Name</Label>
                                    <input class="form-control" type="text" name="name" value="<?php echo $name; ?>" placeholder="Enter your name">
                                </div>
                                <div class="mb-3">
                                    <Label>Location</Label>
                                    <input class="form-control" type="text" name="location" value="<?php echo $location; ?>" placeholder="Enter your location">
                                </div>
                                <div class="modal-footer">
                                    <?php
                                    if ($updat == true) :
                                    ?>
                                        <button class="btn btn-info" type="submit" name="update">Update</button>
                                    <?php else : ?>
                                        <button class="btn btn-primary" type="submit" name="save">Save</button>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>



</body>

</html>