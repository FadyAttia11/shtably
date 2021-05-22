<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);

    $all_points_query = "select * from packages join users on packages.client_name = users.user_name where Full = 'false'";
    $all_points = mysqli_query($con, $all_points_query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Shtably</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-inner-pages">
    <div class="container-fluid">

      <div class="row justify-content-center">
        <div class="col-xl-10 d-flex align-items-center justify-content-end">

          <h1 class="logo mr-auto"><a href="index.php">Shtably</a></h1>
          <!-- Uncomment below if you prefer to use an image logo -->
          <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

          <nav class="nav-menu d-none d-lg-block">
          <ul>
              <li><a href="index.php">Home</a></li>
              <li><a href="new-profession.php">Add new Profession</a></li>
              <li><a href="package-reserv.php">Packages Reservations</a></li>
              <li class="active"><a href="point-reserv.php">Points Reservations</a></li>
              <li><a href="profession-reserv.php">Profession Reservations</a></li>
              <li><a href="#">Balance: <?php echo $user_data['balance'] ?> L.E</a></li>
              <li><a href="logout.php">Logout</a></li>

            </ul>
          </nav><!-- .nav-menu -->

        </div>
      </div>
    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container-fluid">

        <div class="row justify-content-center">
          <div class="col-xl-10">
            <ol>
              <li><a href="index.php">Home</a></li>
              <li>Packages Reservations</li>
            </ol>
            <h2>Packages Reservations</h2>
          </div>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
        <div class="container">
            <div class="row">
                <?php
                while($row = mysqli_fetch_array($all_points)) {
                ?>

                <div class="card col-5 ml-2" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Package Name: <?php echo $row['package_name'] ?></h5>
                        <p class="card-text">Package Price: <?php echo $row['price'] ?> L.E</p>
                        <p class="card-text">Client Name: <?php echo $row['client_name'] ?></p>
                        <p class="card-text">Client Phone: 0<?php echo $row['phone'] ?></p>
                        <p class="card-text">Client Address: <?php echo $row['address'] ?></p>
                        <h5>Points: </h5>
                        <?php 
                            if ($row['Cracking'] == 'true') {
                                echo "Cracking ";
                            }
                            if ($row['Isolation'] == 'true') {
                                echo "Isolation ";
                            }
                            if ($row['Plumbing'] == 'true') {
                                echo "Plumbing ";
                            }
                            if ($row['Electricity'] == 'true') {
                                echo "Electricity ";
                            }
                            if ($row['ACs'] == 'true') {
                                echo "ACs ";
                            }
                            if ($row['Carpentry'] == 'true') {
                                echo "Carpentry ";
                            }
                            if ($row['Gibson'] == 'true') {
                                echo "Gibson ";
                            }
                            if ($row['Paint'] == 'true') {
                                echo "Paint ";
                            }
                            if ($row['Floors'] == 'true') {
                                echo "Floors ";
                            }
                            if ($row['Alumetal'] == 'true') {
                                echo "Alumetal ";
                            }
                        ?>
                    </div>
                </div>

                <?php } ?>
            </div>
        </div>
    </section>

  </main><!-- End #main -->




  <div id="preloader"></div>
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>