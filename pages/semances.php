<?php
require $_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php";

$security = new \outiljardinage\SecurityManager();
$security->lockPageToRegistered();

$dbManager = new outiljardinage\DataManager();
$template = new outiljardinage\Template();
ob_start();
?>

    <main>

        <div id="semances-menu">
            <a href="/pages/addsemance.php">ajouter une semance</a>
        </div>

        <h2>Les semances</h2>
        <div id="semances-list">
            <?php
            $allSeeds = $dbManager->getAllSeeds();
            for ($i = 0; $i < 15; $i++) {
                foreach ($allSeeds as $seed) {
                    ?>
                    <div class="semance">

                        <div class="semance-top-part">
                            <img class="semance-img" src="<?=$seed["url_image"]?>" alt="image de graine" >
                            <a href="/pages/removesemance.php?id=<?=$seed["id"]?>">
                                <p class="semance-label">suppr.</p>
                            </a>
                        </div>

                        <div class="semance-name"><?=$seed["nom"]?></div>
                        <div class="semance-famille"><?=$seed["famille"]?></div>

                        <div class="semance-bottom-part">
                            <span class="semance-mois-plantation">
                                <p class="semance-label">
                                    plant. : <?=$seed["mois_plantation"]?>
                                </p>
                            </span>
                            <span class="semance-mois-recolte">
                                <p class="semance-label">
                                    rec. : <?=$seed["mois_recolte"]?>
                                </p>
                            </span>

                            <span class="semance-qtt">
                                <p class="semance-label">
                                    qtt. : <?=$seed["quantite_stock"]?>
                                </p>
                            </span>
                        </div>

                    </div>
                    <?php
                }
            }
            ?>
        </div>

    </main>

<?php
$page_content = ob_get_clean();
$template::render("SEMANCES",
    $page_content,
    ["/resources/css/semances.css"],
    []);