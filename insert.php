<?php
    /*regularni izrazi i opsta provera podataka*/
    $nazivProizvod   = $_POST['tbNameArticle'];
    $reNazivProizvod = "/^[\d\w ]*$/";
    $poruka="";

    $greske=array();
    if(!preg_match($reNazivProizvod, $nazivProizvod)){
        #echo "<div class='alert alert-danger' role='alert'>Ne ispravan unos naziva proizvoda!</div>";
        array_push($greske,"<div class='alert alert-danger' role='alert'>Neispravan unos naziva proizvoda!</div>");
    }
    if(empty($nazivProizvod)){
        #echo"<div class='alert alert-danger' role='alert'>Polje Naziv Artikla mora biti popunjeno!</div>";
        array_push($greske,"<div class='alert alert-danger' role='alert'>Polje Naziv Artikla mora biti popunjeno!</div>" );
    }

    if($_POST['ddlJedinica']=="0"){
        array_push($greske,"<div class='alert alert-danger' role='alert'>Morate izabrati jedinicu!</div>");
    }

    if($_POST['ddlKategorija']=="0"){
        array_push($greske,"<div class='alert alert-danger' role='alert'>Morate izabrati kategoriju!</div>");
    }

    if($_POST['ddlPorez']=="0"){
        array_push($greske,"<div class='alert alert-danger' role='alert'>Morate izabrati porez!</div>");
    }

    if($_POST['ddlRabat']=="izaberi"){
        array_push($greske,"<div class='alert alert-danger' role='alert'>Morate izabrati rabat!</div>");
    }

  

  
      
    if(empty($greske)){
        
        include_once('connection.php');

        $database = new Connection();
        $db = $database->open();
    
    
        $stmt = $db->prepare("INSERT INTO proizvodi(naziv_proizvod, jedinica, kategorija,  porez, rabat) VALUES(:productName, :jedinica, :kategorija, :porez, :rabat)");
        //if-else statement in executing our prepared statement
        
        $stmt->execute(array(':productName' => $_POST['tbNameArticle'] , ':jedinica' => $_POST['ddlJedinica'] , ':kategorija' => $_POST['ddlKategorija'] ,  ':porez' => $_POST['ddlPorez'] , ':rabat' => $_POST['ddlRabat']));
            
        if($stmt){
            echo "<div class='alert alert-success' role='alert'>Uspesno ste uneli novi proizvod.</div>";
        }
        else{
            echo "<div class='alert alert-warning' role='alert'>Trenutno nismo u mogucnosti da obradimo zahtev. Probajte ponovo.</div>";
        }

        //ovde select 
        
    
        $database->close();
    }
    else{

        foreach($greske as $greska){
          echo $greska;
        }
        
       
    }
    

    #}
   
?>
