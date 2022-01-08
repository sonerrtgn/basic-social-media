<?php
include("../data-accses/database.php");
include("../entities/uye.php");
include("../entities/gonderi.php");


session_start();
//print_r($_SESSION);

if(isset($_SESSION["uye"])){
      $oturumAcan = $_SESSION["uye"];
      if(isset($_POST["gonderi_baslik"]) && isset($_POST["gonderi_icerik"])){
            $yeniGonderi = new gonderi("",$oturumAcan->GetId(),$_POST["gonderi_baslik"],$_POST["gonderi_icerik"],"");
            $database  = new Database();

            $database->CreateGonderi($yeniGonderi);
            $data = [];
            $data["status"] = "true";
            echo json_encode($data);
      }else{
            $data = [];
            $data["status"] = "false";
            echo json_encode($data);
      }

}else{
      $data = [];
      $data["status"] = "false";
      echo json_encode($data);
}

?>