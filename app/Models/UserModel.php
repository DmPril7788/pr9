<?php
class User {
    private $name;
    private $email;
    private $gender;
    private $path_to_img;
    private $password;

    public function __construct($name = '', $email = '', $gender = '',$path_to_img='',$password='')
    {
        $this->name = $name;
        $this->email = $email;
        $this->gender = $gender;
        $this->path_to_img=$path_to_img;
        $this->password = $password;
    }

    public function add($conn) {
        $sql = "INSERT INTO users (email, name, gender, password, path_to_img)
           VALUES ('$this->email', '$this->name','$this->gender', '$this->password', '$this->path_to_img')";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            return true;
        }
    }

    public static function all($conn) {
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql); //виконання запиту
        if ($result->num_rows > 0) {
            $arr = [];
            while ( $db_field = $result->fetch_assoc() ) {
                $arr[] = $db_field;
            }
            return $arr;
        } else {
            return [];
        }
    }


    public static function update($conn, $id, $data) {
        $sql = "UPDATE users SET email='".$data['email']."',name='".$data['name']."',gender='".$data['gender']."',password='".$data['password']."',path_to_img='".$data['path_to_img']."'  WHERE id=$id";
        $res = mysqli_query($conn,$sql);
        if($res){
            return true;
        }
    }

    public static function delete($conn, $id) {
        $sql = "DELETE FROM users WHERE id=$id";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            return true;
        }
    }

    public static function byId($conn, $id) {
        $sql = "SELECT * FROM users WHERE id=$id";
        $result = $conn->query($sql); //виконання запиту
        if ($result->num_rows > 0) {
            $arr = $result->fetch_assoc();
            return $arr;
        } else {
            return [];
        }
    }

}
