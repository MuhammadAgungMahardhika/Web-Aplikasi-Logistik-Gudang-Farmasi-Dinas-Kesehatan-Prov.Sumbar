<?php
session_start();
include('connect.php');
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];
 
    $result = mysqli_query($conn,"SELECT username FROM admin WHERE nip=$id ");

    $row = mysqli_fetch_assoc($result);

    if ($key === hash('md5',$row['username'])) {
        $_SESSION['login']= true ;
    }
}


if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit();
}


if (isset($_POST['submit'])) {
     $username= trim($_POST['username']);
     $password= trim($_POST['password']);

     if ($username =="" || $password =="") {
        header("Location: loginerror.php?e=1");
        exit();
     }

     $sql=mysqli_query($conn,"SELECT * FROM admin where username='$username'AND password='$password' ");

     if (mysqli_num_rows($sql) !=0) {
        $row =mysqli_fetch_assoc($sql);
        session_start();
        $_SESSION['login'] = true;

//cek remember me
        setcookie('nip',$row['nip']);
        if (isset($_POST['remember'])) {    
        //membuat cookie
        setcookie('id',$row['nip'],time()+1200);
        setcookie('key',hash('md5',$row['username']),time()+1200);
        }
        header("Location: index.php");
     }

     else{
        header("Location: loginerror.php?e=2");
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
        <title>SISTEM INFORMASI LOGISTIK DINAS KESEHATAN PROVINSI SUMATERA BARAT</title>
        <link rel="icon" href="img/dinkes.png">
       
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
                                        <form method="POST" action="">
                                            <div class="form-group">

                                                <div class="input-group mb-3">
                                                  <span class="input-group-text " id="basic-addon1"><i class="fa fa-user"></i></span>
                                                  <input class="form-control py-4" id="inputUserName" type="text" placeholder="Masukan Nama Pengguna" name="username" />
                                                </div>
                                            </div>
                                            <div class="form-group">

                                                <div class="input-group mb-3">
                                                  <span class="input-group-text " id="basic-addon1"><i class="fa fa-lock"></i></span>
                                                 <input class="form-control py-4" id="inputPassword" type="password" placeholder=" Masukan Kata Sandi" name="password" autocomplete="" />
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" name="remember" />
                                                    <label class="custom-control-label" for="rememberPasswordCheck">Ingat Saya</label>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="lupasandi.php">Lupa Kata Sandi?</a>
                                                <button type="submit" class="btn btn-primary" href="index.html" name="submit">Masuk</button>
                                            </div>
                                        </form>
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
