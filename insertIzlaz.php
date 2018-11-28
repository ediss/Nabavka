<?php
    include_once('connection.php');
    
    $database = new Connection();
    $db = $database->open();
    
    $proizvod   = $_POST['ddlProizvod'];
    $sqlSelect = "SELECT jedinica FROM proizvodi WHERE id_proizvod=".$proizvod."";

    $stmt = $db->prepare($sqlSelect);
    
    $stmt->execute();
   
    $row = $stmt->fetch();
    if($row['jedinica']=='gram')
    {
        $kolicina=($_POST['tbQuantity'] / 1000);
    }
    else
    {
        $kolicina   = $_POST['tbQuantity'];
    }
    
    $datum=date('d-M-Y');
    $timestamp = strtotime($datum);
    $reCena     = "/^[\d\/.\/,]*$/";

    $errors = array();

    if(!preg_match($reCena, $kolicina)){
        #echo "<div class='alert alert-danger' role='alert'>Ne ispravan unos naziva proizvoda!</div>";
        array_push($errors,"<div class='alert alert-danger' role='alert'>Neispravan unos kolicine!</div>");
    }
    
    if(empty($errors)){
        $sqlInsert = 'INSERT INTO izlaz(datum_izlaz, proizvod_id, kolicina_izlaz) VALUES(:datum, :proizvod, :kolicina)';

        $statement = $db->prepare($sqlInsert);

        $statement->execute(array(':datum'=>$timestamp, ':proizvod'=>$proizvod, ':kolicina'=>$kolicina));

    /*Izbacivanje artikla iz magacina*/
        $sqlSelectMagacin = 'SELECT * FROM magacin where proizvod_id=:proizvod';
        $queryPrepare     = $db->prepare($sqlSelectMagacin);
        $queryPrepare->execute(array(':proizvod'=>$proizvod));

        if($queryPrepare->rowCount()>0){
            $sqlUpdateMagacin="UPDATE magacin SET kolicina_magacin=kolicina_magacin-:km WHERE proizvod_id=:pname";
            $sqlUpdatePrepare= $db->prepare($sqlUpdateMagacin);
            $sqlUpdatePrepare->execute(array(":km"=>$kolicina, ":pname"=>$proizvod));
        }


        if($statement){
            echo "<div class='alert alert-success' role='alert'>Uspesno ste izvrsili izlaz robe.</div>";
        }
        else{
            echo "<div class='alert alert-warning' role='alert'>Trenutno nismo u mogucnosti da obradimo zahtev. Probajte ponovo.</div>";
        }

        $database->close();
    }
    else{
        foreach($errors as $error){
          echo $error;
        }
    }
?>
