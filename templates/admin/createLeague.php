<?php include TEMPLATE_PATH."/admin/header.php" ?>

    <main class="admin tableview">
        <div class="container main">
            <h1>Create League</h1>
            <?php if ( isset( $_GET['status'] ) ) {
                if ($_GET['status'] == 'changesSaved') {?>
                    <div class="changesSaved"><p>Changes have been saved. <a href="admin.php?region=<?php echo $region ?>">Return to Region</a></p></div>
                <?php } }?>
            <div class="row">
                <form class="col s12" method="post" action="<?php echo TEMPLATE_PATH?>/admin/save.php?type=league&create=true" enctype="multipart/form-data">
                    <div class="row">
                        <div class="input-field col s2">
                            <input type="hidden" id="eventid" name="eventid">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="name" name="name" type="text" autocomplete="off" class="validate">
                            <label for="name">League Name</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="url" name="url" type="text" autocomplete="off" class="validate">
                            <label for="url">League URL</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="description" name="description" type="text" autocomplete="off" class="validate" length="150">
                            <label for="description">Description (Short)</label>
                        </div>
                    </div>
                    <div class="row">
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
                            <input id="prize" name="prize" type="text" autocomplete="off" class="validate">
                            <label for="prize">Prize Pool</label>
                        </div>
                        <div class="input-field col s4">
                            <input id="fee" name="fee" type="text" class="validate">
                            <label for="fee">Entry Fee</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="signups-comment" name="signups-comment" type="text" autocomplete="off" class="validate" length="150">
                            <label for="description">Signups Comment (Optional)</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="file-field input-field col s6">
                            <div class="file">
                                <span>File</span>
                                <input type="file" name="logoUpload" id="logoUpload">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="Upload a different logo (optional)">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input id="submit" name="submit" type="submit" value="Create">
                            <input id="cancel" name="cancel" type="submit" value="Cancel">
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </main>
<?php include TEMPLATE_PATH."/admin/footer.php" ?>