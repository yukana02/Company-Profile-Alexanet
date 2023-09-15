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
    <title>Dashboard Client | Alexanet</title>
  </head>
  <body class="footer-color ">
    <header>
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark main-color nav-shadow mb-4">
            <a class="navbar-brand" href="Dashboard_client.php"><img src="../images/nobg-alexanet.png" height="40" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarItem" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarItem">
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
        <div class='mt-5 ml-5 mr-5 '><div class='alert alert-success' role='alert'><h4>Selamat Datang "<?=$row['NAMA']?>"</h4></div></div>
    <br>
    <section  id="loginclient" class="bg-cyan container-fluid p-5 main-color nav-shadow">
    <div class="main ml-5 border mr-5  nav-shadow">
        <div class="card-body bg-white">
              <table class="table table-bordered" id="table_id">
                <thead>
                      <tr>
                        <th scope="col">NO</th>
                        <th scope="col">NAMA</th>
                        <th scope="col">BANDWIDTH</th>
                        <th scope="col">HARGA PAKET</th>
                        <th scope="col">ALAMAT</th>
                        <th scope="col">STATUS</th>
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
                        client.id_status=status.id_status");
                        while($row = mysqli_fetch_array($result)) {
                      ?>
                  <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $row['NAMA'] ?></td>
                      <td><?php echo $row['BANDWITH'] ?></td>
                      <td><?php echo $row['HARGA'] ?></td>
                      <td><?php echo $row['ALAMAT'] ?></td>
                      <td><?php echo $row['STATUS'] ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
    </div>
    </section>
  <br>
  <br>
  <br>
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
    </script>
  </body>
</html>