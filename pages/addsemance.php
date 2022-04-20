<?php
require $_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php";

$security = new \outiljardinage\SecurityManager();
$security->lockPageToRegistered();

$dbManager = new outiljardinage\DataManager();
$template = new outiljardinage\Template();

if (isset($_POST["nom"]) &&
    isset($_POST["famille"]) &&
    isset($_POST["plantation"]) &&
    isset($_POST["recolte"]) &&
    isset($_POST["quantite"]) &&
    isset($_POST["conseils"]) &&
    isset($_POST["image_url"])) {

    $dbManager->addOneSeed($_POST["nom"], $_POST["famille"], $_POST["plantation"],
        $_POST["recolte"], $_POST["conseils"], $_POST["image_url"], $_POST["quantite"]);

    header("location: /pages/semances.php");
    die();
}

ob_start();
?>

    <main>
        <h2>Ajouter une semance</h2>

        <form method="post" action="/pages/addsemance.php">
            <label for="nom">
                <span>name:</span>
                <input name="nom" type="text" placeholder="nom de la semance">
            </label>
            <label for="famille">
                <span>famille:</span>
                <select name="famille">
                    <option value="Solanacées">Solanacées</option>
                    <option value="Cucurbitacées">Cucurbitacées</option>
                    <option value="Légumineuses">Légumineuses</option>
                </select>
            </label>
            <label for="plantation">
                <span>mois de plantation:</span>
                <select name="plantation">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
            </label>
            <label for="recolte">
                <span>mois de recolte:</span>
                <select name="recolte">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
            </label>
            <label for="quantite">
                <span>quantité en stock:</span>
                <input type="number" name="quantite">
            </label>
            <label for="conseils">
                <span>conseils d'entretient:</span>
                <textarea name="conseils" cols="30" rows="10"></textarea>
            </label>
            <label for="image_url">
                <span>lien vers l'image du visuel:</span>
                <input type="text" name="image_url">
            </label>

            <button type="submit">Ajouter</button>
        </form>

    </main>

<?php
$page_content = ob_get_clean();
$template::render("ACCUEIL",
    $page_content,
    ["/resources/css/addsemance.css"],
    []);