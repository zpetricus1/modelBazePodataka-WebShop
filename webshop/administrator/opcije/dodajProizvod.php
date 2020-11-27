<?php
  require_once '../../vanjske_biblioteke/baza.class.php';
  require_once '../../vanjske_biblioteke/sesija.class.php';
  require_once '../../skripteBP/prijenosSlikeVozila.php';


  $con=pg_connect("host=localhost dbname=webshop user=postgres password=182ozux33");
 ?>
<!DOCTYPE html>
<!--JAVASCRIPT-->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/hr_HR/sdk.js#xfbml=1&version=v7.0" nonce="iI1yCNpI"></script>
<!--JAVASCRIPT-->

<html lang="eng" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="../../CSS/webshop.css?<?=filemtime("../../CSS/webshop.css")?>" rel="stylesheet" type="text/css" />
    <!--<link href="CSS/webshop.css" rel="stylesheet" type="text/css">-->
    <link href="https://fonts.googleapis.com/css?family=Sen" rel="stylesheet">
    <title></title>
  </head>
  <body>
    <!--HEADER-->

    <br>

    <!--NAVIGACIJA-->
    <div class="topnav">
      <?php
        $putanja = dirname($_SERVER["REQUEST_URI"],3);
        include '../../meni/meni.php';
      ?>
  </div><br>

  <!--BODY-->
  <div class="body">
    <div class="bodySidebarOne">
      <h2 id="SideBar">KOŠARICA</h2><br><br>
      <h2 id="SideBar">FACEBOOK STRANICA</h2>

      <div class="fb-page" data-href="https://www.facebook.com/MercedesBenz" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/MercedesBenz" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/MercedesBenz">Mercedes-Benz</a></blockquote></div>
    </div>
    <div class="bodyContent">
      <div class="topnav">
        <a href="promjenaNaslovneSlike.php"/>Naslovna slika</a>
        <a href="dodajProizvod.php"/>Dodaj proizvod</a>
        <a href="dodajKategoriju.php"/>Dodaj kategoriju</a>
        <a href="dodajModel.php"/>Dodaj model</a>
        <a href="kreirajAkciju.php"/>Kreiraj akciju</a>
      </div><br>

      <form class="" action="../../skripteBP/prijenosSlikeVozila.php" method="post" enctype="multipart/form-data">
        <label for="cijena">Cijena : </label>
        <input type="number" id="cijena" name="cijena" min="1000" max="1000000" step="100" value="100000"><br><br>
        <input type="text" name="gorivo" id="gorivo"  placeholder="Gorivo"><br><br>

        <select name ="model" id="model">
        <?php

          $res=pg_query($con,"select naziv from model");
          while($row=pg_fetch_array($res)){
         ?>
         <option><?php echo $row["naziv"]; ?></option><br><br><br>
         <?php
         }
          ?>

        </select><br><br><br>



        <label for="kilometri">Prijeđeni kilometri : </label>
        <input type="number" id="kilometri" name="kilometri" min="1000" max="1000000" step="100" value="100000"><br><br>

        <textarea rows="10" cols="50" name="opis" id="opis" placeholder="Opis"></textarea><br><br><br>
        <label for="slikaVozila">Slika vozila : </label>
        <input type="file" name="slikaVozila" id="slikaVozila"><br><br><br>
        <input type="submit"name="submit" id="submit" class="buttonPrijava" value="Dodaj"><br><br>
      </form>

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
        <a href="facebook.com"><img src="../multimedija/socialMedia/facebookLogo.png"></a>
        <a href="instagram.com"><img src="../multimedija/socialMedia/instagramLogo.png"></a>
        <a href="twitter.com"><img src="../multimedija/socialMedia/twitterLogo.png"></a>
        <a href="linkedin.com"><img src="../multimedija/socialMedia/linkedinLogo.png"></a>
        <a href="tumblr.com"><img src="../multimedija/socialMedia/tumblrLogo.png"></a>
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
