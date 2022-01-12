<?php
class UsersController
{
    private $conn;
    public function __construct($db)
    {
        $this->conn = $db->getConnect();
    }

    public function index()
    {
        include_once 'app/Models/UserModel.php';

        // отримання користувачів
        $users = (new User())::all($this->conn);

        include_once 'views/users.php';
    }

    public function addForm(){
        include_once 'views/addUser.php';
    }




    public function add()
    {
        include_once 'app/Models/UserModel.php';
        $target_dir = "public/uploads/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        $filePath = '';
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            $filePath = $target_dir . basename($_FILES["photo"]["name"]);
        }
        if($filePath==null){
            $filePath="public/uploads/1.jpg";
        }

        // блок з валідацією
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (trim($name) !== "" && trim($email) !== "" && trim($gender) !== "") {
            // додати користувача
            $user = new User($name, $email, $gender,$filePath,$password);
            $user->add($this->conn);
        }
        header('Location: ?controller=users');
    }

    public function delete() {
        include_once 'app/Models/UserModel.php';
        // блок з валідацією
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (trim($id) !== "" && is_numeric($id)) {
            (new User())::delete($this->conn, $id);
        }
        header('Location: ?controller=users');
    }


    public function show(){
        include_once 'app/Models/UserModel.php';
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (trim($id) !== "" && is_numeric($id)) {
            $user= (new User())::byId($this->conn, $id);
        }
        include_once 'views/showUser.php';
    }

    public function edit(){
        include_once 'app/Models/UserModel.php';

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password= filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


        $path=(new User())::byId($this->conn,$id);
        $target_dir = "public/uploads/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        $filePath='';
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            $filePath = $target_dir . basename($_FILES["photo"]["name"]);
        }
        if($filePath==null){
            $filePath=$path['path_to_img'];
        }

        $data=['name'=>$name,'email'=>$email,'gender'=>$gender,'path_to_img'=>$filePath,'password'=>$password];
        if (trim($id) !== "" && is_numeric($id)) {
            (new User())::update($this->conn, $id,$data);
        }

        if($_SESSION==true){
            $user= (new User())::byId($this->conn, $id);
        }

        include_once 'views/users.php';
    }



}

