<?php include TEMPLATE_PATH."/header.php" ?>

    <main class="contact">
        <div class="container">
            <div class="container-thin main">
                <h1>Contact Us</h1>
                <div class="row">
                    <div id="form-message" class="container col s12"></div>
                    <form class="col s12" id="ajax-contact" method="post" action="<?php echo TEMPLATE_PATH?>/mail.php">
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="name" type="text"  name="name" class="validate" required>
                                <label for="name">Name</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="email" type="email" name="email" class="validate" required>
                                <label for="email">Email Address</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="message" name="message" class="materialize-textarea validate" required></textarea>
                                <label for="message">Message</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input id="submit" type="submit" value="Send">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

<?php include TEMPLATE_PATH."/footer.php" ?>