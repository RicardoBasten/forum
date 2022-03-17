<?php
    abstract class BaseControleur
    {
        public abstract function traite(array $params);

        public function afficheVue($nomVue, $donnees = null)
        {
            $cheminVue = RACINE . "vues/" . $nomVue . ".php";
            
            if(file_exists($cheminVue))
            {
                // Envoie les données de l'usager
                if (isset($this->userData)) {
                    $donnees['userData'] = $this->userData;
                }

                //n.b. le paramètre $data sera utilisé DIRECTEMENT dans la vue
                include_once($cheminVue);
            }
            else
            {
                trigger_error("La vue spécifiée est introuvable.");
            }
        }

        public function obtenirDAO($nomModele)
        {
            $classe = "Modele_" . $nomModele;

            if(class_exists($classe))
            {
                //on créé la connexion à la BD (les constantes sont dans config.php)
                $connexionPDO = DBFactory::getDB(DBTYPE, DBNAME, HOST, USER, PWD);

                //on crée une instance de la classe Modele_$nomModele
                $objetModele = new $classe($connexionPDO);

                if($objetModele instanceof BaseDAO)
                {
                    return $objetModele;
                }
                else
                    trigger_error("Modèle invalide!");  
                
            }
            else
                trigger_error("La classe $classe n'existe pas.");
        }

        public function auth($level_required = 0) {
            // Vérifie si l'utilisateur est connecté et dispose de l'autorisation requise

            if (isset($_SESSION['auth'])) {
                // L'utilisateur est connecté

                $id_usager = $_SESSION['id_usager'];
                $nom_usager = $_SESSION['nom_usager'];
                $profil_usager = $_SESSION['profil_usager'];

                if ($profil_usager < $level_required) {
                    // Le niveau requis est supérieur au niveau de l'utilisateur actuel
                    die("User not authorized");  
                } else {
                    $userData = array(
                        'auth'=>true,
                        'id_usager'=>$id_usager,
                        'nom_usager'=>$nom_usager,
                        'profil_usager'=>$profil_usager
                    );

                    $this->userData = json_decode(json_encode($userData));
                }

            } else {
                // L'utilisateur n'est pas connecté
                header("Location: index.php?Usager&cmd=Login");
            }

        }

    }

?>