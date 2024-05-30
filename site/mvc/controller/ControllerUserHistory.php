<?php
    require_once FILE::build_path(array('view','view.php'));
    require_once FILE::build_path(array('model','UserHistoryModel.php'));
    require_once FILE::build_path(array('model','DailyMovieModel.php'));
    require_once FILE::build_path(array('model','UserModel.php'));


    class ControllerUserHistory {
        //Create a history for the dailymovie
        public static function createUserHistory() {
            $pseudo_user=$_SESSION["pseudo"];
            $user = UserModel::getUserByPseudo($pseudo_user)[0];
            $today_date = date('Y-m-d');
            $daily_movie = DailyMovieModel::getTodayDailyMovie($today_date);

            $hasPlayedToday = UserHistoryModel::hasPlayedToday($user->getId(),$daily_movie->getId());
            if ($hasPlayedToday==false) {
                //if no user history then create one
                //TO-DO handle movie found in COOKIE                
                UserHistoryModel::createUserHistory($user->getId(), $daily_movie->getId(), 0, false);
            } 
        }

        //Add a try
        public static function addUserTry(){
            if(!isset($_SESSION["pseudo"])) return;
            $pseudo_user=$_SESSION["pseudo"];
            $user = UserModel::getUserByPseudo($pseudo_user)[0];
            
            $today_date = date('Y-m-d');
            $daily_movie = DailyMovieModel::getTodayDailyMovie($today_date);
            
            $userHistory = UserHistoryModel::hasPlayedToday($user->getId(),$daily_movie->getId());
            $todayUserHistory =$userHistory->getDailyUserHistory($daily_movie->getId());
            UserHistoryModel::updateTryNumber($user->getId(), $daily_movie->getId(), $todayUserHistory->getTryNumber() + 1);

        }


        public static function getDailyUserHistory(){
            $pseudo_user=$_SESSION["pseudo"];
            $user = UserModel::getUserByPseudo($pseudo_user)[0];
            $userHistory = UserHistoryModel::getUserHistoryByUser($user->getId())[0];
            $id_date = DailyMovieModel::getTodayDailyMovie(date('Y-m-d'))->getId();
            return $userHistory->getDailyUserHistory($id_date);
        }

        //Set Nb Tries on a sessionVariable
        public function setNbTries(){
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