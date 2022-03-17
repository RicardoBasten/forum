<?php

    class Usager
    {
        private $id;
        private $username;
        private $password;
        private $level;

        public function __construct($id = 0, $username = '', $password = '', $level = '')
        {
            $this->id = $id;
            $this->username = $username;
            $this->password = $password;
            $this->level = $level;
        }

        public function getId()
        {
            return $this->id;
        }

        public function getUsername()
        {
            return $this->username;
        }

        public function getPassword()
        {
            return $this->password;
        }

        public function getLevel()
        {
            return $this->level;
        }

    }

?>