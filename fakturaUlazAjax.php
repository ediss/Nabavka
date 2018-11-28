<?php
    include_once('connection.php');
    
    $database = new Connection();
    $db = $database->open();
    
    $odDatuma   = $_POST['odDatuma'];
    $doDatuma   = $_POST['doDatuma'];
    $odDatumaTs=strtotime($odDatuma);
    $doDatumaTs=strtotime($doDatuma);
    
    
    $sqlSelect = 'SELECT *, SUM(kolicina_ulaz) as kolicina_ukupno, SUM(iznos) as iznos_ukupno  FROM ulaz u LEFT JOIN proizvodi p ON u.proizvod_id=p.id_proizvod WHERE datum_ulaz BETWEEN :od AND :do GROUP BY proizvod_id';
    $statement = $db->prepare($sqlSelect);
    $statement->execute(array(':od'=>$odDatumaTs,':do'=>$doDatumaTs));

    //$ukupnaCena=
    if($statement){
        
    ?>
        <table class="table table-bordered table-striped" style="margin-top:20px;" id="dataTables-example">
        <thead>
            <th>Redni broj</th>
            <th>Proizvod</th>
            <th>Kolicina</th>
            <th>Ukupna cena</th>
        </thead>
        <tbody>
        <?php
            $counter=0;
            $mojIznos=0;
            foreach ($statement as $row) {
            
                $counter++;
                $iznosukupno=$row['iznos_ukupno'];
                $mojIznos+=$iznosukupno;
            ?>
                
                <tr>
                   
                    <td><?php echo $counter; ?></td>
                    <td><?php echo $row['naziv_proizvod']; ?></td>
                    <?php
                        if($row['jedinica']=='gram')
                        {
                    ?>
                    <td><?php echo $row['kolicina_ukupno']."g"; ?></td>
                    <?php
                        }
                        else{
                    ?>
                    <td><?php echo $row['kolicina_ukupno']/1; ?></td>
                    <?php            
                        }
                    ?>
                    
                    <td><?php echo number_format ((float)$iznosukupno , 2)."RSD"; ?></td>
                    
                    
                </tr>

            <?php
            }
            ?>
            <tr>
                <td  colspan='4'>Ukupno:<br/><b><?php echo  number_format ((float)$mojIznos,2)." RSD"; ?></b></td>
            </tr>
            
            <tr>
                

        </tbody>

    </table>
    <a href="#" onClick ="$('#dataTables-example').tableExport({type:'pdf',escape:'false'});"><i class="far fa-file-pdf fa-2x"></i> PDF</a>
    <?php
            $database->close();
    
    }
    else{
        echo "<div class='alert alert-warning' role='alert'>Trenutno nismo u mogucnosti da obradimo zahtev. Probajte ponovo.</div>";
    }

    $database->close();
?>
