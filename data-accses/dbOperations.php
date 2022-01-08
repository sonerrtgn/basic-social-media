<?php
include("database.php");
include("../entities/uye.php");
include("../entities/gonderi.php");

$db  = new Database();


//Kurulum için gerekli fonksiyonlar.
$db->CreateUyeTable();
$db->CreateYorumTable();
$db->CreateGonderiTable();

/*

Create test

$yeniuye = new uye("","soner",0);
$db->CreateUye($yeniuye);
*/

/*
Update test
$yeniuye = new uye("3","soner","1");
$db->UpdateUye($yeniuye);
*/

/**
 * Login test
      $yeniuye = new uye("3","soner","");
      if($db->ControlLogin($yeniuye)){
            echo "Giriş başarılı";
      }else{
            echo "giriş basarisiz";
      }
 */
/*
$yeniGonderi = new gonderi("",4,"bu bir test","bu benim ik gonderim","");
$database  = new Database();
$count = 0;
while($count < 15){
      $database->CreateGonderi($yeniGonderi);
      $count++;
}

*/
$database = new Database();
print_r($database->GetGonderi(0));

?>
