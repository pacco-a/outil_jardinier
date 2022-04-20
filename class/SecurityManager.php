<?php
namespace outiljardinage;
require $_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php";

session_start();

class SecurityManager
{
    private DataManager $dbManager;

    public function __construct()
    {
        $this->dbManager = new DataManager();
    }

    public function lockPageToRegistered() {
        if (!$_SESSION["is_log"]) {
            header("location: /");
            die();
        }
    }

    public function redirectIfLogged(string $url) {
        if (isset($_SESSION["is_log"]) && $_SESSION["is_log"]) {
            header("location: " . $url);
            die();
        }
    }

    public function tryLoggingIn(string $username, string $password) {
        if ($this->dbManager->isAccountCorrect($username, $password)) {
            $_SESSION["is_log"] = true;
            header("location: /");
            die();
        }

        header("location: /");
    }

    public function isLog(): bool {
        if (isset($_SESSION["is_log"]) && $_SESSION["is_log"] == true) {
            return true;
        } else {
            return false;
        }
    }
}