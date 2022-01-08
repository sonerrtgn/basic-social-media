<?php


class gonderi{
      /**Primar key */
      private $gonderi_id;

      private $paylasan_id;
      private $gonderi_baslik;
      private $gonderi_icerik;
      private $paylasim_tarihi;

      public function __construct($gonderi_id,$paylasan_id,$gonderi_baslik,$gonderi_icerik,$paylasim_tarihi){
            $this->gonderi_id = $gonderi_id;
            $this->paylasan_id  = $paylasan_id;
            $this->gonderi_baslik = $gonderi_baslik;
            $this->gonderi_icerik = $gonderi_icerik;
            $this->paylasim_tarihi = $paylasim_tarihi;

      }

      public function GetId(){
            return $this->gonderi_id;
      }

      public function GetPaylasan(){
            return $this->paylasan_id;
      }

      public function GetBaslik(){
            return $this->gonderi_baslik;
      }

      public function GetIcerik(){
            return $this->gonderi_icerik;
      }

      public function GetTarih(){
            return $this->paylasim_tarihi;
      }

      
}


?>