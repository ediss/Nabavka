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
					  <li class="active">Izlaz robe</li>
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
                            Prikaz izlaza robe    
                        </div>
                        
                        <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Redni broj</th>
                                        <th>Proizvod</th>
                                        <th>Kolicina</th>
                                        <th>Akcije</th>
                                    </tr>
                                </thead>
                                <tbody>
                                      
                                <?php
                                    include_once('connection.php');
                                    
                                    $database = new Connection();
                                    $db = $database->open();

                                    $sql='SELECT * FROM izlaz i LEFT JOIN proizvodi p ON i.proizvod_id=p.id_proizvod ORDER BY id_izlaz DESC';
                                    $counter=0;

                                    foreach($db->query($sql) as $row){
                                    
                                        $counter++;
                                    ?>
                                        
                                        <tr>
                                           
                                            <td><?php echo $counter; ?></td>
                                            <td><?php echo $row['naziv_proizvod']; ?></td>
                                            <?php
                                                if($row['jedinica']!='gram'){
                                            ?>

                                            <td><?php   echo ($row['kolicina_izlaz']/1);?></td>
                                        
                                        <?php
                                            }
                                            else{
                                                echo"<td>".$row['kolicina_izlaz']."g</td>";
                                            }
                                        ?>
                                            
                                            <td>
                                                <a href="#edit_<?php echo $row['id_izlaz']?>" class="btn btn-success btn-sm" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> Izmeni</a>
                                                <a href="#delete_<?php echo $row['id_izlaz']; ?>" class="btn btn-danger btn-sm" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span> Izbrisi</a>
                                                
                                            </td>
                                            
                                        </tr>
                                        <?php include('edit_delete_modal_izlaz.php'); ?>
                    
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
                            Izlaz robe
                        </div>
                        <div class="panel-body">
                        <form name='formInsert' method='POST' action='insertIzlaz.php' id='formInsert'  class='insertForm'>
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


                                <label class='lblInsert'>Kolicina: </label>
                                <input type='text'id='tbKolicinaIzlaz' name='tbQuantity' class='form-control myInput' onkeyup="proveraDecimal(this);">
                                <span id="spanKolicinaIzlaz"></span><br/><br/>


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
                                            url: 'insertIzlaz.php',
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