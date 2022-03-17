<?php
    class Modele_Sujet extends BaseDAO
    {
        public function getNomTable()
        {
            return "sujet";
        }

        public function getClePrimaire()
        {
            return "id_sujet";
        }

        public function obtenir_par_id($id)
        {
            $resultats = parent::obtenir_par_id($id);
            $resultats->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Sujet");
            $sujet = $resultats->fetch();
            return $sujet;
        }

        public function obtenir_tous()
        {
            /*
                Resultat de chaque sujet

                getId() => id_sujet (id du sujet)
                getTitle() => title (titre du sujet)
                getUsername() => nom_usager (auteur du sujet)
                getDate() => date (date de creation du sujet)
                getLastMessageAuthor() => lastmessage_author (dernier envoie du  usager)
                getLastMessageDate() => lastmessage_date (date de envoie du dernier message)         
                getNumOfMessages() => n_of_messages (nombre de réponses au message)   

            */

            $requete = "SELECT
                            S.*,
                            U.*,
                            (SELECT COUNT(*) FROM message WHERE id_sujet = S.id_sujet) AS n_of_messages,
                            (SELECT MAX(date) FROM message WHERE id_sujet = S.id_sujet) AS lastmessage_date,
                            (SELECT MU.nom_usager FROM
                                message MS
                                    INNER JOIN
                                usager MU
                                    ON MS.id_usager = MU.id_usager
                                WHERE MS.id_sujet = S.id_sujet
                                ORDER BY MS.date DESC
                                LIMIT 1) AS lastmessage_author
                        FROM sujet S
                        INNER JOIN usager U ON S.id_usager = U.id_usager ORDER BY lastmessage_date DESC";
            $resultats = $this->db->query($requete);            
            $usagers = $resultats->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Sujet");
            return $usagers;
        }

        public function sauvegarde(Sujet $sujet)
        {
            // Ajoute un nouveau sujet
            $requete = "INSERT INTO sujet(id_usager, title) VALUES (:u,:t)";
            $requetePreparee = $this->db->prepare($requete);
            $id_usager = $sujet->getUserId();
            $title = $sujet->getTitle();
            $requetePreparee->bindParam(":u", $id_usager);
            $requetePreparee->bindParam(":t", $title);
            $requetePreparee->execute();

            return $this->db->lastInsertId();
        }

        public function supprime($id)
        {
            // Supprime tous les messages de ce sujet
            $requete = "DELETE FROM message WHERE id_sujet =:id";
            $requetePreparee = $this->db->prepare($requete);
            $requetePreparee->bindParam(":id", $id);
            $requetePreparee->execute();

            // Supprime sujet
            $requete = "DELETE FROM sujet WHERE id_sujet =:id";
            $requetePreparee = $this->db->prepare($requete);
            $requetePreparee->bindParam(":id", $id);
            $requetePreparee->execute();
        }

    }

?>