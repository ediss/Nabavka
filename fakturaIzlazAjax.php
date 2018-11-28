<?php
    include_once('connection.php');
    
    $database = new Connection();
    $db = $database->open();
    
    $odDatuma   = $_POST['odDatuma'];
    $doDatuma   = $_POST['doDatuma'];
    $odDatumaTs=strtotime($odDatuma);
    $doDatumaTs=strtotime($doDatuma);
    
    $sqlSelect = 'SELECT *, SUM(kolicina_izlaz) as kolicina_ukupno FROM izlaz i LEFT JOIN proizvodi p ON i.proizvod_id=p.id_proizvod WHERE datum_izlaz BETWEEN :od AND :do GROUP BY proizvod_id';
    $statement = $db->prepare($sqlSelect);
    $statement->execute(array(':od'=>$odDatumaTs,':do'=>$doDatumaTs));

    if($statement){
        
    ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>Redni broj</th>
                    <th>Proizvod</th>
                    <th>Kolicina</th>
                </tr>
            </thead>
            <tbody>
                                      
            <?php
                $counter=0;

                foreach ($statement as $row) {
                
                    $counter++;
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
                </tr>

            <?php
            }
            $database->close();
        ?>
                                     
                         
            </tbody>
        </table>
        <a href="#" onClick ="$('#dataTables-example').tableExport({type:'pdf',escape:'false'});"><i class="far fa-file-pdf fa-2x"></i> PDF</a>
    </div>

   <?php }
    else{
        echo "<div class='alert alert-warning' role='alert'>Trenutno nismo u mogucnosti da obradimo zahtev. Probajte ponovo.</div>";
    }

    $database->close();
?>
