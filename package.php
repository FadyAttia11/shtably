<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
    $user_name = $user_data['user_name'];

    $package_name = $_GET["name"];
    $package_cost = $_GET["cost"];
    $msg = '';
    $Precentage = 0.0;
    $Cracking = "false";
    $Isolation = "false";
    $Plumbing = "false";
    $Electricity = "false";
    $ACs = "false";
    $Carpentry = "false";
    $Gibson = "false";
    $Paint = "false";
    $Floors = "false";
    $Alumetal = "false";

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        if(isset($_POST['full_package'])) {
            $get_money_query = "select * from users where user_role = 'admin'";
            $get_money = mysqli_query($con, $get_money_query);
        
            if($get_money && mysqli_num_rows($get_money) > 0) {
                $current_money = mysqli_fetch_assoc($get_money);
                $updated_money = $current_money['balance'] + $package_cost;
        
                $add_money_query = "update users set balance = '$updated_money' where user_role = 'admin'";
                $add_money = mysqli_query($con, $add_money_query);
        
                if($add_money) {
                    $query = "insert into packages (package_name,client_name,price) values ('$package_name','$user_name','$package_cost')";
                    $result = mysqli_query($con, $query);
    
                    if($result) {
                        $msg = "Successfully Added This Package";
                    } else {
                        $msg = "Error Adding This Package";
                    }
    
                } else {
                    $msg = "error adding money to our account";
                }
            } 

        } else {
    
            if(isset($_POST['Cracking'])) {
                $Cracking = "true";
                $Precentage += 0.12;
            }
            if(isset($_POST['Isolation'])) {
                $Isolation = "true";
                $Precentage += 0.12;
            }
            if(isset($_POST['Plumbing'])) {
                $Plumbing = "true";
                $Precentage += 0.12;
            }
            if(isset($_POST['Electricity'])) {
                $Electricity = "true";
                $Precentage += 0.12;
            }
            if(isset($_POST['ACs'])) {
                $ACs = "true";
                $Precentage += 0.12;
            }
            if(isset($_POST['Carpentry'])) {
                $Carpentry = "true";
                $Precentage += 0.12;
            }
            if(isset($_POST['Gibson'])) {
                $Gibson = "true";
                $Precentage += 0.12;
            }
            if(isset($_POST['Paint'])) {
                $Paint = "true";
                $Precentage += 0.12;
            }
            if(isset($_POST['Floors'])) {
                $Floors = "true";
                $Precentage += 0.12;
            }
            if(isset($_POST['Alumetal'])) {
                $Alumetal = "true";
                $Precentage += 0.12;
            }

            $get_money_query = "select * from users where user_role = 'admin'";
            $get_money = mysqli_query($con, $get_money_query);
        
            if($get_money && mysqli_num_rows($get_money) > 0) {
                $current_money = mysqli_fetch_assoc($get_money);
                $deposit = $package_cost * $Precentage;
                $updated_money = $current_money['balance'] + $deposit;
        
                $add_money_query = "update users set balance = '$updated_money' where user_role = 'admin'";
                $add_money = mysqli_query($con, $add_money_query);
        
                if($add_money) {
                    $query = "insert into points (package_name,client_name,price,Cracking,Isolation,Plumbing,Electricity,ACs,Carpentry,Gibson,Paint,Floors,Alumetal) values ('$package_name','$user_name','$package_cost','$Cracking','$Isolation','$Plumbing','$Electricity','$ACs','$Carpentry','$Gibson','$Paint','$Floors','$Alumetal')";
                    $result = mysqli_query($con, $query);
    
                    if($result) {
                        $msg = "Successfully Added Your Points";
                    } else {
                        $msg = "Error Adding Your Points";
                    }
    
                } else {
                    $msg = "error adding money to our account";
                }
            } 
        } 
    }
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
              <li class="active"><a href="packages.php">Choose Packages</a></li>
              <li><a href="engineers.php">Our Engineers</a></li>
              <li><a href="workers.php">Our Workers</a></li>
              <li><a href="my-cart.php">My Cart</a></li>
              <li><a href="#">Client: <?php echo $user_data['user_name'] ?></a></li>
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
              <li>Package: <?php echo $package_name ?></li>
            </ol>
            <h2>Package: <?php echo $package_name ?></h2>
          </div>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container">
            <h2>Package: <?php echo $package_name ?></h2>
            <h3><?php echo $msg ?></h3>
            <p>Package Cost: <?php echo $package_cost ?> L.E</p>
            <p>Note: prices here are the reservations price (10% of the total price)</p>

            <form method="post">
                <!-- Button to Open the Modal -->
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                Get The Full Package
              </button>

              <!-- The Modal -->
              <div class="modal fade" id="myModal">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Get the Full Package</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                    <div class="form-group mt-2">
                    <label>Card holder's name</label>
                    <input type="text" placeholder="Card holder's name" class="form-control" required>
                    </div>
                    <div class="form-group">
                    <label>Card number</label>
                    <input type="number" placeholder="Card number" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Expire Date</label>
                        <input type="date" placeholder="dd/mm/yy" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>CVV</label>
                        <input type="text" placeholder="CVV" class="form-control" required>
                    </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <input type="hidden" name="full_package" value="full_package">
                      <input type="submit" class="btn btn-primary m-auto" value="Submit Your Request">
                    </div>

                  </div>
                </div>
              </div>
            </form>

            <form method="post" class="mt-5">
                <h4>Get Certain Points from the package</h4>
                <p>Note: Each point on this package costs 12% of the total package cost</p>
                <input type="checkbox" id="Cracking" name="Cracking" value="true">
                <label for="Cracking"> Cracking</label><br>
                <input type="checkbox" id="Isolation" name="Isolation" value="true">
                <label for="Isolation"> Isolation</label><br>
                <input type="checkbox" id="Plumbing" name="Plumbing" value="true">
                <label for="Plumbing"> Plumbing</label><br>
                <input type="checkbox" id="Electricity" name="Electricity" value="true">
                <label for="Electricity"> Electricity</label><br>
                <input type="checkbox" id="ACs" name="ACs" value="true">
                <label for="ACs"> ACs</label><br>
                <input type="checkbox" id="Carpentry" name="Carpentry" value="true">
                <label for="Carpentry"> Carpentry</label><br>
                <input type="checkbox" id="Gibson Board" name="Gibson" value="true">
                <label for="Gibson Board"> Gibson Board</label><br>
                <input type="checkbox" id="Paint" name="Paint" value="true">
                <label for="Paint"> Paint</label><br>
                <input type="checkbox" id="Floors" name="Floors" value="true">
                <label for="Floors"> Floors</label><br>
                <input type="checkbox" id="Alumetal" name="Alumetal" value="true">
                <label for="Alumetal"> Alumetal</label><br>

                <!-- Button to Open the Modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">
                    Get These points only
                </button>

                <!-- The Modal -->
                <div class="modal fade" id="myModal2">
                    <div class="modal-dialog">
                        <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Get These points only</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                        <div class="form-group mt-2">
                        <label>Card holder's name</label>
                        <input type="text" placeholder="Card holder's name" class="form-control" required>
                        </div>
                        <div class="form-group">
                        <label>Card number</label>
                        <input type="number" placeholder="Card number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Expire Date</label>
                            <input type="date" placeholder="dd/mm/yy" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>CVV</label>
                            <input type="text" placeholder="CVV" class="form-control" required>
                        </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary m-auto" value="Submit Your Request">
                        </div>

                        </div>
                    </div>
                </div>

                
            </form>
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