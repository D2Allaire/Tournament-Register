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
<body class="region">
<div class="network">
    <ul class="container">
        <li><a href="http://d2am.net" title="D2AM"><img src="img/d2am.png" alt="D2AM" />D2AM</a></li>
        <li><a href="http://tourr.io/openscrimnetwork/" title="Open Scrim Network">Open Scrim Network</a></li>
        <li><a href="http://tourr.io/register/" title="Tournament Register"><em>Tournament Register</em></a></li>
        <li><a href="http://tourr.io/tcdl/" title="TCDL">TCDL</a></li>
    </ul>
</div>
<div class="nav-cont valign-wrapper">
    <nav role="navigation" class="valign">
        <div class="nav-wrapper container">
            <a id="logo-container" href="index.php" class="brand-logo valign-wrapper"><img src='img/logo_dark.png' alt="Tournament Register" /> Tournament Register</a>
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
            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
        </div>
    </nav>
</div>