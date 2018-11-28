<?php
    include_once('connection.php');

    $database = new Connection();
    $db = $database->open();

    //edit delete proizvoda
    if(isset($_POST['edit']))
    {
        $pname      = $_POST['productName'];
        $porez      = $_POST['ddlPorezIzmena'];
        $rabat      = $_POST['ddlRabat'];
        $id         = $_POST['getId'];
        $jedinica   = $_POST['ddlJedinica'];
        $kategorija = $_POST['ddlKategorija'];
        $rePnmae    = '/^[\d\w ]*$/';

        $errors = array();

        if(!preg_match($rePnmae, $pname)){
          #echo "<div class='alert alert-danger' role='alert'>Ne ispravan unos naziva proizvoda!</div>";
          array_push($errors,"<div class='alert alert-danger' role='alert'>Ne ispravan unos naziva proizvoda edit!</div>");
        }
        if(empty($pname)){
          #echo"<div class='alert alert-danger' role='alert'>Polje Naziv Artikla mora biti popunjeno!</div>";
          array_push($errors,"<div class='alert alert-danger' role='alert'>Polje Naziv Artikla mora biti popunjeno edit!</div>" );
        }
    
        if(empty($errors)){
          $sql= "UPDATE proizvodi SET naziv_proizvod = :pname, jedinica=:jedinica, kategorija=:kategorija, porez= :porez, rabat=:rabat WHERE id_proizvod=:proizvodid";
    
          $statement = $db->prepare($sql);
          $exe=$statement->execute(array(":pname"=>$pname, ":jedinica"=>$jedinica, ":kategorija"=>$kategorija,  ":porez"=>$porez, ":rabat"=>$rabat, ":proizvodid"=>$_POST['getId']));
          
        
          if($exe){
            $message =   "<div class='alert alert-success' role='alert'>Uspesno ste izmenili proizvod.</div>";
          }
          else{
            $message =   "<div class='alert alert-warning' role='alert'>Trenutno nismo u mogucnosti da obradimo zahtev. Probajte ponovo.</div>";
          }
         
          $database->close();
          header("location:proizvodi.php?Message=".$message);
        }
        else{

          foreach($errors as $error){
            echo $error;
          }
        }
        
    }

    if(isset($_POST['delete']))
    {
      $id=$_POST['getIddelete'];
      //  / $safeid= mysqli_real_escape_string($this->$conn, $id);
    
        $sql = "DELETE FROM proizvodi WHERE id_proizvod =  :proizvodID";
    
        $statement = $db->prepare($sql);
        $statement->bindParam(':proizvodID', $id, PDO::PARAM_INT);   
        $exe=$statement->execute();
        //$exe=$statement->execute(array(":pname"=>$_POST['productName'], ":porez"=>$_POST['porez'], ":rabat"=>$_POST['rabat'], ":proizvodid"=>$_POST['getId']));
        
      
        if($exe){
          $message =   "<div class='alert alert-success' role='alert'>Uspesno ste obrisali proizvod.</div>";
        }
        else{
          $message =   "<div class='alert alert-warning' role='alert'>Trenutno nismo u mogucnosti da obradimo zahtev. Probajte ponovo.</div>";
        }
        //var_dump($id);
        $database->close();
        header("location:proizvodi.php?Message=".$message);
    }

    //edit delete dobavljaca
    if(isset($_POST['editDobavljac']))
    {
        $pname  = $_POST['dobavljac'];
        $id     = $_POST['getId'];
    
    
        $sql= "UPDATE dobavljaci SET naziv_dobavljac = :dname WHERE id_dobavljac=:dobavljacid";
    
        $statement = $db->prepare($sql);
        $exe=$statement->execute(array(":dname"=>$_POST['dobavljac'], ":dobavljacid"=>$_POST['getId']));
        
      
        if($exe){
          $message =   "<div class='alert alert-success' role='alert'>Uspesno ste izmenili dobavljaca.</div>";
        }
        else{
          $message =   "<div class='alert alert-warning' role='alert'>Trenutno nismo u mogucnosti da obradimo zahtev. Probajte ponovo.</div>";
        }
       
        $database->close();
        header("location:dobavljaci.php?Message=".$message);
    }
    if(isset($_POST['deleteDobavljac']))
    {
        $id=$_POST['getIddelete'];
        //  / $safeid= mysqli_real_escape_string($this->$conn, $id);
    
        $sql = "DELETE FROM dobavljaci WHERE id_dobavljac =  :dobavljacID";
    
        $statement = $db->prepare($sql);
        $statement->bindParam(':dobavljacID', $id, PDO::PARAM_INT);   
        $exe=$statement->execute();
      
        if($exe){
          $message =   "<div class='alert alert-success' role='alert'>Uspesno ste obrisali dobavljaca.</div>";
        }
        else{
          $message =   "<div class='alert alert-warning' role='alert'>Trenutno nismo u mogucnosti da obradimo zahtev. Probajte ponovo.</div>";
        }
        //var_dump($id);
        $database->close();
        header("location:dobavljaci.php?Message=".$message);
    }
    
    //edit delete ulaz
    if(isset($_POST['editUlaz']))
    {

        $pname  = $_POST['ddlProizvod'];
        $sqlSelect = "SELECT * FROM proizvodi WHERE id_proizvod=".$pname."";

        $stmt = $db->prepare($sqlSelect);
        
        $stmt->execute();
      
        $row = $stmt->fetch();
    
        $porez      = $row['porez']/100;
        $rabat      = $row['rabat']/100;
        $dname      = $_POST['ddlDobavljac'];
        $cena       = $_POST['tbCenaUlaz'];
        $kolicina   = $_POST['tbKolicinaUlaz'];

        if(is_numeric($cena) && is_numeric($kolicina)){
        $ukupnaCena = ($cena+($cena*$porez)-($cena*$rabat));
        $iznos      = $ukupnaCena*$kolicina;
        }
        $id         = $_POST['getId'];
      //  $ukupnaCena = ($cena+($cena*$porez)-($cena*$rabat));
       // $iznos      = $ukupnaCena*$kolicina;


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
    
    
        $sql= "UPDATE ulaz SET proizvod_id=:pname, dobavljac_id = :dname, cena_ulaz=:cena, kolicina_ulaz=:kolicina, ukupna_cena_ulaz=:ukupno, iznos=:iznos WHERE id_ulaz=:ulazid";
    
        $statement = $db->prepare($sql);
        $exe=$statement->execute(array(":pname"=>$pname,":dname"=>$dname, ":cena"=>$cena, ":kolicina"=>$kolicina, ":ukupno"=>$ukupnaCena,":iznos"=>$iznos, ":ulazid"=>$id));
        
      
        if($exe){
          $message =   "<div class='alert alert-success' role='alert'>Uspesno ste izmenili ulaz.</div>";
        }
        else{
          $message =   "<div class='alert alert-warning' role='alert'>Trenutno nismo u mogucnosti da obradimo zahtev. Probajte ponovo.</div>";
        }
       
        $database->close();
        header("location:ulazRobe.php?Message=".$message);
      }
      else{
        foreach($errors as $error){
          echo $error;
      }
    }
    }
    if(isset($_POST['deleteUlaz']))
    {
        $id=$_POST['getIddelete'];
        //  / $safeid= mysqli_real_escape_string($this->$conn, $id);
    
        $sql = "DELETE FROM ulaz WHERE id_ulaz =  :ulazID";
    
        $statement = $db->prepare($sql);
        $statement->bindParam(':ulazID', $id, PDO::PARAM_INT);   
        $exe=$statement->execute();
      
        if($exe){
          $message =   "<div class='alert alert-success' role='alert'>Uspesno ste obrisali ulaz robe.</div>";
        }
        else{
          $message =   "<div class='alert alert-warning' role='alert'>Trenutno nismo u mogucnosti da obradimo zahtev. Probajte ponovo.</div>";
        }
        //var_dump($id);
        $database->close();
        header("location:ulazRobe.php?Message=".$message);
    }
    //edit delete izalz
    if(isset($_POST['editIzlaz']))
    {

        $pname  = $_POST['ddlProizvod'];
        $kolicina  = $_POST['tbKolicinaIzlaz'];
        $id        = $_POST['getId'];

        $reCena     = "/^[\d\/.\/,]*$/";

        $errors = array();
        if(!preg_match($reCena, $kolicina)){
            #echo "<div class='alert alert-danger' role='alert'>Ne ispravan unos naziva proizvoda!</div>";
            array_push($errors,"<div class='alert alert-danger' role='alert'>Neispravan unos kolicine!</div>");
        }
        if(empty($errors)){
          $sql= "UPDATE izlaz SET proizvod_id=:pname, kolicina_izlaz=:kolicina WHERE id_izlaz=:izlazID";
    
          $statement = $db->prepare($sql);
          $exe=$statement->execute(array(":pname"=>$pname, /*":cena"=>$ukupnaCena,*/ ":kolicina"=>$kolicina, ":izlazID"=>$id));
          
        
          if($exe){
            $message =   "<div class='alert alert-success' role='alert'>Uspesno ste izmenili izlaz.</div>";
          }
          else{
            $message =   "<div class='alert alert-warning' role='alert'>Trenutno nismo u mogucnosti da obradimo zahtev. Probajte ponovo.</div>";
          }
         
          $database->close();
          header("location:izlazRobe.php?Message=".$message);
        }
        else{

          foreach($errors as $error){
            echo $error;
          }

      }

       
    }
    if(isset($_POST['deleteIzlaz']))
    {
        $id=$_POST['getIddelete'];
        //  / $safeid= mysqli_real_escape_string($this->$conn, $id);
    
        $sql = "DELETE FROM izlaz WHERE id_izlaz =  :izlazID";
    
        $statement = $db->prepare($sql);
        $statement->bindParam(':izlazID', $id, PDO::PARAM_INT);   
        $exe=$statement->execute();
      
        if($exe){
          $message =   "<div class='alert alert-success' role='alert'>Uspesno ste obrisali izlaz robe.</div>";
        }
        else{
          $message =   "<div class='alert alert-warning' role='alert'>Trenutno nismo u mogucnosti da obradimo zahtev. Probajte ponovo.</div>";
        }
        //var_dump($id);
        $database->close();
        header("location:izlazRobe.php?Message=".$message);
    }
    

    
    $database->close();
    

?>