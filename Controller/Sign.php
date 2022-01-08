<?php

include("../data-accses/database.php");
include("../entities/uye.php");
session_start();
if(isset($_POST["name"])){
      $uye = new uye("",$_POST["name"],"0");
     
      //print_r($uye);
      $database = new Database();
      $userID   = $database->CreateUye($uye);
      if($userID > 0){
            $_SESSION["uye"] = $uye;
            
            echo "<script>alert('Başarıyla üye olundu,üyelik id = ".$userID."'); location.href = '../view/uye-ol.html'</script>";
      }else{
            echo "<script>alert('Üye olunamadı'); location.href = '../view/uye-ol.html'</script>";
      }
}else{
      echo "<script>alert('üyelik bilgileri geçersiz'); location.href = '../view/uye-ol.html'</script>";
}



?>