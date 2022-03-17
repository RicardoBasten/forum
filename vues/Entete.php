<?php

if (isset($donnees['userData'])) {
    $userData = $donnees['userData'];
}

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Forum</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="css/style.css">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet"> 

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">   

    </head>
    <body>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12 header">
                    Forum! <i class="fa fa-cat"></i>
                </div>
            </div>

            <div class="row menu">
                <div class="col-12 col-md-auto">
                    <div class="row justify-content-start">
                        <div class="col-12 col-md-auto text-center text-md-left">
                            <a href="index.php"><button class="btn menuButton text-white"><i class="fa fa-home"></i> Home</button></a>
                        </div>
                        <?php
                            if (isset($userData)) {
                                ?>
                                    <div class="col-12 col-md-auto text-center text-md-left">
                                        <a href="index.php?Sujet&cmd=CreeSujet"><button class="btn menuButton text-white"><i class="fa fa-edit"></i> New thread</button></a>
                                    </div>    
                                <?php
                            }
                        ?>
                    </div>
                </div>

                <!-- User buttons -->
                <div class="col">
                    <div class="row justify-content-end">

                        <?php

                        if (isset($userData)) {
                            ?>  
                                <div class="col-12 col-md-auto text-center text-md-right">
                                    <a href="index.php?Usager&cmd=Logout"><button class="btn menuButton text-white"><i class="fa fa-sign-in-alt"></i> Logout</button></a>
                                </div>                        
                            <?php
                        } else {
                            ?>
                                <div class="col-12 col-md-auto text-center text-md-right">
                                    <a href="index.php?Usager&cmd=NouveauUsager"><button class="btn menuButton text-white"><i class="fa fa-sign-in-alt"></i> Sign up</button></a>
                                </div>
                                <div class="col-12 col-md-auto text-center text-md-right">
                                    <a href="index.php?Usager&cmd=Login"><button class="btn menuButton text-white"><i class="fa fa-user"></i> Login</button></a>
                                </div>     
                            <?php
                        }

                        ?>  

                    </div>
                </div>
                <!-- End user buttons -->  

            </div>
            <?php
                if (isset($userData)) {
                    ?>
                        <div class="row text-right">
                            <div class="col-12 welcomeUserBar">
                                Welcome, <strong><?=$userData->nom_usager?>!</strong>
                            </div>
                        </div>
                    <?php
                }
            ?>
        </div>