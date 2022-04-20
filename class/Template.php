<?php

namespace outiljardinage;

class Template
{
    public static function render(string $title, string $content,
                                  array $stylesheets, array $scripts) {
        ?>
        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport"
                  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title><?=$title?></title>
            <link rel="stylesheet" href="/resources/css/main.css">
            <?php
                foreach ($stylesheets as $sheet) {
                    echo "<link rel=\"stylesheet\" href=\"$sheet\">";
                }
            ?>
            <?php
            foreach ($scripts as $script) {
                echo "<script defer src=\"$script\"></script>";
            }
            ?>
        </head>
        <body>
        <?php include $_SERVER["DOCUMENT_ROOT"] . "/templates/header.php"; ?>
        <main>
        <?=$content?>
        </main>
        <?php include $_SERVER["DOCUMENT_ROOT"] . "/templates/footer.php"; ?>
        </body>
        </html>
        <?php
    }
}