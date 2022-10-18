<?php
$f = new Clases\PublicFunction();
$config = new Clases\Config();
$usuarios = new Clases\Usuarios();
$menu = new Clases\Menu();
$idiomas = new Clases\Idiomas();
$listLang = $idiomas->list(["habilitado = 1"], "", "");
#Se carga la sesión del usuario
$usuario = $usuarios->viewSession();
#Se carga la configuración de contacto
$contactData = $config->viewContact();
$socialData = $config->viewSocial();
$sesionActiva = isset($_SESSION['usuarios']['cod']) ? true :  false;
#Captcha
$captchaData = $config->viewCaptcha();
#Si existe la sesión y no es invitado, entonces se habilita el botón de mi cuenta en la nav
$habilitado = (isset($usuario["invitado"]) && $usuario["invitado"] == 0) ?  true : false;
?>
<div class="g-recaptcha" data-sitekey="<?= $captchaData['data']['captcha_key'] ?>" data-callback="onSubmit" data-size="invisible"></div>
<!-- header area starts -->
<header id="collapse-group">
    <div class="header-top theme1 bg-dark pt-2 pb-2">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 col-sm-8 order-last hidden-xs hidden-sm   order-sm-first">
                    <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
                        <div class="social-network2">
                            <ul class="d-flex">
                                <?php
                                foreach ($socialData['data'] as $key => $value) {
                                    if (!$value) continue;
                                    echo  "<li><a class='fs-18 color-white ml-10' href='" . $value . "' target='_blank'><i class='fab fa-" . $key . "'></i></a></li>";
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="media static-media ml-4 d-flex align-items-center">
                            <div class="media-body">
                                <div class="phone">
                                    <?php if (!empty($contactData['data']['whatsapp'])) { ?>
                                        <a href="https://wa.me/<?= str_replace(" ", "", $contactData['data']['whatsapp']) ?>" class="text-white fs-12 mr-10"><i class="fa fa-phone color-white" aria-hidden="true"></i> <?= $contactData['data']['whatsapp'] ?> </a>
                                    <?php } ?>
                                    <?php if (!empty($contactData['data']['telefono'])) { ?>
                                        <a href="tel:<?= $contactData['data']['telefono'] ?>" class="text-white fs-12"><i class="fa fa-phone color-white" aria-hidden="true"></i> <?= $contactData['data']['telefono'] ?></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4  ">
                    <nav class="navbar-top pb-2 pb-sm-0 position-relative">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="searchbar hidden-md-down">
                                    <input class="search_input fs-13   search-bar" id="search-bar-nav" type="text" name="title" placeholder="<?= $_SESSION["lang-txt"]["productos"]["buscar_productos"] ?>">
                                </div>
                            </div>
                            <div class="col-md-2" style="align-self: center;">
                                <select id="cmbIdioma" onchange="changeLang('<?= URL ?>',this.value)" style="width: 50px;">
                                    <?php foreach ($listLang as $idioma_) {  ?>
                                        <option value="<?= $idioma_["data"]["cod"] ?>" data-iconurl="<?= URL_ADMIN ?>/img/idiomas/<?= $idioma_["data"]["cod"] ?>.png" <?= $idioma_["data"]["cod"] == $_SESSION['lang'] ? "selected" : "" ?>></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="header-1 pt-25">
        <div class="container">
            <div class="row">
                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-7 order-md-2 order-lg-1">
                    <div class="logo text-md-center text-lg-left">
                        <a href="<?= URL ?>"><img width="150px" src="<?= LOGO ?>" alt="<?= TITULO ?>"></a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-3 order-md-1 offset-sm-2 offset-md-0 order-lg-2 col-sm-auto">
                    <nav>
                        <div id="mobile-menu" class="main-menu">
                            <?= $menu->build_nav("", "", "web") ?>
                        </div>
                    </nav>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-5 order-md-3 order-lg-3">
                    <div class="nav-icons">
                        <ul class="d-flex">
                            <li>
                                <a class="offcanvas-toggle" data-toggle="collapse" href="#collapseFavoritos" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <span class="position-relative">
                                        <i class="far fa-heart fs-18"></i>
                                    </span>
                                </a>
                                <div class="collapse collapse-favoritos" id="collapseFavoritos" data-parent="#collapse-group">
                                    <div class="head d-flex flex-wrap justify-content-betwe en">
                                        <span class="title"><i class="fa fa-heart" aria-hidden="true"></i>
                                            <?= $_SESSION["lang-txt"]["sesion"]["mis_favoritos"] ?></span>
                                    </div>
                                    <?php
                                    if ($sesionActiva) { ?>
                                        <ul class="minicart-product-list product_bar_fav">
                                            <li>
                                                <div class="row grid-favorites" data-col="12" data-url="<?= URL ?>" data-favorites="true">
                                                </div>
                                            </li>
                                        </ul>
                                    <?php } else { ?>
                                        <div class="alert alert-warning" role="alert">
                                            <?= $_SESSION["lang-txt"]["sesion"]["logearte_favoritos"] ?> <a href="<?= URL ?>/usuarios?link=<?= CANONICAL ?>">
                                                <?= $_SESSION["lang-txt"]["sesion"]["click_aqui_productos"] ?></a></div>
                                    <?php } ?>
                                </div>
                            </li>
                            <li class="mr-xl-0 cart-block position-relative">
                                <a class="offcanvas-toggle" data-toggle="collapse" href="#collapseCart" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <span class="position-relative">
                                        <i class="fas fa-shopping-bag fs-18"></i>
                                        <span class="badge cbdg1 amountCartNav"></span>
                                    </span>
                                </a>
                                <div class="collapse collapse-cart" id="collapseCart" data-parent="#collapse-group">
                                    <div class="head d-flex flex-wrap justify-content-between">
                                        <span class="title"><i class="fa fa-cart-arrow-down fs-14" aria-hidden="true"></i>
                                            <?= $_SESSION["lang-txt"]["carrito"]["mi_carrito"] ?></span>
                                    </div>
                                    <cart></cart>
                                    <div class="container">
                                        <btn-finish-cart></btn-finish-cart>
                                    </div>
                                    <?php if (isset($_SESSION["usuarios"]["cod"])) { ?>
                                        <div class="row">
                                            <div class="col-12"><a onclick="saveCartPerFile('<?= URL ?>')" class="btn-cart pull-left py-3"><i class="fa fa-save" aria-hidden="true"></i> <?= $_SESSION["lang-txt"]["carrito"]["guardar"] ?></a></div>
                                            <div class="col-12"><a href="<?= URL ?>/sesion/carritos" class="btn-cart pull-right py-3"> <?= $_SESSION["lang-txt"]["carrito"]["ver_guardados"] ?></a>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="row pull-left">
                                            <div class="col-md-12"><a href="<?= URL ?>/usuarios?carrito=1" class="btn-cart  fs-14 py-3"><i class="fa fa-save" aria-hidden="true"></i> <?= $_SESSION["lang-txt"]["carrito"]["guardar"] ?></a></div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </li>
                            <li style="width: 46px;">
                                <?php if ($habilitado) { ?>
                                    <a class="fs-18" data-toggle="collapse" href="#collapseUser" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <i class="fas fa-user"></i>
                                        <i class="fas fa-angle-down"></i>
                                    </a>
                                    <ul class="collapse collapse-user" id="collapseUser" data-parent="#collapse-group">
                                        <li><a class="fs-14" href="<?= URL . "/sesion" ?>">
                                                <i class="fas fa-user"></i> <?= $_SESSION["lang-txt"]["usuarios"]["mi_cuenta"] ?></a></li>
                                        <li><a class="fs-14" href="<?= URL . "/sesion?logout" ?>">
                                                <i class="fas fa-sign-out-alt"></i> <?= $_SESSION["lang-txt"]["usuarios"]["salir"] ?></a></li>
                                    </ul>
                                <?php } else { ?>
                                    <a class="fs-18" href="<?= URL ?>/usuarios"> <i class="fas fa-user"></i></a>
                                <?php } ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mobile-menu"></div>
        </div>
    </div>
</header>
<!-- header area ends -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $('#search-bar-nav').keypress(function(event) {
        var keycode = event.keyCode || event.which;
        if (keycode == '13') {
            document.location.href = "<?= URL ?>/productos/b/titulo/" + $('#search-bar-nav').val();
        }
    });
</script>