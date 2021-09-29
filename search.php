<?php
include_once "classes/Register.php";

$register = new Register();

$searchedUser;


if (isset($_POST["submit"])) {
    $name = $_POST['string'];
    
    if (!$searchedUser) {
        echo "User not found";
    } else {
        $searchedUser = $register->searchByName(strtolower($name));
        echo $searchedUser;
    }
} else {
    $name = "";
}

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
    <title>Title</title>
</head>

<body>
    <div class="container">
        <table  class="table border">
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
                </tr>
            </thead>

            <?php
            if ($searchedUser) {
                while ($row = mysqli_fetch_assoc($searchedUser)) {


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
        </table>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>

</html>