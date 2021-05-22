<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);

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
              <li class="active"><a href="new-profession.php">Add new Profession</a></li>
              <li><a href="package-reserv.php">Packages Reservations</a></li>
              <li><a href="point-reserv.php">Points Reservations</a></li>
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
              <li>Add New Profession</li>
            </ol>
            <h2>Add New Profession</h2>
          </div>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
        <div class="container">
            <h3>Add New Profession</h3>
            <form method="post" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="col">
                        <label>Professional Name: </label>
                        <input type="text" class="form-control" placeholder="Ex: Ahmed Ashraf" name="name" required>
                    </div>
                    <div class="col">
                        <label>Major: </label>
                        <select class="form-control mb-3" name="major" required>
                            <option disabled selected value>Engineer</option>
                            <option value="Civil">Civil Engineer</option>
                            <option>Architect</option>
                            <option disabled value>Worker</option>
                            <option>Carpenter</option>
                            <option>Plumber</option>
                            <option>Electrician</option>
                            <option>Painter</option>
                        </select> 
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label>Experience: (In Years)</label>
                        <input type="number" class="form-control" placeholder="Ex: 3" name="experience" required>
                    </div>
                    <div class="col">
                        <label>Salary: (Monthly for engineer & Daily for worker)</label>
                        <input type="number" class="form-control" placeholder="Ex: 120" name="salary" required>
                    </div>
                </div>

                <label for="fileToUpload">Profile Picture: </label>
                <input type="file" name="fileToUpload" class="mb-3" id="fileToUpload" required><br>

                <button type="submit" class="btn btn-primary">Add This Professional</button>
                <?php 
                    if($_SERVER['REQUEST_METHOD'] == "POST") {
                        $image = '';
                        $name = $_POST['name'];
                        $major = $_POST['major'];
                        $experience = $_POST['experience'];
                        $salary = $_POST['salary'];
                
                        $target_dir = "uploads/";
                        $target_file = $target_dir . time() . basename($_FILES["fileToUpload"]["name"]);
                
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                            $image = time() . basename($_FILES["fileToUpload"]["name"]);
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                        
                        $query = "insert into profession (name,major,experience,salary,image) values ('$name','$major','$experience','$salary','$image')";
                        $result = mysqli_query($con, $query);
            
                        if($result) {
                            echo "Successfully added this professional!";
                        } else {
                            echo "Error adding this professional!";
                        }
                    }
                ?>
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