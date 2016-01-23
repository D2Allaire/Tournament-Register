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
<div class="network">
    <ul class="container">
        <li><a href="http://d2am.net" title="D2AM"><img src="img/d2am.png" alt="D2AM" />D2AM</a></li>
        <li><a href="http://tourr.io/openscrimnetwork/" title="Open Scrim Network">Open Scrim Network</a></li>
        <li><a href="http://tourr.io/register/" title="Tournament Register"><em>Tournament Register</em></a></li>
        <li><a href="http://tourr.io/tcdl/" title="TCDL">TCDL</a></li>
    </ul>
</div>

<main class="admin-login">

    <div class="login_div">
        <?php if ( isset( $results['errorMessage'] ) ) { ?>
            <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
        <?php } ?>
        <a id="logo-container" href="admin.php" class="brand-logo valign-wrapper"><img src='img/logo_dark.png' alt="Tournament Register" /> Admin Panel</a>
        <form class="login_form" method="post" action="?login=true">
         <div class="input-field">
              <input id="username" placeholder="Username" name="username" type="text" class="validate" required autofocus maxlength="20">
         </div>
        <div class="input-field">
            <input id="password" placeholder="Password" name="password" type="password" class="validate" required maxlength="20">
        </div>
            <input id="submit" name="login" type="submit" value="Login">
        </form>
    </div>

</main>

<?php include TEMPLATE_PATH."/admin/footer.php" ?>