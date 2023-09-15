<?php
    include('../connection.php');
    session_start(); 
if($user = $_SESSION['user']){
    
    $result = mysqli_query($conn , "UPDATE client SET ID_STATUS = '2' WHERE ID_STATUS = '1'");
    // 1 LUNAS 
    // 2 BELUM
    echo "<div class='mt-2 ml-1 mr-4 '><div class='alert alert-success' role='alert'>DATA CLIENT BERHASIL DI RUBAH</div></div>;";
    
    echo header('Location:tagihan_client.php');

}
 else{
  echo header('Location:login_admin.php');
}    
?>