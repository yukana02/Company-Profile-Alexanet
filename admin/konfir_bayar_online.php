
<?php 
include('../connection.php');
session_start(); 
if($user = $_SESSION['user']){
  $result = mysqli_query($conn , "select * from admin WHERE username = '$user'");
  $row = mysqli_fetch_array($result);
}
 else{
  echo header('Location:login_admin.php');
}
error_reporting('0');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Dashboard </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link href="../css/bootstrap.css" type="text/css" rel = "stylesheet"/>
    <link href="../css/mystyle.css" type="text/css" rel = "stylesheet"/>
    <style>
    .zoomimg:hover{
        text-align: center;
        transform: scale(2.2);
        padding-bottom: 73px;
    }
    </style>
  </head>
  <body class="bg-back">
    <div class="container-fluid">
        <div class="row g-0">
            <div class="col-3 px-1 bg-blue position-fixed" id="sticky-sidebar" style = "min-height:700px" hight="300px";>
                <div>
                    <img src="../images/nobg-alexanet.png" class="img-responsive img-thumbnail rounded-circle mt-3 ml-3" width="220px" alt="">
                </div>
                    <div class="list-group">
                    <div class="border mt-5 mb-3" >
                        <div>
                            <a href="Dashboard_admin.php" class="list-group-item list-group-item-action">Dashboard</a>
                        </div>
                        <div>
                            <a href="tambah_client.php" class="list-group-item list-group-item-action">Tambah Client</a>
                        </div>
                        <div>
                            <a href="konfir_bayar_online.php" class="list-group-item list-group-item-action">Pembayaran client</a>
                        </div>
                        <div>
                            <a href="tagihan_client.php" class="list-group-item list-group-item-action">Tagihan Client</a>
                        </div>
                        <div>
                            <a href="paket.php" class="list-group-item list-group-item-action">Paket Bandwith</a>
                        </div>
                        <div>
                            <a href="../logout.php" class="list-group-item list-group-item-action">Keluar</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col offset-2" id="main-content">
                <div class="ml-5 mr-5 mt-3 text-center border card">
                    <h2> Berikut ini adalah data client yang melakukan pembayaran online</h2>
                </div>
                <form action="konfir_bayar_online.php" method = "POST">
                    <?php
                    //select dari tablel client dan pembayaran client dimana id client sama antar table
                        $result = mysqli_query($conn, "select client.*, pembayaran_client.*
                        from client, pembayaran_client
                        where
                        pembayaran_client.id_client=client.id_client");
                        while($data = mysqli_fetch_array($result)) {
                        $id = $data['ID_CLIENT'];
                        $bukti = $data['BUKTI_PEMBAYARAN'];
                        // echo $id;
                        ?>
                    <div class="mr-5 ml-5 mt-3 mb-3 border card nav-shadow"> 
                        <div class=" row mr-5 ml-5 mb-3"> 
                            <div class="col-6 mt-2">
                                ID KLIENT </div>
                            <div class="col-6 mt-2">
                                <?=$data['ID_CLIENT']?> </div><hr>
                            <div class="col-6">
                                NAMA </div>
                            <div class="col-6">
                                <?=$data['NAMA']?></div><hr>
                            <div class="col-6">
                                PAKET </div>
                            <div class="col-6">
                                <?=$data['ID_PAKET']?></div><hr>
                            <div class="col-6">
                                TAGIHAN </div>
                            <div class="col-6">
                                <?=$data['TAGIHAN']?></div><hr>
                                <!-- menampilakan foto dari database -->
                            <div class="col-6 zoomimg">
                                <?="<img src='../client/berkas/".$data['BUKTI_PEMBAYARAN']."'style='width:100px; height:200px;'>"?></div>
                            <div class="col-6 ">
                            <button type="submit" name="button_konfirmasi" class="btn btn-primary">KONFIRMASI</button>
                                <?php
                                //jika klik button konfimasi
                                 if(isset($_POST["button_konfirmasi"])) {
                                    $result1 = mysqli_query($conn , "UPDATE client SET 
                                    ID_STATUS = '1' WHERE ID_CLIENT = '$id'");
                                     echo "<div class='mt-4'><div class='alert alert-success' role='alert'>Berhasil Konfirmasi</div></div>";
                                   } 
                                   //jika konfirmasi berhasil otomatis hapus data yang ada di database 
                                 if($result1){
                                   $delete_bukti = mysqli_query($conn, "DELETE FROM pembayaran_client 
                                   WHERE 
                                   ID_CLIENT = '$id' and BUKTI_PEMBAYARAN ='$bukti'");
                                   } 
                                      else{
                                        // echo "<div class='mt-2 ml-1 mr-4 '><div class='alert alert-danger' role='alert'>ada kesalahan</div></div>;";
                                      }
                                ?>
                            </div>
                        </div>
                    </div> 
                            <?php } ?>  
                </form>
                </div>
            </div>
        </div>
    </div>
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="../js/jquery-3.2.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    
</body>
</html>