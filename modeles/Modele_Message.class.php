<?php
    class Modele_Message extends BaseDAO
    {
        public function getNomTable()
        {
            return "message";
        }

        public function getClePrimaire()
        {
            return "id_message";
        }

        public function obtenir_par_id($id)
        {
            $resultats = parent::obtenir_par_id($id);
            $resultats->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Message");
            $message = $resultats->fetch();
            return $message;
        }

        public function obtenir_tous()
        {
            $resultats = parent::obtenir_tous();
            $messages = $resultats->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Message");
            return $messages;
        }

        public function obtenir_par_sujet($id)
        {
            $requete = "SELECT * FROM message INNER JOIN usager USING(id_usager) WHERE id_sujet = :id ORDER BY date ASC";
            $requetePreparee = $this->db->prepare($requete);
            $requetePreparee->bindParam(":id", $id);
            $requetePreparee->execute();

            $messages = $requetePreparee->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Message");
            return $messages;
        }

        public function sauvegarde(Message $message)
        {
            // Add new message
            $requete = "INSERT INTO message(id_usager, id_sujet, message_title, message) VALUES (:a,:s,:t,:m)";
            $requetePreparee = $this->db->prepare($requete);
            $id_usager = $message->getUserId();
            $id_sujet = $message->getSujet();
            $message_title = $message->getTitle();
            $message = $message->getMessage();
            $requetePreparee->bindParam(":a", $id_usager);
            $requetePreparee->bindParam(":s", $id_sujet);
            $requetePreparee->bindParam(":t", $message_title);
            $requetePreparee->bindParam(":m", $message);
            $requetePreparee->execute();

            return $this->db->lastInsertId();
        }

    }

?>