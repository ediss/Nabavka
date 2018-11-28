<?php
    include_once('connection.php');
    
    $database = new Connection();
    $db = $database->open();
    
    $odDatuma   = $_POST['odDatuma'];
    $doDatuma   = $_POST['doDatuma'];
    $odDatumaTs=strtotime($odDatuma);
    $doDatumaTs=strtotime($doDatuma);
    
    
    $sqlSelect = 'SELECT *, SUM(iznos) as iznos_ukupno  FROM ulaz u LEFT JOIN dobavljaci d ON u.dobavljac_id=d.id_dobavljac WHERE datum_ulaz BETWEEN :od AND :do GROUP BY dobavljac_id';
    $statement = $db->prepare($sqlSelect);
    $statement->execute(array(':od'=>$odDatumaTs,':do'=>$doDatumaTs));

    //$ukupnaCena=
    if($statement){
        
    ?>
        <table class="table table-bordered table-striped" style="margin-top:20px;">
        <thead>
            <th>Redni broj</th>
            <th>Dobavljac</th>
            <th>Ukupna cena</th>
        </thead>
        <tbody>
        <?php
            $counter=0;

            foreach ($statement as $row) {
            
                $counter++;
            ?>
                
                <tr>
                   
                    <td><?php echo $counter; ?></td>
                    <td><?php echo $row['naziv_dobavljac']; ?></td>
                    <td><?php echo number_format ((float)$row['iznos_ukupno'] , 2)."RSD"; ?></td>
                    
                    
                </tr>

            <?php
            }
            $database->close();
        ?>

        </tbody>

    </table>
   <?php }
    else{
        echo "<div class='alert alert-warning' role='alert'>Trenutno nismo u mogucnosti da obradimo zahtev. Probajte ponovo.</div>";
    }

    $database->close();
?>
