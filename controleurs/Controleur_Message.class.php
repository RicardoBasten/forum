<?php

    class Controleur_Message extends BaseControleur
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
                trigger_error("Action invalide.");
            }
       
            //détermine la vue, remplir le modèle approprié
            switch($commande)
            {
                case "Cree":
                    if (empty($_POST))
                        trigger_error("Action invalide.");
                    else
                        $this->processNewMessage($params);
                break;
                default:
                    trigger_error("Action invalide.");
            }
        }

        public function processNewMessage($params) {

            $title = isset($_POST['title']) ? $_POST['title'] : false;
            $message = isset($_POST['message']) ? $_POST['message'] : false;

            if (isset($params['id_sujet']))
                $id_sujet = $params['id_sujet'];
            else 
                trigger_error("Invalid thread ID.");

            $error = false;

            if (!$message) {
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
                // Envoie le message

                $id_usager = $_SESSION['id_usager'];

                $modeleMessage = $this->obtenirDAO("Message");
                $nouveauMessage = new Message(0, $id_usager, '', $id_sujet, $title, $message);
                $modeleMessage->sauvegarde($nouveauMessage);             

                // Redirect to the thread
                header("Location: index.php?Sujet&cmd=Lire&id=" . $id_sujet);
            } else {
                $donnees['id_sujet'] = $id_sujet;

                $this->afficheVue("Entete");
                $this->afficheVue("MessageError", $donnees);
                $this->afficheVue("PiedDePage");   
            }
        }

    }
?>
