<?php include TEMPLATE_PATH."/admin/header.php" ?>
<!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
<main class="admin tableview">
    <div class="container main">
        <h1 class="container-thin">Dashboard</h1>
        <?php if ( isset( $_GET['status'] ) ) {
            if ($_GET['status'] == 'eventDeleted') {?>
                <div class="changesSaved"><p>Submission has been deleted.</p></div>
            <?php } }?>

        <div class="clear"></div>
        <div class="card">
            <div class="card-content">
                <span class="card-title">General Statistics</span>
                <div class="row">
                    <div class="col s3 box">
                        <i class="medium material-icons">language</i>
                        <h3><?php echo Region::count(); ?></h3>
                        <h5>Regions</h5>
                    </div>
                    <div class="col s3 box">
                        <i class="medium material-icons">games</i>
                        <h3><?php echo Tournament::count(); ?></h3>
                        <h5>Tournaments</h5>
                    </div>
                    <div class="col s3 box">
                        <i class="medium material-icons">web</i>
                        <h3><?php echo League::count(); ?></h3>
                        <h5>Leagues</h5>
                    </div>
                    <div class="col s3 box">
                        <i class="medium material-icons">feedback</i>
                        <h3><?php echo Submission::count(); ?></h3>
                        <h5>Submissions</h5>
                    </div>
                </div>
                <hr>
                <span class="card-title">Submissions</span>
                <p>Select one of the submissions to view details:</p>
                <table class="bordered highlight">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($results['submissions'] as $submission) { ?>
                        <tr>
                            <?php
                                if ($submission->getPicture()==null && $submission->getType()=='league') $picture = 'img/league.png';
                                elseif ($submission->getPicture()==null && $submission->getType()=='tournament') $picture = 'img/tournament.png';
                                else $picture = $submission->getPicture();
                            ?>
                            <td><img src="<?php echo $picture ?>" /></td>
                            <td><a href="?editSubmission=<?php echo $submission->getID(); ?>"><?php echo $submission->getName(); ?></a></td>
                            <td><?php echo ucfirst($submission->getType()) ?></td>
                            <td>
                                <a class="cyan-text text-lighten-2" href="?editSubmission=<?php echo $submission->getID(); ?>"><i class="material-icons">edit</i></a>
                                <a class="red-text text-lighten-1 modal-trigger" href="#modal1" eventid="<?php echo $submission->getID() ?>" eventtype="submission"><i class="material-icons">delete</i></a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Delete Submission</h4>
            <p>Are you sure you want to delete this submission?</p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close btn-flat ">Cancel</a>
            <a href="#!" class="modal-action modal-agree btn-flat ">Yes</a>
        </div>
    </div>
</main>

<?php include TEMPLATE_PATH."/admin/footer.php" ?>