<?php
class IndexController
{
    private $conn;
    public function __construct($db)
    {
        $this->conn = $db->getConnect();
    }

    public function index()
    {
        // виклик відображення
        include_once 'views/home.php';
    }

    public function auth()
    {
        include_once 'app/Models/UserModel.php';
        $email=filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password=filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $_SESSION['auth']=false;
        $user['email']='not_exist';
        $user['password']='not_exist';
        $users_general = (new User())::all($this->conn);
        foreach ($users_general as $user_search){
            if($user_search['email']===$email && $user_search['password']===$password){
                $id=$user_search['id'];
                $user= (new User())::byId($this->conn, $id);
            }
        }

        if($_POST['email']!=$user['email'] || $_POST['password']!=$user['password'])
        {
            header('?controller=index');
            include_once 'views/home.php';
        }
        else
        {
            $_SESSION['auth']=true;
            $user= (new User())::byId($this->conn, $id);
            include_once 'views/users.php';
        }
    }

    public function logout(){
        session_unset();
        session_destroy();
        include_once 'views/home.php';
    }
}

