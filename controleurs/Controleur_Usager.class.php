<?php

    class Controleur_Usager extends BaseControleur
    {

        public function traite(array $params)
        {
            $donnees = array();
            $vue = "";
           
            if(isset($params["cmd"])) {
                 $commande = $params["cmd"]; 
            } else {
                 //commande par défaut
                $commande = "Login";
            }
        
            //détermine la vue, remplir le modèle approprié
            switch($commande) {
                case "Login":
                    $this->userLogin();
                break;
                case "NouveauUsager":
                    $this->signUp();
                break;
                case "Logout":
                     // Efface les données de la session.
                    $_SESSION = array();
            
                    //Si detruit la session va aussi a effacer les cookies
                    if (ini_get("session.use_cookies")) {
                        $params = session_get_cookie_params();
                        setcookie(session_name(), '', time() - 42000,
                            $params["path"], $params["domain"],
                            $params["secure"], $params["httponly"]
                        );
                    }
            
                    // Destruit la session.
                    session_destroy();
                    header("Location: index.php");
                break;                    
                default:
                    trigger_error("Action invalide.");
            }
        }

        public function userLogin() {
            if (!empty($_POST)) {
                // Envoie le formulaire

                $error = false;

                $username = isset($_POST['username']) ? $_POST['username'] : false;
                $password = isset($_POST['password']) ? $_POST['password'] : false;

                // Validation
                if (!$username || !$password) {
                    $error = true;
                    $donnees = ['error_message'=>'Please, complete all the fields.'];
                } else {
                    // Essaie le conection de l'usager

                    // Vérifiez si le nom d'utilisateur existe déjà
                    $modeleUsager = $this->obtenirDAO("Usager");
                    $usager = $modeleUsager->obtenir_par_nom($_POST['username']);

                    if (!$usager) {
                        $error = true;
                        $donnees = ['error_message'=>'The username was not found.'];
                    } elseif (!password_verify($password, $usager->getPassword())) {
                        $error = true;
                        $donnees = ['error_message'=>'The password is wrong.'];
                    }
                }              

                if (!$error) {
                    // Connection

                    // Enregistre les valeurs de la session
                    $this->setUserSession($username);

                    // Return à l'accueil
                    header("Location: index.php");
                } else {
                    // Erreurs
                    $this->afficheVue("Entete");
                    $this->afficheVue("Login", $donnees);
                    $this->afficheVue("PiedDePage");
                }
            } else {
                $this->afficheVue("Entete");
                $this->afficheVue("Login");
                $this->afficheVue("PiedDePage");
            }
        }

        public function signUp() {
            if (!empty($_POST)) {
                // Envoie le formulaire

                $error = false;

                $username = isset($_POST['username']) ? $_POST['username'] : false;
                $password = isset($_POST['password']) ? $_POST['password'] : false;
                $password2 = isset($_POST['password2']) ? $_POST['password2'] : false;

                // Validation
                if (!$username || !$password || !$password2) {
                    $error = true;
                    $donnees = ['error_message'=>'Please, complete all the fields.'];
                } elseif ($password != $password2) {
                    $error = true;
                    $donnees = ['error_message'=>'The passwords do not match.'];
                } else {
                    // Vérifie si le nom d'utilisateur existe déjà
                    $modeleUsager = $this->obtenirDAO("Usager");
                    $usager = $modeleUsager->obtenir_par_nom($_POST['username']);
                    if ($usager) {
                        $error = true;
                        $donnees = ['error_message'=>'The username already exists.'];
                    }
                }

                if (!$error) {
                    // S'inscrire
                    $modeleUsager = $this->obtenirDAO("Usager");
                    $nouveauUsager = new Usager(0, $username, password_hash($password, PASSWORD_DEFAULT), 0); // 0 = normal user
                    $modeleUsager->sauvegarde($nouveauUsager);

                    // Enregistre les valeurs de la session
                    $this->setUserSession($username);

                    // Retur à l'accueil
                    header("Location: index.php");
                } else {
                    // Erreurs
                    $this->afficheVue("Entete");
                    $this->afficheVue("NouveauUsager", $donnees);
                    $this->afficheVue("PiedDePage");
                }
            } else {
                $this->afficheVue("Entete");
                $this->afficheVue("NouveauUsager");
                $this->afficheVue("PiedDePage");
            }
        }

        public function setUserSession($nom_usager) {
            $modeleUsager = $this->obtenirDAO("Usager");
            $usager = $modeleUsager->obtenir_par_nom($nom_usager);

            $_SESSION['auth'] = true;
            $_SESSION['id_usager'] = $usager->id_usager;
            $_SESSION['nom_usager'] = $usager->nom_usager;
            $_SESSION['profil_usager'] = $usager->profil_usager; 
        }

    }
?>