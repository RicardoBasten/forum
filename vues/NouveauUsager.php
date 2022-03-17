<div class="container-fluid window">

    <div class="row justify-content-center">
        <div class="col-11 col-md-6 windowTitle">
            Sign Up
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-11 col-md-6 windowContent">            

            <?php
                if (isset($donnees)) {
                    ?>
                        <div class="alert alert-danger" role="alert">
                            <strong>Error:</strong> <?=$donnees['error_message']?>
                        </div>
                    <?php
                }
            ?>

            <form method="post" action="index.php?Usager&cmd=NouveauUsager">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required/>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required/>
                </div>
                <div class="form-group">
                    <label for="password2">Repeat password</label>
                    <input type="password" class="form-control" id="password2" name="password2" placeholder="Password" required/>
                </div>
                <button type="submit" class="btn btn-red">Sign up</button>
            </form>
        </div>
    </div>

</div>