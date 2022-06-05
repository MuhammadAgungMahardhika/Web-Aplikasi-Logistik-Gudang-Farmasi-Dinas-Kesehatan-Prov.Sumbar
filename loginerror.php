<?php





?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>SISTEM INFORMASI LOGISTIK DINAS KESEHATAN PROVINSI SUMATERA BARAT</title>
       
         <link rel="stylesheet" href="css/login.css">

        <!-- font awesome -->
        <script src="fontawesome-free-5.15.2-web/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content" style="background-image: url(img/login1.jpg); background-size: cover; ">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="font-family: belgates">Selamat Datang</h3></div>
                                    <div class="card-body">
                                       
                                    	<?php
											if (isset($_GET['e'])) {
												$eror = $_GET['e'];

												if ($eror==1) {
													echo "<p>Silahkan Masukan Username dan Password</p>";?>
													<a href="login.php">Kembali</a><?php
												}
												elseif ($eror==2) {
												echo "<p> Username atau password anda Salah  </p>";
												?> 

												<a href="login.php">Kembali</a>

												<?php

												}

											}

												
											?>

                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small">Dinas Kesehatan Provinsi Sumatera Barat</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Dinas Kesehatan Provinsi Sumatera Barat 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

       
                <!-- Jquery -->
               <script src="js/jquery/jquery-3.5.1.slim.js" crossorigin="anonymous"></script>
               <!-- akhir Jquery -->


                <!-- Css Js Bootsrap 4 -->
                     <script src="css/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>


                 <!--My Js  -->

                <script src="js/scripts.js"></script>
                <!-- akhir My Js -->
                       
            
    </body>
</html>
