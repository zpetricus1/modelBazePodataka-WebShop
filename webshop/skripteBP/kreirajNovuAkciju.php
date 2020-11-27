<?php


if(isset($_POST['submit'])){

  $con=pg_connect("host=localhost dbname=webshop user=postgres password=182ozux33");

        $iznos=$_POST['iznos'];
        $pocetak=$_POST['pocetak'];
        $kraj=$_POST['kraj'];


        $unos =pg_query($con,"insert into akcija(iznos,pocetak,kraj) values ('".$iznos."', '".$pocetak."', '".$kraj."')");

        if($unos){
          $unos_d=pg_query($con,"insert into dnevnik(id_radnja,id_korisnik) values(1,'".$_COOKIE['korisnik_id']."')");
        }

    pg_close($con);
        header('location:../../index.php');
        }


 ?>
