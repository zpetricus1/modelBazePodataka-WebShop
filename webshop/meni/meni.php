<?php
if(isset($_GET['submit'])){
  $korime=$_GET['korime'];
      $lozinka=$_GET['lozinka'];


  $con=pg_connect("host=localhost dbname=webshop user=postgres password=182ozux33");
  $upit = "select * from korisnik where korisnickoime= '".$_GET["korime"]."'AND lozinkasha1='".sha1($_GET["lozinka"])."'and email_potvrda = TRUE and blokiran=FALSE";
  $res_e=pg_query($con, $upit);
  $upit2= pg_fetch_array($res_e);
  //if(isset($_COOKIE['name'])){echo "value='{$_COOKIE['name']}'";}

  if($upit2){
      setcookie('name',$korime,time()+10000);
      setcookie('lozinka',$lozinka,time()+10000);
  }
  $upit3="select id_uloga from korisnik where korisnickoime='".$_GET["korime"]."'";

  $res_t=pg_query($con, $upit3);
  $upit4= pg_fetch_array($res_t);

  $upit5="select korisnik_id from korisnik where korisnickoime='".$_GET["korime"]."'";

  $res_z=pg_query($con, $upit5);
  $upit6= pg_fetch_array($res_z);
  if($upit4){
      setcookie('uloga',$upit4["id_uloga"],time()+10000);
      setcookie('korisnik_id',$upit6["korisnik_id"],time()+10000);
  }
}



  //include_once "../skripteBP/prijava.php";
echo
"
<nav>

    <a href=\"$putanja/obrasci/registracija.php\">Registracija</a>
    <a href=\"$putanja/index.php\">Početna</a>
    ";

    if(isset($_COOKIE['uloga'])){
      if($_COOKIE['uloga']>=1){
        echo
        "  <a href=\"$putanja/obrasci/kontakt.php\">Kontakt</a>
          <a href=\"$putanja/racun/racun.php\">Moji računi</a>
          <a href=\"$putanja/proizvodi/limuzine/limuzine.php\">Limuzine</a>
          <a href=\"$putanja/proizvodi/karavani/karavani.php\">Karavani</a>
          <a href=\"$putanja/proizvodi/suv/suv.php\">SUV</a>
          <a href=\"$putanja/proizvodi/compact/compact.php\">Compact</a>";
      }

      }
      if(isset($_COOKIE['uloga'])){
        if($_COOKIE['uloga']>=2){
          echo
          "
          <a href=\"$putanja/administrator/administrator.php\">Administrator</a>
          ";
        }

        }

echo "
</nav>


";

?>
