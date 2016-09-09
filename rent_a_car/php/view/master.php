<?php
include_once 'ViewDescriptor.php';
include_once basename(__DIR__) . '/../Settings.php';

if (!$vd->isJson()) {
    ?>

    <!DOCTYPE html>
    <html>
        <head>
            <title><?= $vd->getTitolo() ?></title>
            <base href="<?= Settings::getApplicationPath() ?>php/"/>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <link rel="stylesheet" type="text/css" href="../css/stile.css">
            <link rel="shortcut icon" type="image/x-icon" href="../img/icon.png" />
            <?php
            foreach ($vd->getScripts() as $script) {
                ?>
                <script type="text/javascript" src="<?= $script ?>"></script>
                <?php
            }
            ?>

        </head>
        <body>
            <div id="page">
                <header>
                    <div id="header">
                        <h1>Rent a Car</h1>
                    </div>
                    <div id="top">
                        <?php
                        $logo = $vd->getLogoFile();
                        require "$logo";
                        ?>
                    </div>
                </header>

                <div id="sidebar1">
                    <?php
                    $left = $vd->getLeftBarFile();
                    require "$left";
                    ?>
                </div>

                <div id="content">
                    <?php
                    if ($vd->getMessaggioErrore() != null) {
                        ?>
                        <div class="error">
                            <div>
                                <?=
                                $vd->getMessaggioErrore();
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if ($vd->getMessaggioConferma() != null) {
                        ?>
                        <div class="confirm">
                            <div>
                                <?=
                                $vd->getMessaggioConferma();
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    $content = $vd->getContentFile();
                    require "$content";
                    ?>
                </div>

                <div id="clear">

                </div>

                <div id="footer">
                    <p>
                        Daniele Sanna
                    </p>
                    <p>
                        <a id="htmlval" href="http://validator.w3.org/check?uri=referer">HTML Valid</a>

                        <a id="cssval" href="http://jigsaw.w3.org/css-validator/check/refer">CSS Valid</a>
                    </p>
                </div>
            </div>
        </body>
    </html>
    <?php
} else {

    header('Cache-Control: no-cache, must-revalidate');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Content-type: application/json');

    $content = $vd->getContentFile();
    require "$content";
}
?>
