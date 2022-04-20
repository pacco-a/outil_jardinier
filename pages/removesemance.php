<?php
require $_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php";

$security = new \outiljardinage\SecurityManager();
$security->lockPageToRegistered();

$dbManager = new outiljardinage\DataManager();

if (!isset($_GET["id"])) {
    echo "Erreur: veuillez spécifier un paramètre ID";
    die();
}

$dbManager->removeOneSeed($_GET["id"]);

header("location: /pages/semances.php");
die();