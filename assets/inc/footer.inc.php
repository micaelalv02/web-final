<?php
$config = new Clases\Config();
$contenidos = new Clases\Contenidos();
#Se carga la configuración de email
$socialData = $config->viewSocial();
$footer =  $contenidos->list(["filter" => ["contenidos.cod = 'footer'"]], $_SESSION["lang"], true);
?>

<!-- Footer Area Starts -->
<footer class="footer-area ">
  <div class="container">
    <div class="footer-menu pt-120">
      <?= $footer["data"]["contenido"] ?>
    </div>
  </div>
  <div class="footer-bottom mt-80">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="copyright mt-15">
            <p>2021 © Todos los derechos reservados <a href="<?= URL ?>" target="_blank"><?= TITULO ?></a>.
              Desarrollado por <a href="https://www.estudiorochayasoc.com" target="_blank">Estudio Rocha & Asociados</a>
            </p>
          </div>
        </div>
        <div class="col-md-4">
          <ul class="social-icon text-center mt-15">
            <?php
            foreach ($socialData['data'] as $key => $value) {
              if (!$value) continue;
              echo  "<li><a class='fs-18 ml-10' href='" . $value . "' target='_blank'><i class='fab fa-" . $key . "'></i></a></li>";
            }
            ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- first modal -->
<div class="modal fade theme1 style1" id="quick-view" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="add-quantity" id="cart-f" data-url="<?= URL ?>" onsubmit="addToCart('cart-f','','<?= URL ?>', '','');">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6 mx-auto col-lg-6 mb-5 mb-lg-0">
              <div id="img-slick"> </div>
              <div id="img-slick-nav"></div>
            </div>
            <div class="col-lg-6">
              <div class="modal-product-info">
                <div class="product-head">
                  <h2 class="title" id="modalPr-titulo"></h2>
                  <h4 class="sub-title"><span id="modalPr-cod"></span></h4>
                  <p id="modalPr-desarrollo" class="mt-10 mb-10 fs-16"></p>
                </div>
                <div class="product-body">
                  <span class="product-price text-center" id="modalPr-precio"></span>

                </div>
                <div class="d-flex">
                  <div class="product-size" id="modalPr-variacion"></div>
                </div>
                <div id="modalPr-fav"></div>
                <div id="modalPr-stock-finish"></div>
                <div id="modalPr-bulto"></div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- second modal -->

<!-- Scripts Template -->
<script src="<?= URL ?>/assets/theme/js/vendor/modernizr-3.11.2.min.js"></script>
<script src="<?= URL ?>/assets/theme/js/vendor/bootstrap.min.js"></script>
<script src="<?= URL ?>/assets/theme/js/vendor/popper.min.js"></script>
<script src="<?= URL ?>/assets/theme/js/vendor/jquery-mean-menu.min.js"></script>
<script src="<?= URL ?>/assets/theme/js/vendor/owl.carousel.min.js"></script>
<script src="<?= URL ?>/assets/theme/js/vendor/slick.min.js"></script>
<script src="<?= URL ?>/assets/theme/js/vendor/jquery.magnific-popup.min.js"></script>
<script src="<?= URL ?>/assets/theme/js/vendor/isotope.min.js"></script>
<script src="<?= URL ?>/assets/theme/js/vendor/jquery.nice-number.js"></script>
<script src="<?= URL ?>/assets/theme/js/scripts.js"></script>
<!-- Fin Scripts Template -->


<!-- Scripts CMS -->
<script src="<?= URL ?>/assets/js/services/lang.js"></script>
<script src="<?= URL ?>/assets/js/lightbox.js"></script>
<script src="<?= URL ?>/assets/js/jquery-ui.min.js"></script>
<script src="<?= URL ?>/assets/js/select2.min.js"></script>
<script src="<?= URL ?>/assets/js/bootstrap-notify.min.js"></script>
<script src="<?= URL ?>/assets/js/toastr.min.js"></script>
<script src="<?= URL ?>/assets/js/services/services.js"></script>
<script src="<?= URL ?>/assets/js/services/email.js"></script>
<script src="<?= URL ?>/assets/js/services/search.js"></script>
<script src="<?= URL ?>/assets/js/services/products.js"></script>
<script src="<?= URL ?>/assets/js/services/user.js"></script>
<script src="<?= URL ?>/assets/js/services/cart.js"></script>
<script src="<?= URL ?>/assets/js/sticky/sticky-sidebar.min.js"></script>
<!-- Fin Scripts CMS -->

<script>
  $(document).ready(function() {
    <?php if (isset($_SESSION['usuarios']['cod'])) { ?>
      getDataFavorites();
    <?php } ?>
    refreshCart($('body').attr('data-url'));
    $("price").removeClass("hidden");
    viewCart($('body').attr('data-url'));
  });
</script>