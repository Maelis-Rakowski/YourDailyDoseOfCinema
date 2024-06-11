<?php
    require_once FILE::build_path(array('view','view.php'));
    require_once FILE::build_path(array('model','UserModel.php'));
    class ControllerAdminUser {

        //variable of the view to generate
        private $_view;

        public function __construct() {        
        }

        public function readAll() {
            $this->_view = new View(array('view', 'admin', 'user', 'viewUserList.php'));
            //Generate the view without data
            $users = UserModel::selectAll("users", "UserModel");
            $this->_view->generate(array('users'=>$users));
        }

        public function delete() {
            $userIdToDelete = $_POST["user_id"];
            UserModel::deleteUserById($userIdToDelete);
        }

        public function modifyUser() {
            $user_id = $_POST["user_id"];
            $user_email = $_POST["new_user_email"];
            $user_pseudo = $_POST["new_user_pseudo"];
            $user_isAdmin = isset($_POST['new_user_isAdmin']) ? 1 : 0;            
            
            $this->_view = new View(array('view', 'admin', 'user', 'viewUserList.php'));
            UserModel::updateUser($user_id, $user_email, $user_pseudo, $user_isAdmin);
            $users = UserModel::selectAll("users", "UserModel");
            $this->_view->generate(array('users'=>$users));
        }        

        public function edit() {
            $user_id = $_POST["user_id"];
            $user_email = $_POST["user_email"];
            $user_pseudo = $_POST["user_pseudo"];
            $user_isAdmin = $_POST["user_isAdmin"];

            $this->_view = new View(array('view', 'admin', 'user', 'viewModifyUser.php'));
            $this->_view->generate(array(
                'user_id'=>$user_id,
                'user_email'=>$user_email,
                'user_pseudo'=>$user_pseudo,
                'user_isAdmin'=>$user_isAdmin
            ));
        }
    }
?>