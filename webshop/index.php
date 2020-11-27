<?php
require_once 'vanjske_biblioteke/baza.class.php';
require_once 'vanjske_biblioteke/sesija.class.php';
//include_once "skripteBP/prijava.php";
$con=pg_connect("host=localhost dbname=webshop user=postgres password=182ozux33");
$sql_u = "select nazivslike from naslovnaslika where id=(select max(id) from naslovnaslika)";
$res_u = pg_query($con, $sql_u);
$upit= pg_fetch_assoc($res_u);

pg_close($con);

 ?>



<!DOCTYPE html>
<!--JAVASCRIPT-->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/hr_HR/sdk.js#xfbml=1&version=v7.0" nonce="iI1yCNpI"></script>
<!--JAVASCRIPT-->
<html lang="eng" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="CSS/webshop.css?<?=filemtime("CSS/webshop.css")?>" rel="stylesheet" type="text/css" />
    <!--<link href="CSS/webshop.css" rel="stylesheet" type="text/css">-->
    <link href="https://fonts.googleapis.com/css?family=Sen" rel="stylesheet">
    <title></title>
  </head>
  <body>
    <div id="greske" style="color:red">


    </div>
    <!--HEADER-->

    <div class="header">
      <div class="headerSlika">

        <img class="naslovnaSlika" src="multimedija/headerSlika/<?php echo $upit["nazivslike"]; ?>" >
      </div>
      <div class="logoPrijava"><br><br><br>
      <img class="logoSlika" src="multimedija/slika1.png" alt="">
      <h2>MERCEDES BENZ</h2>
      </div>
      <div class="prijava"><br>
        <form novalidate name="prijava" id="prijava" class="" action="?" method="get">
          <input type="text" id="korime" name="korime" placeholder="Korisničko ime" <?php if(isset($_COOKIE['name'])){echo "value='{$_COOKIE['name']}'";} ?>><br>
          <input type="password" id="lozinka" name="lozinka" placeholder="Lozinka" <?php if(isset($_COOKIE['lozinka'])){echo "value='{$_COOKIE['lozinka']}'";} ?>><br>
          <a href ="zaboravljena_lozinka.php">Zaboravljena lozinka?</a><br><br>

          <input type="submit" name="submit" class="buttonPrijava" value="Prijavi se"><br>
        </form>

        <a href="obrasci/registracija.php">Registriraj se sada!</a>
      </div>
      <?php
      if(isset($greska)){
        echo '<script>alert("Nisu ispravno popunjeni podaci! Provjerite korisničko ime i lozinku!") </script>';
      }
     ?>


    </div><br>

    <!--NAVIGACIJA-->
    <div class="topnav">
      <?php
        $putanja = dirname($_SERVER["REQUEST_URI"]);
        include 'meni/meni.php';
      ?>
  </div><br>

  <!--BODY-->
  <div class="body">
    <div class="bodySidebarOne">


      <h2 id="SideBar">FACEBOOK STRANICA</h2>

      <div class="fb-page" data-href="https://www.facebook.com/MercedesBenz" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/MercedesBenz" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/MercedesBenz">Mercedes-Benz</a></blockquote></div>
    </div>
    <div class="bodyContentLimuzine">
      <?php



        /*$brojac_min = "SELECT min(proizvod_id) from proizvodi join model as mo on id_model=mo.model_id join kategorija as k on mo.id_kategorija=k.kategorija_id where k.kategorija_id = 3";
        $res_u_min = pg_query($con, $brojac_min);
        $upit_min= pg_fetch_array($res_u_min);*/

        $con=pg_connect("host=localhost dbname=webshop user=postgres password=182ozux33");
        $sql = "SELECT proizvod_id from proizvodi where id_akcija is not null";

      //  $brojac = "SELECT proizvod_id from proizvodi join model as mo on id_model=mo.model_id join kategorija as k on mo.id_kategorija=k.kategorija_id where k.kategorija_id = 3";
      //  $result = pg_query($con, $brojac);
      //  $upit= pg_fetch_array($result);
      $result = pg_query($con, $sql);

if (pg_num_rows($result) > 0) {
// output data of each row
while($row = pg_fetch_assoc($result)) {

  $upitProizvodi = "select * from proizvodi where proizvod_id=".$row["proizvod_id"];
  $res_e = pg_query($con, $upitProizvodi);
  $upit2= pg_fetch_assoc($res_e);
  $upitModel = "select naziv from model where model_id=".$upit2["id_model"];
  $res_m = pg_query($con, $upitModel);
  $upit3= pg_fetch_assoc($res_m);
  $upitAkcija = "select * from akcija where akcija_id=".$upit2["id_akcija"];
  $res_t = pg_query($con, $upitAkcija);
  $upit4= pg_fetch_assoc($res_t);
  $upit5="0.";
  if($upit2){
    ?><div class="proizvodi">


      <br>


        <img src="multimedija/headerSlika/<?php echo $upit2["slikanaziv"]; ?>" height="250" width ="350" alt="" style="border: 5px solid #555 ;"><br>
        <p class="podaci">Šifra proizvoda: <?php echo $upit2["proizvod_id"]; ?></p>
        <p class="podaci">Model: <?php echo $upit3["naziv"]; ?></p>
        <p class="podaci"><del>Stara cijena: <?php echo $upit2["cijena"]; ?></del></p>
        <h3>Nova cijena: <?php echo ($upit2["cijena"]-($upit2["cijena"]*($upit4["iznos"])/100)) ?>$</h3>
        <p class="podaci">Vrsta motora: <?php echo $upit2["vrsta_motora"]; ?></p>
        <p class="podaci"><?php echo $upit2["opis"]; ?></p>
        <form class="" action="#" method="post">
          <input type="text" name="proizvod_id" id="proizvod_id"  placeholder="Šifra proizvoda"><br>
          <input type="submit" name="submit1" class="buttonKosarica"  id="submit1" value="Kupi gotovinom">
          <input type="submit" name="submit2" class="buttonKosarica"  id="submit2" value="Kupi karticom">
        </form>



    </div>
    <?php

  }
}
} else {
echo "0 results";
}

pg_close($con);



       ?>

    </div>
    <div class="bodySidebarTwo">
      <h2 id="rightSideBar">LOKACIJA</h2>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d23163.87244064339!2d17.311225385571394!3d43.47136760889117!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x134b26df70a1f60f%3A0xab55804f498b7c75!2zUG9zdcWhamU!5e0!3m2!1shr!2sba!4v1594657698398!5m2!1shr!2sba" width="300" height="200" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe><br>
      <br><h2 id="rightSideBar">KONTAKT</h2>
      <ol>
        <p><b>Tel: </b> +385 95 7970 427</p>
        <p><b>Email: </b> zpetricus@foi.hr</p>
        <p><b>Adresa: </b>Julija Merlića 9</p>
        <p><b>Mjesto: </b>42 000 Varaždin</p>
      </ol>
    </div>
  </div>

  </body>
  <!--FOOTER-->

  <footer>
    <div class="footer">
      <div class="socialMedia">
        <h3>DRUŠTVENE MREŽE</h3>
        <p>Pratite nas na društvenim mrežama. Ukoliko trebate pomoć
        ili imate nekih pitanja, tamo možete pronaći odgovor. Javite
        nam se!</p>
        <a href="facebook.com"><img src="multimedija/socialMedia/facebookLogo.png"></a>
        <a href="instagram.com"><img src="multimedija/socialMedia/instagramLogo.png"></a>
        <a href="twitter.com"><img src="multimedija/socialMedia/twitterLogo.png"></a>
        <a href="linkedin.com"><img src="multimedija/socialMedia/linkedinLogo.png"></a>
        <a href="tumblr.com"><img src="multimedija/socialMedia/tumblrLogo.png"></a>
      </div>
      <div class="keepMePosted">
        <h3>OSTANITE POVEZANI</h3>
        <p>Saznajte sve o našim novim akcijam i proizvodima na vrijeme. Sve što
        trebate napraviti je unijeti vašu email adresu.</p>
        <form class="" action="index.html" method="post">
          <input type="text" placeholder="Vaša email adresa"><br>
          <input type="button" class="buttonEmail" value="Obavještavaj me"><br>

        </form>


      </div>
      <div class="miniGalerija">
        <h3>KONTAKT</h3>

        <ol>
          <p><b>Tel: </b> +385 95 7970 427</p>
          <p><b>Email: </b> zpetricus@foi.hr</p>
          <p><b>Adresa: </b>Julija Merlića 9</p>
          <p><b>Mjesto: </b>42 000 Varaždin</p>
        </ol>
      </div>



    </div><br>
  </footer>
</html>

<?php
if(isset($_POST['submit1'])){
  $con=pg_connect("host=localhost dbname=webshop user=postgres password=182ozux33");
  $proizvod=$_POST['proizvod_id'];
  $upit3="select cijena from proizvodi where proizvod_id='".$proizvod."'";

  $res_t=pg_query($con, $upit3);
  $upit4= pg_fetch_array($res_t);



  $con=pg_connect("host=localhost dbname=webshop user=postgres password=182ozux33");

  $unos=pg_query($con,"insert into racun (id_proizvod,id_korisnik,id_placanje,cijena,PDV,ukupna_cijena) values ('".$proizvod."','".$_COOKIE['korisnik_id']."',2,'".$upit4['cijena']."',25,'".$upit4['cijena']*1.25."')");
  if($unos){
    $unos_d=pg_query($con,"insert into dnevnik(id_radnja,id_korisnik) values(1,'".$_COOKIE['korisnik_id']."')");
  }
  pg_close($con);

      }
      if(isset($_POST['submit2'])){
        $con=pg_connect("host=localhost dbname=webshop user=postgres password=182ozux33");
        $proizvod=$_POST['proizvod_id'];
        $upit3="select cijena from proizvodi where proizvod_id='".$proizvod."'";

        $res_t=pg_query($con, $upit3);
        $upit4= pg_fetch_array($res_t);



        $con=pg_connect("host=localhost dbname=webshop user=postgres password=182ozux33");

        $unos=pg_query($con,"insert into racun (id_proizvod,id_korisnik,id_placanje,cijena,PDV,ukupna_cijena) values ('".$proizvod."','".$_COOKIE['korisnik_id']."',2,'".$upit4['cijena']."',25,'".$upit4['cijena']*1.25."')");

        if($unos){
          $unos_d=pg_query($con,"insert into dnevnik(id_radnja,id_korisnik) values(1,'".$_COOKIE['korisnik_id']."')");
        }

        pg_close($con);

            }
 ?>
