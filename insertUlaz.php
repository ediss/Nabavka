<?php
    include_once('connection.php');
    
    $database = new Connection();
    $db = $database->open();
    
    $proizvod   = $_POST['ddlProizvod'];
    $sqlSelect = "SELECT * FROM proizvodi WHERE id_proizvod=".$proizvod."";

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
    $jedinica   = $row['jedinica'];
    $porez      = $row['porez']/100;
    $rabat      = $row['rabat']/100;
    $dobavljac  = $_POST['ddlDobavljaci'];
    $cena       = $_POST['tbPrice'];
    if(is_numeric($cena) && is_numeric($kolicina)){
        $ukupnaCena = ($cena+($cena*$porez)-($cena*$rabat));
        $iznos      = $ukupnaCena*$kolicina;
    }

    $datum      = date('d-M-Y');
    $timestamp  = strtotime($datum);
    

    $reCena     = "/^[\d\/.\/,]*$/";

    $errors = array();

    if(!preg_match($reCena, $cena)){
        #echo "<div class='alert alert-danger' role='alert'>Ne ispravan unos naziva proizvoda!</div>";
        array_push($errors,"<div class='alert alert-danger' role='alert'>Neispravan unos cene!</div>");
    }
    if(!preg_match($reCena, $kolicina)){
        #echo "<div class='alert alert-danger' role='alert'>Ne ispravan unos naziva proizvoda!</div>";
        array_push($errors,"<div class='alert alert-danger' role='alert'>Neispravan unos kolicine!</div>");
    }
    if(empty($errors)){
        $sqlInsert = 'INSERT INTO ulaz(datum_ulaz, proizvod_id, dobavljac_id, jedinica_ulaz, cena_ulaz, kolicina_ulaz, ukupna_cena_ulaz, iznos) VALUES(:datum, :proizvod, :dobavljac, :jedinica, :cena, :kolicina, :ukupnaCena, :iznos)';

        $statement = $db->prepare($sqlInsert);
    
        $statement->execute(array(':datum'=>$timestamp,':proizvod'=>$proizvod, ':dobavljac'=>$dobavljac, ':jedinica'=>$jedinica, ':cena'=>$cena, ':kolicina'=>$kolicina,':ukupnaCena'=>$ukupnaCena, ':iznos'=>$iznos));
    
        /*Unos artikla u magacin*/
        $sqlSelectMagacin = 'SELECT * FROM magacin where proizvod_id=:proizvod';
        $queryPrepare     = $db->prepare($sqlSelectMagacin);
        $queryPrepare->execute(array(':proizvod'=>$proizvod));
    
        if($queryPrepare->rowCount()>0){
            $sqlUpdateMagacin="UPDATE magacin SET kolicina_magacin=kolicina_magacin+:km WHERE proizvod_id=:pname";
            $sqlUpdatePrepare= $db->prepare($sqlUpdateMagacin);
            $sqlUpdatePrepare->execute(array(":km"=>$kolicina, ":pname"=>$proizvod));
        }
        else{
            $sqlInsertMagacin = 'INSERT INTO magacin (proizvod_id, kolicina_magacin) VALUES(:proizvod,:kolicina)';
            $statementMagacin = $db->prepare($sqlInsertMagacin);
            $statementMagacin->execute(array(':proizvod'=>$proizvod, ':kolicina'=>$kolicina));
        } 
    
        
        if($statement){
            echo "<div class='alert alert-success' role='alert'>Uspesno ste izvrsili ulaz robe.</div>";
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
