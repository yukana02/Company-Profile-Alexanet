<?php
  include("../connection.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Edit Data Client </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="../css/bootstrap.css" type="text/css" rel = "stylesheet"/>
    <link href="../css/mystyle.css" type="text/css" rel = "stylesheet"/>
    <link href="../css/css/datatables.min.css" type="text/css" rel = "stylesheet"/>
  </head>
  <body  class="bg-back">
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
                        <a href="konfir_bayar_online.php" class="list-group-item list-group-item-action">Pembayaran Client</a>
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
          <?php
          session_start(); 
          if($user = $_SESSION['user']){
            $id = $_GET['ID_CLIENT'];
            // echo $id;
            $queryGetData = "SELECT * FROM client WHERE ID_CLIENT='$id'";
            $result = mysqli_query ($conn, $queryGetData);
          }
           else{
            echo header('Location:login_admin.php');
          }   
          while($data = mysqli_fetch_array($result)) :
                ?>
            <form action="#" method = "POST">
              <div class="card mt-5 ml-5 p-3">
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="show_id_client" id="disabledTextInput" class="form-label">ID KLIEN</label>
                      <input type="text" name="form_id_client" class="form-control" value="<?php echo $data['ID_CLIENT']; ?>">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="show_NAMA" class="form-label">PAKET INTERNET</label>
                      <input type="text" name="form_id_paket" class="form-control" value="<?php echo $data['ID_PAKET']; ?>">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="show_id_client" class="form-label">ID_STATUS</label>
                      <input type="text" name="form_id_status" class="form-control" value="<?php echo $data['ID_STATUS']; ?>">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="show_username" class="form-label">USERNAME</label>
                      <input type="text" name="form_username" class="form-control" value="<?php echo $data['USERNAME']; ?>">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="show_password" class="form-label">PASSWORD</label>
                      <input type="text" name="form_password" class="form-control" value="<?php echo $data['PASSWORD']; ?>">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="show_nama" class="form-label">NAMA CLIENT</label>
                      <input type="text" name="form_nama" class="form-control" value="<?php echo $data['NAMA']; ?>">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="show_no_hp" class="form-label">NO HP</label>
                      <input type="text" name="form_no_hp" class="form-control" value="<?php echo $data['NO_HP']; ?>">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="show_alamat" class="form-label">ALAMAT</label>
                      <input type="text" name="form_alamat" class="form-control" value="<?php echo $data['ALAMAT']; ?>">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="show_tgl_pasang" class="form-label">TANGGAL PEMASANGAN</label>
                      <input type="text" name="form_tgl_pasang" class="form-control" value="<?php echo $data['TGL_PEMASANGAN']; ?>">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="show_tagihan" class="form-label">TAGIAHAN</label>
                      <input type="text" name="form_tagihan" class="form-control" value="<?php echo $data['TAGIHAN']; ?>">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="show_keterangan" class="form-label">KETERANGAN</label>
                      <input type="text" name="form_keterangan" class="form-control" value="<?php echo $data['KETERANGAN']; ?>">
                    </div>
                  </div>
                  <div class="col-8">
                    <div class="form-group">
                      <button class="btn btn-primary" type = "submit" name = "button_update">UPDATE</button>
                    </div>
                  </div>
                  <div class="col-2 card">
                    <div class="form-group m-2">
                    <a href="hapus_client.php?ID_CLIENT=<?php echo $data['ID_CLIENT'] ?>" class="btn btn-primary">HAPUS</a>
                    </div>
                  </div>
                        <?php 
                        if(isset($_POST["button_update"])){
                            $ID_CLIENT1 = $_POST['form_id_client'];
                            $ID_PAKET = $_POST['form_id_paket'];
                            $ID_STATUS = $_POST['form_id_status'];
                            $USERNAME = $_POST['form_username'];
                            $PASSWORD = $_POST['form_password'];
                            $NAMA = $_POST['form_nama'];
                            $NO_HP = $_POST['form_no_hp'];
                            $ALAMAT = $_POST['form_alamat'];
                            $TGL_PASANG = $_POST['form_tgl_pasang'];
                            $TAGIHAN = $_POST['form_tagihan'];
                            $KETERANGAN = $_POST['form_keterangan'];

                                if( $result1 = mysqli_query($conn , "UPDATE client SET 
                                  ID_PAKET = '$ID_PAKET',
                                  ID_STATUS = '$ID_STATUS',
                                  USERNAME = '$USERNAME',
                                  PASSWORD = '$PASSWORD',
                                  NAMA = '$NAMA',
                                  NO_HP = '$NO_HP',
                                  ALAMAT = '$ALAMAT',
                                  TGL_PEMASANGAN = '$TGL_PASANG',
                                  TAGIHAN = '$TAGIHAN',
                                  KETERANGAN ='$KETERANGAN' WHERE ID_CLIENT = '$id'") 
                                ){
                                  echo "<div class='mt-2 ml-1 mr-4 '><div class='alert alert-success' role='alert'>DATA CLIENT BERHASIL DI RUBAH</div></div>;";
                                }else  {
                                  error_reporting(0);
                                  echo "<div class='mt-4'><div class='alert alert-danger' role='alert'>Data ada yang sama</div></div>";
                              }    
                          }
                        ?>
                </div>
              </div>
              <?php endwhile; ?>
            </form>
          </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="../js/jquery-3.2.1.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.js"></script>
  </body>
</html>