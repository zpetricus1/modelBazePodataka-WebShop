<?php
  require_once '../../vanjske_biblioteke/baza.class.php';
  require_once '../../vanjske_biblioteke/sesija.class.php';
  require_once '../../skripteBP/dodajNoviModel.php';


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
      <div class="">
        <h2>Računi korisnika</h2>
        <table align="center" border="1px" style= "color:#333">
          <tr>
            <th>Račun ID</th>
            <th>Proizvod ID</th>
            <th>Korisnik ID</th>
            <th>Cijena</th>
            <th>PDV</th>
            <th>Ukupna cijena</th>
            <th>Plaćeno?</th>
            <th>Isporučeno?</th>
            <th>Plaćanje potvrđeno?</th>
            <?php
            $link=pg_connect("host=localhost dbname=webshop user=postgres password=182ozux33");
            $upit1 ="select korisnik_id from korisnik where korisnickoime='{$_COOKIE['name']}'";
            $res_u = pg_query($link, $upit1);
            $red = pg_fetch_assoc($res_u);

            $upit = "Select racun_id, id_proizvod,id_korisnik,cijena,pdv,ukupna_cijena,placeno,isporuceno,placanje_potvrdjeno from racun";

            $rezultat=pg_query($link, $upit);

            while($rows = pg_fetch_assoc($rezultat)){
            ?>

            <tr>
              <td><?php echo $rows['racun_id']; ?></td>
              <td><?php echo $rows['id_proizvod']; ?></td>
              <td><?php echo $rows['id_korisnik']; ?></td>

              <td><?php echo $rows['cijena']; ?></td>
              <td><?php echo $rows['pdv']; ?></td>
              <td><?php echo $rows['ukupna_cijena']; ?></td>
              <td><?php echo $rows['placeno']; ?></td>
              <td><?php echo $rows['isporuceno']; ?></td>
              <td><?php echo $rows['placanje_potvrdjeno']; ?></td>

            </tr>
              <?php
            }


            ?>
      </div>
      <br><br>
      <div class="">
        <form  action="#" method="post">
          <label for="racun">ID Računa:</label><br>
          <input id="racun" name="racun" type="text"><br><br>
          <input name="submit1" id="submit1" class="buttonPrijava"  type="submit" value="Potvrdi plaćanje"/>
          <input name="submit2" id="submit2" class="buttonPrijava"  type="submit" value="Označi kao isporučeno"/>
        </form>
      </div>



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
<?php
if(isset($_POST['submit1'])){
  $racun=$_POST['racun'];


  $con=pg_connect("host=localhost dbname=webshop user=postgres password=182ozux33");

  $unos=pg_query($con,"update racun set placanje_potvrdjeno=TRUE where racun_id=".$racun."");

  pg_close($con);

      }
      if(isset($_POST['submit2'])){
        $racun=$_POST['racun'];


        $con=pg_connect("host=localhost dbname=webshop user=postgres password=182ozux33");

        $unos=pg_query($con,"update racun set isporuceno=TRUE where racun_id=".$racun."");
        if($unos){
          $unos_d=pg_query($con,"insert into dnevnik(id_radnja,id_korisnik) values(1,'".$_COOKIE['korisnik_id']."')");
        }
        pg_close($con);

            }
 ?>
