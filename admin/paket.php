
<?php 
include('../connection.php');
error_reporting('0');
session_start(); 
if($user = $_SESSION['user']){
    $result = mysqli_query($conn , "select * from admin WHERE username = '$user'");
    $row = mysqli_fetch_array($result);    
}
 else{
  echo header('Location:login_admin.php');
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Paket internet </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="../css/bootstrap.css" type="text/css" rel = "stylesheet"/>
    <link href="../css/mystyle.css" type="text/css" rel = "stylesheet"/>
  </head>
  <body class="bg-back ">
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
              <div class="main mr-5 ml-5 mt-3 mb-3 main-color">
              <div class="card-body ">
              <table class="table table-bordered" id="table_id">
                <thead>
                      <tr>
                        <th scope="col">NO</th>
                        <th scope="col">ID PAKET</th>
                        <th scope="col">BANDWIDTH</th>
                        <th scope="col">HARGA PAKET</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                      include('../connection.php');
                        $no = 1;
                        session_start();
                          $result = mysqli_query($conn , "select * from paket_internet ");
                          while($row = mysqli_fetch_array($result)) {    
                      ?>
                  <tr class="text-white">
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $row['ID_PAKET'] ?></td>
                      <td><?php echo $row['BANDWITH'] ?></td>
                      <td><?php echo $row['HARGA'] ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
                    </div>
            </div>
      </div>
  </div>
  <div class="card-body bg-back shadow-box">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="../js/jquery-3.2.1.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.js"></script>
</body>
</html>