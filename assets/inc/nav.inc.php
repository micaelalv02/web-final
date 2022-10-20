<!-- ======= Header ======= -->
<header id="header" class="fixed-top header-inner-pages">
  <div class="container d-flex align-items-center">
    <h1 class="logo me-auto"><a href="<?= URL ?>"></a></h1>
    <!-- Uncomment below if you prefer to use an image logo -->
    <a href="<?= URL ?>" class="logo me-auto"><img src="assets/theme/assets/img/logo.png" alt="" class="img-fluid"></a>

    <nav id="navbar" class="navbar">
      <ul>
        <li><a class="nav-link scrollto <?= (CANONICAL == URL) ? 'active' : '' ?>" href="<?= URL ?>">Home</a></li>
        <li><a class="nav-link scrollto <?= strpos(CANONICAL,"empresa") !== false ? 'active' : '' ?>" href="<?= URL ?>/empresa">Sobre Nosotros</a></li>
        <li><a class="nav-link scrollto <?= strpos(CANONICAL,"c/novedades") !== false ? 'active' : '' ?>" href="<?= URL ?>/c/novedades">Novedades</a></li>
        <li><a class="nav-link scrollto <?= strpos(CANONICAL,"c/portafolio") !== false ? 'active' : '' ?>" href="<?= URL ?>/c/portafolio">Portfolio</a></li>
        <li><a class="nav-link scrollto <?= strpos(CANONICAL,"c/servicios") !== false ? 'active' : '' ?>" href="<?= URL ?>/c/servicios">Servicios</a></li>
        <!--<li><a class="nav-link scrollto" href="#contact">Contact</a></li>-->
        <li><a class="getstarted scrollto" href="<?= URL ?>/contacto">Contacto</a></li>
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
      <!--<li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li>-->
    </nav><!-- .navbar -->

  </div>
</header><!-- End Header -->