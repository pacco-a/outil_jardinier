<?php
require $_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php";

$security = new \outiljardinage\SecurityManager();

?>
<header>
    <h1>Outils jardinage</h1>

    <?php
    if ($security->isLog()) {
        echo "<div id='logout-menu'>
                <a href='/pages/logout.php'>deconnexion</a>
              </div>";
    }

    ?>
    <div id="header-menu">
        <a href="/">accueil</a>
        <a href="/pages/semances.php">semances</a>
    </div>
</header>