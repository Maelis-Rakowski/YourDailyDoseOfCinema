<?php
    require_once FILE::build_path(array('view','view.php'));
    require_once FILE::build_path(array('model','UserHistoryModel.php'));
    require_once FILE::build_path(array('model','UserModel.php'));


    class ControllerUserHistory {
        public static function createUserHistory($pseudo_user) {
            $user = UserModel::getUserByPseudo($pseudo_user)[0];
            $today_date = date('Y-m-d');
            $daily_movie = DailyMovieModel::getTodayDailyMovie($today_date);

            $todayUserHistory = UserHistoryModel::getUserHistoryByDailyMovie($daily_movie->getId());
            if (!$todayUserHistory) {
                //if no user history then create one
                //TO-DO handle movie found in COOKIE 
                UserHistoryModel::createUserHistory($user->getId(), $daily_movie->getId(), 1, false);
            } else {
                UserHistoryModel::updateTryNumber($user->getId(), $daily_movie->getId(), $todayUserHistory->getTryNumber() + 1);
            }
        }

    }
?>