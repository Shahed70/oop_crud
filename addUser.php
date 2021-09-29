<?php
include_once "classes/Register.php";
include_once "config/config.php";
echo "<br>";
$db = new Database();
echo $db->error;
$usrObj = new Register();

if (isset($_POST["submit"])) {
    $data = $_POST;
    $uploadDir = "upload/";
    $fileName = basename($_FILES['image']["name"]);
    $uploadFile = $uploadDir . $fileName;  //basename($_FILES['image']["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $uploadFile);
    $usrObj->save_user($data, $uploadFile);
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
        <div class="row">
            <div class="col-md-6 offset-md-3 col-sm-12">

                <div class="card p-4">
                    <div class="row d-flex justify-content-between">
                        <div class="col-md-6">
                        <h3 class="text-center">User resigtration</h3>
                        </div>
                        <div class="col-md-6">
                            <a href="index.php" class="btn btn-info float-right">User List</a>
                        </div>
                    </div>
                  
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input name="name" type="text" class="form-control" id="name" placeholder="Your name">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input name="email" type="email" class="form-control" id="email" placeholder="Your email">
                            </div>
                            <div class="form-group">
                                <label for="age">Age</label>
                                <input name="age" type="number" class="form-control" id="age" placeholder="Your age">
                            </div>
                            <div class="form-group">
                                <label for="file">Picture</label>
                                <input name="image" type="file" class="form-control-file" id="file">
                            </div>

                            <p>Please select your gender </p>
                            <div class="form-check form-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                                <label class="form-check-label" for="male">
                                    Male
                                </label>
                            </div>

                            <div class="form-check form-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="female">
                                <label class="form-check-label" for="male">
                                    Female
                                </label>
                            </div>
                            <p class="mt-4"> Your hobbies </p>
                            <div class="form-check form-inline">
                                <input name="hobby" class="form-check-input" type="checkbox" value="football" id="football">
                                <label class="form-check-label" for="football">
                                    Playing Football
                                </label>
                            </div>
                            <div class="form-check form-inline">
                                <input name="hobby" class="form-check-input" type="checkbox" value="cricket" id="cricket">
                                <label class="form-check-label" for="cricket">
                                    Playing Cricket
                                </label>
                            </div>
                            <div class="form-check form-inline">
                                <input name="hobby" class="form-check-input" type="checkbox" value="visiting" id="newplace">
                                <label class="form-check-label" for="newplace">
                                    Visiting new places
                                </label>
                            </div>

                            <div class="form-groupm mt-4">
                                <label for="Address"> Your address</label>
                                <textarea name="address" class="form-control" id="address" rows="3"></textarea>
                            </div>
                            <input type="submit" class="btn btn-primary mt-3" value="Submit" name="submit" />
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>

</html>