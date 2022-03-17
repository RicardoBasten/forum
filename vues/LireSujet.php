<div class="container-fluid messagesContainer">

    <?php

    /*

        SUJET

        getId()
        getTitle() => title (titre du sujet)
        getUsername() => nom_usager (auteur du sujet)
        getDate() => date (date de création du sujet)
        
        MESSAGES

        getMessage() => message
        getUsername() => nom_usager (auteur)
        getDate() => date

    */


    $sujet = $donnees['sujet'];
    $messages = $donnees['messages'];

    ?>

    <div class="row threadsBar">
        <div class="col-12">
            <a href="index.php">Index</a> - <?=$sujet->getTitle()?>
        </div>
    </div>

    <div class="sujetTitle"><?=$sujet->getTitle()?></div>

    <?php

    // Reçoit le premier message
    $first_message = array_shift($messages);

    ?>

        <div class="row messageRow messageRowFirst">
            <div class="col-12 col-md-2 messageProfile">
                <?=$first_message->getUsername()?>
                <br />
                <div class="userIcon"><i class="fa fa-user-circle fa-4x" aria-hidden="true"></i></div>
            </div>
            <div class="col-12 col-md-10 messageContentWrapper">
                <div class="col-12 col-md-12 messageContent">
                        <div class="messageText">
                            <?=$first_message->getMessage()?>
                        </div>
                    <br />
                    <div class="messageDate">
                        <?=$first_message->getDate()?>
                    </div>
                </div>
            </div>
        </div>

        <div class="repliesTitle">Messages</div>

    <?php

    foreach($messages as $message) {
        ?>

            <div class="row messageRow">
                <div class="col-12 col-md-2 messageProfile">
                    <?=$message->getUsername()?>
                    <br />
                    <div class="userIcon"><i class="fa fa-user-circle fa-4x" aria-hidden="true"></i></div>
                </div>
                <div class="col-12 col-md-10 messageContentWrapper">
                    <div class="col-12 col-md-12 messageContent">
                            <div class="messageText">
                                <strong><?=$message->getTitle()?></strong>
                                <br />
                                <?=$message->getMessage()?>
                            </div>
                        <br />
                        <div class="messageDate">
                            <?=$message->getDate()?>
                        </div>
                    </div>
                </div>
            </div>

        <?php
    }

    if (!$messages) {
        ?>

        <div class="row messageRow">
            <div class="col-12 col-md-12 messageContentWrapper">
                    No messages yet.
            </div>
        </div>

        <?php
    }

    ?>

    <div class="row replyWindowRow justify-content-center">
        <div class="col-12 col-md-12 replyWindowTitle">
            Reply
        </div>
    </div>
    <div class="row replyWindowRow justify-content-center">
        <div class="col-12 col-md-12 replyWindowContent">            

            <?php
                if (isset($donnees['error_message'])) {
                    ?>
                        <div class="alert alert-danger" role="alert">
                            <strong>Error:</strong> <?=$donnees['error_message']?>
                        </div>
                    <?php
                }

                //Recupere le message ou titre au cas où le formulaire contiendrait une erreur
                $message = isset($donnees['message']) ? $donnees['message'] : '';
                $title = isset($donnees['title']) ? $donnees['title'] : '';
            ?>

            <form method="post" action="index.php?Message&cmd=Cree&id_sujet=<?=$sujet->getId()?>">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Insert a title for the message (less than 64 characters)" value="<?=$title?>" required/>
                </div>
                <div class="form-group">
                    <label for="title">Message:</label>
                    <textarea class="form-control" id="message" name="message" rows="3" placeholder="Write a message"><?=$message?></textarea>
                </div>

                <button type="submit" class="btn btn-red">Send message</button>
            </form>
        </div>
    </div>

</div>