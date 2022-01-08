
<?php
include("../data-accses/database.php");
include("../entities/uye.php");
include("../entities/gonderi.php");


session_start();
//print_r($_SESSION);

if(isset($_SESSION["uye"])){
      $oturumAcan = $_SESSION["uye"];
      $database = new Database();

      $database->CreateYorum($oturumAcan,"bu bir testtir","56");
}else{
      $data = [];
      $data["status"] = "false";
      echo json_encode($data);
}

?>