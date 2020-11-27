<?php


if(isset($_POST['submit'])){

  $con=pg_connect("host=localhost dbname=webshop user=postgres password=182ozux33");

        $kategorijaNaziv=$_POST['kategorijaNaziv'];


        $unos =pg_query($con,"insert into kategorija(naziv) values ('".$kategorijaNaziv."')");
        if($unos){
          $unos_d=pg_query($con,"insert into dnevnik(id_radnja,id_korisnik) values(1,'".$_COOKIE['korisnik_id']."')");
        }

    pg_close($con);
        header("Location: ../../index.php?uploadsuccess");
        }


 ?>
