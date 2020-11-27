<?php


if(isset($_POST['submit'])){

  $con=pg_connect("host=localhost dbname=webshop user=postgres password=182ozux33");

        $proizvod_id=$_POST['proizvod_id'];
        $akcija=$_POST['akcija'];

        $sql="select akcija_id from akcija where iznos=".$akcija;
        $res=pg_query($con,$sql);
        $upit=pg_fetch_array($res);


        $update=pg_query($con,"UPDATE proizvodi SET id_akcija = ".$upit['akcija_id']." WHERE proizvod_id=".$proizvod_id);
        if($update){
          $unos_d=pg_query($con,"insert into dnevnik(id_radnja,id_korisnik) values(2,'".$_COOKIE['korisnik_id']."')");
        }

      //  $unos =pg_query($con,"insert into korisnik(ime,prezime,email,telefon,korisnickoime,lozinkasha1,adresa,postanskibroj,mjesto) values ('".$ime."', '".$prezime."', '".$email."', '".$telefon."' , '".$korIme."','".sha1($lozinkaSHA1)."', '".$adresa."' , '".$postBroj."','".$mjesto."')");

    pg_close($con);
       header('location:../../index.php');
        }


 ?>
