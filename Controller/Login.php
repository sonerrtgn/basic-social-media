<?php

include("../data-accses/database.php");
include("../entities/uye.php");
session_start();
if(isset($_POST["name"]) && isset($_POST["uyeId"]) ){
      $uye = new uye($_POST["uyeId"],$_POST["name"],"");
     
      //print_r($uye);
      $database = new Database();
      if($database->ControlLogin($uye)){
            $_SESSION["uye"] = $uye;
            
            echo "<script>alert('Giris yapildi'); location.href = '../view/'</script>";
      }else{
            echo "<script>alert('Giris yapilamadi'); location.href = '../view/uye-ol.html'</script>";
      }
}else{
      echo "<script>alert('Giris yapilamadi, bilgiler geçersiz'); location.href = '../view/uye-ol.html'</script>";
}



?>