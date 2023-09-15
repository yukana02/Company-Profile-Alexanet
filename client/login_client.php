<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="../css/bootstrap.css" type="text/css" rel = "stylesheet"/>
    <link href="../css/main.css" type="text/css" rel = "stylesheet"/>
    <link rel="icon" href="../images/nobg-alexanet.png" type="image/icon type">
    <title>Login Client | Alexanet</title>
  </head>
  <body>
    <header>
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark main-color nav-shadow mb-4">
            <a class="navbar-brand" href="../index.html"><img src="../images/nobg-alexanet.png" height="40" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarItem" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse text-white" id="navbarItem">
                <ul class="navbar-nav text-white">
                    <li class="nav-item active">
                        <a class="nav-link" href="../index.html">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="../layanan.html">Layanan</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="../tentangkami.html">Tentang Kami</a>
                    </li>
                    <li class="nav-item active ">
                        <a class="nav-link" href="login_client.php" >Login</a>
                    </li>
                   
                </ul>
            </div>
        </nav>
    </header>
    <br>
    <br>
    <section id="loginclient" class="bg-cyan container-fluid p-5 footer-color nav-shadow">
    <div class=" border main-body bg-cyan container-fluid p-5 main-color nav-shadow">
         <div class="border mt-5 ml-5 mr-4 mb-5">
            <form class="main mt-3 mb-5 mr-5 ml-5" action="login_client.php" method="POST" enctype="multipart/form-data">
                <div class="form-group mr-5">
                <label for="Userclient" class="form-label text-white">Username</label>
                <input type="text" name ="userclient" class="form-control" placeholder="Username">
                </div>
                <div class="form-group mr-5">
                <label for="Passwordclient" class="form-label text-white">Password</label>
                <input type="password" name ="passclient" class="form-control" placeholder="Password">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Login</button>
                    <?php
                    include "../connection.php";
                    error_reporting('0');
                    if(isset($_POST['submit'])){
                    $user=$_POST['userclient'];
                    $pass=$_POST['passclient'];
                    $result = mysqli_query($conn , "select * from client where username ='$user' and password='$pass'");
                    $data = mysqli_num_rows($result);
                    $row = mysqli_fetch_array($result);
                    // print_r($row);
                    // echo $data;
                    if($data >= 0){
                        //jika data cocok
                        if ($pass == $row['PASSWORD']) {
                            session_start();
                            $_SESSION['userclient'] = $user;
                            echo header('Location:Dashboard_client.php');
                        }else  {
                            //jika tidak cocok
                            echo "<div class='mt-4'><div class='alert alert-danger' role='alert'>Data tida cocok</div></div>";
                    }
                    }
                    } 
                    if(isset($_POST['halaman_utama'])){
                    echo header('Location:../index.php');}
                    if(isset($_POST['login_admin'])){
                    echo header('Location:login_admin.php');}
                    ?>
                    
                    <a href="../admin/login_admin.php" class="btn btn-primary">Login Admin</a>
            </form>
        </div>   
    </div>
    </section>
    <footer>
        <div class="card text-center">
            <div class="card-body main-color shadow-box">
                <div class="col-12"><img src="../images/nobg-alexanet.png" height="60px" alt=""></div>
                <div class="col-12"><p class="font-weight-bold mt-2">&copy 2022 Alexanet</p></div>
            </div>
            <div class="card-header footer-color text-white">
                Alexanet adalah tempat terbaik untuk memasang wifi Anda! Hubungi 
                <a href="https://api.whatsapp.com/send?phone=6285336786438&text=Halo%20MyAlexa%2C%20saya%20mau%20Pasang%20WiFi%20mohon%20dibantu%20Terimakasih." class="font-weight-bold text-white">
                    di sini
                </a>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="../js/jquery-3.2.1.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.js"></script>
  </body>
</html>