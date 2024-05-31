<?php
    require_once FILE::build_path(array('view','view.php'));
    require_once FILE::build_path(array('model','UserHistoryModel.php'));
    require_once FILE::build_path(array('model','UserModel.php'));

    class ControllerUserHistory {

        public static function createUserHistory() {
            if (isset($_SESSION["pseudo"])) {
                
                $pseudo_user = $_SESSION["pseudo"];
                $user = UserModel::getUserByPseudo($pseudo_user)[0];
                $today_date = date('Y-m-d');
                $daily_movie = DailyMovieModel::getTodayDailyMovie($today_date);

                $todayUserHistory = UserHistoryModel::getUserHistoryByDailyMovieAndUser($daily_movie->getId(), $user->getId());
                $success = $_COOKIE["success"];
                // convert from string to boolean
                if ($success == 'true') {
                    $success = true;
                } else {
                    $success = false;
                }
                if (!$todayUserHistory) {
                    //if no user history then create one
                    UserHistoryModel::createUserHistory($user->getId(), $daily_movie->getId(), 1, $success);
                } else {    
                    // else update the existing one                
                    UserHistoryModel::updateTryNumberAndSuccess($user->getId(), $daily_movie->getId(), $todayUserHistory->getTryNumber() + 1, $success);
                }
            }
        }

    }
?>