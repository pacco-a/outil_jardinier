<?php
require $_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php";

$security = new \outiljardinage\SecurityManager();
$security->redirectIfLogged("/pages/semances.php");

$dbManager = new outiljardinage\DataManager();
$template = new outiljardinage\Template();
ob_start();
?>

<main>
    <h2>Connectez-vous</h2>

    <p> <strong>note :</strong> dans la base de donnée exemple les identifiants sont username: jardinier, password: motdepasse</p>

    <form method="post" action="/pages/login.php">
        <label for="username">
            <span>username:</span>
            <input type="text" name="username">
        </label>
        <label for="password">
            <span>password:</span>
            <input type="password" name="password">
        </label>
        <button type="submit">Connexion</button>
    </form>
</main>

<?php
$page_content = ob_get_clean();
$template::render("ACCUEIL", $page_content, [], []);