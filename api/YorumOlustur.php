<?php
include("../data-accses/database.php");
include("../entities/uye.php");
include("../entities/gonderi.php");


session_start();
//print_r($_SESSION);

if(isset($_SESSION["uye"])){
      $oturumAcan = $_SESSION["uye"];
      if(isset($_POST["yorum_icerigi"]) && isset($_POST["gonderi_id"])){
            $database  = new Database();

            $database->CreateYorum($oturumAcan,$_POST["yorum_icerigi"],$_POST["gonderi_id"]);
            $data = [];
            $data["status"] = "true";
            echo json_encode($data);
      }else{
            $data = [];
            $data["status"] = "hatali bilgi";
            echo json_encode($data);
      }

}else{
      $data = [];
      $data["status"] = "gecersiz oturum";
      echo json_encode($data);
}

?>