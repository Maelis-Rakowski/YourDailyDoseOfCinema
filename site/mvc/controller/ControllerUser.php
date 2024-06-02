<?php
    require_once FILE::build_path(array('view','view.php'));
    require_once FILE::build_path(array('model','UserModel.php'));
    require_once FILE::build_path(array('model','UserHistoryModel.php'));
    require_once FILE::build_path(array('model','DailyMovieModel.php'));
    require_once FILE::build_path(array('model','MovieModel.php'));

    class ControllerUser {
        //variable of the view to generate
        private $_view;

        public function __construct() {      
        }

        public function details() {
            if (isset($_SESSION["pseudo"])) {
                $user = UserModel::getUserByPseudo($_SESSION["pseudo"]);
                if(!empty($user)) {
                    $user = $user[0];
                    //Récupérer le compteur d'essais du joueur
                    $userHistories = UserHistoryModel::getUserHistoryByUser($user->getId());
                    foreach ($userHistories as $userHistory) {
                        $dailyMovie = DailyMovieModel::getDailyMovieById($userHistory->getIdDailyMovie());
                        $movie = MovieModel::getMovieById($dailyMovie->getIdMovie());
                        $dailyMovie->setMovie($movie);
                        $userHistory->setDailyMovie($dailyMovie);
                    }
                    $this->_view = new View(array('view', 'user', 'viewUser.php'));
                    $this->_view->generate(array('user' => $user, 'userHistories' => $userHistories));
                } else {
                    $controllerError = new ControllerError();
                    $controllerError->show404();
                }
                
            } else {
                $controllerError = new ControllerError();
                $controllerError->show401();
            }
        }
    }