<?php
    require_once FILE::build_path(array('view','view.php'));
    require_once FILE::build_path(array('model','UserHistoryModel.php'));
    require_once FILE::build_path(array('model','DailyMovieModel.php'));
    require_once FILE::build_path(array('model','UserModel.php'));

    class ControllerUserHistory {

        public static function createUserHistory() {
            if (isset($_SESSION["pseudo"])) {
                
                $pseudo_user = $_SESSION["pseudo"];
                $user = UserModel::getUserByPseudo($pseudo_user)[0];
                $today_date = date('Y-m-d');
                $daily_movie = DailyMovieModel::getTodayDailyMovie($today_date);
                $success=false;
                if (isset($_COOKIE["success"])){
                    $success = $_COOKIE["success"];
                    // convert from string to boolean
                    if ($success == 'true') {
                        $success = true;
                    } else {
                        $success = false;
                    }
                }
               
                $hasPlayedToday = UserHistoryModel::hasPlayedToday($user->getId(),$daily_movie->getId());
                if ($hasPlayedToday==false) {
                    //if no user history then create one             
                    UserHistoryModel::createUserHistory($user->getId(), $daily_movie->getId(), 0, $success);
                } 
            }
        }
        //Add a try
        public static function updateUserTry(){
            if(isset($_SESSION["pseudo"])){
                $pseudo_user=$_SESSION["pseudo"];
                $user = UserModel::getUserByPseudo($pseudo_user)[0];
                
                $today_date = date('Y-m-d');
                $daily_movie = DailyMovieModel::getTodayDailyMovie($today_date);
                $success = $_COOKIE["success"];
                // convert from string to boolean
                if ($success == 'true') {
                    $success = true;
                } else {
                    $success = false;
                }
                $userHistory = UserHistoryModel::hasPlayedToday($user->getId(),$daily_movie->getId());
                $todayUserHistory =$userHistory->getDailyUserHistory($daily_movie->getId());
                UserHistoryModel::updateTryNumberAndSuccess($user->getId(), $daily_movie->getId(), $todayUserHistory->getTryNumber() + 1, $success);
            }   
        }

        public static function getDailyUserHistory(){
            
            $pseudo_user=$_SESSION["pseudo"];
            $user = UserModel::getUserByPseudo($pseudo_user)[0];
            $userHistory = UserHistoryModel::getUserHistoryByUser($user->getId())[0];
            $id_date = DailyMovieModel::getTodayDailyMovie(date('Y-m-d'))->getId();
            return $userHistory->getDailyUserHistory($id_date);
        }

        //Set Nb Tries on a sessionVariable
        public function setNbTriesAsSessionVariable(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nbTries'])) {
                $_SESSION['nbTries'] = (int)$_POST['nbTries'];
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Paramètre nbTries manquant']);
            }
        }

        //Get the Nb Tries on the sessionVariable
        public function getNbTries(){
            if(!isset($_SESSION['pseudo'])){
                if (isset($_SESSION['nbTries'])) {
                    echo json_encode(['status' => 'success', 'nbTries' => $_SESSION['nbTries']]);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'nbTries non défini']);
                }
            }
            else{
                $userHistory = ControllerUserHistory::getDailyUserHistory();
                $tryNumber=$userHistory->getTryNumber();
                echo json_encode(['status' => 'success', 'nbTries' => $tryNumber]);
            }
        }
    }
?>