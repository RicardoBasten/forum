<?php

    class Controleur_Sujet extends BaseControleur
    {
        public function traite(array $params)
        {
            // Vérifie l'utilisateur
            $this->auth();

            $donnees = array();
            $vue = "";
           
            if(isset($params["cmd"])) {
                 $commande = $params["cmd"]; 
            } else {
                 //commande par défaut
                $commande = "Index";
            }
        
            //détermine la vue, remplir le modèle approprié
            switch($commande)
            {
                case "Index":
                    //afficher la page d'accueil

                    $modeleSujet = $this->obtenirDAO("Sujet");
                    $threads = $modeleSujet->obtenir_tous();

                    $donnees['threads'] = $threads;

                    $this->afficheVue("Entete");
                    $this->afficheVue("Index", $donnees);
                    $this->afficheVue("PiedDePage");               
                break;
                case "CreeSujet":
                    if (empty($_POST))
                        $this->createThreadForm();
                    else
                        $this->processCreateThreadForm();
                break;
                case "Lire":
                    if (isset($params['id']))
                        $this->readThread($params['id']);
                    else 
                        trigger_error("Invalid thread ID.");
                break;
                case "Supprime":
                    // Uniquement accès à l'administrateur
                    $this->auth(1);
                    if (isset($params['id'])) {

                        $id_sujet = $params['id'];

                        if (isset($params['confirm'])) {
                            $this->deleteThread($id_sujet);
                        } else {
                            $donnees['id_sujet'] = $id_sujet;
                            $this->afficheVue("Entete");
                            $this->afficheVue("confirmationSupprimeSujet", $donnees);
                            $this->afficheVue("PiedDePage");
                        }

                    } else {
                        trigger_error("Action invalide.");
                    }
                break;
                default:
                    trigger_error("Action invalide.");
            }
        }

        public function createThreadForm() {
            $this->afficheVue("Entete");
            $this->afficheVue("CreeSujet");
            $this->afficheVue("PiedDePage");   
        }

        public function processCreateThreadForm() {

            $title = isset($_POST['title']) ? $_POST['title'] : false;
            $message = isset($_POST['message']) ? $_POST['message'] : false;

            $error = false;

            if (!$title || !$message) {
                $error = true;
                $donnees['error_message'] = 'Please, complete all the fields.';
            } elseif (strlen($title) > 64) {
                $error = true;
                $donnees['error_message'] = 'The lenght of the title should be equal or less than 64 characters.';
            } elseif (strlen($message) > 500) {
                $error = true;
                $donnees['error_message'] = 'The lenght of the message should be equal or less than 500 characters.';
            }

            if ($title != false)
                $donnees['title'] = $title;

            if ($message != false)
                $donnees['message'] = $message;

            if (!$error) {
                // Crée sujet

                $id_usager = $_SESSION['id_usager'];

                $modeleSujet = $this->obtenirDAO("Sujet");
                $nouveauSujet= new Sujet(0, $id_usager, $title);
                $new_id = $modeleSujet->sauvegarde($nouveauSujet);

                // Sauvegarde le première message
                $modeleMessage = $this->obtenirDAO("Message");
                $nouveauMessage = new Message(0, $id_usager, '', $new_id, $title, $message);
                $modeleMessage->sauvegarde($nouveauMessage);

                // Redirige vers le dernier sujet créé
                header("Location: index.php?Sujet&cmd=Lire&id=" . $new_id);
            } else {
                $this->afficheVue("Entete");
                $this->afficheVue("CreeSujet", $donnees);
                $this->afficheVue("PiedDePage");   
            }
        }

        public function readThread($id) {
            $modeleSujet = $this->obtenirDAO("Sujet");
            $sujet = $modeleSujet->obtenir_par_id($id);

            $modeleMessage = $this->obtenirDAO("Message");
            $messages = $modeleMessage->obtenir_par_sujet($id);

            if ($sujet) {
                $donnees['sujet'] = $sujet;
                $donnees['messages'] = $messages;
                $this->afficheVue("Entete");
                $this->afficheVue("LireSujet", $donnees);
                $this->afficheVue("PiedDePage");   
            } else {
                trigger_error("Invalid thread ID.");
            }
        }

        public function deleteThread($id) {
            $modeleSujet = $this->obtenirDAO("Sujet");
            $modeleSujet->supprime($id);

            // Retour à l'index
            header("Location: index.php");
        }

    }
?>
