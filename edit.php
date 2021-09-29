<?php
include_once "classes/Register.php";
include_once "config/config.php";
echo "<br>";
$db = new Database();
echo $db->error;
$usrObj = new Register();

if (isset($_GET["id"])) {
    $id = $_GET["id"];
}else{
    $id = "";
}

if(isset($_POST["update"])){
    $updateUser = $usrObj->update_user($_POST, $_FILES, $id);
}else{
    $updateUser = "";
}

//$id = isset($_GET['id']) ? $_GET['id'] : '';

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
                            <h3 class="text-center">Update User</h3>
                        </div>
                        <div class="col-md-6">
                            <a href="index.php" class="btn btn-info float-right">User List</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <?php
                        $getUser = $usrObj->fetchUserById($id);
                        if ($getUser) {
                            while ($row = mysqli_fetch_assoc($getUser)) {
                        ?>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input name="name" type="text" class="form-control" id="name" value="<?= $row["name"] ?>" placeholder="Your name">
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input name="email" type="email" class="form-control" id="email" value="<?= $row["email"] ?>" placeholder="Your email">
                                    </div>
                                    <div class="form-group">
                                        <label for="age">Age</label>
                                        <input name="age" type="number" class="form-control" id="age" value="<?= $row["age"] ?>" placeholder="Your age">
                                    </div>
                                    <div class="form-group">
                                        <label for="file">Picture</label>
                                        <input name="image" type="file"  class="form-control-file" id="file">
                                        <img class="img-fluid p-3" src="<?= $row["picture"] ?>" alt="update-image">
                                    </div>

                                    <p>Please select your gender </p>
                                    <div class="form-check form-inline">
                                        <input class="form-check-input" type="radio" name="gender" value="<?= $row["gender"] ?>" id="male" 
                                            <?php
                                            if($row['gender']=="male"){
                                                echo"checked";
                                            }
                                            
                                            ?>

                                         >
                                        <label class="form-check-label" for="male">
                                            Male
                                        </label>
                                    </div>

                                    <div class="form-check form-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="female" value="<?= $row["gender"] ?>"
                                        <?php
                                            if($row['gender']=="female"){
                                                echo"checked";
                                            }
                                            
                                            ?>
                                        
                                        >
                                        <label class="form-check-label" for="female">
                                            Female
                                        </label>
                                    </div>
                                    <p class="mt-4"> Your hobbies </p>
                                    <div class="form-check form-inline">
                                        <input name="hobby" class="form-check-input" type="checkbox"  value="<?= $row["hobby"] ?>" id="playingFootball"
                                        <?php
                                            if($row['hobby']=="football"){
                                                echo"checked";
                                            }
                                            
                                            ?>
                                        
                                        >
                                        <label class="form-check-label" for="playingFootball">
                                            Playing Football
                                        </label>
                                    </div>
                                    <div class="form-check form-inline">
                                        <input name="hobby" class="form-check-input" type="checkbox"  value="<?= $row["hobby"] ?>" id="playingCricket"
                                        <?php
                                            if($row['hobby']=="cricket"){
                                                echo"checked";
                                            }
                                            
                                            ?>
                                        >
                                        <label class="form-check-label" for="playingCricket">
                                            Playing Cricket
                                        </label>
                                    </div>
                                    <div class="form-check form-inline">
                                        <input name="hobby" class="form-check-input" type="checkbox"  value="<?= $row["hobby"] ?>" id="visitngNewPlace"
                                        <?php
                                            if($row['hobby']=="visiting"){
                                                echo"checked";
                                            }
                                            
                                            ?>
                                        
                                        >
                                        <label class="form-check-label" for="visitngNewPlace">
                                            Visiting new places
                                        </label>
                                    </div>

                                    <div class="form-groupm mt-4">
                                        <label for="Address"> Your address</label>
                                        <textarea name="address" class="form-control"  id="address"  rows="3"><?= $row["address"] ?>"</textarea>
                                    </div>
                                    <input type="submit" class="btn btn-primary mt-3" value="Update" name="update" />
                                </form>

                        <?php
                            }
                        }
                        ?>

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