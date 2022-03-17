<div class="container-fluid window">

    <div class="row justify-content-center">
        <div class="col-11 col-md-6 windowTitle">
            Error sending the message
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-11 col-md-6 windowContent">            

            <?php
                if (isset($donnees)) {
                    ?>
                        <div class="alert alert-danger" role="alert">
                            <strong>Error:</strong> <?=$donnees['error_message']?>
                            <br /><br />
                            <a href="index.php?Sujet&cmd=Lire&id=<?=$donnees['id_sujet']?>">Go back</a>
                        </div>
                    <?php
                }
            ?>

        </div>
    </div>

</div>