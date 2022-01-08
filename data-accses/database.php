<?php

class Database{
      public $dbName = "odev";
      public $dbUser = "root";
      public $dbPass = "";
      public $dbPointer;

      public function __construct(){
            $this->dbPointer = new PDO("mysql:host=localhost;dbname=$this->dbName;charset=utf8mb4",$this->dbUser,$this->dbPass);
      }
        //$DB->query("INSERT INTO bi_manuel_teklif (TcNo,Sirket,Fiyat,Notu) VALUES ('$this->TcKimlikNo','$this->TeklifSirket','$this->TeklifFiyat','$this->Not') ");




      public function CreateUyeTable(){
            $this->dbPointer->query("CREATE TABLE uye (
	            uye_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                  uye_adi VARCHAR(25),
                  gonderi_sayisi INT 
            )");
            echo "create uye table";
      }

      public function CreateYorumTable(){
            $this->dbPointer->query("CREATE TABLE yorum (
	            yorum_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                  yorum_icerigi VARCHAR(150),
                  yorum_Tarihi DATE,
                  yorum_atan INT,
                  gonderi_id INT 
            )");
      }

      public function CreateGonderiTable(){
            $this->dbPointer->query("CREATE TABLE gonderi (
	            gonderi_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                  paylasan_id INT,
                  gonderi_baslik VARCHAR(100),
                  gonderi_icerik VARCHAR(500),
                  paylasim_tarihi DATE 
            )");
      }
      

      public function CreateYorum(uye $uye,$yorum_icerigi,$gonderi_id){
            $this->dbPointer->query("INSERT INTO yorum (yorum_id,yorum_icerigi,yorum_Tarihi,yorum_atan,gonderi_id) VALUES (NULL,'$yorum_icerigi','".date("Y-m-d")."','".$uye->GetId()."', $gonderi_id)");

      }

      public function CreateUye(uye $uye){
            $this->dbPointer->query("INSERT INTO uye (uye_id,uye_adi,gonderi_sayisi) VALUES (NULL,'".$uye->GetAdi()."','0')");
            $query = $this->dbPointer->prepare("SELECT uye_id FROM uye ORDER BY uye_id DESC LIMIT 1");

            //Sorgumuzu çalıştırıyoruz
            $query->execute();

            //Tüm verileri çekiyoruz
            $result=$query->fetchAll(PDO::FETCH_ASSOC); 

            return $result[0]["uye_id"]; //son olusan uyenin idsini bir sonraki işlemlerde kullanmak için geriye dönüyor.
      }

      public function UpdateUye(uye $uye){
            $this->dbPointer->query("UPDATE uye SET uye_adi = '".$uye->GetAdi()."', gonderi_sayisi =".$uye->GetGonderiSayisi()." WHERE uye_id = ".$uye->GetId()."");
      }

      public function ControlLogin(uye $uye){
            $query = $this->dbPointer->prepare("SELECT * FROM uye WHERE uye_id =".$uye->GetId()." AND uye_adi = '".$uye->GetAdi()."'");

            //Sorgumuzu çalıştırıyoruz
            $query->execute();

            //Tüm verileri çekiyoruz
            $result=$query->fetchAll(PDO::FETCH_ASSOC);

            if(count($result) > 0){
                  return true;
            }

            return false;

      }

      public function CreateGonderi(gonderi $gonderi){
            $this->dbPointer->query("INSERT INTO gonderi (gonderi_id,paylasan_id,gonderi_baslik,gonderi_icerik,paylasim_tarihi) VALUES (NULL,".$gonderi->GetPaylasan().",'".$gonderi->GetBaslik()."','".$gonderi->GetIcerik()."','".date("Y-m-d")."')");
      }



      //Her cagrimda 10 adet gonderi getirir. sayfa numarasi ile o kadar gonderiyi atlayarak getirir.
      public function GetGonderi($sayfaId){

            $gonderiBaslangici = $sayfaId*10;
            $query = $this->dbPointer->prepare("SELECT gonderi.gonderi_baslik, gonderi.gonderi_icerik, gonderi.paylasim_tarihi,uye.uye_adi,gonderi.gonderi_id FROM gonderi,uye WHERE gonderi.paylasan_id = uye.uye_id ORDER BY gonderi_id DESC LIMIT $gonderiBaslangici,10");

            //Sorgumuzu çalıştırıyoruz
            $query->execute();

            //Tüm verileri çekiyoruz
            $result=$query->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
      }

      public function GetYeniGonderiler($sonGonderiId){

            $query = $this->dbPointer->prepare("SELECT gonderi.gonderi_baslik, gonderi.gonderi_icerik, gonderi.paylasim_tarihi,uye.uye_adi,gonderi.gonderi_id FROM gonderi,uye WHERE gonderi.gonderi_id > $sonGonderiId && gonderi.paylasan_id = uye.uye_id ORDER BY gonderi_id DESC");

            //Sorgumuzu çalıştırıyoruz
            $query->execute();

            //Tüm verileri çekiyoruz
            $result=$query->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
      }

      public function GetYorum($postId){

            $query = $this->dbPointer->prepare("SELECT * FROM yorum WHERE gonderi_id = $postId ");

            //Sorgumuzu çalıştırıyoruz
            $query->execute();

            //Tüm verileri çekiyoruz
            $result=$query->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
      }
      public function GetUser($uye_id){
            $query = $this->dbPointer->prepare("SELECT uye_adi FROM uye WHERE uye_id = $uye_id ");

            //Sorgumuzu çalıştırıyoruz
            $query->execute();

            //Tüm verileri çekiyoruz
            $result=$query->fetchAll(PDO::FETCH_ASSOC);
            
            return $result[0]["uye_adi"];
      }


}


?>