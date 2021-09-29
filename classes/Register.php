<?php
error_reporting(E_ERROR | E_PARSE);

include_once "./lib/Database.php";


class Register
{

    public $db;
    public $per_page = 5;
    public $start = 0;

    public function __construct()
    {
        $this->db = new Database();
    }

    function save_user($data, $file)
    {
        $name = $data["name"];
        $email = $data["email"];
        $age = $data["age"];
        $image = $file;
        $gender = $data["gender"];
        $hobby = $data["hobby"];
        $address = $data["address"];

        if (empty($name) || empty($email) || empty($age) || empty($image) || empty($gender) || empty($hobby) || empty($address)) {
            $msg = "Field must not be empty";
            return $msg;
        } else {
            $query = "INSERT INTO `users`(`name`, `email`, `age`, `picture`, `gender`, `hobby`, `address`) VALUES ('$name', '$email', '$age',   '$image','$gender', '$hobby', '$address')";
            $result = $this->db->insert($query);
            if ($result) {
                $msg = "User registration successfull";
                return $msg;
            } else {
                $msg = "Registration failed";
                return $msg;
            }
        }
    }

    public function fetchUser()
    {
        $query = "SELECT * FROM  users ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function fetchUserById($id)
    {
        $query = "SELECT * FROM  users WHERE id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }


    public function update_user($data, $file, $id)
    {
        $name = $data["name"];
        $email = $data["email"];
        $age = $data["age"];
        $gender = $data["gender"];
        $hobby = $data["hobby"];
        $address = $data["address"];
        $uploadDir = "upload/";
        $fileName = basename($file['image']['name']);
        $uploadFile = $uploadDir . $fileName;

        // echo "$name, $email, $uploadFile, $address";

        if (empty($name) || empty($email) || empty($age) || empty($gender) || empty($hobby) || empty($address)) {
            $msg = "Field must not be empty";
            return $msg;
        } else {
            if (!$file) {
                $uploadDir = "upload/";
                $fileName = basename($file['image']["name"]);
                $uploadFile = $uploadDir . $fileName;  //basename($_FILES['image']["name"]);
                move_uploaded_file($file["image"]["tmp_name"], $uploadFile);
            }

            $query = "UPDATE `users` SET `name`='$name',`email`='$email',`age`='$age',`picture`='$uploadFile',`gender`='$gender',`hobby`='$hobby',`address`='$address' WHERE id = $id";
            $result = $this->db->update($query);

            if ($result) {
                $msg = "User update successfull";
                return $msg;
            } else {
                $msg = "Update failed";
                return $msg;
            }
        };
    }

    public function deletUserById($id)
    {
        $image_query = "SELECT * FROM `users` WHERE id='$id'";
        $query =  "DELETE FROM `users` WHERE id=$id";
        $img_res = $this->db->select($image_query);
        if ($img_res) {
            while ($row = mysqli_fetch_assoc($img_res)) {
                $image = $row['picture'];
                unlink($image);
            }
        }
        $result = $this->db->delete($query);
        if ($result) {
            $msg = "User deleted successfully";
            return $msg;
        } else {
            $msg = "Delete failed";
            return $msg;
        }
    }

    public function searchByName($name)
    {
        $query = "SELECT * FROM `users`
        WHERE 'name' LIKE '%{$name}%'";
        $result = $this->db->search($query);
        return $result;
    }
}
