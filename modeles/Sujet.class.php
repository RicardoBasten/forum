<?php

    class Sujet
    {
        private $id_sujet;
        private $id_usager;
        private $title;
        private $nom_usager;
        private $date;
        private $lastmessage_author;
        private $lastmessage_date;
        private $n_of_messages;

        public function __construct($id_sujet = 0, $id_usager = '',  $title = '', $nom_usager = '', $date = '', $lastmessage_author = '', $lastmessage_date = '', $n_of_messages = '')
        {
            $this->id_sujet = $id_sujet;
            $this->id_usager = $id_usager;
            $this->title = $title;
            $this->lastmessage_author = $lastmessage_author;
            $this->lastmessage_date = $lastmessage_date;
            $this->n_of_messages = $n_of_messages;
        }

        public function getId()
        {
            return $this->id_sujet;
        }

        public function getUserId()
        {
            return $this->id_usager;
        }

        public function getUsername()
        {
            return $this->nom_usager;
        }

        public function getTitle()
        {
            return $this->title;
        }

        public function getDate() {
            return $this->date;
        }

        public function getLastMessageAuthor() {
            return $this->lastmessage_author;
        }

        public function getLastMessageDate() {
            return $this->lastmessage_date;
        }

        public function getNumOfMessages() {
            return $this->n_of_messages;
        }

    }

?>