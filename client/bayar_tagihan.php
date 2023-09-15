<?php 

include('../connection.php');
session_start(); 
if($user = $_SESSION['userclient']){
$result = mysqli_query($conn , "select * from client WHERE username = '$user'");
$row = mysqli_fetch_array($result);
}
 else{
  echo header('Location:login_client.php');
}
error_reporting('0');
?> 
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="../css/bootstrap.css" type="text/css" rel = "stylesheet"/>
    <link href="../css/main.css" type="text/css" rel = "stylesheet"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link rel="icon" href="../images/nobg-alexanet.png" type="image/icon type">
    <title>Bayar Tagihan | Alexanet</title>
  </head>
  <body class="footer-color" >
    <header>
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark main-color nav-shadow mb-4">
            <a class="navbar-brand" href="Dashboard_client.php"><img src="../images/nobg-alexanet.png" height="40" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarItem" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse"id="navbarItem">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="Dashboard_client.php">Dashboard<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="bayar_tagihan.php">Bayar Tagihan</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="profil_client.php">Profil</a>
                    </li>
                    <li class="nav-item active ">
                        <a class="nav-link" href="../logout.php" >logout</a>
                    </li>
                   
                </ul>
            </div>
        </nav>
    </header>
    <br>
    <br>
    <div class="main-body mt-5 mr-5 ml-5 ">
        <h3 class="border card border-radius:20px;">
            <p class="p-3 text-center mt-3">
            BERIKUT ADALAH RINCIAN TAGIHAN ANDA
            </p>
        </h3>
            <div class="rincian border card card-body mt-3">
                <?php
                include('../connection.php');
                $no = 1;
                $result = mysqli_query($conn , "select client.*, paket_internet.*, status.*
                from client, paket_internet, status
                where 
                client.id_paket=paket_internet.id_paket and
                client.id_status=status.id_status and
                client.username='$user'");
                $data = mysqli_fetch_array($result);
                ?>
                <br>
                <div>
                    STATUS PEMBAYARAN ANDA SAAT INI &emsp;&emsp;&emsp; <span class="border p-3"style="background-color: #b0c838"><?=$data['STATUS']?></span>
                </div>
                <br><hr><br>
                <div class=" row mr-5 ml-5">
                    <div class="col-6">
                        NAMA </div>
                    <div class="col-6">
                        <?=$data['NAMA']?></div><hr>
                    <div class="col-6">
                        PAKET </div>
                    <div class="col-6">
                        <?=$data['ID_PAKET']?> </div><hr>
                     <div class="col-6">
                        TAGIHAN </div>
                    <div class="col-6">
                        <?=$data['TAGIHAN']?></div><hr>
                    <div class="col-6">
                        CATATAN DARI ADMIN </div>
                    <div class="col-6">
                        <?=$data['KETERANGAN']?> </div><hr>
                </div>
            </div>

            <div class="card mb-3 mt-3 border p-3">
                <form action="bayar_tagihan.php" method="POST" enctype="multipart/form-data">
                    <div>
                        <label for="formFile" class="form-label">Upload Bukti Pembayaran Anda</label>
                        <input class="form-control" type="file" name="buktifile" id="formFile">
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-primary" type="submit" name="simpan" value="upload">Upload</button>
                    </div>
                    
                    <?php
                    $id_client = $data['ID_CLIENT'];
                    //CEK STATUS PEMBAYAR JIKA LUNAS
                    if($data['ID_STATUS'] == "1"){
                        echo "<script>alert('TAGIIHAN ANDA SUDAH LUNAS');</script>";
                    }
                    //CEK STATUS PEMBAYARAN JIKA BELUM LUNAS
                    if($data['ID_STATUS'] == "2"){
                        $query = mysqli_query($conn, "SELECT ID_CLIENT FROM pembayaran_client  WHERE ID_CLIENT = '$id_client'");
                        //CEK DI TABLE PEMBAYARAN_CLIENT APAKAH ADA DATA DENGAN ID_CLINT = $id_client jika ada tidak bisa lanjut
                        if($query->num_rows > 0) {
                        echo "<script>alert('anda sudah upload bukti dan belum di konfirmasi admin');</script>";
                        }
                     //JIKA TIDAK ADA DATA YANG SAMA ATAU TIDAK ADA DATA, LANJUT PROSES
                    else {if(isset($_POST['simpan'])){
                        //tempat foto nanti di pindahkan
                        $direktori = "berkas/";
                        $file_name = $_FILES['buktifile']['name'];
                        //memindahkan file foto
                        move_uploaded_file($_FILES['buktifile']['tmp_name'],$direktori.$file_name);
                        //upload text di database
                        mysqli_query($conn,"INSERT INTO `pembayaran_client`(`ID_CLIENT`, `BUKTI_PEMBAYARAN`) VALUES('$id_client','$file_name' )");
                        echo "<div class='mt-4'><div class='alert alert-success' role='alert'>berhasil upload</div></div>";
                    }
                    }
                    }
                        ?>
                </form>
            </div>
            <div class="border card ml-1 mr-1 mb-2">
            <h3 class="text-center mb-2 mt-2"> Berikut adalah pilihan rekening pembayaran secara online</h3>
            <div class=" row mr-3 ml-3 mb-2">
                
                    <div class="col-4">
                        BCA  </div>
                    <div class="col-4">
                        YUDA JAKA PRADANA</div>
                    <div class="col-4">
                        1131827071 </div><hr>
                    <div class="col-4">
                        JAGO / ASTROS  </div>
                    <div class="col-4">
                        YUDA JAKA PRADANA</div>
                    <div class="col-4">
                        103118343217 </div><hr>
                        <div class="col-4">
                        DANA / OVO / SHOPEEPAY / GOPAY </div>
                    <div class="col-4">
                        YUDA JAKA PRADANA</div>
                    <div class="col-4">
                        085607187467 </div><hr>
                </div>
            </div>
    </div>
    <footer>
        <div class="card text-center">
            <div class="card-body main-color shadow-box">
                <div class="col-12"><img src="../images/nobg-alexanet.png" height="60px" alt=""></div>
                <div class="col-12"><p class="font-weight-bold mt-2">&copy 2022 Alexanet</p></div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="../js/jquery-3.2.1.js"></script>
    <script src="../js/popper.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script>
      $(document).ready( function () {
          $('#table_id').DataTable();
      } );
  </body>
</html>