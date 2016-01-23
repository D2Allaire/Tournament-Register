<?php include TEMPLATE_PATH."/admin/header.php";
function truncate($string, $length, $dots = "...") {
    return (strlen($string) > $length) ? substr($string, 0, $length - strlen($dots)) . $dots : $string;
}
?>

<main class="admin tableview">
<div class="container main">
    <h1 class="container-thin">Region: <?php echo $rname; ?></h1>
    <?php if ( isset( $_GET['status'] ) ) {
        if ($_GET['status'] == 'eventDeleted') {?>
            <div class="changesSaved"><p>Event has been deleted.</p></div>
        <?php } }?>

    <h2>Tournaments</h2>
    <a href="?createTournament=<?php echo $rid ?>" class="right file createe waves-effect waves-light">Create New</a>
    <hr>
    <table class="bordered highlight">
        <thead>
            <tr>
                <th>Tournament Name</th>
                <th>Description</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($results['tournaments'] as $tournament) { ?>
                    <tr>
                        <td><a href="?editTournament=<?php echo $tournament->getID(); ?>"><?php echo $tournament->getName(); ?></a></td>
                        <td class="hidden-phone"><?php echo truncate($tournament->getDescription(), 75); ?></td>
                        <td>
                            <a class="cyan-text text-lighten-2" href="?editTournament=<?php echo $tournament->getID(); ?>"><i class="material-icons">edit</i></a>
                            <a class="red-text text-lighten-1 modal-trigger" href="#modal2" eventid="<?php echo $tournament->getID() ?>" eventtype="tournament"><i class="material-icons">delete</i></a>
                        </td>
                    </tr>
            <?php } ?>
        </tbody>
    </table>

    <h2>Leagues</h2>
    <a href="?createLeague=<?php echo $rid ?>" class="right file createe waves-effect waves-light">Create New</a>
    <hr>
    <table class="bordered highlight">
        <thead>
        <tr>
            <th>League Name</th>
            <th>Description</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($results['leagues'] as $league) { ?>
            <tr>
                <td><a href="?editLeague=<?php echo $league->getID(); ?>"><?php echo $league->getName(); ?></a></td>
                <td class="hidden-phone"><?php echo truncate($league->getDescription(), 75); ?></td>
                <td>
                    <a class="cyan-text text-lighten-2" href="?editLeague=<?php echo $league->getID(); ?>"><i class="material-icons">edit</i></a>
                    <a class="red-text text-lighten-1 modal-trigger" href="#modal1" eventid="<?php echo $league->getID() ?>" eventtype="league"><i class="material-icons">delete</i></a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Delete League</h4>
            <p>Are you sure you want to delete this league?</p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close btn-flat ">Cancel</a>
            <a href="#!" class="modal-action modal-agree btn-flat ">Yes</a>
        </div>
    </div>

    <div id="modal2" class="modal">
        <div class="modal-content">
            <h4>Delete Tournament</h4>
            <p>Are you sure you want to delete this tournament?</p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close btn-flat ">Cancel</a>
            <a href="#!" class="modal-action modal-agree btn-flat ">Yes</a>
        </div>
    </div>

</main>
<?php include TEMPLATE_PATH."/admin/footer.php" ?>