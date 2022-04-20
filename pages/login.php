<?php
require $_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php";

$security = new \outiljardinage\SecurityManager();

if (!isset($_POST["username"]) || !isset($_POST["password"])) {
    header("location: /");
    die();
}

$security->tryLoggingIn($_POST["username"], $_POST["password"]);
die();