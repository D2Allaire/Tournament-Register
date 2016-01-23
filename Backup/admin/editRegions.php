<?php include TEMPLATE_PATH."/admin/header.php";
function truncate($string, $length, $dots = "...") {
    return (strlen($string) > $length) ? substr($string, 0, $length - strlen($dots)) . $dots : $string;
}
?>
<!-- **********************************************************************************************************************************************************
MAIN CONTENT
*********************************************************************************************************************************************************** --
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <h3>Region: <?php echo $rname; ?></h3>

        <div class="row mt">
            <div class="col-md-12">
                <div class="content-panel">
                    <table class="table table-striped table-advance table-hover">
                        <h4><i class="fa fa-angle-right"></i> Tournaments</h4>
                        <hr>
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
                                    <td class="hidden-phone"><?php echo truncate($tournament->getDescription(), 80); ?></td>
                                    <td>
                                        <a class="btn btn-primary btn-xs" href="?editTournament=<?php echo $tournament->getID(); ?>"><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-danger btn-xs" href="?deleteTournament=<?php echo $tournament->getID(); ?>"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                        <?php } ?>

                        <tr>
                            <td><a href="basic_table.html#">Company Ltd</a></td>
                            <td class="hidden-phone">Lorem Ipsum dolor</td>
                            <td>
                                <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                                <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                                <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div><!-- /content-panel -->
            </div><!-- /col-md-12 -->
        </div><!-- /row -->

        <div class="row mt">
            <div class="col-md-12">
                <div class="content-panel">
                    <table class="table table-striped table-advance table-hover">
                        <h4><i class="fa fa-angle-right"></i> Leagues</h4>
                        <hr>
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
                                <td class="hidden-phone"><?php echo truncate($league->getDescription(), 80); ?></td>
                                <td>
                                    <a class="btn btn-primary btn-xs" href="?editLeague=<?php echo $league->getID(); ?>"><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-danger btn-xs" href="?deleteLeague=<?php echo $league->getID(); ?>"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        <?php } ?>

                        <tr>
                            <td><a href="basic_table.html#">Company Ltd</a></td>
                            <td class="hidden-phone">Lorem Ipsum dolor</td>
                            <td>
                                <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                                <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                                <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div><!-- /content-panel -->
            </div><!-- /col-md-12 -->
        </div><!-- /row -->

    </section><! --/wrapper -->
</section><!-- /MAIN CONTENT -->

<!--main content end-->
</section>
<?php include TEMPLATE_PATH."/admin/footer.php" ?>