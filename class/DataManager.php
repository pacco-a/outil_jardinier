<?php

namespace outiljardinage;

use PDO;

class DataManager
{
    private string $db_name = "outil_jardinage";
    private string $db_host = "127.0.0.1";
    private string $db_port = "3306";
    private string $db_user = "root";
    private string $db_pwd = "Okodje16";

    private bool $DEBUG_SUCCESS = false;

    public static PDO $pdo;

    public function __construct()
    {
        if (!isset($this::$pdo)) {
            // Connexion à la BDD
            try {
                // Agrégation des informations de connexion dans une chaine DSN (Data Source Name)
                $dsn = 'mysql:dbname=' . $this->db_name . ';host=' . $this->db_host . ';port=' . $this->db_port;

                // Connexion et récupération de l'objet connecté
                $this::$pdo = new PDO($dsn, $this->db_user, $this->db_pwd);
            } // Récupération d'une éventuelle erreur
            catch (\Exception $ex) { ?>
                <!-- Affichage des informations liées à l'erreur-->
                <div style="color: red">
                <b>!!! ERREUR DE CONNEXION !!!</b><br>
                Code : <?= $ex->getCode() ?><br>
                Message : <?= $ex->getMessage() ?>
                </div><?php
                // Arrêt de l'exécution du script PHP
                die("-> Exécution stoppée <-");
            }

            if ($this->DEBUG_SUCCESS) {
                // Poursuite de l'exécution du script ?>
                <div style="color: green">Connecté à <b><?= $dsn ?></b></div>
                <?php
            }

        }
    }

    public function getAllSeeds(): array
    {
        $sql = "SELECT * FROM semance";
        $statement = $this::$pdo->prepare($sql);

        /** @noinspection PhpVoidFunctionResultUsedInspection */
        $statement->execute() or die(var_dump($statement->errorInfo()));

        return $statement->fetchAll();
    }

    public function addOneSeed(string $nom, string $famille,
        int $mois_plantation, int $mois_recolte, string $conseils,
        string $url_image, int $quantite) {

        $sql = "INSERT INTO `semance` 
            (`id`, `nom`, `famille`, `mois_plantation`, `mois_recolte`, `conseils`, `url_image`, `quantite_stock`)
            VALUES (NULL, :nom, :famille, :plantation, :recolte, :conseils, :url, :quantite)";
        $statement = $this::$pdo->prepare($sql);
        $statement->bindValue(":nom", $nom);
        $statement->bindValue(":famille", $famille);
        $statement->bindValue(":plantation", $mois_plantation);
        $statement->bindValue(":recolte", $mois_recolte);
        $statement->bindValue(":conseils", $conseils);
        $statement->bindValue(":url", $url_image);
        $statement->bindValue(":quantite", $quantite);

        /** @noinspection PhpVoidFunctionResultUsedInspection */
        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    public function removeOneSeed(int $id) {
        $sql = "DELETE FROM `semance` WHERE id = :id";
        $statement = $this::$pdo->prepare($sql);
        $statement->bindValue(":id", $id);

        /** @noinspection PhpVoidFunctionResultUsedInspection */
        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    public function isAccountCorrect(string $username, string $password): bool {
        $sql = "SELECT * FROM compte WHERE username = :usr AND password = :psw";
        $statement = $this::$pdo->prepare($sql);
        $statement->bindValue(":usr", $username);
        $statement->bindValue("psw", $password);

        /** @noinspection PhpVoidFunctionResultUsedInspection */
        $statement->execute() or die(var_dump($statement->errorInfo()));


        return sizeof($statement->fetchAll()) > 0;
    }
}