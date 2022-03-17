<?php

    class Message
    {
        private $id;
        private $id_usager;
        private $nom_usager;
        private $id_sujet;
        private $message_title;
        private $message;
        private $date;

        public function __construct($id = 0, $id_usager = '', $nom_usager = '', $id_sujet = '', $message_title = '', $message = '', $date = '')
        {
            $this->id = $id;
            $this->id_usager = $id_usager;
            $this->nom_usager = $nom_usager;
            $this->id_sujet = $id_sujet;
            $this->message_title = $message_title;
            $this->message = $message;
            $this->date = $date;
        }

        public function getId()
        {
            return $this->id;
        }

        public function getUserId() {
            return $this->id_usager;
        }

        public function getUsername()
        {
            return $this->nom_usager;
        }

        public function getSujet() {
            return $this->id_sujet;
        }

        public function getTitle()
        {
            return $this->message_title;
        }

        public function getMessage()
        {
            return $this->message;
        }

        public function getDate() {
            return $this->date;
        }

    }

?>