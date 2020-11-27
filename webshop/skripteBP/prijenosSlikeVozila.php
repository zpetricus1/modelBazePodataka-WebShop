<?php
  if(isset($_POST['submit'])){
    $con=pg_connect("host=localhost dbname=webshop user=postgres password=182ozux33");
    $file = $_FILES['slikaVozila'];

    $fileName = $_FILES['slikaVozila']['name'];
    $fileTmpName = $_FILES['slikaVozila']['tmp_name'];
    $fileSize = $_FILES['slikaVozila']['size'];
    $fileError = $_FILES['slikaVozila']['error'];
    $fileType = $_FILES['slikaVozila']['type'];

    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg' , 'jpeg', 'png');

    if(in_array($fileActualExt,$allowed)){
      if($fileError === 0){
        if($fileSize < 1000000){
          $fileNameNew = uniqid('', true).".".$fileActualExt;
          $fileDestination = '../multimedija/headerSlika/'.$fileName;
          move_uploaded_file($fileTmpName, $fileDestination);

          //$con=pg_connect("host=localhost dbname=webshop user=postgres password=182ozux33");
          //$unos =pg_query($con,"insert into proizvodi(slikanaziv) values ('".$fileNameNew."')");


          //pg_close($con);


        }else{
          echo "Vaša datoteka je prevelika!";
        }
      }else{
        echo "Greška prilikom prijenosa datoteke!";
      }
    }else{
      echo "Tip ove datoteke nije podržan!";
    }
    $cijena=$_POST['cijena'];
    $gorivo=$_POST['gorivo'];
    $kategorija=$_POST['kategorija'];
    $marka=$_POST['marka'];
    $model=$_POST['model'];
    //$abs=$_POST['abs'];
    //$esp=$_POST['esp'];
    //$edc=$_POST['edc'];
    $kilometri=$_POST['kilometri'];
    $opis=$_POST['opis'];
    $slikaVozila=$_POST['slikaVozila'];

    $upitModel = "select model_id from model where naziv='$model'";
    $res_e = pg_query($con, $upitModel);
    $upit1= pg_fetch_assoc($res_e);





    $unos =pg_query($con,"insert into proizvodi(cijena,opis,vrsta_motora
    ,slikanaziv,kilometri,id_model) values ('".$cijena."',
    '".$opis."', '".$gorivo."',
    '".$fileName."','".$kilometri."','".$upit1['model_id']."')");

    if($unos){
      $unos_d=pg_query($con,"insert into dnevnik(id_radnja,id_korisnik) values(1,'".$_COOKIE['korisnik_id']."')");
    }

    pg_close($con);
    header("Location: ../index.php?uploadsuccess");
  }
 ?>
