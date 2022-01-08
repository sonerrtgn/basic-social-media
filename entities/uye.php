<?php
class uye{

      /** primary key */
      private $uye_id;

      private $uye_adi;
      private $gonderi_sayisi;

      public function __construct($uye_id,$uye_adi,$gonderi_sayisi){     
            $this->uye_id = $uye_id;
            $this->uye_adi = $uye_adi;
            $this->gonderi_sayisi = $gonderi_sayisi;
      }

      public function GetId(){
            return $this->uye_id;
      }

      public function GetAdi(){
            return $this->uye_adi;
      }

      public function GetGonderiSayisi(){
            return $this->gonderi_sayisi;
      }

      public function AddGonderiSayisi(){
            $this->gonderi_sayisi++;
      }
      



}

?>