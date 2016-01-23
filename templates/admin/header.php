<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Tournament Register - Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="The Tournament Register is a collection of current amateur Dota 2 events">
    <link href="css/admin.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body class="admin">
<div class="network hide-on-small-and-down">
    <ul class="container">
        <li><a href="http://d2am.net" title="D2AM"><img src="img/d2am.png" alt="D2AM" />D2AM</a></li>
        <li><a href="http://tourr.io/openscrimnetwork/" title="Open Scrim Network">Open Scrim Network</a></li>
        <li><a href="http://tourr.io/register/" title="Tournament Register"><em>Tournament Register</em></a></li>
        <li><a href="http://tourr.io/tcdl/" title="TCDL">TCDL</a></li>
    </ul>
</div>
<div class="nav-cont valign-wrapper up-nav hide-on-med-and-down">
    <div class="valign" id="logo">
        <div class="nav-wrapper container">
            <a id="logo-container" href="admin.php" class="brand-logo valign-wrapper"><img src='img/logo_dark.png' alt="Tournament Register" /> Tournament Register - Admin Panel</a>
            <ul class="right">
                <li><a href="?logout=true" class="btn waves-effect waves-light blue-grey darken-5">Logout</a></li>
            </ul>
        </div>
    </div>
</div>
<nav>
    <a href="#" data-activates="slide-out" class="button-collapse valign-wrapper"><i class="material-icons">menu</i><span valign>Admin Panel - Menu</span></a>
    <ul id="slide-out" class="side-nav fixed">
        <li class="logo"><a id="logo-container" href="index.php">
                <img src='img/tournamentregister.png' alt="Tournament Register" />
                <br />Tournament Register
            </a></li>
        <li><a href="admin.php" class="waves-effect waves-light">Dashboard</a></li>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a class="collapsible-header waves-effect waves-light">Regions</a>
                    <div class="collapsible-body">
                        <ul>
                            <?php
                            $regions = Region::getList(10);
                            foreach ($regions as $value) {
                                $url = strtolower($value->getRegion());
                                $url = preg_replace('/\s+/', '', $url);
                                echo "<li><a href='?region=".$url."'>".$value->getRegion()."</a></li>\r\n";
                            }
                            ?>
                        </ul>
                    </div>
                </li>
            </ul>
        </li>
        <li><a href="?logout=true" class="waves-effect waves-light">Logout</a></li>
    </ul>
</nav>