<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $row['id_ulaz']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Izmena ulaza</h4></center>
                </div>
                <div class="modal-body">
    			<div class="container-fluid">
                <form method="POST" name='editForm' id='editForm' action="crudProizvodi.php">
                <!--<form method="POST" name='editForm' action="edit.php">-->
                    <div class="row form-group">
    					<div class="col-sm-2">
    						<label class="control-label" style="position:relative; top:7px;">Proizvod:</label>
    					</div>
                        <div class="col-sm-10">
                            <?php
                                $database = new Connection();
                                $db = $database->open();

                                $sql = 'SELECT * FROM proizvodi';
                                            
                            ?>
                            <select name='ddlProizvod'  id='ddlProizvod' class='form-control crudInput'>
                                <option value="<?php echo $row['id_proizvod']; ?>"><?php echo $row['naziv_proizvod']; ?></option>
                                <?php
                                    foreach($db->query($sql) as $row2){
                                ?>
                                    <option value="<?php echo $row2['id_proizvod']; ?>"><?php echo $row2['naziv_proizvod']; ?></option>
                                <?php
                                    }
                                    $database->close();    
                                ?>
                            </select>
    					</div>
    				</div>

                    <div class="row form-group">
    					<div class="col-sm-2">
    						<label class="control-label" style="position:relative; top:7px;">Dobavljac:</label>
    					</div>
    					<div class="col-sm-10">
                            <?php
                                $database = new Connection();
                                $db = $database->open();

                                $sql = 'SELECT * FROM dobavljaci';
                                        
                            ?>
                            <select name='ddlDobavljac'  id='ddlDobavljac' class='form-control crudInput'>
                                    <option value="<?php echo $row['id_dobavljac']; ?>"><?php echo $row['naziv_dobavljac']; ?></option>
                                <?php
                                    foreach($db->query($sql) as $row2){
                                ?>
                                    <option value="<?php echo $row2['id_dobavljac']; ?>"><?php echo $row2['naziv_dobavljac']; ?></option>
                                <?php
                                    }
                                    $database->close();
                                ?>
                                </select>
    					</div>
    				</div>

                    <div class="row form-group">
    					<div class="col-sm-2">
    						<label class="control-label" style="position:relative; top:7px;">Cena:</label>
    					</div>
    					<div class="col-sm-10">
                            <input type="text" class="form-control" id='tbCenaUlaz' name="tbCenaUlaz" value="<?php echo $row['cena_ulaz']; ?>"onkeyup="proveraDecimal(this);">
                            <span id='spanCenaEdit'></span>
    					</div>
    				</div>

                    <div class="row form-group">
    					<div class="col-sm-2">
    						<label class="control-label" style="position:relative; top:7px;">Kolicina:</label>
    					</div>
    					<div class="col-sm-10">
                            <?php
                                $kolicina=$row['kolicina_ulaz']/1;
                                $kolicinaGram=$row['kolicina_ulaz'];
                            ?>
                            <input type="text" class="form-control" id="tbKolicinaUlaz" name="tbKolicinaUlaz" value="<?php echo ($row['jedinica']=='gram') ? $kolicinaGram :  $kolicina; ?>"onkeyup="proveraDecimal(this);">
                            <span id='spanKolicinaEdit'></span>
    					</div>
    				</div>
    		
    		
                    <input type='hidden' value='<?php echo $row['id_ulaz']?>' name='getId'>
                </div> 
    			</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Odustani</button>
                    <button type="submit" name="editUlaz" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Izmeni</button>
                   <!-- <input type="submit" name="edit" value='Izmeni' class="btn btn-success"><span class="glyphicon glyphicon-check"></span> -->
                    <br/><br/><br/>
                   
                    
                </form>
                    <!--POZIV AJAXA...ne funkcionise-->
                <script type='text/javascript'>
                  /*  $(document).ready(function() {
                        $("#editForm").submit(function() {		
                            $.ajax({
                                type: "POST",
                                url: 'edit.php',
                                data:$("#editForm").serialize(),
                                success: function (data) {	
                                    // Inserting html into the result div on success
                                    $('#message').show();
                                    $('#message').html(data);
                                }                        
                            });
                            return false;
                        });
                    });*/
                </script>
     
                </div>
     
            </div>
        </div>
    </div>

     <!-- Delete -->
     <div class="modal fade" id="delete_<?php echo $row['id_ulaz']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Izbrisi ulaz</h4></center>
                </div>
            <form action='crudProizvodi.php' method='POST'>
                <div class="modal-body">	
                	<p class="text-center">Da li ste sigurni da zelite da obrisete ulaz?</p>
    				<h2 class="text-center"><?php echo $row['naziv_proizvod'];?></h2>
    			</div>
                <input type='hidden' value='<?php echo $row['id_ulaz']?>' name='getIddelete'>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Odustani</button>
                    
                    <button type="submit" name="deleteUlaz" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Izbrisi</button>
                </div>
            </form>
            </div>
        </div>
    </div>