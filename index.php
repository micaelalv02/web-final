<?php
require_once "Config/Autoload.php";
Config\Autoload::run();

$template = new Clases\TemplateSite();
$f = new Clases\PublicFunction();
$banners = new Clases\Banners();
$productos = new Clases\Productos();
$contenidos = new Clases\Contenidos();
$sliderDesktop = $banners->list(["categoria" => 'main-slider-index', "idioma" => $_SESSION["lang"]], '', '', false);
$popularCategories = $banners->list(["categoria" => 'popular-categories', "idioma" => $_SESSION["lang"]], 'orden', '', false);

$contenidosIndex = $contenidos->list(["filter" => ["contenidos.area = 'index'"], "images" => true], $_SESSION["lang"]);

$data = [
    "filter" => ["contenidos.area = 'novedades'"],
    "images" => true,
    "order" => "fecha",
    "limit" => 3
];
$novedades = $contenidos->list($data, $_SESSION["lang"]);

#Información de cabecera
$template->set("title", TITULO);
$template->set("description", "");
$template->set("keywords", "");
$template->themeInit();
?>

<!-- slider area starts -->
<div class="slider-area pt-105">
    <?php foreach ($sliderDesktop as $key => $slider) { ?>
        <div class="single-slide slider-height position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-5 col-md-8">
                        <div class="slider-description margin-slider-description">
                            <h1 style="margin: 0px !important;"><?= $slider['data']['titulo'] ?></h1>
                            <p class="pb-30 "><?= $slider['data']['subtitulo'] ?></p>
                        </div>
                    </div>
                    <div class="slider-images ">
                        <div class="slider-image-bg">
                            <img src="<?= URL ?>/<?= $slider['image']['ruta'] ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

</div>
<!-- slider area ends -->

<!-- popular category area starts -->
<div class="popular-category-area pt-110">
    <div class="container">
        <div class="section-title text-center pb-45">
            <h2><?= $popularCategories['0']['category']['titulo'] ?></h2>
        </div>
        <div class="row">
            <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                <div class="category-img-item first-items position-relative">
                    <div class="cat-thumb overflow-hidden">
                        <img src="<?= URL . "/" . $popularCategories['0']['image']['ruta'] ?>" alt="img1">
                    </div>
                    <div class="category-texts ">
                        <h3><a href="<?= $popularCategories['.']['data']['link'] ?>"><?= $popularCategories['0']['data']['titulo'] ?></a></h3>
                    </div>
                </div>
            </div>

            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                <div class="category-img-item second-items position-relative mb-30">
                    <div class="cat-thumb overflow-hidden">
                        <img src="<?= URL . "/" . $popularCategories['1']['image']['ruta'] ?>" alt="img2">
                    </div>
                    <div class="category-texts position-absolute">
                        <h3><a href="<?= $popularCategories['1']['data']['link'] ?>"><?= $popularCategories['1']['data']['titulo'] ?></a></h3>
                    </div>
                </div>

                <div class="category-img-item third-items position-relative">
                    <div class="cat-thumb overflow-hidden">
                        <img src="<?= URL . "/" . $popularCategories['2']['image']['ruta'] ?>" alt="img3">
                    </div>
                    <div class="category-texts position-absolute">
                        <h3><a href="<?= $popularCategories['2']['data']['link'] ?>"><?= $popularCategories['2']['data']['titulo'] ?></a></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-50">
    <div class="row">
        <div class="products-section shop mt-0" style="width: 100%">
            <div class=" shop_wrapper grid_3">
                <div class="row grid-products-outstanding" data-url="<?= URL ?>"></div>
            </div>
        </div>
    </div>
</div>
<div class="today-deal pt-115">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-6 col-md-6 col-sm-12">
                <div class="deal-details pt-90">
                    <span><?= $contenidosIndex['dd7203bf47']['data']['subtitulo'] ?></span>
                    <h2><?= $contenidosIndex['dd7203bf47']['data']['titulo'] ?></h2>
                    <?= $contenidosIndex['dd7203bf47']['data']['contenido'] ?>
                    <a class="p-btn position-relative" href="<?= $contenidosIndex['dd7203bf47']['data']['link'] ?>">
                        <span><?= $_SESSION['lang-txt']['general']['ver_mas'] ?></span>
                    </a>
                </div>
            </div>
            <div class="col-xl-7 col-lg-6 col-md-6 col-sm-12">
                <div class="today-deal-img deal-img-position  text-center position-relative">
                    <img src="<?= $contenidosIndex['dd7203bf47']['images'][0]['url'] ?>" alt="product">
                    <span class="deal-badge slider-price-badge">
                        <span><?= $contenidosIndex['dd7203bf47']['data']['keywords'] ?></span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Today Deal Area Ends -->
<!-- News Area Start -->
<div class="news-area pt-115">
    <div class="container">
        <div class="section-title text-center pb-45">
            <h2 class="text-uppercase"><?= $_SESSION['lang-txt']['general']['novedades'] ?></h2>
        </div>
        <div class="row">
            <?php foreach ($novedades as $novedad) {
                $link = URL . "/c/" . $novedad['data']["area"] . "/" . $f->normalizar_link($novedad['data']["titulo"]) . "/" . $novedad['data']["cod"] ?>
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="news-items mb-30 mb-md-0">
                        <div class="news-img">
                            <a href="<?= $link ?>"><img src="<?= $novedad['images'][0]['url'] ?>" alt="<?= $novedad['data']['titulo'] ?>"></a>
                        </div>
                        <div class="news-details pt-20">
                            <div class="news-title pr-50">
                                <a href="<?= $link ?>"><?= $novedad['data']['titulo'] ?></a>
                            </div>
                            <span class="d-block"><?= $novedad['data']['fecha'] ?></span>
                            <a class="slider-btn d-inline-block position-relative mt-10" href="<?= $link ?>"><?= $_SESSION['lang-txt']['general']['ver_mas'] ?></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<div class="instagram-area pt-110 pb-120">
    <div class="container">
        <div class="section-title text-center">
            <h2 class="text-uppercase"><?= $contenidosIndex['279e76a3d8']['data']['titulo'] ?></h2>
            <span><?= $contenidosIndex['279e76a3d8']['data']['subtitulo'] ?></span>
        </div>
        <div class="instagram-images d-flex pt-60">
            <?php foreach ($contenidosIndex['279e76a3d8']['images'] as $imagen) { ?>
                <div class="insta-imgs position-relative">
                    <img src="<?= $imagen['url'] ?>" alt="img">
                </div>
            <?php } ?>

        </div>
    </div>
</div>

<?php $template->themeEnd() ?>

<script>
    $(document).ready(function() {
        getDataOutstanding();
    });
</script>