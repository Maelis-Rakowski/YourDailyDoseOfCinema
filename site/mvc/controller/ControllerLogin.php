<?php
require_once FILE::build_path(array('view','view.php'));
require_once FILE::build_path(array('model','UserModel.php'));

//Pour la renitialisation du mdp
//<!-- Reset le mot de passe (private key, date de renouvellement de mdp/ lien vers changer mdp dans le mail, dans l'url je mets private key (/moodifiermdp/privatekey) si la private key). faire la différence du temps (30), faire un seed en fonction de la date. Private key email de la personne et timestamp -->
class ControllerLogin {

    //variable of the view to generate
    private $_view;

    public function __construct() {      
    }

    public function readAll() {               
        $this->signUpView();
    }

    //View for SignUp (create new user)
    public function signUpView(){

        //If the user is already connected, it shows the view connected, else signUpView
        session_start();
        if($this->checkSessionAlreadyExists()==true){
            $this->connected();
            exit;
        }

        $this->_view = new View(array('view','login','viewSignUp.php'));
        //Generate the view without data
        $this->_view->generate(array(null));
    }

    //View for SignIn (connect)
    public function signInView(){

        //If the user is already connected, it shows the view connected, else signInView
        session_start();
        if($this->checkSessionAlreadyExists()==true){
            $this->connected();
            exit;
        }
     
        $this->_view = new View(array('view','login','viewSignIn.php'));
        //Generate the view without data
        $this->_view->generate(array(null));
    }





    public function connected(){
        $this->_view = new View(array('view','login','viewConnected.php'));
        //Generate the view without data
        $this->_view->generate(array(null));
    }

    public function disconnect(){
        session_start();
        session_destroy();
        $this->signInView();
    }







    //Register
    public function signUp() {

        $email = $_POST["email"];
        $pseudo = $_POST["pseudo"];
        $password = $_POST["password"];

        UserModel::create($email,$pseudo,$password);

        $this->createSession($pseudo,$password);
        $this->connected();
    }


    //Try connect
    public function signIn(){
        $pseudo = $_POST["pseudo"];
        $password = $_POST["password"];


        //TO DO
        //TO DO
        //TO DO
        //For futur
        //$user = UserModel::getUser($pseudo,$password);

       
        //replace the condition to user!=null fot the future
        //TO DO
        //TO DO
        //TO DO

        
        if($pseudo=="logan" && $password=="logan"){


            $this->createSession($pseudo,$password);
            $this->connected();
        }
        else{
            $this->signInView();
        }
    }




    public function checkSessionAlreadyExists(){
        if(isset($_SESSION['pseudo'])){
            return true;
        }
        return false;
    }

    public function createSession($pseudo,$password){
        session_start();
        $_SESSION['pseudo'] = $pseudo ;
        $_SESSION['password'] = $password ;
    }








    public function resetPassword(){
        $this->_view = new View(array('view','login','viewConnected.php'));
        //Generate the view without data
        $this->_view->generate(array(null));
    }
}
?>