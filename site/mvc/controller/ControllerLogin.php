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
        if(isset($_POST["pseudo"]) && isset($_POST["password"])) {
            $pseudo = $_POST["pseudo"];
            $password = $_POST["password"];
            // Récupérer l'utilisateur correspondant au pseudo
            $users = UserModel::getUserByPseudo($pseudo);
            // Vérifier si l'utilisateur existe
            if(!empty($users)) {
                $user = $users[0];
    
                // Vérifier si le mot de passe correspond
                if(password_verify($password, $user->getPassword())) {
                    // Mot de passe valide, connecter l'utilisateur
                    $this->createSession($pseudo, $user->getPassword());
                    $this->connected();
                } else {
                    // Mot de passe invalide, afficher la vue de connexion
                    $this->signInView();
                }
            } else {
                // Utilisateur inexistant, afficher la vue de connexion
                $this->signInView();
            }
        } else {
            // Les champs pseudo et mot de passe n'ont pas été envoyés, afficher la vue de connexion
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
        
        $this->_view = new View(array('view','login','viewResetPassword.php'));
        //Generate the view without data
        $this->_view->generate(array(null));
    }

    public function sendEmail() {

        $email = $_POST['email'];
        $users = UserModel::getUserByEmail($email);
        if($users==null) {
            echo("email non reconnu");
            return;
        }
        $user = $users[0];
        $current_date = date('Y-m-d H:i:s'); // Obtenir la date et l'heure actuelles
        $random_string = bin2hex(random_bytes(16)); // Générer une chaîne de caractères aléatoire
        $token_data =  $user->getId() . $current_date . $random_string . $email;
        $token = hash('sha256', $token_data);

        UserModel::updateUserToken($user->getId(), $token, $current_date);
        $this->_view = new View(array('view','login','viewMail.php'));
        //Generate the view without data
        $this->_view->generate(array('token'=>$token, 'email'=>$email));
    }


    function generatePrivateKey($email) {
        // Générer une clé privée en concaténant l'email et la date actuelle
        $privateKey = $email . "_" . date("Y-m-d H:i:s");
    
        // Ajouter un timestamp pour l'expiration après 20 minutes
        $expirationTimestamp = time() + (20 * 60);
        $privateKey .= "_" . $expirationTimestamp;
    
        // Hasher la clé privée pour plus de sécurité
        $hashedKey = hash("sha256", $privateKey);
    
        return $hashedKey;
    }
    
    public function updatePassword(){
        $email = $_POST['email'];
        $users = UserModel::getUserByEmail($email);
    
        if($users==null){
            echo("email non reconnu");
            return;
        }
        $user = $users[0];
        //If confirm password not same as new password, abort
        if($_POST['newPassword']!=$_POST['confirmPassword']){
            echo("Mot de passe non identique");
            return;
        }

        if($_POST['token']!=$user->getToken()){
            echo("Token incorrect");
            return;
        }
        
        // Récupérer la dernière date et heure de demande de token de l'utilisateur
        $lastRequestedDate = $user->getLastRequestedDate();

        // Créer un objet DateTime pour la dernière date et heure de demande de token
        $lastRequestedDateTime = new DateTime($lastRequestedDate);
        // Ajouter 15 minutes à la dernière date et heure de demande de token
        $lastRequestedDateTime->add(new DateInterval('PT15M'));

        // Créer un objet DateTime pour la date et l'heure actuelles
        $currentDateTime = new DateTime();
        
        // Vérifier si la date et l'heure actuelles sont supérieures à 15 minutes après la dernière demande de token
        if ($currentDateTime > $lastRequestedDateTime) {
            // Le token a expiré
            echo("Token expiré, renouvellez votre demande de mot de passe");
            return;
        }

        //update the new password and then go back to signInView
        UserModel::updateUser($user->getId(), $_POST['newPassword'], $user->getEmail(),$user->getPseudo(), $user->getIsAdmin());
        $this->signInView();

    }
    
}
?>