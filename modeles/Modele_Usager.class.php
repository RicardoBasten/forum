<?php
    class Modele_Usager extends BaseDAO
    {
        public function getNomTable()
        {
            return "usager";
        }

        public function getClePrimaire()
        {
            return "id_usager";
        }

        public function obtenir_par_id($id)
        {
            $resultats = parent::obtenir_par_id($id);
            $resultats->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Usager");
            $usager = $resultats->fetch();
            return $usager;
        }

        public function obtenir_par_nom($nom)
        {
            $resultats = parent::obtenir_par_field('nom_usager', $nom);
            $resultats->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Usager");
            $usager = $resultats->fetch();
            return $usager;
        }

        public function sauvegarde(Usager $usager)
        {
            // Add new user
            $requete = "INSERT INTO usager(nom_usager, password, profil_usager) VALUES (:n,:p,:l)";
            $requetePreparee = $this->db->prepare($requete);
            $nom_usager = $usager->getUsername();
            $password = $usager->getPassword();
            $level = $usager->getLevel();
            $requetePreparee->bindParam(":n", $nom_usager);
            $requetePreparee->bindParam(":p", $password);
            $requetePreparee->bindParam(":l", $level);
            $requetePreparee->execute();
        }

    }

?>