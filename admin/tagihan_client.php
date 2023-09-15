
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
error_reporting(0);
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
<main class="mt-5 ml-1" id="content-admin" style = "min-height:600px">
    <div class="container ml-3 mt-1" style="margin-top: 80px">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              DATA CLIENT BELUM LUNAS
            </div>
            <div class="card-body">
                <div class="reset">
                <a href="reset_tagihan.php" class="btn btn-primary" type = "submit" name = "button_reset">RESET TAGIHAN</a>
                </div>
                <br>
              <table class="table table-bordered" id="table_id">
                <thead>
                      <tr>
                        <th scope="col">NO</th>
                        <th scope="col">NAMA</th>
                        <th scope="col">BANDWIDTH</th>
                        <th scope="col">ALAMAT</th>
                        <th scope="col">TAGIHAN</th>
                        <th scope="col">STATUS PEMBAYARAN</th>
                        <th scope="col">KETERANGAN</th>
                        <th scope="col">KONFIRMASI PEMBAYARAN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                      include('../connection.php');
                        $no = 1;
                        $result = mysqli_query($conn , "select client.*, paket_internet.*, status.*
                        from client, paket_internet, status
                        where 
                        client.id_paket=paket_internet.id_paket and
                        client.id_status=status.id_status and
                        client.id_status='2'");
                        while($row = mysqli_fetch_array($result)) {
                      ?>
                  <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $row['NAMA'] ?></td>
                      <td><?php echo $row['BANDWITH'] ?></td>
                      <td><?php echo $row['ALAMAT'] ?></td>
                      <td><?php echo $row['TAGIHAN'] ?></td>
                      <td><?php echo $row['STATUS'] ?></td>
                      <td><?php echo $row['KETERANGAN'] ?></td>
                      <td class="text-center">
                        <a href="konfirmasi_pembayaran.php?ID_CLIENT=<?php echo $row['ID_CLIENT'] ?>" class="btn btn-sm btn-primary">KONFIRMASI</a>
                      </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
      </div>
    </div>
    <br>
</main>
<br>
<main class="mt-1 ml-1" id="content-admin2" style = "min-height:600px">
<form action="tagihan_client.php" method = "POST">
    <div class="container ml-3 mt-1" style="margin-top: 80px">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              DATA CLIENT LUNAS
            </div>
            <div class="card-body">
                <br>
              <table class="table table-bordered" id="table_id2">
                <thead>
                      <tr>
                        <th scope="col">NO</th>
                        <th scope="col">NAMA</th>
                        <th scope="col">BANDWIDTH</th>
                        <th scope="col">ALAMAT</th>
                        <th scope="col">TAGIHAN</th>
                        <th scope="col">STATUS PEMBAYARAN</th>
                        <th scope="col">KETERANGAN</th>
                        <th scope="col">BATALKAN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                      include('../connection.php');
                        $no = 1;
                        $result = mysqli_query($conn , "select client.*, paket_internet.*, status.*
                        from client, paket_internet, status
                        where 
                        client.id_paket=paket_internet.id_paket and
                        client.id_status=status.id_status and
                        client.id_status='1'");
                        while($row1 = mysqli_fetch_array($result)) {
                        $id_client = $row1['ID_CLIENT'];
                      ?>
                  <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $row1['NAMA'] ?></td>
                      <td><?php echo $row1['BANDWITH'] ?></td>
                      <td><?php echo $row1['ALAMAT'] ?></td>
                      <td><?php echo $row1['TAGIHAN'] ?></td>
                      <td><?php echo $row1['STATUS'] ?></td>
                      <td><?php echo $row1['KETERANGAN'] ?></td>
                      <td class="text-center">
                      <button type="submit" name="batal" class="btn btn-primary">BATALKAN</button>
                      </td>
                  </tr>
                  <?php } ?>
                  <?php
                   if(isset($_POST["batal"])){
                  $result1 = mysqli_query($conn , "UPDATE client SET 
                  ID_STATUS = '2' WHERE ID_CLIENT = '$id_client'");
                   echo "<div class='mt-4'><div class='alert alert-success' role='alert'>Berhasil Konfirmasi</div></div>";
                   }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
      </div>
    </div>
    <br>
</form>
</main>
          </div>
      </div>
  </div>
 
  <div class="card-body bg-back shadow-box">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="../js/jquery-3.2.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script>
      $(document).ready( function () {
          $('#table_id').DataTable();
      } );
    </script>
    <script>
      $(document).ready( function () {
          $('#table_id2').DataTable();
      } );
    </script>
   
</body>
</html>