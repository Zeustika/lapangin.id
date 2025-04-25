<?php
session_start();
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billiard Billing - Status Ketersediaan Lapangan</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="img/bill.png"/>
    <!-- Custom styles -->
    <link href="css/yozz.min.css" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <style>
        body {
            background: url('img/nack.avif');
            background-size: 30%;
            color: #fff;
        }
        .container {
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            padding: 30px;
        }
        .table {
            background-color: rgba(255, 255, 255, 0.8);
            color: #000;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-secondary:disabled {
            background-color: #343a40;
        }
    </style>
</head>
<body id="page-top">

<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
  <div class="container-fluid">
    <a class="navbar-brand js-scroll-trigger" href="#page-top">eightspacebilliard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav text-uppercase ms-auto">
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#pesan">pesan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#portfolio">Profil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#contact">Kontak Kami</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<style>
  body {
    padding-top: 56px; /* Tambahkan padding agar konten tidak tertutup navbar */
  }
  * {box-sizing:border-box}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Hide the images by default */
.mySlides {
  display: none;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  margin-top: -22px;
  padding: 16px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/*  */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  animation-name: fade;
  animation-duration: 1.5s;
}

@keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}
</style>

<!-- Header -->
<header class="masthead">
    <div class="container">
        <div class="intro-text">
            <div class="intro-lead-in">Welcome To</div>
            <div class="intro-heading text-uppercase">eightspacebilliard</div>
            <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#pesan">Selengkapnya</a>
        </div>
    </div>
</header>
<!-- Slideshow container -->
<div class="slideshow-container">

  <!-- Full-width images with number and  -->
  <div class="mySlides fade">
    <div class="numbertext">1 / 3</div>
    <img src="img/slide/img1.jpg" style="width:100%">
    <div class="text"></div>
  </div>

  <div class="mySlides fade">
    <div class="numbertext">2 / 3</div>
    <img src="img/slide/img2.jpg" style="width:100%">
    <div class="text"></div>
  </div>

  <div class="mySlides fade">
    <div class="numbertext">3 / 3</div>
    <img src="img/slide/img3.jpg" style="width:100%">
    <div class="text"></div>
  </div>

  <!-- Next and previous buttons -->
  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>


<!-- Status Ketersediaan Lapangan Section -->
<section id="pesan" class="mt-5">
    <div class="container">
        <h1 class="text-center mb-4">Status Ketersediaan Table</h1>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Nama Table</th>
                    <th>Jenis Table</th>
                    <th>Status</th>
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) { echo "<th>Ketersediaan</th>"; } ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT id_lapangan, nama_lapangan, jenis_lapangan, status FROM lapangan";
                $result = $mysqli->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["nama_lapangan"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["jenis_lapangan"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["status"]) . "</td>";
                        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                            if ($row["status"] == "Tersedia") {
                                echo "<td><a class='btn btn-primary' href='booking.php?id_lapangan=" . $row["id_lapangan"] . "'>Pesan</a></td>";
                            } else {
                                echo "<td><button class='btn btn-secondary' disabled>Tidak Tersedia</button></td>";
                            }
                        }
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="text-center">
            <?php 
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                echo '<p><a class="btn btn-danger" href="logout.php">Logout</a></p>'; 
            } else {
                echo '<p><a class="btn btn-success" href="login_pengguna.php">Login Pengguna</a></p>';
                echo '<p><a class="btn btn-info" href="register.php">Sign Up Pengguna</a></p>';
            }
            ?>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact">
    <div class="container">
        <h2 class="text-center text-uppercase">Kontak Kami</h2>
        <h3 class="section-subheading text-muted text-center">Silakan menghubungi kami melalui form di bawah ini:</h3>
        <form id="contactForm" name="sentMessage" novalidate="novalidate">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input class="form-control" id="name" type="text" placeholder="Nama *" required data-validation-required-message="Silahkan masukkan nama Anda terlebih dahulu.">
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="email" type="email" placeholder="Email *" required data-validation-required-message="Silahkan masukkan email Anda terlebih dahulu.">
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="subject" type="text" placeholder="Perihal *" required data-validation-required-message="Silahkan masukkan perihal terlebih dahulu.">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <textarea class="form-control" id="message" placeholder="Isi Pesan *" required data-validation-required-message="Silahkan isi pesan terlebih dahulu."></textarea>
                    </div>
                </div>
                <div class="col-lg-12 text-center">
                    <button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase" type="submit">Kirim Pesan</button>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="container text-center">
        <span class="copyright">Copyright 2024 &copy; All Rights Reserved</span>
        <ul class="list-inline quicklinks mt-3">
            <li class="list-inline-item">
                <a href="https://www.youtube.com/@yustikaslamet9432/videos">Tugas RPL Informatika UNSIL 2024</a>
            </li>
        </ul>
    </div>
</footer>

<!-- Bootstrap JS, Popper.js, and jQuery -->
<script>let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  slides[slideIndex-1].style.display = "block";
  setTimeout(showSlides, 2500); // Change image every 2 seconds
}</script> 

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>