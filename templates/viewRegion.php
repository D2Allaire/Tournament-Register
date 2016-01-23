<?php include TEMPLATE_PATH."/header.php" ?>
<main class="region">
    <div class="container main">
        <h1 class="container-thin"><?php echo $rname ?></h1>
        <div class="clear"></div>
        <div class="card trr-card">
            <div class="card-content">
                <span class="card-title">Leagues</span>
                <p>Leagues are usually multi-regional tournaments with a Round Robin format. There are different divisions that represent different skill levels. Each division might have separate groups within. Your team gets placed in one of these groups, and over the course of one season faces all the other opponents in your group. At the end of the season, top teams advance into a higher division; bottom teams fall down.</p>
            </div>
            <div class="entry">
                <ul class="collection">
                    <?php
                    foreach ($results['leagues'] as $league) {
                        $status = $league->getSignup()==0 ? 'closed' : 'open';
                        $picture = $league->getPicture() ? $league->getPicture() : 'img/league.png' ?>
                        <li class="collection-item avatar">
                            <img src="<?php echo $league->getPicture()?>" alt="" class="circle">
                            <span class="title"><a href="<?php echo $league->getUrl()?>"><i class="tiny material-icons">call_made</i><?php echo htmlspecialchars($league->getName())?></a></span>
                            <p><?php echo htmlspecialchars($league->getDescription())?></p>
                            <table class="table-responsive">
                                <tbody>
                                <tr>
                                    <td>Entry Fee: <?php echo htmlspecialchars($league->getFee())?></td>
                                    <td>Prize Pool: <?php echo htmlspecialchars($league->getPrize())?></td>
                                </tr>
                                </tbody>
                            </table>
                            <p>Signups: <span class="<?php echo $status ?>"><?php echo ucfirst($status)?></span>. <em><?php echo htmlspecialchars($league->getSignupDescription()) ?></em></p>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>

        <div class="clear"></div>
        <div class="card trr-card">
            <div class="card-content">
                <span class="card-title">Tournaments</span>
                <p>Tournaments can be of any format (Single Elimination Bracket), Round Robin Group-Stage into playoffs, etc. Most of these events are single elimination one-day cups unless stated otherwise.</p>
            </div>
            <div class="entry">
                <ul class="collection">
                    <?php
                    foreach ($results['tournaments'] as $tournament) {
                        $status = $tournament->getSignup()==0 ? 'closed' : 'open';
                        $picture = $tournament->getPicture() ? $tournament->getPicture() : 'img/tournament.png' ?>
                        <li class="collection-item avatar">
                            <img src="<?php echo $picture?>" alt="" class="circle">
                            <span class="title"><a href="<?php echo $tournament->getUrl()?>"><i class="tiny material-icons">call_made</i><?php echo htmlspecialchars($tournament->getName())?></a></span>
                            <p><?php echo htmlspecialchars($tournament->getDescription())?></p>
                            <table class="table-responsive">
                                <tbody>
                                <tr>
                                    <td>Entry Fee: <?php echo htmlspecialchars($tournament->getFee())?></td>
                                    <td>Prize Pool: <?php echo htmlspecialchars($tournament->getPrize())?></td>
                                </tr>
                                <tr>
                                    <td>Format: <?php echo htmlspecialchars($tournament->getFormat())?></td>
                                    <td>Signups: <span class="<?php echo $status ?>"><?php echo ucfirst($status)?></span>.</td>
                                </tr>
                                </tbody>
                            </table>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</main>
<?php include TEMPLATE_PATH."/footer.php" ?>