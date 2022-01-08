<?php
include("../data-accses/database.php");
include("../entities/uye.php");
include("../entities/gonderi.php");
session_start();
if (!isset($_SESSION["uye"])) {
      echo "<script>location.href = 'http://localhost/vtys-odev/view/uye-ol.html';</script>";
      exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Sosyal Medya - Uye Ol</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

      <style>
            .posts::-webkit-scrollbar {
                  width: 5px;
                  overflow: auto;
            }

            .loader {
                  border: 8px solid #f3f3f3;
                  /* Light grey */
                  border-top: 8px solid #3498db;
                  /* Blue */
                  border-radius: 50%;
                  width: 60px;
                  height: 60px;
                  animation: spin 1.2s linear infinite;
                  margin: auto;
            }

            @keyframes spin {
                  0% {
                        transform: rotate(0deg);
                  }

                  100% {
                        transform: rotate(360deg);
                  }
            }

            #yeni-gonderi-uyari{
                  width:17em;
                  height:5em;
                  position: absolute;
                  margin-top: 5em;
                  margin-left: 2em;
                  background-color: #DC3454;
                  border-radius: 1em;
                  z-index: 9;
                  display: none;
                  
            }
            #yeni-gonderi-uyari h4{
                  font-weight: 600;
                  color: white;
            }
      </style>
</head>

<body>
      <div id="yeni-gonderi-uyari">
            <h4 class="mt-4 text-center">Yeni Gonderiler Var! <h4>
      </div>
      <div class="container-fluid">
            <!-- header -->
            <div class="row  bg-warning">
                  <div class="col-3 mt-3">
                        <h3>Anasayfa</h3>
                  </div>
                  <!--Serach -->
                  <div class="col-3 mt-3">
                        <input type="text" placeholder="Uye adını giriniz" class="form-control" />
                  </div>
                  <div class="col-1 mt-3">
                        <button class="btn" style="float:left; width:30px; height: 30px; margin-left:-60px;">
                              <img src="search.png" class="img" style="float:left; width:30px; height: 30px; margin-left: -10px;">

                        </button>
                  </div>
                  <div class="col-2">

                  </div>

                  <div class="col-2 mt-3">
                        <h3 style="float:right;"><?php echo $_SESSION["uye"]->GetAdi(); ?></h3>
                  </div>
                  <div class="col-1 mt-4">
                        <img src="profile-user.png" alt="" srcset="" width="30px;">
                  </div>

            </div>

            <div class="row">
                  <div class="col-3 d-none d-md-block mt-4">

                  </div>

                  <div class="col-12 col-md-4 posts" id="gonderiler" style=" overflow: auto; max-height: 90vh; ">
                        <?php
                        $count = 0;
                        $database = new Database();

                        $sonOnGonderi = $database->GetGonderi(0);

                        $sonOnGonderiUzunluk = count($sonOnGonderi);
                        while ($count < $sonOnGonderiUzunluk) {
                        ?>
                              <?php $gonderi_id = $sonOnGonderi[$count]["gonderi_id"]; ?>

                              <div class="card mt-2">
                                    <div class="card-header">
                                          <div class="row">
                                                <div class="col-1 mt-1">
                                                      <img src="profile-user.png" alt="" srcset="" width="30px;">
                                                </div>
                                                <div class="col-5">
                                                      <h3><?php echo $sonOnGonderi[$count]["uye_adi"];  ?></h3>
                                                </div>
                                                <div class="col-2">
                                                </div>
                                                <div class="col-4 mt-1">
                                                      <h5><?php echo $sonOnGonderi[$count]["paylasim_tarihi"];  ?></h5>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="card-body">
                                          <h5 class="card-title"><?php echo $sonOnGonderi[$count]["gonderi_baslik"];  ?></h5>
                                          <p class="card-text"><?php echo $sonOnGonderi[$count]["gonderi_icerik"];  ?></p>

                                          <div class="row">
                                                <div class="col-8">
                                                      <input type="text" class="form-control" placeholder="Yorum yazınız" id="yorumInput-<?php echo $gonderi_id; ?>"/>
                                                </div>
                                                <div class="col-4">
                                                      <input type="submit" class="form-control bg-danger text-light" value="yorum yap" onclick="YorumYap(<?php echo $gonderi_id; ?>)" />
                                                </div>
                                          </div>
                                          <div id="yorumlar-<?php  echo $gonderi_id;  ?>">
                                                <h3>Yorumlar</h3>

                                          <?php 
                                                $yorumlar = $database->GetYorum($sonOnGonderi[$count]["gonderi_id"]);
                                                $count2 = 0;
                                                $yorumLeng = count($yorumlar);
                                                while($count2 < $yorumLeng){
                                          ?>
                                                <div class="card-header mt-2">
                                                      <div class="row">
                                                            <div class="col-1 mt-2">
                                                                  <img src="profile-user.png" alt="" srcset="" width="30px;" style="margin-top: 0.20rem;">
                                                            </div>
                                                            <div class="col-4 mt-3">
                                                                  <h6><?php echo $database->GetUser($yorumlar[$count2]["yorum_atan"]);  ?></h6>
                                                            </div>
                                                            <div class="col mt-3">
                                                                  <p><?php  echo $yorumlar[$count2]["yorum_icerigi"];  ?></p>
                                                            </div>

                                                      </div>
                                                </div>

                                          <?php
                                                      $count2++;
                                                }
                                                
                                          ?> 
                                                
                                          </div>
                                    </div>
                              </div>



                        <?php
                              $count++;
                        }
                        ?>










                  </div>
                  <div class="col-12 col-md-4">

                        <div class="card mt-2">
                              <div class="card-header">
                                    <div class="row">
                                          <h3>Yeni Gönderi Oluştur</h3>

                                    </div>
                              </div>
                              <div class="card-body">
                                    <div class="form-group">
                                          <label for="baslik">Gönderi başlığınız</label>
                                          <input type="text" class="form-control" id="baslik" placeholder="Gönderi başlığı">

                                    </div>
                                    <div class="form-group">
                                          <label for="icerik">Gonderi İçeriğiniz</label>
                                          <textarea id="icerik" class="form-control" placeholder="Gönderinizi yazınız."></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-2" style="float:right;" onclick="YeniGonderi()">Gönderi oluştur</button>
                              </div>



                        </div>
                  </div>
            </div>


            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


            <script>
                  <?php 
                        if(!isset($sonOnGonderi[0]["gonderi_id"])){
                              $sonOnGonderi[0]["gonderi_id"] = 0;
                        } 
                  ?>
                  var sonGonderiId = <?php echo $sonOnGonderi[0]["gonderi_id"]."\n"; ?>
                  var oturumAcanUye = '<?php echo $_SESSION["uye"]->GetAdi(); ?>';
                  var tarih = '<?php echo date("Y-m-d"); ?>';

 
                  function YorumYap(gonderi_id){
                        var yorum = document.getElementById("yorumInput-"+gonderi_id).value;
                        var yorumEklenecekDiv = document.getElementById("yorumlar-"+gonderi_id);
                        $.ajax({
                              type: 'POST',
                              url: '../api/YorumOlustur.php',
                              data: {"yorum_icerigi":yorum,"gonderi_id":gonderi_id},
                              success: function(cevap) {
                                    console.log(cevap);
                                    yorumEklenecekDiv.innerHTML += '<div class="card-header mt-2">'+
                                                      '<div class="row">'+
                                                            '<div class="col-1 mt-2">'+
                                                                  '<img src="profile-user.png" alt="" srcset="" width="30px;" style="margin-top: 0.20rem;">'+
                                                            '</div>'+
                                                            '<div class="col-4 mt-3">'+
                                                                  '<h6>'+oturumAcanUye+'</h6>'+
                                                            '</div>'+
                                                            '<div class="col mt-3">'+
                                                                  '<p>'+yorum+'</p>'+
                                                            '</div>'+
                                                      '</div>'+
                                                '</div>';
                              }
                        });



                  }
                  function YeniGonderi() {

                        $.ajax({
                              type: 'POST',
                              url: '../api/GonderiOlustur.php',
                              data: {
                                    "gonderi_baslik": $("#baslik").val(),
                                    "gonderi_icerik": $("#icerik").val()
                              },
                              success: function(cevap) {
                                    console.log(cevap);
                                    var response = JSON.parse(cevap);
                                    if (response["status"] == "true") {
                                          
                                          sonGonderiId++;
                                          alert("Gönderi oluşturuldu.");



                                          var oncekiGonderiler = document.getElementById("gonderiler").innerHTML;

                                          document.getElementById("gonderiler").innerHTML = '' +
                                                '<div class="card mt-2">' +
                                                '<div class="card-header">' +
                                                '<div class="row">' +
                                                '<div class="col-1 mt-1">' +
                                                '<img src="profile-user.png" alt="" srcset="" width="30px;">' +
                                                '</div>' +
                                                '<div class="col-5">' +
                                                '<h3>' + oturumAcanUye + '</h3>' +
                                                '</div>' +
                                                '<div class="col-2">' +
                                                '</div>' +
                                                '<div class="col-4 mt-1">' +
                                                '<h5>' + tarih + '</h5>' +
                                                '</div>' +
                                                '</div>' +
                                                '</div>' +
                                                '<div class="card-body">' +
                                                      '<h5 class="card-title">' + $("#baslik").val() + '</h5>' +
                                                      '<p class="card-text">' + $("#icerik").val() + '</p>' +
                                                      '<div class="row">' +
                                                            '<div class="col-8">' +
                                                                  '<input type="text" class="form-control" placeholder="Yorum yazınız" id="yorumInput-'+(sonGonderiId)+'" />' +
                                                            '</div>' +
                                                            '<div class="col-4">' +
                                                                  '<input type="submit" class="form-control bg-danger text-light" value="yorum yap" onclick="YorumYap('+(sonGonderiId)+')"/>' +
                                                            '</div>' +
                                                      '</div>' +
                                                      '<div id="yorumlar-'+(sonGonderiId)+'">'+
                                                                  '<h3>Yorumlar</h3>'+
                                                            '</div>'+
                                                '</div>';
                                          document.getElementById("gonderiler").innerHTML += oncekiGonderiler;
                                          $("#baslik").val("");
                                          $("#icerik").val("");

                                    } else {
                                          alert("Gönderi oluşturulamadı, oturumunuzun süresi dolmuş olabilir.");
                                    }
                              }
                        });
                  }


            function YeniGonderiVarmi(){
                  $.ajax({
                              type: 'POST',
                              url: '../api/YeniGonderiVarmi.php',
                              data: {"sonGonderiId":sonGonderiId},
                              success: function(cevap) {
                                   
                                          var gonderiler = JSON.parse(cevap);
                                          sonGonderiId += gonderiler[gonderiler.length-1]["yeniGonderiSayisi"];
                                          console.log(gonderiler);
                                          var count = 0;
                                          var uzunluk = gonderiler.length;
                                          if(uzunluk > 1){
                                                
                                                var eskiGonderiler = $("#gonderiler").html();
                                                $("#gonderiler").html("");
                                                

                                                YeniGonderiUyariGoster();
                                          }
                                          while (count < uzunluk-1) {
                                                var yorumlarHTML = "";
                                                var count2 = 0;
                                                var yorumUzunlugu = gonderiler[count]["yorumlar"].length;

                                                while(count2 < yorumUzunlugu){
                                                      yorumlarHTML +=  '<div class="card-header mt-2">'+
                                                      '<div class="row">'+
                                                            '<div class="col-1 mt-2">'+
                                                                  '<img src="profile-user.png" alt="" srcset="" width="30px;" style="margin-top: 0.20rem;">'+
                                                            '</div>'+
                                                            '<div class="col-4 mt-3">'+
                                                                  '<h6>'+ gonderiler[count]["yorumlar"][count2]["yorum_atan"]+'</h6>'+
                                                            '</div>'+
                                                            '<div class="col mt-3">'+
                                                                  '<p>'+gonderiler[count]["yorumlar"][count2]["yorum_icerigi"]+'</p>'+
                                                            '</div>'+
                                                      '</div>'+
                                                '</div>';
                                                      count2++;
                                                }


                                                document.getElementById("gonderiler").innerHTML += '<div class="card mt-2">'+
                                                                                                      '<div class="card-header">'+
                                                                                                            '<div class="row">'+
                                                                                                                  '<div class="col-1 mt-1">'+
                                                                                                                        '<img src="profile-user.png" alt="" srcset="" width="30px;">'+
                                                                                                                  '</div>'+
                                                                                                                  '<div class="col-5">'+
                                                                                                                        '<h3>'+gonderiler[count]["uye_adi"]+'</h3>'+
                                                                                                                  '</div>'+
                                                                                                                  '<div class="col-2">'+
                                                                                                                  '</div>'+
                                                                                                                  '<div class="col-4 mt-1">'+
                                                                                                                        '<h5>'+gonderiler[count]["paylasim_tarihi"] +'</h5>'+
                                                                                                                  '</div>'+
                                                                                                            '</div>'+
                                                                                                      '</div>'+
                                                                                                      '<div class="card-body">'+
                                                                                                            '<h5 class="card-title">'+gonderiler[count]["gonderi_baslik"]+'</h5>'+
                                                                                                            '<p class="card-text">'+gonderiler[count]["gonderi_icerik"]+'</p>'+
                                                                                                            '<div class="row">'+
                                                                                                                  '<div class="col-8">'+
                                                                                                                        '<input type="text" class="form-control" placeholder="Yorum yazınız" id="yorumInput-'+gonderiler[count]["gonderi_id"]+'" />'+
                                                                                                                  '</div>'+
                                                                                                                  '<div class="col-4">'+
                                                                                                                        '<input type="submit" class="form-control bg-danger text-light" value="yorum yap"'+
                                                                                                                              'onclick="YorumYap('+gonderiler[count]["gonderi_id"]+')" />'+
                                                                                                                  '</div>'+
                                                                                                            '</div>'+
                                                                                                            '<div id="yorumlar-'+gonderiler[count]["gonderi_id"]+'">'+
                                                                                                                  '<h3>Yorumlar</h3>'+
                                                                                                                  yorumlarHTML+
                                                                                                            '</div>'+
                                                                                                      '</div>'+
                                                                                                '</div>';
                                                
                                                count++;
                                          }
                                    if(uzunluk  > 1){
                                          document.getElementById("gonderiler").innerHTML += eskiGonderiler;
                                    }
                              }
                        });
                  }

                  setInterval(() => {
                        YeniGonderiVarmi();
                  }, 5000);


                  function YeniGonderiUyariGoster(){
                        $("#yeni-gonderi-uyari").show("slow");
                        setTimeout(() => {
                              $("#yeni-gonderi-uyari").hide("slow");

                        }, 3000);
                  }
            </script>
</body>

</html>