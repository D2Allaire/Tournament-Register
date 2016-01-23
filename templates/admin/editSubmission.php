<?php include TEMPLATE_PATH."/admin/header.php" ?>

    <main class="admin tableview">
        <div class="container main">
            <h1>Edit Submission</h1>
            <?php if ( isset( $_GET['status'] ) ) {
                if ($_GET['status'] == 'changesSaved') {?>
                    <div class="changesSaved"><p>Changes have been saved. <a href="admin.php">Return to Dashboard</a></p></div>
                <?php } }?>
            <div class="row">
                <form class="col s12" method="post" action="<?php echo TEMPLATE_PATH?>/admin/save.php?type=submission">
                    <div class="row">
                        <div class="input-field col s2">
                            <input type="hidden" value="<?php echo $event->getID() ?>" id="eventid" name="eventid">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="name" name="name" value="<?php echo $event->getName() ?>" type="text" autocomplete="off" class="validate">
                            <label for="name">Event Name</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="url" name="url" value="<?php echo $event->getURL() ?>" type="text" autocomplete="off" class="validate">
                            <label for="url">Event URL</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="description" name="description" value="<?php echo $event->getDescription() ?>" type="text" autocomplete="off" class="validate" length="250">
                            <label for="description">Description (Short)</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <select id="eventtype" name="eventtype">
                                <option value="" disabled selected>Choose your option</option>
                                <option value="League" <?php if ($event->getType()=='League') { echo "selected='selected'"; } ?>>League</option>
                                <option value="Tournament" <?php if ($event->getType()=='Tournament') { echo "selected='selected'"; } ?>>Tournament</option>
                            </select>
                            <label>Event Type</label>
                        </div>
                        <div class="input-field col s4">
                            <select id="region" name="region">
                                <option value="" disabled selected>Choose your option</option>
                                <?php
                                $regions = Region::getList(10);
                                foreach ($regions as $value) {
                                    $select = null;
                                    if ($value->getID()==$event->getRegion()) $select = 'selected';
                                    echo "<option value='".$value->getID()."'".$select.">".$value->getRegion()."</option>\r\n";
                                }
                                ?>
                            </select>
                            <label>Region</label>
                        </div>
                        <div class="input-field col s4">
                            <select id="signups" name="signups">
                                <option value="" disabled selected>Choose your option</option>
                                <option value="1" <?php if ($event->getSignup()==1) { echo "selected='selected'"; } ?>>Open</option>
                                <option value="0" <?php if ($event->getSignup()==0) { echo "selected='selected'"; } ?>>Closed</option>
                            </select>
                            <label>Signups</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <input id="prize" name="prize" value="<?php echo $event->getPrize() ?>" type="text" autocomplete="off" class="validate">
                            <label for="prize">Prize Pool</label>
                        </div>
                        <div class="input-field col s4">
                            <input id="fee" name="fee" value="<?php echo $event->getFee() ?>" type="text" class="validate">
                            <label for="fee">Entry Fee</label>
                        </div>
                        <div class="input-field col s4">
                            <input id="format" name="format" value="<?php echo $event->getFormat() ?>" type="text" class="validate" length="20">
                            <label for="format">Format</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="signups-comment" name="signups-comment" value="<?php echo $event->getSignupDescription() ?>" type="text" class="validate" length="150">
                            <label for="description">Signups Comment (Optional)</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s2 pic">
                            <?php $picture = $event->getPicture() ? $event->getPicture() : 'img/tournament.png' ?>
                            <img src="<?php echo $picture?>" alt="" class="circle">
                            <p>Current Picture</p>
                        </div>
                        <div class="file-field input-field col s6">
                            <div class="file">
                                <span>File</span>
                                <input type="file">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="Upload a different logo (optional)">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input id="submit" name="submit" type="submit" value="Save Changes">
                            <input id="cancel" name="cancel" type="submit" value="Cancel">
                            <input id="delete" name="delete" type="submit" value="Delete" onclick="return confirm('Delete This Event?')">
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </main>
<?php include TEMPLATE_PATH."/admin/footer.php" ?>