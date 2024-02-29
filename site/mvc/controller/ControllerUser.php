<?php
    require_once FILE::build_path(array('view','view.php'));
    require_once FILE::build_path(array('model','UserModel.php'));
    class ControllerUser {

        //variable of the view to generate
        private $_view;

        public function __construct() {        
        }

        public function readAll() {
            $this->_view = new View(array('view', 'user', 'viewUserList.php'));
            //Generate the view without data
            $users = UserModel::selectAll("users", "UserModel");
            $this->_view->generate(array('users'=>$users));
        }

        public function deleteUser() {
            $userIdToDelete = $_POST["user_id"];
            $this->_view = new View(array('view', 'user', 'viewUserList.php'));
            UserModel::deleteUserById($userIdToDelete);
            $users = UserModel::selectAll("users", "UserModel");
            $this->_view->generate(array('users'=>$users));
        }

        public function modifyUser() {
            $user_id = $_POST["user_id"];
            $user_password = $_POST["new_user_password"];
            $user_email = $_POST["new_user_email"];
            $user_pseudo = $_POST["new_user_pseudo"];
            $user_isAdmin = isset($_POST['new_user_isAdmin']) ? 1 : 0;            
            
            $this->_view = new View(array('view', 'user', 'viewUserList.php'));
            UserModel::modifyUser($user_id, $user_password, $user_email, $user_pseudo, $user_isAdmin);
            $users = UserModel::selectAll("users", "UserModel");
            $this->_view->generate(array('users'=>$users));
        }        

        public function openViewToModifyUser() {
            $user_id = $_POST["user_id"];
            $user_password = $_POST["user_password"];
            $user_email = $_POST["user_email"];
            $user_pseudo = $_POST["user_pseudo"];
            $user_isAdmin = $_POST["user_isAdmin"];

            $this->_view = new View(array('view', 'user', 'viewModifyUser.php'));
            $this->_view->generate(array(
                'user_id'=>$user_id,
                'user_password'=>$user_password,
                'user_email'=>$user_email,
                'user_pseudo'=>$user_pseudo,
                'user_isAdmin'=>$user_isAdmin
            ));
        }
    }
?>