<!-- Affiche tous les sujets -->

<div class="container-fluid threadsContainer">

    <div class="row threadsBar">
        <div class="col-12">
            <a href="index.php">Index</a>
        </div>
    </div>

    <div class="row threadsListTitle">
        <div class="col-12">
            General discussion
        </div>
    </div>

    <?php

    // Données de l'usager
    $userData = $donnees['userData'];

    // Sujets
    $threads = $donnees['threads'];

    foreach($threads as $thread) {

        /*

            RÉSULTAT POUR CHAQUE SUJET

            getId() => id_sujet (Id du sujet)
            getTitle() => title (Titre du sujet)
            getUsername() => nom_usager (Auteur du sujet)
            getDate() => date (Date de creation du sujet)
            getLastMessageAuthor() => lastmessage_author (nom d'utilisateur du dernier message)
            getLastMessageDate() => lastmessage_date (date du dernier message)         
            getNumOfMessages() => n_of_messages (nombre de réponses au message)   

        */

        ?>

            <div class="row threadRow">
                <div class="col-12 col-md-1 threadIcon">
                    <a href="index.php?Sujet&cmd=Lire&id=<?=$thread->getId()?>"><i class="far fa-comments" aria-hidden="true"></i></a>
                </div>
                <div class="col-12 col-md-5 text-center text-md-left">
                    <a href="index.php?Sujet&cmd=Lire&id=<?=$thread->getId()?>"><span class="threadTitle"><?=$thread->getTitle()?></span></a>
                    <br />
                    <span class="threadData">By <strong><?=$thread->getUsername()?></strong> on <?=$thread->getDate()?></span>
                </div>
                <div class="col-12 col-md-3 text-center">
                    <span class="threadMessages">Messages: <strong><?=$thread->getNumOfMessages()?></strong></span>
                </div>
                <div class="col-12 col-md-3 text-center">
                    <span class="threadLastMessageData">Last message by <strong><?=$thread->getLastMessageAuthor()?></strong> on <?=$thread->getLastMessageDate()?></span>
                </div>
                <?php
                    // Vérifie si l'utilisateur est un administrateur, puis affichez le bouton de suppression
                    if ($userData->profil_usager > 0) {
                        ?>
                            <div class="col-12 col-md-12 text-center deleteThread">
                                <a href="index.php?Sujet&cmd=Supprime&id=<?=$thread->getId()?>"><i class="fa fa-times" aria-hidden="true"></i> Delete thread</a>
                            </div>                                  
                        <?php
                    }
                ?>
            </div>

        <?php

    }

    if (!$threads) {
        ?>

            <div class="row threadRow">
                <div class="col-12 col-md-1 threadIcon">
                    <i class="far fa-comments" aria-hidden="true"></i>
                </div>
                <di v class="col-12 col-md-11 text-center text-md-left">
                    <span class="threadTitle">No threads available yet.</span>
                    <br />
                </div>
            </div>

        <?php
    }

    ?>

</div>