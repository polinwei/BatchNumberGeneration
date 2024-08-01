<?php
require 'config.php';

$today_max_qrcode = '';
$filename = '';
$updateDate = '';
if (isset($_REQUEST['op']) && $_REQUEST['op']=='getBatchNo' ) {
  //QRCode 產生的模式 1:一天只有一個批號, 2:每次取得新的批號
  if (GENERATE_MODE==1) {
    $qrcode_data = get_today_one_qrcode();
  } else {
    $qrcode_data = get_today_max_qrcode();
  } 
} else {
  $qrcode_data = get_today_current_qrcode();
}
if (!empty($qrcode_data)) {
  $today_max_qrcode = $qrcode_data['qrcode_date'] . $qrcode_data['qrcode_no'];
  $filename = $qrcode_data['qrcode_filename'];
  $updateDate = $qrcode_data['updateDate'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>生產批號產生器</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: FlexStart
  * Updated: Mar 10 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="<?php echo home_url(); ?>" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span>KP-KMI</span>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="<?php echo home_url(); ?>">Home</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up" class="text-center">KMI 出站必刷</h1>          
          <?php
            if (GENERATE_MODE==1) {
              echo '<h4 data-aos="fade-up" class="text-center">目前模式為: 1:一天只有一個批號</h4>';
            } else {
              echo '<h4 data-aos="fade-up" class="text-center">目前模式為: 2:每次取得新的批號</h4>';
            }
          ?>
          <h3 data-aos="fade-up" class="text-center">請按下方按鈕 取得生產批號 !!</h3>
          <div data-aos="fade-up" data-aos-delay="100">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
              <input type="hidden" name="op" value="getBatchNo">
              <div class="col-md-12">
                <button type="submit" class="btn-get-started">取得生產批號
                  <i class="bi bi-arrow-right"></i>
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 hero-img" data-aos="zoom-out" data-aos-delay="100">
          <img src="<?php echo PNG_WEB_DIR . basename($filename); ?>" class="img-fluid" alt="">
          <header class="section-header">
            <p> <?php echo $today_max_qrcode.'<br/>'; ?> </p>
            <h2>
              <?php echo '產生時間:'. $updateDate; ?>
            </h2>
          </header>
        </div>
      </div>
    </div>
  </section><!-- End Hero -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>FlexStart</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/flexstart-bootstrap-startup-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Modified by 魏明盛
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>