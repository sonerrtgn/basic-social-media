<?php
include("../data-accses/database.php");
include("../entities/uye.php");
include("../entities/gonderi.php");


$database = new Database();
$gonderiler = $database->GetYeniGonderiler($_POST["sonGonderiId"]);
$yeniGonderiSayisi = 0;
$count = 0;
$leng  = count($gonderiler);
while($count <$leng){

      //print_r($database->GetYorum($gonderiler[$count]["gonderi_id"]));
      $gonderiler[$count]["yorumlar"] = $database->GetYorum($gonderiler[$count]["gonderi_id"]);
      $count2 = 0;
      $gonderininYorumSayisi = count($gonderiler[$count]["yorumlar"]);
      while($count2 < $gonderininYorumSayisi){
            $gonderiler[$count]["yorumlar"][$count2]["yorum_atan"] = $database->GetUser($gonderiler[$count]["yorumlar"][$count2]["yorum_atan"]);
            $count2++;
      }
      $count++;
      $yeniGonderiSayisi++;
}

$gonderiler[] = [];
$gonderiler[count($gonderiler)-1]["yeniGonderiSayisi"] = $yeniGonderiSayisi;

echo json_encode($gonderiler);

?>