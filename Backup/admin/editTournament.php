<?php include TEMPLATE_PATH."/admin/header.php" ?>

<section id="main-content">
    <section class="wrapper">
        <h3>Edit Tournament</h3>

        <div class="row mt">
            <div class="col-md-12">
                <div class="content-panel">
                    <form method="post" action="<?php echo TEMPLATE_PATH?>/submit_event.php">
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="name" name="name" type="text" class="validate" required>
                                <label for="name">Tournament Name</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="url" name="url" type="text" class="validate" required>
                                <label for="url">Tournament URL</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="description" name="description" type="text" class="validate" length="150" required>
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
                                    <option value="1">Europe</option>
                                    <option value="2">North America</option>
                                    <option value="3">Australia</option>
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
                                <input id="prize" name="prize" type="text" class="validate" required>
                                <label for="prize">Prize Pool</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="fee" name="fee" type="text" class="validate" required>
                                <label for="fee">Entry Fee</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="format" name="format" type="text" class="validate" length="20" required>
                                <label for="format">Format</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="signups-comment" name="signups-comment" type="text">
                                <label for="signups-comment">Signups Comment (Optional)</label>
                            </div>
                            <div class="file-field input-field col s6">
                                <div class="btn">
                                    <span>File</span>
                                    <input type="file">
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
    </section>
</section>
