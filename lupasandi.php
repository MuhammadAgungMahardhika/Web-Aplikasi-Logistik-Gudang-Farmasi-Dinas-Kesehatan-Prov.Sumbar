<?php
require 'function.php';

if (isset($_POST['lupaakun'])) {
     $nip= trim($_POST['nip']);
     $namapengguna= trim($_POST['namapengguna']);
     $tanggal_lahir = trim($_POST['tanggal_lahir']);

     $enkrip = base64_encode($nip);
     if ($nip =="" || $namapengguna =="" || $tanggal_lahir =="") {
        
        echo "<script>

            window.addEventListener('load',function(){
                
            Swal.fire('Gagal','Silahkan masukan data pengguna!','error');
            setTimeout(function(){

                document.location.href = 'lupasandi.php';


                },1000);
            });

            </script>
        ";
        exit();
     }

     $sql=mysqli_query($conn,"SELECT * FROM admin where nip='$nip'AND username='$namapengguna' AND tanggal_lahir = '$tanggal_lahir' ");

     if (mysqli_num_rows($sql) !=0) {
        $row =mysqli_fetch_assoc($sql);
        session_start();
        $_SESSION['login'] = true;
        $_SESSION['akun'] = true;


         header("Location: akun.php?nip=$enkrip");
     }

     else{
           echo "<script>

            window.addEventListener('load',function(){
                
            Swal.fire('Gagal','Data pengguna salah!','error');
            setTimeout(function(){

                document.location.href = 'lupasandi.php';


                },1000);
            });

            </script>
        ";


        exit();

     }



}
    


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>SISTEM INFORMASI LOGISTIK</title>
        <link rel="icon" href="img/dinkes.png">
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication" style="background-image: url(img/tambahuser1.jpg);background-size: cover;">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Lupa password</h3></div>
                                    <div class="card-body">
                                        <form action="" method="POST">
                                            <div class="form-row">
                                                <div class="col-lg">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Nip</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="number" name="nip" placeholder="Masukan Nip" />
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Nama Pengguna</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="text"  name="namapengguna" placeholder="Masukan nama pengguna" />
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Tanggal lahir</label>
                                                        <input class="form-control py-4" id="inputPassword" type="date" name="tanggal_lahir" />
                                                    </div>
                                                </div>
                                              
                                            </div>

                                            <div  class="form-group mt-4 mb-0" name="lupaakun"  type="submit"><button class="btn btn-primary btn-block" type="submit"  name="lupaakun">Lihat password</a></button>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="login.php">login</a></div>
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
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>

        <script src="js/dist/sweetalert2.all.min.js"></script>
    </body>
</html>
