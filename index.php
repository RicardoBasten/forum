<?php
    
    require_once("config.php");

    // Session
    session_start();

    //appel du routeur
    Routeur::route();

?>