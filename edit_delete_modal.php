<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $row['id_proizvod']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Izmena proizvoda</h4></center>
                </div>
                <div class="modal-body">
    			<div class="container-fluid">
                <form method="POST" name='editForm' id='editForm' action="crudProizvodi.php">
                <!--<form method="POST" name='editForm' action="edit.php">-->
    				<div class="row form-group">
    					<div class="col-sm-2">
    						<label class="control-label" style="position:relative; top:7px;">Naziv:</label>
    					</div>
    					<div class="col-sm-10">
    						<input type="text" class="form-control crudInput" name="productName" id="productName" value="<?php echo $row['naziv_proizvod']; ?>" onKeyUp="proveraNaziv(this);">
                            <span id="spanNazivEdit"  class="mojaklasa"></span><br/><br/>
    					</div>
    				</div>

                    <div class="row form-group">
    				    <div class="col-sm-2">
    						<label class="control-label" style="position:relative; top:7px;">Jedinica:</label>
    					</div>
                        <div class="col-sm-10">
                            <?php
                                $database = new Connection();
                                $db = $database->open();

                                $sql = 'SELECT * FROM proizvodi';
                                            
                            ?>
                            <select name='ddlJedinica'  id='ddlJedinica' class='form-control crudInput'>
                                <option value="<?php echo $row['jedinica']; ?>"><?php echo $row['jedinica']; ?></option>
                                <option value='paket'>Paket</option>
                                <option value='komad'>Komad</option>
                                <option value='gram'>Gram</option>
                                <?php
                                    $database->close();    
                                ?>
                            </select>
    				    </div>
                    </div>

                    <div class="row form-group">
    				    <div class="col-sm-2">
    						<label class="control-label" style="position:relative; top:7px;">Kategorija:</label>
    					</div>
                        <div class="col-sm-10">
                            <?php
                                $database = new Connection();
                                $db = $database->open();

                                $sql = 'SELECT * FROM proizvodi';
                                            
                            ?>
                            <select name='ddlKategorija'  id='ddlKategorija' class='form-control crudInput'>
                                <option value="<?php echo $row['kategorija']; ?>"><?php echo $row['kategorija']; ?></option>
                                <option value='hrana'>Hrana</option>
                                <option value='higijena'>Higijena</option>
                                <option value='ostalo'>Ostalo</option>
                                <?php
                                    $database->close();    
                                ?>
                            </select>
    				    </div>
                    </div>

    				<div class="row form-group">
    					<div class="col-sm-2">
    						<label class="control-label" style="position:relative; top:7px;">Porez:</label>
    					</div>
    					<div class="col-sm-10">
                        <?php
                            $porez = $row['porez'];
                            
                        ?>
                        <select name='ddlPorezIzmena' id='ddlPorezEdit' class='form-control crudInput'onchange="proveraDdlPorez();">
                            <option value='10'<?php echo (!empty($porez) && $porez=='10') ? "selected='selected'": ""; ?>>10%</option>
                            <option value='18'<?php echo (!empty($porez) && $porez=='18') ? "selected='selected'": ""; ?>>18%</option>
                            <option value='20'<?php echo (!empty($porez) && $porez=='20') ? "selected='selected'": ""; ?>>20%</option>
                        </select>
    						
    					</div>
    				</div>
    				<div class="row form-group">
    					<div class="col-sm-2">
    						<label class="control-label" style="position:relative; top:7px;">Rabat:</label>
    					</div>
                        
    					<div class="col-sm-10">
                        <?php
                            $rabat = $row['rabat'];
                        ?>
                        <select name='ddlRabat' id='ddlRabatEdit' class='form-control crudInput' onchange="proveraDdlRabat();">
                            <option value='0'<?php echo (!empty($rabat) && $rabat=='0') ? "selected='selected'": ""; ?>>0%</option>
                            <option value='6'<?php echo (!empty($rabat) && $rabat=='6') ? "selected='selected'": ""; ?>>6%</option>
                            <option value='15'<?php echo (!empty($rabat) && $rabat=='15') ? "selected='selected'": ""; ?>>15%</option>
                        </select>
                           
    					</div>
    				</div>
                    <input type='hidden' value='<?php echo $row['id_proizvod']?>' name='getId'>
                </div> 
    			</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Odustani</button>
                    <button type="submit" name="edit" class="btn btn-success" onclick="provera(this);"><span class="glyphicon glyphicon-check"></span> Izmeni</button>
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
     <div class="modal fade" id="delete_<?php echo $row['id_proizvod']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Izbrisi proizvod</h4></center>
                </div>
            <form action='crudProizvodi.php' method='POST'>
                <div class="modal-body">	
                	<p class="text-center">Da li ste sigurni da zelite da obrisete proizvod?</p>
    				<h2 class="text-center"><?php echo $row['naziv_proizvod'];?></h2>
    			</div>
                <input type='hidden' value='<?php echo $row['id_proizvod']?>' name='getIddelete'>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Odustani</button>
                    
                    <button type="submit" name="delete" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Izbrisi</button>
                </div>
            </form>
            </div>
        </div>
    </div>