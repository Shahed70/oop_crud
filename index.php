<?php

include_once "classes/Register.php";
$register = new Register();
$allUsers = $register->fetchUser();

$numOfRow = mysqli_num_rows($allUsers);
// echo $numOfRow;

if (isset($_GET['delUser'])) {
    $id = $_GET['delUser'];
    $deleteUser = $register->deletUserById($id);
}


$record = $numOfRow;
$pagination = ceil($record / $register->per_page);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <title>Title</title>
</head>

<body>

    <div class="container py-5 px-2">
        <div class="row ">
            <div class="col-md-4 offset-md-4 ">
                <form action="search.php" method="POST" class="d-flex">
                    <input type="search" class="form-control" name="string" value="" />
                    <input type="submit" class="btn btn-info" name="submit" required>
                </form>
                <!-- <a href="search.php">Search</a> -->
            </div>
        </div>
        <div class="row d-flex justify-content-between">
            <div class="col-md-6">
                <h3>All User info</h3>
            </div>
            <div class="col-md-6">
                <a href="addUser.php" class="btn btn-info float-right">Add New User</a>
            </div>
        </div>
        <table class="table border" id="datatableId">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Age</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Hobby</th>
                    <th scope="col">Address</th>
                    <th class="float-right" scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                if ($allUsers) {
                    while ($row = mysqli_fetch_assoc($allUsers)) {
                ?>

                        <tr>
                            <td><?= $row["id"] ?></td>
                            <td><?= $row["name"] ?></td>
                            <td><?= $row["email"] ?></td>
                            <td><?= $row["age"] ?></td>
                            <td> <img class="img-fluid w-50 h-50" src='<?= $row["picture"] ?>' alt="img"></td>
                            <td><?= $row["gender"] ?></td>
                            <td><?= $row["hobby"] ?></td>
                            <td><?= $row["address"] ?></td>
                            <td>
                                <a href="edit.php?id=<?= $row['id'] ?>" onclick="editUser(<?= $row['id'] ?>)" class="btn btn-warning btn-block">Edit</a>
                            </td>
                            <td> <a href="?delUser=<?= $row['id'] ?>" onclick="confirm('Are you sure you want to delete')" class="btn btn-danger btn-block">Delete</a></td>
                        </tr>
                <?php

                    }
                }
                ?>



            </tbody>
        </table>

        <nav aria-label="...">
            <ul class="pagination pagination">
                <?php
                for ($i = 1; $i <= $pagination; $i++) { ?>
                    <li class="page-item active" aria-current="page">
                        <span class="page-link"><?= $i ?></span>
                    </li>

                <?php
                }
                ?>
            </ul>
        </nav>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#datatableId').DataTable();
        });
    </script>
</body>

</html>