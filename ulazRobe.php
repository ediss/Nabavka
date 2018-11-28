<?php
    include('header.php');
    include('navbar_side.php');
?>
       
  <div id="page-wrapper">
		    <div class="header"> 
                <h1 class="page-header">
                    Dashboard <small>Zdravo Ana!</small>
                </h1>
				    <ol class="breadcrumb">
					  <li><a href="#">Pocetna</a></li>
					  <li><a href="#">Ulaz/Izlaz</a></li>
					  <li class="active">Ulaz robe</li>
					</ol> 
									
		    </div>
            <div name='message' id='message'>
                <?php
                    if( !empty( $_REQUEST['Message'] ) )
                    {
                        echo sprintf( '<p>%s</p>', $_REQUEST['Message'] );
                    }

                   
                ?>
            </div>
            <div id="page-inner">

            <div class="row"> 
                <div class="col-md-6 col-sm-12 col-xs-12">                     
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Prikaz ulaza robe
                            
                        </div>
                        
                        <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Redni broj</th>
                                        <th>Proizvod</th>
                                        <th>Dobavljac</th>
                                        <th>Kolicina</th>
                                        <th>Cena</th>
                                        <th>Cena+PDV-Rabat</th>
                                        <th>Akcije</th>
                                    </tr>
                                </thead>
                                <tbody>
                                      
                                <?php
                                include_once('connection.php');
                                                        
                                    $database = new Connection();
                                    $db = $database->open();

                                    $sql='SELECT * FROM (ulaz u LEFT JOIN proizvodi p ON u.proizvod_id=p.id_proizvod)LEFT JOIN dobavljaci d ON u.dobavljac_id=d.id_dobavljac ORDER BY id_ulaz DESC';
                                    $counter=0;

                                    foreach($db->query($sql) as $row){
                                                        
                                    $counter++;
                                                        
                                    ?>
                                                            
                                    <tr>              
                                        <td><?php echo $counter; ?></td>
                                        <td><?php echo $row['naziv_proizvod']; ?></td>
                                        <td><?php echo $row['naziv_dobavljac']; ?></td>
                                        <?php
                                            if($row['jedinica_ulaz']!='gram'){
                                            ?>

                                        <td><?php   echo ($row['kolicina_ulaz']/1);?></td>
                                        
                                        <?php
                                            }
                                            else{
                                                echo"<td>".$row['kolicina_ulaz']."g</td>";
                                            }
                                        ?>
                                        <td><?php echo $row['cena_ulaz']; ?>,00RSD</td>
                                        <td><?php echo $row['ukupna_cena_ulaz']; ?>,00RSD</td>
                                                                
                                        <td>
                                            <a href="#edit_<?php echo $row['id_ulaz']?>" class="btn btn-success btn-sm btnUlaz" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> Izmeni</a>
                                            <a href="#delete_<?php echo $row['id_ulaz']; ?>" class="btn btn-danger btn-sm btnUlaz" data-toggle="modal"><span class="glyphicon glyphicon-trash spanBrisanje"></span> Izbrisi</a>
                                                                    
                                        </td>
                                                                
                                    </tr>
                                    <?php include('edit_delete_modal_ulaz.php'); ?>    
                                    
                                    <?php
                                    }
                                    $database->close();
                                    ?>       
                         
                                </tbody>
                            </table>
                        </div>
              
                     
                              

                        </div>
                    </div>            
                </div>
            <!--kraj unosa-->        
                <div class="col-md-6 col-sm-12 col-xs-12">                     
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Ulaz robe
                        </div>
                        <div class="panel-body">
                        <form name='formInsert' method='POST' action='insertUlaz.php' id='formInsert'  class='insertForm'>
                                <?php include_once('connection.php');?>
                                <label class='lblInsert'>Proizvod: </label>
                                    <?php
                                        $database = new Connection();
                                        $db = $database->open();

                                        $sql = 'SELECT * FROM proizvodi';
                                        
                                    ?>
                                <select name='ddlProizvod'  id='ddlProizvod' class='form-control myInput'>
                                    <?php
                                        foreach($db->query($sql) as $row){
                                        ?>
                                        <option value="<?php echo $row['id_proizvod']; ?>"><?php echo $row['naziv_proizvod']; ?></option>
                                    <?php
                                        }    
                                        $database->close();    
                                    ?>
                                </select><br/><br/>

                                <label class='lblInsert'>Dobavljac: </label>
                                    <?php
                                        $database = new Connection();
                                        $db = $database->open();

                                        $sql = 'SELECT * FROM dobavljaci';
                                        
                                    ?>
                                <select name='ddlDobavljaci'  id='ddlDobavljaci' class='form-control myInput'>
                                    <?php
                                        foreach($db->query($sql) as $row){
                                        ?>
                                        <option value="<?php echo $row['id_dobavljac']; ?>"><?php echo $row['naziv_dobavljac']; ?></option>
                                    <?php
                                        }
                                        $database->close();    
                                    ?>
                                </select><br/><br/>

                                <label class='lblInsert'>Cena: </label>
                                <input type='text'id='tbPrice' name='tbPrice' id='tbPrice' class='form-control myInput' onkeyup="proveraDecimal(this);">
                                <span id="spanCena"></span><br/><br/>

                                <label class='lblInsert'>Kolicina: </label>
                                <input type='text'id='tbQuantity' name='tbQuantity' class='form-control myInput' onkeyup="proveraDecimal(this);">
                                <span id="spanKolicina"></span><br/><br/>

                                <!--<label class='lblInsert'>Datum ulaza: </label>
                                <input type="date" name="datumUlaza"  class='form-control myInput'>-->


                                <div class='btns'>
                                    <input type='submit' id='btnInsertUlaz' name='btnInsertUlaz'class='btn btn-primary btnInsertArticle' value='Unesi'>
                                    <input type='reset' name='btnReset'class='btn btn-danger btnReset' value='Odustani'>
                                </div>
                                
                            </form>
                            <script src="assets/js/provera.js"></script>
              
                            <script type="text/javascript">

                                $(document).ready(function() {
                                    $("#formInsert").submit(function() {		
                                        $.ajax({
                                            type: "POST",
                                            url: 'insertUlaz.php',
                                            data:$("#formInsert").serialize(),
                                            success: function (data) {	
                                                // Inserting html into the result div on success
                                                $('#message').show();
                                                $('#message').html(data);
                                            }
                                            /*error: function(jqXHR, text, error){
                                            // Displaying if there are any errors
                                                $('#ajaxDiv').html(error);        
                                        }*/   
                                    });
                                        return false;
                                    });
                                });

                            </script>
                
                        </div>
                    </div>            
                </div>
            <!--kraj izmene--> 
                
            </div>
            <!--kraj row-a za unos/izmenu artikla-->

          <!--  <div class="row"> 
                <div class="col-md-6 col-sm-12 col-xs-12 insertArticle">                     
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Prikaz artikla
                        </div>
                        
                        <div class="panel-body">

                        </div>
                    </div>            
                </div>
                
            </div>-->
            
            <!--kraj row-a za prikaz-->
<?php
    include('footer.php');
?>