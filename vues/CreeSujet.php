<div class="container-fluid window">

    <div class="row justify-content-center">
        <div class="col-11 col-md-6 windowTitle">
            Create a new thread
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-11 col-md-6 windowContent">            

            <?php
                if (isset($donnees['error_message'])) {
                    ?>
                        <div class="alert alert-danger" role="alert">
                            <strong>Error:</strong> <?=$donnees['error_message']?>
                        </div>
                    <?php
                }
                // Recupere le message ou le title ou case où le message a un erreur
                
                $title = isset($donnees['title']) ? $donnees['title'] : '';
                $message = isset($donnees['message']) ? $donnees['message'] : '';
            ?>

            <form method="post" action="index.php?Sujet&cmd=CreeSujet">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Insert a title for the thread (less than 64 characters)" value="<?=$title?>" required/>
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea class="form-control" id="message" name="message" rows="3" placeholder="Write a message"><?=$message?></textarea>
                </div>

                <button type="submit" class="btn btn-red">Create thread</button>
            </form>
        </div>
    </div>

</div>