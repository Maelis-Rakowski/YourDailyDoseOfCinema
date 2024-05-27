<?php
class View {
    
    private $_file;
    private $_t;

    public function __construct($arrayPath) {

        $this->_file = File::build_path($arrayPath);

    }

    //GENERE ET AFFICHE LA VUE
    public function generate($data,$generateTemplate=true) {

        //PARTIE SPECIFIQUE DE LA VUE (sans header ni footer)
        $view = $this->generateFile($this->_file, $data);
        if($generateTemplate){
            //TEMPLATE
            $template = File::build_path(array('view', 'template.php'));
            $view = $this->generateFile($template, array('t' => $this->_t, 'content' => $view));
        }
        echo $view;
       
    }

    //GENERE UN FICHIER VUE ET RENVOIE LE RESULTAT PRODUIT
    private function generateFile($file, $data) {
        if(file_exists($file)){
           
            extract($data);

            ob_start();

            //INCLUS LE FICHIER VUE
            require $file;

            return ob_get_clean();
        } else {
           
            throw new Exception('Fichier '.$file.' introuvable');
        }
    }
}