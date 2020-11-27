<?php


if(isset($_POST['submit'])){

  $con=pg_connect("host=localhost dbname=webshop user=postgres password=182ozux33");

        $ime=$_POST['ime'];
        $prezime=$_POST['prezime'];
        $email=$_POST['email'];
        $telefon=$_POST['telefon'];
        $korIme=$_POST['korIme'];
        $lozinkaSHA1=$_POST['lozinka'];
        $adresa=$_POST['adresa'];
        $postBroj=$_POST['postBroj'];
        $mjesto=$_POST['mjesto'];

        $unos =pg_query($con,"insert into korisnik(ime,prezime,email,telefon,korisnickoime,lozinkasha1,adresa,postanskibroj,mjesto) values ('".$ime."', '".$prezime."', '".$email."', '".$telefon."' , '".$korIme."','".sha1($lozinkaSHA1)."', '".$adresa."' , '".$postBroj."','".$mjesto."')");
        if($unos){
          $unos_d=pg_query($con,"insert into dnevnik(id_radnja,id_korisnik) values(1,'".$_COOKIE['korisnik_id']."')");
        }
    pg_close($con);
        header('location:../index.php');
        }




 ?>
