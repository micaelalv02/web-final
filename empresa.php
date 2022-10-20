<?php
require_once "Config/Autoload.php";
Config\Autoload::run();

$template = new Clases\TemplateSite();
$f = new Clases\PublicFunction();
$contenidos = new Clases\Contenidos();

$filter = [];

isset($_GET["area"]) ?  $filter[] = "contenidos.area = '" . $f->antihack_mysqli($_GET["area"]) . "'" : '';
isset($_GET["cod"]) ?  $filter[] = "contenidos.cod = '" . $f->antihack_mysqli($_GET["cod"]) . "'" : '';


$data = [
    "filter" => ["contenidos.cod='sobre-nosotros-empresa'"],
    "images" => true,
    //"category" => false,
    //"gallery" => true,
];

#List de contenidos (al ser único el título, solo trae un resultado)
$contenidoData = $contenidos->list($data, $_SESSION["lang"], true);
//$novedadesRelacionadas = $contenidos->list(["filter" => ["contenidos.area = '" . $f->antihack_mysqli($_GET["area"]) . "'", "contenidos.cod != '" . $f->antihack_mysqli($_GET["cod"]) . "'"], "images" => true, "limit" => 3], $_SESSION["lang"]);

#Si se encontro el contenido se almacena y sino se redirecciona al inicio
if (empty($contenidoData)) $f->headerMove(URL);
#Información de cabecera
$template->set("title", $contenidoData['data']['titulo'] . " | " . TITULO);
$template->set("description", $contenidoData['data']['description']);
$template->set("keywords", $contenidoData['data']['keywords']);
$template->set("imagen", isset($contenidoData['data']['images'][0]['url']) ? $contenidoData['data']['images'][0]['url'] : LOGO);
$template->themeInit();
?>

<main id="main">
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="index.html"><?=$contenidoData['area']['data']['titulo']?></a></li>
                <li><?= $contenidoData['data']['titulo']?></li>
            </ol>
            <h2><?=$contenidoData['data']['subtitulo']?></h2>

        </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
        <div class="container">
            <p>
                <?= $contenidoData['data']['contenido']?>
            </p>
        </div>
    </section>
</main>

<?php
$template->themeEnd();
?>