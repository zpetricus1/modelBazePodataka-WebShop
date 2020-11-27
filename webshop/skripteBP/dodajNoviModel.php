<?php


if(isset($_POST['submit'])){

  $con=pg_connect("host=localhost dbname=webshop user=postgres password=182ozux33");

        $kategorija=$_POST['kategorija'];
        $modelNaziv=$_POST['modelNaziv'];

        $sql_u = "select kategorija_id from kategorija where naziv='".$kategorija."'";
        $res_u = pg_query($con, $sql_u);
        $upit= pg_fetch_assoc($res_u);



        //echo $upit["kategorija_id"];
        $unos =pg_query($con,"insert into model(naziv,id_kategorija) values ('".$modelNaziv."','".$upit["kategorija_id"]."')");

        if($unos){
          $unos_d=pg_query($con,"insert into dnevnik(id_radnja,id_korisnik) values(1,'".$_COOKIE['korisnik_id']."')");
        }

    pg_close($con);
        header("Location: ../../index.php?uploadsuccess");
        }


 ?>
