<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars($results['pageTitle']) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="The Tournament Register is a collection of current amateur Dota 2 events">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link type="image/x-icon" rel="shortcut icon" href="favicon.png" />
</head>
<body>
<header>
    <div class="fixed-bg bg1">
        <div class="network">
            <ul class="container">
                <li><a href="http://d2am.net" title="D2AM"><img src="img/d2am.png" alt="D2AM" />D2AM</a></li>
                <li><a href="http://tourr.io/openscrimnetwork/" title="Open Scrim Network">Open Scrim Network</a></li>
                <li><a href="http://tourr.io/register/" title="Tournament Register"><em>Tournament Register</em></a></li>
                <li><a href="http://tourr.io/tcdl/" title="TCDL">TCDL</a></li>
            </ul>
        </div>
        <div class="clear"></div>
        <nav role="navigation">
            <div class="nav-wrapper container">
                <a href="#" data-activates="nav-mobile" class="button-collapse valign-wrapper"><i class="material-icons">menu</i></a>
                <a id="logo-container" href="#" class="brand-logo valign-wrapper"><img src='img/tournamentregister.png' alt="Tournament Register Logo" /> Tournament Register</a>
                <ul class="right hide-on-med-and-down">
                    <?php
                    $regions = Region::getList(10);
                    foreach ($regions as $value) {
                        $url = strtolower($value->getRegion());
                        $url = preg_replace('/\s+/', '', $url);
                        echo "<li><a href='?region=".$url."'>".strtoupper($value->getRegion())."</a></li>\r\n";
                    }
                    ?>
                    <li><a href="?submit" class="btn waves-effect waves-light blue-grey darken-5">Submit Your Own</a></li>
                </ul>

                <ul id="nav-mobile" class="side-nav">
                    <?php
                    foreach ($regions as $value) {
                        $url = strtolower($value->getRegion());
                        $url = preg_replace('/\s+/', '', $url);
                        echo "<li><a href='?region=".$url."'>".$value->getRegion()."</a></li>\r\n";
                    }
                    ?>
                    <li><a href="?submit">Submit Your Own</a></li>
                </ul>
            </div>
        </nav>

        <div id="slogan">
            <h1>The Tournament Register</h1>
            <h2>A collection of all current amateur Dota 2 events.</h2>
        </div>
        <p class="sidelines"><span>Regions</span></p>
        <div id="container_regions">
            <a href="?region=europe" title="Europe"><div id="left"></div></a>
            <a href="?region=northamerica" title="North America"><div id="center"></div></a>
            <a href="?region=australia" title="Australia"><div id="right"></div></a>
        </div>
    </div>
</header>
<div class="clear"></div>
<main class="start container">
            <h1>The Tournament Register</h1>
            <p>The Tournament Register is a collection of all current online amateur Dota 2 events in selected regions. This includes continous leagues &amp; ladders as well as one-time tournaments or cups. See below for a full list of selection criteria.</p>
        <div class="links">
            <?php
            foreach ($regions as $value) {
                $url = strtolower($value->getRegion());
                $url = preg_replace('/\s+/', '', $url);
                echo "<a href='?region=".$url."'>".$value->getRegion()."</a>\r\n";
            }
            ?>
        </div>
            <h2>Selection Criteria</h2>
            <p><strong>Regions</strong>: Europe does not include CIS-predominant tournaments, with the exception of Starladder. Russian events are usually organized and shared over VK.com, so make sure to join the right groups over there. Australia includes NZ tournaments but not SEA.</p>
            <p><strong>Exclusivity</strong>: Tournaments aimed at a certain restricted audience (for example, college/highschool events or tournaments restricted to a specific country/region) are not included. Tournaments for teams below a certain MMR treshold will be listed since the audience for them is rather large. LAN-exclusive tournaments are not listed.</p>
            <p><strong>Format</strong>: Only 5v5 tournaments are listed. No 1v1, 3v3 or inhouse leagues (solo ladders).</p>
            <h2>Contact Us</h2>
            <p>Feel free to contact us if you wish your event to be listed (you can also use the <a href="?submit">Submit Form</a> for this) or need any further information. We are not responsible for these tournaments; if you have any questions about sign-ups or similar regards, contact the respective tournament organizers.</p>
            <a class="waves-effect waves-light blue-grey darken-5 btn-flat" href="?contact">Contact Us</a>
</main>

<?php include TEMPLATE_PATH."/footer.php" ?>
