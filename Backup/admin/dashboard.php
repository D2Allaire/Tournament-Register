<?php include TEMPLATE_PATH."/admin/header.php" ?>
<!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
<!--main content start-->
<section id="main-content">
    <section class="wrapper">

        <div class="row">

            <div class="col-lg-9 main-chart">
                <div class="row mtbox">
                    <div class="col-md-offset-1">
                        <h2>General Statistics</h2>
                    </div>
                    <div class="col-md-2 col-sm-2 col-md-offset-1 box0">
                        <div class="box1">
                            <span class="li_world"></span>
                            <h3><?php echo Region::count(); ?></h3>
                            <h5>Regions</h5>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 box0">
                        <div class="box1">
                            <span class="li_vallet"></span>
                            <h3><?php echo Tournament::count(); ?></h3>
                            <h5>Tournaments</h5>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 box0">
                        <div class="box1">
                            <span class="li_news"></span>
                            <h3><?php echo League::count(); ?></h3>
                            <h5>Leagues</h5>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 box0">
                        <div class="box1">
                            <span class="li_stack"></span>
                            <h3><?php echo Event::countSubmission(); ?></h3>
                            <h5>Submissions</h5>
                        </div>
                    </div>

                </div><!-- /row mt -->

            </div><!-- /col-lg-9 END SECTION MIDDLE -->


            <!-- **********************************************************************************************************************************************************
            RIGHT SIDEBAR CONTENT
            *********************************************************************************************************************************************************** -->
        </div><! --/row -->
    </section>
</section>

<!--main content end-->
</section>
<?php include TEMPLATE_PATH."/admin/footer.php" ?>