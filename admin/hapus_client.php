<?php
    include('../connection.php');
    session_start(); 
    if($user = $_SESSION['user']){
        $id = $_GET['ID_CLIENT'];
       //delete data di table client
        $result = mysqli_query ($conn , "DELETE FROM client WHERE ID_CLIENT = '$id'");
    }
     else{
      echo header('Location:login_admin.php');
    }
    echo "<script>alert('DATA BERHASIL DI HAPUSS');</script>";
        
    echo header('Location:Dashboard_admin.php');
?>