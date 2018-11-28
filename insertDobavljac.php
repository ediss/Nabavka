<?php
    include_once('connection.php');

    $database = new Connection();
    $db = $database->open();
  
    $stmt = $db->prepare("INSERT INTO dobavljaci(naziv_dobavljac) VALUES(:dobavljacName)");
    //if-else statement in executing our prepared statement
    
    $stmt->execute(array(':dobavljacName' => $_POST['tbNameDobavljac'] ));
        
    if($stmt){
        echo "<div class='alert alert-success' role='alert'>Uspesno ste uneli novog dobavljaca.</div>";
    }
    else{
        echo "<div class='alert alert-warning' role='alert'>Trenutno nismo u mogucnosti da obradimo zahtev. Probajte ponovo.</div>";
    }
    
    $database->close();
?>