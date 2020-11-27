<?php
  if(isset($_POST['submit'])){
    $file = $_FILES['promjenaNaslovneSlike'];

    $fileName = $_FILES['promjenaNaslovneSlike']['name'];
    $fileTmpName = $_FILES['promjenaNaslovneSlike']['tmp_name'];
    $fileSize = $_FILES['promjenaNaslovneSlike']['size'];
    $fileError = $_FILES['promjenaNaslovneSlike']['error'];
    $fileType = $_FILES['promjenaNaslovneSlike']['type'];

    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg' , 'jpeg', 'png');

    if(in_array($fileActualExt,$allowed)){
      if($fileError === 0){
        if($fileSize < 1000000){
          $fileNameNew = uniqid('', true).".".$fileActualExt;
          $fileDestination = '../multimedija/headerSlika/'.$fileNameNew;
          move_uploaded_file($fileTmpName, $fileDestination);

          $con=pg_connect("host=localhost dbname=webshop user=postgres password=182ozux33");
          $unos =pg_query($con,"insert into naslovnaslika(nazivslike) values ('".$fileNameNew."')");
          if($unos){
            $unos_d=pg_query($con,"insert into dnevnik(id_radnja,id_korisnik) values(1,'".$_COOKIE['korisnik_id']."')");
          }

          pg_close($con);

          header("Location: ../index.php?uploadsuccess");
        }else{
          echo "Vaša datoteka je prevelika!";
        }
      }else{
        echo "Greška prilikom prijenosa datoteke!";
      }
    }else{
      echo "Tip ove datoteke nije podržan!";
    }


  }
 ?>
