<div class="clear"></div>
<footer>
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5>Tournament Register</h5>
                <p>The Tournament Register is a collection of all current online amateur Dota 2 events.</p>
                <ul>
                    <?php
                    foreach ($regions as $value) {
                        $url = strtolower($value->getRegion());
                        $url = preg_replace('/\s+/', '', $url);
                        echo "<li><a href='?region=".$url."'>".$value->getRegion()."</a></li>\r\n";
                    }
                    ?>
                </ul>
            </div>
            <div class="col l3 s12 right">
                <h5>D2AM Network</h5>
                <ul>
                    <li><a href="http://tourr.io/register">Open Scrim Network</a></li>
                    <li><a href="http://tourr.io/register">Tournament Register</a></li>
                    <li><a href="http://tourr.io/tcdl">TCDL</a></li>
                    <li><a href="http://d2am.net">D2AM</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
<script>
    $(document).ready(function() {
        $('select').material_select();
    });
</script>
<script src="js/mail.js"></script>
<script src="js/submit.js"></script>
</body>
</html>