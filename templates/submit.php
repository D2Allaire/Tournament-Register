<?php include TEMPLATE_PATH."/header.php" ?>

<main class="contact">
    <div class="container">
        <div class="container-thin main">
            <h1>Submit a Tournament</h1>
            <div class="row">
                <div id="form-message" class="container col s12"></div>
                <form class="col s12" id="ajax-submit" method="post" action="<?php echo TEMPLATE_PATH?>/submit_event.php" enctype="multipart/form-data">
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="name" name="name" type="text" class="validate" autocomplete="off" required>
                            <label for="name">Tournament Name</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="url" name="url" type="text" class="validate" autocomplete="off" required>
                            <label for="url">Tournament URL</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="description" name="description" type="text" class="validate" length="150" autocomplete="off" required>
                            <label for="description">Description (Short)</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <select id="type" name="type">
                                <option value="" disabled selected>Choose your option</option>
                                <option value="league">League</option>
                                <option value="tournament">Tournament</option>
                            </select>
                            <label>Tournament Type</label>
                        </div>
                        <div class="input-field col s4">
                            <select id="region" name="region">
                                <option value="" disabled selected>Choose your option</option>
                                <?php
                                $regions = Region::getList(10);
                                foreach ($regions as $value) {
                                    echo "<option value='".$value->getID()."'>".$value->getRegion()."</option>\r\n";
                                }
                                ?>
                            </select>
                            <label>Region</label>
                        </div>
                        <div class="input-field col s4">
                            <select id="signups" name="signups">
                                <option value="" disabled selected>Choose your option</option>
                                <option value="1">Open</option>
                                <option value="0">Closed</option>
                            </select>
                            <label>Signups</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <input id="prize" name="prize" type="text" class="validate" autocomplete="off" required>
                            <label for="prize">Prize Pool</label>
                        </div>
                        <div class="input-field col s4">
                            <input id="fee" name="fee" type="text" class="validate" autocomplete="off" required>
                            <label for="fee">Entry Fee</label>
                        </div>
                        <div class="input-field col s4">
                            <input id="format" name="format" type="text" class="validate" length="20" autocomplete="off" required>
                            <label for="format">Format</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="signups-comment" name="signups-comment" autocomplete="off" type="text">
                            <label for="signups-comment">Signups Comment (Optional)</label>
                        </div>
                        <div class="file-field input-field col s6">
                            <div class="btn">
                                <span>File</span>
                                <input type="file" name="logoUpload" id="logoUpload">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="Upload a tournament logo (optional)">
                            </div>
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
